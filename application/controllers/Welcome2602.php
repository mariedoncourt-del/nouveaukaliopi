<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	//index
	public function index(){
		if($this->session->userdata('logged_in')){
				redirect('welcome/dashboard');
		}

		$this->form_validation->set_rules('idformation', 'ID-FORMATION', 'required');
		$data['message']=$this->session->flashdata('public_failed');

		if($this->form_validation->run() === FALSE){

			$this->load->view('header');
			$this->load->view('index',$data);
			$this->load->view('footer');

			}else{
				$id_formation = $this->input->post('idformation');

				$id_formation = $this->WelcomeModel->login_public($id_formation);

				if($id_formation){
					$user_data = array(
						'id_formation' => $id_formation,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					redirect('welcome/dashboard');
				}else{
					$this->session->set_flashdata('public_failed', 'ID Invalide');
					redirect('/');
				}		
			}
 	}

 	public function dashboard(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/dashboard',$data);
 		$this->load->view('welcome/footer',$data);
 	}


 	//support
 	public function support(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/dashboard');
		}

		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
		$data['supports']=$this->FormationModel->get_suports_apprenant($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/support',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//inidcateur
 	public function indicateur(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);


 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/indicateur',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//certification
 	public function certification(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['certificats']=$this->FormationModel->get_certificats();

 		$this->load->view('welcome/header',$data);
 	$this->load->view('welcome/certification',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//seance
 	public function seance(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['seances']=$this->FormationModel->get_seances($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_seance(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('numero', 'Numéro', 'required');
		$this->form_validation->set_rules('date_seance', 'Date', 'required');
		$this->form_validation->set_rules('horaire', 'Horaire', 'required');
	    $this->form_validation->set_rules('lieu', 'Lieu', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/seance');

 		}else{
        	if($this->FormationModel->add_seance($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/seance');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_seance(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('numero', 'Numéro', 'required');
		$this->form_validation->set_rules('date_seance', 'Date', 'required');
		$this->form_validation->set_rules('horaire', 'Horaire', 'required');
	    $this->form_validation->set_rules('lieu', 'Lieu', 'required');

	    

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/seance');

 		}else{
 			$id=$this->input->post('id');
 			if($this->FormationModel->update_seance($id,$id_formation)){
 				$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}else{
 				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}
 			redirect('welcome/seance');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_seance($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_seance($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}	
		redirect('/welcome/seance');
 	}

 	
 	//besoins
 	public function besoin(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['besoins']=$this->FormationModel->get_besoins($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/besoin',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_besoin(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('context', 'Numéro', 'required');
		$this->form_validation->set_rules('caractere', 'Caractéristique', 'required');
		$this->form_validation->set_rules('contenu', 'Contenu', 'required');
	    $this->form_validation->set_rules('ressource', 'Ressources', 'required');
	    $this->form_validation->set_rules('planning', 'Planning', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('welcome/besoin');

 		}else{
 			if($this->FormationModel->add_besoin($id_formation)){
 				$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}else{
 				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}
 			redirect('welcome/besoin');
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/besoin',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_besoin(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');


		$this->form_validation->set_rules('context', 'Numéro', 'required');
		$this->form_validation->set_rules('caractere', 'Caractéristique', 'required');
		$this->form_validation->set_rules('contenu', 'Contenu', 'required');
	    $this->form_validation->set_rules('ressource', 'Ressources', 'required');
	    $this->form_validation->set_rules('planning', 'Planning', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('welcome/besoin');

 		}else{
 			$id=$this->input->post('id');

        	if($this->FormationModel->update_besoin($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/besoin');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_besoin($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_besoin($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/welcome/besoin');
 	}

 	
 	//scenario
 	public function scenario(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['scenarios']=$this->FormationModel->get_scenarios($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/scenario',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_scenario(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('unite', 'Unité', 'required');
		$this->form_validation->set_rules('titre', 'Titre', 'required');
		$this->form_validation->set_rules('activite[]', 'Activité', 'required');
	    $this->form_validation->set_rules('media[]', 'Média', 'required');
	    $this->form_validation->set_rules('just_media', 'Justification média', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/scenario');

 		}else{

        	if($this->FormationModel->add_scenario($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/scenario');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_scenario(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('unite', 'Unité', 'required');
		$this->form_validation->set_rules('titre', 'Titre', 'required');
		$this->form_validation->set_rules('activite[]', 'Activité', 'required');
	    $this->form_validation->set_rules('media[]', 'Média', 'required');
	    $this->form_validation->set_rules('just_media', 'Justification média', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/scenario');

 		}else{
 			
 			$id=$this->input->post('id');


        	if($this->FormationModel->update_scenario($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/scenario');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_scenario($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_scenario($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		}
		redirect('/welcome/scenario');
 	}


 	//evaluation
 	public function evaluation(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['evaluations']=$this->FormationModel->get_evaluations($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_evaluation(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('titre', 'Intitulé de la connaissance', 'required');
	    

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/evaluation');

 		}else{
 			if($this->FormationModel->add_evaluation($id_formation)){
 				$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}else{
 				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			}
 			redirect('welcome/evaluation');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_evaluation(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('titre', 'Intitulé de la connaissance', 'required');
	    

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('welcome/evaluation');

 		}else{
 			$id=$this->input->post('id');

        	if($this->FormationModel->update_evaluation($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/evaluation');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_evaluation($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_evaluation($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/welcome/evaluation');
 	}

 	
 	//qcm
 	public function qcm(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['qcms']=$this->FormationModel->get_qcms($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/qcm',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	
 	//video
 	public function video(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['videos']=$this->FormationModel->get_videos($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/video',$data);
 		$this->load->view('welcome/footer',$data);
 	}


 	//evaluation projet
 	public function eval_pro(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['eval_pros']=$this->FormationModel->get_evaluations_pro($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation_pro',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_evaluation_pro(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('titre', 'Titre du projet', 'required');
	    

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/eval_pro');

 		}else{

 			$count = count($_FILES['pj']['name']);
 			$total_files=[];

 			for($i=0;$i<=$count;$i++){
 				if(!empty($_FILES['pj']['name'][$i])){
 					//book file upload


 				$_FILES['file']['name'] = $_FILES['pj']['name'][$i];
          		$_FILES['file']['type'] = $_FILES['pj']['type'][$i];
         		$_FILES['file']['tmp_name'] = $_FILES['pj']['tmp_name'][$i];
          		$_FILES['file']['error'] = $_FILES['pj']['error'][$i];
          		$_FILES['file']['size'] = $_FILES['pj']['size'][$i];

				$config_file['upload_path']='./assets/pj/';
				$config_file['allowed_types']='pdf|docx|jpg|png|gif|zip|rar|7z';
				$config_file['file_name']=$_FILES['pj']['name'][$i];
				$this->load->library('upload',$config_file);
				$this->upload->initialize($config_file);
				if($this->upload->do_upload('file')){
					$upload_data=$this->upload->data();
					$pj=$upload_data['file_name'];
					$total_files[]=$pj;

				}else{
					$pj="";
				}
 				}
 				
 			}

        	if($this->FormationModel->add_evaluation_pro($id_formation,$total_files)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/eval_pro');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/eval_pro',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_evaluation_pro(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('titre', 'Intitulé de la connaissance', 'required');

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('titre', 'Titre du projet', 'required');
	    

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/eval_pro');

 		}else{

 			$count = count($_FILES['pj']['name']);
 			$total_files=[];

 			for($i=0;$i<=$count;$i++){
 				if(!empty($_FILES['pj']['name'][$i])){
 					//book file upload

 				$_FILES['file']['name'] = $_FILES['pj']['name'][$i];
          		$_FILES['file']['type'] = $_FILES['pj']['type'][$i];
         		$_FILES['file']['tmp_name'] = $_FILES['pj']['tmp_name'][$i];
          		$_FILES['file']['error'] = $_FILES['pj']['error'][$i];
          		$_FILES['file']['size'] = $_FILES['pj']['size'][$i];

				$config_file['upload_path']='./assets/pj/';
				$config_file['allowed_types']='pdf|docx|jpg|png|gif|zip|rar|7z';
				$config_file['file_name']=$_FILES['pj']['name'][$i];
				$this->load->library('upload',$config_file);
				$this->upload->initialize($config_file);
				if($this->upload->do_upload('file')){
					$upload_data=$this->upload->data();
					$pj=$upload_data['file_name'];
					$total_files[]=$pj;

				}else{
					$pj="";
				}
 				}
 				
 			}

 			$id=$this->input->post('id');


        	if($this->FormationModel->update_evaluation_pro($id,$id_formation,$total_files)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/eval_pro');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/eval_pro',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_evaluation_pro($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_evaluation_pro($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/welcome/eval_pro');
 	}


 	//evaluation note	
 	public function eval_note(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation_moyenne',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_eval_note(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('note', 'NOTE', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/eval_note');

 		}else{
        	
        	if($this->FormationModel->update_evaluation_note($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/eval_note');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation',$data);
 		$this->load->view('welcome/footer',$data);
 	}


 	//evaluation chaud
 	public function eval_hot(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['eval_field_name']=['Communication des objectifs et du programme avant la formation',
 							  'Organisation et déroulement de la formation',
 							  'Adéquation des moyens matériels mis à disposition',
 							  'Conformité de la formation dispensée au programme',
 							  'Clarté du contenu',
 							  'Qualité des supports pédagogiques',
 							  'Animation de la formation par le ou les intervenants',
 							  'Progression de la formation (durée, rythme, alternance théorie/pratique) '];
 		$data['sati_field_name']=['La formation a-t-elle répondu à vos attentes initiales ?',
 							  'Pensez-vous avoir atteint les objectifs pédagogiques prévus lors de la formation ?',
 							  'Estimez-vous que la formation était en adéquation avec le métier ou les réalités du secteur ?',
 							  'Recommanderiez-vous ce stage à une personne exerçant le même métier que vous ?'];

 	 	if($this->WelcomeModel->eval_hot_exist($id_formation)){
 			//
 		}else{
 			$this->FormationModel->add_evaluation_hot($id_formation);
 		}

 		$data['eval_hot']=$this->FormationModel->get_evaluations_hot($id_formation);
 	

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/evaluation_hot',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_eval_hot(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');

		$this->form_validation->set_rules('id', 'ID', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/eval_hot');

 		}else{
 			$id=$this->input->post('id');

        	if($this->FormationModel->update_evaluation_hot($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/eval_hot');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/eval_hot',$data);
 		$this->load->view('welcome/footer',$data);
 	}
 	

 	//questionnaire
 	public function questionnaire(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['questions']=$this->FormationModel->get_questions($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/questionnaire',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function create_question(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');
		$this->form_validation->set_rules('attente_01','Votre attente','required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('welcome/questionnaire');

 		}else{
        	if($this->FormationModel->add_question($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/questionnaire');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/questionnaire',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function update_question(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		$id_formation=$this->session->userdata('id_formation');
		$this->form_validation->set_rules('attente_01','Votre attente','required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('welcome/questionnaire');

 		}else{
 			$id=$this->input->post('id');
        	
        	if($this->FormationModel->update_question($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('welcome/questionnaire');
        	
 		}

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/seance',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	public function delete_question($id){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

		if($this->FormationModel->delete_question($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/welcome/questionnaire');
 	}


 	//emargement
 	public function emargement(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/emargement',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//cv
 	public function cv(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['prof']=$this->FormationModel->get_prof($data['formation']['prof_id']);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/cv',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//veilles
 	public function veille(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['archives']=$this->FormationModel->get_all_veilles();
 		
 		$data['feed_one'] = new SimpleXMLElement('https://www.centre-inffo.fr/category/site-centre-inffo/actualites-centre-inffo/le-quotidien-de-la-formation-actualite-formation-professionnelle-apprentissage/feed', null, true);
 		$data['feed_two'] = new SimpleXMLElement('https://www.centre-inffo.fr/category/actualites-droit/feed', null, true);
 		$data['feed_three'] = new SimpleXMLElement('https://www.conseilsmarketing.com/feed/', null, true);
 		$data['feed_four'] = new SimpleXMLElement('https://www.journaldunet.com/rss/', null, true);
 		$data['feed_tech'] = new SimpleXMLElement('https://moodle.com/feed/', null, true);
 		$data['feed_hyg'] = new SimpleXMLElement('https://www.economie.gouv.fr/dgccrf/rss', null, true);
 		$data['feed_ginter'] = new SimpleXMLElement('https://www.groupeinteractions.fr/feed/', null, true);

 		$data['handicap_url'] = 'https://innovation.agefiph.fr/actualites-et-evenements';
 		$data['handicap_title'] = 'Actualités et événements - Agefiph';
 		
 		$data['compta_url'] = 'https://www.efl.fr/archives';
 		$data['compta_title'] = 'https://www.efl.fr/archives';
 		
 		
 		$data['certif_urls'] = [
 			['title'=>'Leveltel','url'=>'https://leveltel.com/l/FR/actu'],
 			['title'=>'Moncompteformation.gouv.fr','url'=>'https://www.of.moncompteformation.gouv.fr/liste/Actualites?th%5B0%5D=thematique%3A50']
 		];


 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/veille',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//archives veilles
 	public function archive($category=null){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['veilles']=$this->FormationModel->get_veilles($category);

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/archive',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//abandon
 	public function abandon(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);


 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/abandon',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//espace documentaire
 	public function documentaire(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['documents']=$this->FormationModel->get_documents();

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/documentaire',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//contact
 	public function contact(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		//$data['documents']=$this->FormationModel->get_documents();
 		$data['contacts']=$this->FormationModel->get_contacts();

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/contact',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//reclamation
 	public function reclamation(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}

 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[60]');
 		$this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[12]|max_length[200]');

 		//Run form validation
    	if ($this->form_validation->run() === FALSE)
   		{
        	$this->load->view('welcome/header',$data);
        	$this->load->view('welcome/reclamation',$data);
        	$this->load->view('welcome/footer',$data);
    	} else {

	        	//Get the form data
	        $nom = $data['formation']['nom_apprenant'];
	        $reclamation = utf8_encode(htmlentities($this->input->post('reclamation'), ENT_QUOTES, "UTF-8"));
	        $from_email = $this->input->post('email');
	        $objet = $this->input->post('objet');
	        $message = $this->input->post('message');

	        $to_email = 'maformationsas@gmail.com'; //Webmaster email, who receive mails
	        //$to_email = 'rgmickael@gmail.com'; //Webmaster email, who receive mails

	        $config['protocol'] = 'smtp';
	        $config['smtp_host'] = 'ssl://smtp.gmail.com';
	        $config['smtp_port'] = '465';
	        $config['smtp_user'] = 'harenadesign@gmail.com'; // Your email address
	        $config['smtp_pass'] = 'harena2021'; // Your email account password
	        $config['mailtype'] = 'html'; // or 'text'
	        $config['charset'] = 'utf-8';
	        $config['wordwrap'] = TRUE; //No quotes required
	        $config['newline'] = "\r\n"; //Double quotes required

	        $this->email->initialize($config);                        

	        //Send mail with data
	        $this->email->from($from_email, utf8_encode(htmlentities($nom, ENT_QUOTES, "UTF-8"))." - KALIOPI");
	        $this->email->to($to_email);
	        $this->email->subject($objet." ".$reclamation);
	        $this->email->message(utf8_encode(htmlentities($message, ENT_QUOTES, "UTF-8")));

	        //echo $reclamation;die();
        
        	if ($this->email->send()){
            	$this->session->set_flashdata('msg','<br><div class="alert alert-success">Reclamation envoyé</div>');

            	redirect('welcome/reclamation');
        	} else {
            	$this->session->set_flashdata('msg','<br><div class="alert alert-danger">Non envoyé</div>');
            	$this->load->view('welcome/header',$data);
            	$this->load->view('welcome/reclamation',$data);
            	$this->load->view('welcome/footer',$data);
        	}

    	}
 	}

 	//handicap
 	public function handicap(){
 		if(!$this->session->userdata('logged_in')){
				redirect('welcome/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['documents']=$this->FormationModel->get_handicaps();

 		$this->load->view('welcome/header',$data);
 		$this->load->view('welcome/handicap',$data);
 		$this->load->view('welcome/footer',$data);
 	}

 	//logout
 	public function logout_public(){
 		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id_formation');
			
		redirect('welcome');
 	}
}
