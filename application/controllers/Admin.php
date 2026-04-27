<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	//main navigation
	public function index(){
		if($this->session->userdata('logged_admin')){
				redirect('admin/dashboard');
		}else{

		$this->form_validation->set_rules('login', 'login', 'required');
		$this->form_validation->set_rules('password', 'mot de passse', 'required');
		$data['message']=$this->session->flashdata('login_failed');

		if($this->form_validation->run() === FALSE){

			$this->load->view('admin/index',$data);

			}else{
				// SECURITY P0.1 - Le mot de passe est désormais transmis en clair au modèle
				// qui se charge lui-même de la vérification bcrypt + migration MD5 transparente.
				// SECURITY P1.1 - Rate limiting (5 tentatives / 15 min / IP)
				$this->load->library('rate_limiter');
				$ip = $this->input->ip_address();
				if (!$this->rate_limiter->allow('admin_login', $ip, 5, 900)) {
					log_message('warning', 'Rate limit dépassé pour admin login depuis IP ' . $ip);
					$this->session->set_flashdata('login_failed', 'Trop de tentatives. Réessayez dans 15 minutes.');
					redirect('/admin/index');
					return;
				}

				$login = $this->input->post('login');
				$password = $this->input->post('password'); // Plus de md5() ici

				$loginid = $this->WelcomeModel->login_admin($login, $password);

				// Audit log P1.6 : traçabilité authentification (RGPD article 32)
				$this->load->library('audit_log');

				if($loginid){
					// SECURITY - Régénération de l'ID de session après authentification (anti session-fixation)
					$this->session->sess_regenerate(TRUE);

					$user_data = array(
						'user_id' => $loginid,
						'logged_admin' => true,
						'login_time' => time(),
						'login_ip'   => $ip
					);

					$this->session->set_userdata($user_data);
					$this->rate_limiter->reset('admin_login', $ip);

					$this->audit_log->record('admin.login.success', [
						'table_name' => 'admin',
						'record_id'  => $loginid,
					]);

					log_message('info', 'Connexion admin réussie : ' . $login . ' depuis ' . $ip);
					redirect('admin/dashboard');
				}else{
					$this->audit_log->record('admin.login.failure', [
						'table_name' => 'admin',
						'record_id'  => $login,
					]);
					log_message('warning', 'Échec connexion admin login=' . $login . ' depuis ' . $ip);
					$this->session->set_flashdata('login_failed', 'Login ou mot de passe invalide');
					redirect('/admin/index');
				}		
			}
		}
 	}

 	public function logout_admin(){
 		// Audit log P1.6 : traçabilité déconnexion (RGPD article 32)
 		$user_id = $this->session->userdata('user_id');
 		if ($user_id) {
 			$this->load->library('audit_log');
 			$this->audit_log->record('admin.logout', [
 				'table_name' => 'admin',
 				'record_id'  => $user_id,
 			]);
 		}
 		$this->session->unset_userdata('logged_admin');
		$this->session->unset_userdata('user_id');
			
		redirect('admin');
 	}

 	public function dashboard(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$id_formation=$this->session->userdata('user_id');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/dashboard',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	//veilles
 	public function veille(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
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


 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/veille',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	//archives veilles
 	public function archive($category=null){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$id_formation=$this->session->userdata('id_formation');
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['veilles']=$this->FormationModel->get_veilles($category);

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/archive',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	//programmes
 	public function programme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
		$this->load->helper('file');

		/*$file_path=base_url('/assets/files/programmes/lines.txt');
		$data['programmes'] = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);*/
		$data['programmes']=$this->FormationModel->get_programmes();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/programmes',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function gestion_programme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['programmes']=$this->FormationModel->get_programmes();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_programme',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_programme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/gestion_programme');
 		}else{

			// SECURITY P1.4 - Upload sécurisé via Secure_upload (whitelist MIME, renommage aléatoire, .htaccess deny PHP)
			$this->load->library('secure_upload');
			$result = $this->secure_upload->process('link', 'programme', './assets/programmes/');
			$pdf = $result['success'] ? $result['file_name'] : "";
			if (!$result['success'] && $result['error']) {
				log_message('warning', 'Upload programme refusé : ' . $result['error']);
			}

        	if($this->FormationModel->add_programme($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_programme');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_programme',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_programme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/gestion_programme');
 		}else{

			// SECURITY P1.4 - Upload sécurisé via Secure_upload
			$this->load->library('secure_upload');
			$result = $this->secure_upload->process('link', 'programme', './assets/programmes/');
			$pdf = $result['success'] ? $result['file_name'] : "";
			if (!$result['success'] && $result['error']) {
				log_message('warning', 'Upload programme (update) refusé : ' . $result['error']);
			}

			$id=$this->input->post('id');

        	if($this->FormationModel->update_programme($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_programme');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_programme',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_programme($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_programme($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_programme');
 	}

 	//formations
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

 	public function dossier_tr(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$data['formations']=$this->FormationModel->get_formations();
 		$data['profs']=$this->FormationModel->get_profs();
 		$data['les_cours']=$this->FormationModel->get_cours();
 		$data['apprenants']=$this->FormationModel->get_apprenants();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/dossier_tr',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_formation(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$this->form_validation->set_rules('apprenant', 'Apprenant', 'required');
		$this->form_validation->set_rules('prof', 'Prof', 'required');
		$this->form_validation->set_rules('cours', 'Cours', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/formation');
 		}else{

 			$apprenant=$this->FormationModel->get_apprenant($this->input->post('apprenant'));
 			$cours=$this->FormationModel->get_le_cours($this->input->post('cours'));
 			$prof=$this->FormationModel->get_prof($this->input->post('prof'));

 			//var_dump($cours);die();

 			$id_formation=$apprenant['nom']."-".rand(1,10)."-".$cours['id'];
 			$id_formation=str_replace(' ','',$id_formation);
 			//$string = str_replace(' ', '', $string);
 			//echo $id_formation;die();
 			$emargement="";
 			$formateur_name=str_replace(' ','%20',$prof['nom']);
 			$apprenant_name=str_replace(' ','%20',$apprenant['nom']);
 			$apprenant_pre=str_replace(' ','%20',$apprenant['prenom']);
 			$formation_name=str_replace(' ','%20', $cours['titre']);
 			

 			$url = 'https://script.google.com/macros/s/AKfycby587WUDtf8W3r3_pCsXmokdfGNAIJm0S7gRK0d/exec?idFormation='.$id_formation.'&formateurName='.$formateur_name.'&formationName='.$formation_name.'&apprenantName='.$apprenant_name.'&apprenantPre='.$apprenant_pre;


			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			$emargement = curl_exec($curl);
			

			if($emargement==""){
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger">Stage existant</div>');
			}else{
				if($this->FormationModel->add_formation($id_formation, $emargement)){
					$this->session->set_flashdata('msg','<br><div class="alert alert-success">Stage ajouté</div>');
				}else{
					$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}

			curl_close($curl);
			//attestation
			$id_formation_para='ATTESTATION-'.$id_formation;		

			$url_sec = 'https://script.google.com/macros/s/AKfycbwynC9lClkdbezE8sOaub9sCOYMbbOX3dmp1fdEpcn5LfaE3cACv2tIW90mqwRj_YrG/exec?idFormation='.$id_formation_para.'&apprenantName='.$apprenant_name.'&apprenantPre='.$apprenant_pre;


			$curl_sec = curl_init();
			curl_setopt($curl_sec, CURLOPT_URL, $url_sec);
			curl_setopt($curl_sec, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($curl_sec, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_sec, CURLOPT_FOLLOWLOCATION, true);
			$attestation = curl_exec($curl_sec);			

			if($attestation==""){
				echo '<p style="color:red">NO</p><br>';
			}else{
				echo '<p style="color:green">OK</p><br>';
				$this->FormationModel->update_drive($id_formation, $attestation);
			}
			echo '<br>';
			echo $attestation.'<br>';
			echo $url_sec.'<br>';
			curl_close($curl_sec);
			//die();
 
 			
			//finally
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/formation');
 		}else{

 			$id_formation=$this->input->post('id');

			if($this->FormationModel->update_formation($id_formation)){
				$this->session->set_flashdata('msg','<br><div class="alert alert-success">Stage modifié</div>');
			}else{
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}
        	
 			redirect('admin/formation');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/formation',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_formation($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		// Audit log P1.6 : capturer l'état avant suppression
		$this->load->library('audit_log');
		$row_before = $this->FormationModel->get_formation($id);

		if($this->FormationModel->delete_formation($id)){
			$this->audit_log->record('formation.delete', [
				'table_name'  => 'formation',
				'record_id'   => $id,
				'data_before' => $row_before,
			]);
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/formation');
 	}

 	public function resume_formation($id_formation){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}
 		$data['formation']=$this->FormationModel->get_formation($id_formation);
 		$data['seances']=$this->FormationModel->get_seances($id_formation);
 		$data['besoins']=$this->FormationModel->get_besoins($id_formation);
 		$data['questions']=$this->FormationModel->get_questions($id_formation);
 		$data['evaluations']=$this->FormationModel->get_evaluations($id_formation);
 		$data['eval_pros']=$this->FormationModel->get_evaluations_pro($id_formation);
 		$data['scenarios']=$this->FormationModel->get_scenarios($id_formation);

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
 		$data['eval_pros']=$this->FormationModel->get_evaluations_pro($id_formation);

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

 		$data['eval_hot']=$this->FormationModel->get_evaluations_hot($id_formation);
 		$data['questions']=$this->FormationModel->get_questions($id_formation);


 		$name=strval('resume-'.$id_formation);


        $html = $this->load->view('admin/resumepdf', $data, true);



        $this->pdf->createPDF($html, $name);

        //$this->load->view('admin/resumepdf', $data);
	}


	//recrutement
 	public function recrutement(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['recrutements']=$this->FormationModel->get_recrutements();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/recrutement',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function gestion_recrutement(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['recrutements']=$this->FormationModel->get_recrutements();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_recrutement',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_recrutement(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_recrutement');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'cv_etendu', './assets/recrutements/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload recrutements refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_recrutement($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_recrutement');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_recrutement',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_recrutement(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_recrutement');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'cv_etendu', './assets/recrutements/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload recrutements refusé : ' . $_su_result['error']);
				}

			

			$id=$this->input->post('id');
			if($this->FormationModel->update_recrutement($pdf,$id)){
				$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}else{
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}
 			redirect('admin/gestion_recrutement');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_recrutement',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_recrutement($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_recrutement($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_recrutement');
 	}

 	//documentaires
 	public function gestion_documentaire(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['documents']=$this->FormationModel->get_documents();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_documentaire',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_document(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_documentaire');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/documents/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload documents refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_document($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_documentaire');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_document(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_documentaire');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/documents/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload documents refusé : ' . $_su_result['error']);
				}


			$id=$this->input->post('id');
        	if($this->FormationModel->update_document($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_documentaire');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_document($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_document($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_documentaire');
 	}

 	//handicap
 	//documentaires
 	public function gestion_handicap(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['documents']=$this->FormationModel->get_handicaps();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_handicap',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_handicap(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/gestion_handicap');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/handicap/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload handicap refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_handicap($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        	}
 			redirect('admin/gestion_handicap');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_handicap',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_handicap(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_handicap');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/handicap/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload handicap refusé : ' . $_su_result['error']);
				}

			

			$id=$this->input->post('id');
        	if($this->FormationModel->update_handicap($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_handicap');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_handicap($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_handicap($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

		}
		redirect('/admin/gestion_handicap');
 	}


 	//organigramme
 	public function organigramme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['organigramme']=$this->FormationModel->get_organigramme();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/organigramme',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_organigramme(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('id', 'ID', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/organigramme');	
 		}else{

 			// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('orga', 'image', './assets/organigramme/');
				$img = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload organigramme refusé : ' . $_su_result['error']);
				}


        	if($this->FormationModel->update_organigramme($img)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/organigramme');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}


 	//reclamation
 	public function reclamation(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/reclamation',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	//tuto
 	public function tuto(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/tuto',$data);
 		$this->load->view('admin/footer',$data);
 	}


 	//procedures
 	public function procedure(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$data['procedures']=$this->FormationModel->get_procedures();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/procedure');
 		$this->load->view('admin/footer',$data);
 	}

 	public function gestion_procedure(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['procedures']=$this->FormationModel->get_procedures();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_procedure',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_procedure(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/gestion_procedure');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/procedures/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload procedures refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_procedure($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_procedure');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_procedure(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_procedure');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/procedures/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload procedures refusé : ' . $_su_result['error']);
				}

			

			$id=$this->input->post('id');
        	if($this->FormationModel->update_procedure($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_procedure');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_procedure($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_procedure($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}else{
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}
		redirect('/admin/gestion_procedure');
 	}

 	//certification
 	public function certification(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

 		$data['certificats']=$this->FormationModel->get_certificats();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/certification',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function gestion_certificat(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['certificats']=$this->FormationModel->get_certificats();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_certificat',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_certificat(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

 			redirect('admin/gestion_certificat');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/certificat/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload certificat refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_certificat($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_certificat');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_certificat(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		//$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_certificat');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'scenario', './assets/certificat/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload certificat refusé : ' . $_su_result['error']);
				}

			

			$id=$this->input->post('id');
        	if($this->FormationModel->update_certificat($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_certificat');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_certificat($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_certificat($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_certificat');
 	}


 	//indicateur
 	public function indicateur(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		$data['links']=[
 			['titre'=>'Linkedin','url'=>'https://fr.linkedin.com/'],
 			['titre'=>'Viadeo','url'=>'http://www.viadeo.com/']
 		];

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/indicateur');
 		$this->load->view('admin/footer',$data);
 	}


 	//support
 	public function support(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}

		/*$url="https://formacall.fr/kaliopi.php";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		$response = curl_exec($curl);

		$data['supports']=json_decode($response,true);*/

		$data['supports']=$this->FormationModel->get_supports();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/support',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function gestion_support(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['supports']=$this->FormationModel->get_supports();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_support',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_support(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_support');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'support', './assets/support/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload support refusé : ' . $_su_result['error']);
				}

        	if($this->FormationModel->add_support($pdf)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_support');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_support(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('nom', 'Titre', 'required');
		$this->form_validation->set_rules('category', 'Categorie', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_support');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('link', 'support', './assets/support/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload support refusé : ' . $_su_result['error']);
				}

			

			$id=$this->input->post('id');
        	if($this->FormationModel->update_support($pdf,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_support');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_support($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_support($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_support');
 	}

 	//qcm
 	public function gestion_qcm(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['qcms']=$this->FormationModel->get_les_qcms();
 		$data['formations']=$this->FormationModel->get_formations();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_qcm',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_qcm(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('titre', 'Titre du QCM', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_qcm');
 		}else{

 			$id_formation=$this->input->post('id_formation');
 			$type=$this->input->post('id_type');
        	if($this->FormationModel->add_qcm($id_formation, $type)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_qcm');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_qcm(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('titre', 'Titre du QCM', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_qcm');
 		}else{
			
			$id=$this->input->post('id');
			$id_formation=$this->input->post('id_formation');

        	if($this->FormationModel->update_qcm($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_qcm');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_qcm($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		// Audit log P1.6 : Qualiopi indicateur 32 - traçabilité actions pédagogiques
		$this->load->library('audit_log');

		if($this->FormationModel->delete_qcm($id)){
			$this->audit_log->record('qcm.delete', [
				'table_name' => 'qcm',
				'record_id'  => $id,
			]);
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_qcm');
 	}


 	//contact
 	public function gestion_contact(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['contacts']=$this->FormationModel->get_contacts();
 		//$data['formations']=$this->FormationModel->get_formations();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_contact',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_contact(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('titre', 'Titre', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			
 			redirect('admin/gestion_contact');
 		}else{

        	if($this->FormationModel->add_contact()){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_contact');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_contact(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('titre', 'Titre du QCM', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_contact');
 		}else{
			
			$id=$this->input->post('id');
        	if($this->FormationModel->update_contact($id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_contact');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_contact($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_contact($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_contact');
 	}

 	//videos
 	public function gestion_video(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['videos']=$this->FormationModel->get_les_videos();
 		$data['formations']=$this->FormationModel->get_formations();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_video',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_video(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('cours', 'Titre du cours', 'required');

 		if(!$this->form_validation->run()){

 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			
 			redirect('admin/gestion_video');
 		}else{

 			$id_formation=$this->input->post('id_formation');
        	
        	if($this->FormationModel->add_video($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_video');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_video(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('cours', 'Titre du cours', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_video');
 		}else{
			
			$id=$this->input->post('id');
			$id_formation=$this->input->post('id_formation');
        	if($this->FormationModel->update_video($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_video');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_video($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_video($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}else{
				$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			}
		redirect('/admin/gestion_qcm');
 	}

 	//videos
 	public function gestion_support_apprenant(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('welcome/index');
		}
 		$data['supports']=$this->FormationModel->get_supports();
 		$data['formations']=$this->FormationModel->get_formations();
 		$data['support_as']=$this->FormationModel->get_les_support_apprenant();
 		//$data['single']=$this->FormationModel->get_support();

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_support_apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function create_support_apprenant(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('support', 'Support', 'required');
		//$this->form_validation->set_rules('apprenant', 'Formation', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_support_apprenant');
 		}else{

 			$id_formation=$this->input->post('apprenant');
        	if($this->FormationModel->add_support_apprenant($id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_support_apprenant');
        	
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/gestion_support_apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function update_support_apprenant(){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		$this->form_validation->set_rules('support', 'Support', 'required');

 		if(!$this->form_validation->run()){
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/gestion_support_apprenant');
 		}else{
			
			$id=$this->input->post('id');
			$id_formation=$this->input->post('apprenant');

        	if($this->FormationModel->update_support_apprenant($id,$id_formation)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
 			redirect('admin/gestion_support_apprenant');
 		}

 		$this->load->view('admin/header',$data);
 		$this->load->view('admin/apprenant',$data);
 		$this->load->view('admin/footer',$data);
 	}

 	public function delete_support_apprenant($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_support_apprenant($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/gestion_support_apprenant');
 	}

 	//prof
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/prof');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('cv', 'cv', './assets/cv/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload cv refusé : ' . $_su_result['error']);
				}
				// SECURITY P1.4 - Upload sécurisé charte
				$_su_charte = $this->secure_upload->process('charte', 'cv', './assets/charte/');
				$charte = $_su_charte['success'] ? $_su_charte['file_name'] : '';
				if (!$_su_charte['success'] && $_su_charte['error']) {
					log_message('warning', 'Upload charte refusé : ' . $_su_charte['error']);
				}

				// SECURITY P1.4 - Upload sécurisé maj
				$_su_maj = $this->secure_upload->process('maj', 'cv', './assets/maj/');
				$maj = $_su_maj['success'] ? $_su_maj['file_name'] : '';
				if (!$_su_maj['success'] && $_su_maj['error']) {
					log_message('warning', 'Upload maj refusé : ' . $_su_maj['error']);
				}

        	if($this->FormationModel->add_prof($pdf,$charte,$maj)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/prof');
 		}else{

        	//book file upload
				// SECURITY P1.4 - Upload sécurisé via Secure_upload
				$this->load->library('secure_upload');
				$_su_result = $this->secure_upload->process('cv', 'cv', './assets/cv/');
				$pdf = $_su_result['success'] ? $_su_result['file_name'] : '';
				if (!$_su_result['success'] && $_su_result['error']) {
					log_message('warning', 'Upload cv refusé : ' . $_su_result['error']);
				}

			// SECURITY P1.4 - Upload sécurisé charte (update)
				$_su_charte = $this->secure_upload->process('charte', 'cv', './assets/charte/');
				$charte = $_su_charte['success'] ? $_su_charte['file_name'] : '';
				if (!$_su_charte['success'] && $_su_charte['error']) {
					log_message('warning', 'Upload charte (update) refusé : ' . $_su_charte['error']);
				}

				// SECURITY P1.4 - Upload sécurisé maj (update)
				$_su_maj = $this->secure_upload->process('maj', 'cv', './assets/maj/');
				$maj = $_su_maj['success'] ? $_su_maj['file_name'] : '';
				if (!$_su_maj['success'] && $_su_maj['error']) {
					log_message('warning', 'Upload maj (update) refusé : ' . $_su_maj['error']);
				}

			$id=$this->input->post('id');
        	if($this->FormationModel->update_prof($pdf,$charte,$maj,$id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
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

		// Audit log P1.6 : capturer l'état avant suppression
		$this->load->library('audit_log');
		$row_before = $this->FormationModel->get_prof($id);

		if($this->FormationModel->delete_prof($id)){
			$this->audit_log->record('prof.delete', [
				'table_name'  => 'prof',
				'record_id'   => $id,
				'data_before' => $row_before,
			]);
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/prof');
 	}


 	//apprenant
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/apprenant');
 		}else{
        	if($this->FormationModel->add_apprenant()){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/apprenant');
 		}else{
        	$id=$this->input->post('id');
        	if($this->FormationModel->update_apprenant($id)){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
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

		// Audit log P1.6 : RGPD article 30 - traçabilité suppression données personnelles
		$this->load->library('audit_log');
		$row_before = $this->FormationModel->get_apprenant($id);

		if($this->FormationModel->delete_apprenant($id)){
			$this->audit_log->record('apprenant.delete', [
				'table_name'  => 'apprenant',
				'record_id'   => $id,
				'data_before' => $row_before,
			]);
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/apprenant');
 	}


 	//cours
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/cours');
 		}else{
        	if($this->FormationModel->add_cours()){
        		$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}else{
        		$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        	}
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
 			$this->session->set_flashdata('msg','<br><div class="alert alert-warning alert-dismissible fade show" role="alert">Veuillez remplir tous les champs<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 			redirect('admin/cours#editCours');
 		}else{
 			$id=$this->input->post('id_key');
 			if($this->FormationModel->update_cours($id)){
 				$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données enregistrées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 				}else{
 					$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
 				}
 			redirect('admin/cours');
 		}
 	}

 	public function delete_cours($id){
 		if(!$this->session->userdata('logged_admin')){
				redirect('admin/index');
		}

		if($this->FormationModel->delete_cours($id)){
			$this->session->set_flashdata('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">Données supprimées<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->session->set_flashdata('msg','<br><div class="alert alert-danger alert-dismissible fade show" role="alert">Il y a eu une erreur, veuillez réessayer<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('/admin/cours');
 	}
}
