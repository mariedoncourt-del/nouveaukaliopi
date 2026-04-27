<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prof extends CI_Controller {

	public function index(){
		if($this->session->userdata('logged_prof')){
				redirect('prof/dashboard');
		}else{

		$this->form_validation->set_rules('login', 'login', 'required');
		$this->form_validation->set_rules('password', 'mot de passse', 'required');
		$data['message']=$this->session->flashdata('login_failed');

		if($this->form_validation->run() === FALSE){

			$this->load->view('prof/index',$data);

			}else{
				// SECURITY P0.1 + P1.1 - Idem que Admin::index() : plus de md5(), rate limiting actif
				$this->load->library('rate_limiter');
				$ip = $this->input->ip_address();
				if (!$this->rate_limiter->allow('prof_login', $ip, 5, 900)) {
					log_message('warning', 'Rate limit dépassé pour prof login depuis IP ' . $ip);
					$this->session->set_flashdata('login_failed', 'Trop de tentatives. Réessayez dans 15 minutes.');
					redirect('/prof/index');
					return;
				}

				$login = $this->input->post('login');
				$password = $this->input->post('password'); // Plus de md5() ici - le modèle gère bcrypt

				$loginid = $this->WelcomeModel->login_admin($login, $password);

				if($loginid){
					$this->session->sess_regenerate(TRUE);

					$user_data = array(
						'user_id' => $loginid,
						'logged_prof' => true,
						'login_time' => time(),
						'login_ip'   => $ip
					);

					$this->session->set_userdata($user_data);
					$this->rate_limiter->reset('prof_login', $ip);

					log_message('info', 'Connexion prof réussie : ' . $login . ' depuis ' . $ip);
					redirect('prof/dashboard');
				}else{
					log_message('warning', 'Échec connexion prof login=' . $login . ' depuis ' . $ip);
					$this->session->set_flashdata('login_failed', 'Login ou mot de passe invalide');
					redirect('/prof/index');
				}		
			}
		}
 	}

 	public function logout_admin(){
 		$this->session->unset_userdata('logged_admin');
		$this->session->unset_userdata('user_id');
			
		redirect('admin');
 	}

 	public function dashboard(){
 		if(!$this->session->userdata('logged_prof')){
				redirect('prof/index');
		}
 		$id_formation=$this->session->userdata('user_id');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->load->view('prof/header',$data);
 		//$this->load->view('welcome/main',$data);
 		$this->load->view('prof/footer',$data);
 	}

 	public function formation(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$data['formations']=$this->FormationModel->get_formations();
 		$data['profs']=$this->FormationModel->get_profs();
 		$data['les_cours']=$this->FormationModel->get_cours();
 		$data['apprenants']=$this->FormationModel->get_apprenants();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/formation',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function resume_formation($id_formation){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['seances']=$this->FormationModel->get_seances($id_formation);
 		$data['besoins']=$this->FormationModel->get_besoins($id_formation);
 		$data['evaluations']=$this->FormationModel->get_evaluations($id_formation);
 		$data['scenarios']=$this->FormationModel->get_scenarios($id_formation);

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/btnpdf');
 		$this->load->view('admin/resume',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function resumepdf($id_formation){
		$this->load->library('pdf');
		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['seances']=$this->FormationModel->get_seances($id_formation);
 		$data['besoins']=$this->FormationModel->get_besoins($id_formation);
 		$data['evaluations']=$this->FormationModel->get_evaluations($id_formation);
 		$data['scenarios']=$this->FormationModel->get_scenarios($id_formation);

 		$name=strval('resume-'.$id_formation);



        $html = $this->load->view('admin/resumepdf', $data, true);
        $this->pdf->createPDF($html, $name);
	}

 	public function create_formation(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$this->form_validation->set_rules('apprenant', 'Apprenant', 'required');
		$this->form_validation->set_rules('prof', 'Prof', 'required');
		$this->form_validation->set_rules('cours', 'Cours', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/formation');
 		}else{

 			$apprenant=$this->FormationModel->get_apprenant($this->input->post('apprenant'));
 			$cours=$this->FormationModel->get_le_cours($this->input->post('cours'));

 			//var_dump($cours);die();

 			$id_formation=$apprenant['nom']."-".$cours['id'];
 			//echo $id_formation;die();
 			$emargement="";

 			$url = 'https://script.google.com/macros/s/AKfycbywMBu9pEuNZWQAmfJG_wsouwl2rjt7zNsFpzb13e6slvnmz_-qkTlbVECqY1ou5FIz/exec?idFormation='.$id_formation;

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			$emargement = curl_exec($curl);
			
			

			if($emargement==""){
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger">Stage existant</div>');
			}else{
				$this->session->set_flashdata('msg','<br><div class="alert alert-success">Stage ajouté</div>');
				$this->FormationModel->add_formation($id_formation, $emargement);
			}

			curl_close($curl);
        	
 			redirect('admin/formation');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_formation(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$this->form_validation->set_rules('apprenant', 'Apprenant', 'required');
		$this->form_validation->set_rules('prof', 'Prof', 'required');
		$this->form_validation->set_rules('cours', 'Cours', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/formation');
 		}else{

 			$id_formation=$this->input->post('id');

			if($this->FormationModel->update_formation($id_formation)){
				$this->session->set_flashdata('msg','<br><div class="alert alert-success">Stage modifié</div>');
			}
        	
 			redirect('admin/formation');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}



 	public function delete_formation($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$this->FormationModel->delete_formation($id);	
		redirect('/admin/formation');
 	}

 	public function recrutement(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/'],
 			['titre'=>'Monster','url'=>'https://www.monster.fr/'],
 			['titre'=>'France Emploi','url'=>'https://www.france-emploi.com/'],
 			['titre'=>'Keljob','url'=>'https://www.keljob.com/'],
 			['titre'=>'Apec','url'=>'https://www.apec.fr/'],
 			['titre'=>'Jooble','url'=>'https://fr.jooble.org/'],
 			['titre'=>'Region Job','url'=>'https://www.regionsjob.com/'],
 			['titre'=>'Pole Emploi','url'=>'https://www.pole-emploi.fr/accueil/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/recrutement',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function livret(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/livret',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function selection(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/selection',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function contrat(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/contrat',$data);
 		$this->load->view('admin/footer',$data);
 	}


 	public function prof(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['profs']=$this->FormationModel->get_profs();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/prof',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_prof(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/apprenant');
 		}else{

        	//book file upload
				$config_file['upload_path']='./assets/cv/';
				$config_file['allowed_types']='pdf';
				$this->load->library('upload',$config_file);
				$this->upload->initialize($config_file);
				if($this->upload->do_upload('cv')){
					$upload_data=$this->upload->data();
					$pdf=$upload_data['file_name'];
				}else{
					$pdf="";
				}

        	$this->FormationModel->add_prof($pdf);
 			redirect('admin/prof');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_prof(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/apprenant');
 		}else{

        	//book file upload
				$config_file['upload_path']='./assets/cv/';
				$config_file['allowed_types']='pdf';
				$this->load->library('upload',$config_file);
				$this->upload->initialize($config_file);
				if($this->upload->do_upload('cv')){
					$upload_data=$this->upload->data();
					$pdf=$upload_data['file_name'];
				}else{
					$pdf="";
				}

			$id=$this->input->post('id');
        	$this->FormationModel->update_prof($pdf,$id);
 			redirect('admin/prof');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}



 	public function delete_prof($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->FormationModel->delete_prof($id);	
		redirect('/admin/prof');
 	}

 	public function apprenant(){
 		/*if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}*/
 		$data['apprenants']=$this->FormationModel->get_apprenants();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_apprenant(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/apprenant');
 		}else{
        	$this->FormationModel->add_apprenant();
 			redirect('admin/apprenant');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_apprenant(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('prenom', 'Prenom', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/apprenant');
 		}else{
        	$id=$this->input->post('id');
        	$this->FormationModel->update_apprenant($id);
 			redirect('admin/apprenant');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_apprenant($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$this->FormationModel->delete_apprenant($id);	
		redirect('/admin/apprenant');
 	}

 	public function cours(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$data['les_cours']=$this->FormationModel->get_cours();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/cours',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_cours(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('id_cours', 'ID-COURS', 'required');
		$this->form_validation->set_rules('titre', 'Titre', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/cours');
 		}else{
        	$this->FormationModel->add_cours();
 			redirect('admin/cours');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/cours',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_cours(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('id_cours', 'ID-COURS', 'required');
		$this->form_validation->set_rules('titre', 'Titre', 'required');

 		if(!$this->form_validation->run()){
 			redirect('admin/cours#editCours');
 		}else{
 			$id=$this->input->post('id_key');
 			$this->FormationModel->update_cours($id);
 			redirect('admin/cours');
 		}
 	}

 	public function delete_cours($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->FormationModel->delete_cours($id);	
		redirect('/admin/cours');
 	}
}
