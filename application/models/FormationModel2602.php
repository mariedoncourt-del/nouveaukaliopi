<?php

class FormationModel extends CI_Model
{
	//formations
    public function get_formation($id_formation){

		$this->db->select('*,formation.id as id, apprenant.nom as nom_apprenant, apprenant.prenom as prenom_apprenant, prof.nom as nom_prof, prof.prenom as prenom_prof, cours.titre as cours');
		$this->db->from('formation');
 		$this->db->join('apprenant', 'apprenant.id = formation.apprenant_id','inner');
 		$this->db->join('prof', 'prof.id = formation.prof_id','inner');
 		$this->db->join('cours', 'cours.id_key = formation.cours_id','inner');
 		$this->db->where(array('formation.id' => $id_formation));

 		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_formations(){

		$this->db->select('*,formation.id as id, apprenant.nom as nom_apprenant, apprenant.prenom as prenom_apprenant, prof.nom as nom_prof, prof.prenom as prenom_prof, cours.titre as cours');
		$this->db->from('formation');
 		$this->db->join('apprenant', 'apprenant.id = formation.apprenant_id','inner');
 		$this->db->join('prof', 'prof.id = formation.prof_id','inner');
 		$this->db->join('cours', 'cours.id_key = formation.cours_id','inner');
 		//$this->db->where(array('formation.id' => $id_formation));

 		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_formation($id_formation,$emargement){
		$data = array(
				'cours_id' => $this->input->post('cours'),
				'prof_id' => $this->input->post('prof'),
				'apprenant_id' => $this->input->post('apprenant'),
				'id' => $id_formation,
				'suivi' => $emargement,
			);
 		return $this->db->insert('formation',$data);
	}

	public function update_drive($id_formation,$emargement){
		$data = array(
				'drive' => $emargement,
			);
 		$this->db->where('id', $id_formation);
		return $this->db->update('formation', $data);
	}

	public function update_formation($id_formation){
		$data = array(
				'cours_id' => $this->input->post('cours'),
				'prof_id' => $this->input->post('prof'),
				'apprenant_id' => $this->input->post('apprenant'),
				//'suivi' => $emargement,
			);
 		$this->db->where('id', $id_formation);
		return $this->db->update('formation', $data);
	}

	public function delete_formation($id){
		$this->db->where('id', $id);
		return $this->db->delete('formation');
	}

	//apprenant
	public function get_apprenants(){

		$this->db->from('apprenant');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_apprenant($id_apprenant){

		$this->db->from('apprenant');
 		$this->db->or_where(['id'=>$id_apprenant]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function add_apprenant(){
		$data = array(
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
			);
 		return $this->db->insert('apprenant',$data);
	}

	public function update_apprenant($id){

		$data = array(
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
			);
 		$this->db->where('id', $id);
		return $this->db->update('apprenant', $data);
	}

	public function delete_apprenant($id){
		$this->db->where('id', $id);
		return $this->db->delete('apprenant');
	}


	//prof
	public function get_prof($id_prof){

		$this->db->from('prof');

 		$this->db->or_where(['id'=>$id_prof]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_profs(){

		$this->db->from('prof');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_prof($cv,$charte,$maj){

		$data = array(
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
				'profile'=>$cv,
				'charte'=>$charte,
				'maj'=>$maj
			);
 		return $this->db->insert('prof',$data);
	}

	public function update_prof($cv,$charte,$maj,$id){
		$data=[];
		if($cv!=null){
			$data+=['profile'=>$cv];
		}
		if($charte!=null){
			$data+=['charte'=>$charte];
		}

		if($maj!=null){
			$data+=['maj'=>$maj];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('prof', $data);
		//print_r($this->db->last_query());die();
	}

	public function delete_prof($id){
		$this->db->where('id', $id);
		return $this->db->delete('prof');
	}

	//support
	public function get_supports(){

		$this->db->from('support');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_support($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('support',$data);
	}

	public function update_support($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('support', $data);
	}

	public function delete_support($id){
		$this->db->where('id', $id);
		return $this->db->delete('support');
	}


	//recrutement
	public function get_recrutements(){

		$this->db->from('recrutement');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_recrutement($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link,
				'lien'=>$this->input->post('lien')
			);
 		return $this->db->insert('recrutement',$data);
	}

	public function update_recrutement($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'lien'=>$this->input->post('lien')
			);

 		$this->db->where('id', $id);
		return $this->db->update('recrutement', $data);
	}

	public function delete_recrutement($id){
		$this->db->where('id', $id);
		return $this->db->delete('recrutement');
	}


	//documentaires
	public function get_documents(){

		$this->db->from('document');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_document($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link,
				'lien'=>$this->input->post('lien')
			);
 		return $this->db->insert('document',$data);
	}

	public function update_document($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'lien'=>$this->input->post('lien')
			);

 		$this->db->where('id', $id);
		return $this->db->update('document', $data);
	}

	public function delete_document($id){
		$this->db->where('id', $id);
		return $this->db->delete('document');
	}

	//handicaps
	public function get_handicaps(){

		$this->db->from('handicap');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_handicap($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link,
				'lien'=>$this->input->post('lien')
			);
 		return $this->db->insert('handicap',$data);
	}

	public function update_handicap($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'lien'=>$this->input->post('lien')
			);

 		$this->db->where('id', $id);
		return $this->db->update('handicap', $data);
	}

	public function delete_handicap($id){
		$this->db->where('id', $id);
		return $this->db->delete('handicap');
	}


	//procedures
	public function get_procedures(){

		$this->db->from('procedures');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_procedure($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('procedures',$data);
	}

	public function update_procedure($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('procedures', $data);
	}

	public function delete_procedure($id){
		$this->db->where('id', $id);
		return $this->db->delete('procedures');
	}

	//certifications
	public function get_certificats(){

		$this->db->from('certificat');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_certificat($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('certificat',$data);
	}

	public function update_certificat($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('certificat', $data);
	}

	public function delete_certificat($id){
		$this->db->where('id', $id);
		return $this->db->delete('certificat');
	}


	//programmes
	public function get_programmes(){

		$this->db->from('programme');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_programme($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('programme',$data);
	}

	public function update_programme($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				//'category' => $this->input->post('category'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('programme', $data);
	}

	public function delete_programme($id){
		$this->db->where('id', $id);
		return $this->db->delete('programme');
	}


	//veilles
	public function get_veilles($category=false){

		$this->db->from('veille');
		$this->db->or_where(['category'=>$category]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_veilles(){

		$this->db->from('veille');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_veille($data){
 		return $this->db->insert('veille',$data);
	}

	//cours
	public function get_le_cours($id_cours){

		$this->db->from('cours');
 		$this->db->or_where(['id_key'=>$id_cours]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_cours(){

		$this->db->from('cours');
		$this->db->order_by('titre');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_cours(){

		$data = array(
				'id' => $this->input->post('id_cours'),
				'titre' => $this->input->post('titre'),
			);
 		return $this->db->insert('cours',$data);
	}

	public function update_cours($id){

		$data = array(
				'id' => $this->input->post('id_cours'),
				'titre' => $this->input->post('titre'),
			);
 		$this->db->where('id_key', $id);
		return $this->db->update('cours', $data);
	}

	public function delete_cours($id){
		$this->db->where('id', $id);
		return $this->db->delete('cours');
	}

	//seances
	public function get_seances($id_formation){

		$this->db->from('seance');
		$this->db->order_by('numero');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_seance($id_formation){

		$data = array(
				'id'=> md5(uniqid()),
				'numero' => $this->input->post('numero'),
				'date_seance' => $this->input->post('date_seance'),
				'lieu' => $this->input->post('lieu'),
				'horaire' => $this->input->post('horaire'),
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('seance',$data);
	}

	public function update_seance($id, $id_formation){

		$data = array(
				'numero' => $this->input->post('numero'),
				'date_seance' => $this->input->post('date_seance'),
				'lieu' => $this->input->post('lieu'),
				'horaire' => $this->input->post('horaire'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('seance', $data);
	}

	public function delete_seance($id){
		$this->db->where('id', $id);
		return $this->db->delete('seance');
	}

	//questionnaires
	public function get_questions($id_formation){

		$this->db->from('question');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	//besoins
	public function get_besoins($id_formation){

		$this->db->from('besoin');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_besoin($id_formation){

		$data = array(
				'id'=> md5(uniqid()),
				'context' => $this->input->post('context'),
				'caractere' => $this->input->post('caractere'),
				'contenu' => $this->input->post('contenu'),
				'ressource' => $this->input->post('ressource'),
				'planning' => $this->input->post('planning'),
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('besoin',$data);
	}

	public function update_besoin($id,$id_formation){

		$data = array(
				'context' => $this->input->post('context'),
				'caractere' => $this->input->post('caractere'),
				'contenu' => $this->input->post('contenu'),
				'ressource' => $this->input->post('ressource'),
				'planning' => $this->input->post('planning'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('besoin', $data);
	}

	public function delete_besoin($id){
		$this->db->where('id', $id);
		return $this->db->delete('besoin');
	}

	//videos
	public function get_videos($id_formation){

		$this->db->from('video');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_les_videos(){
		$this->db->from('video');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_video($id_formation){

		$data = array(
				'cours' => $this->input->post('cours'),
				'pseudo' => $this->input->post('pseudo'),
				'password' => $this->input->post('password'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('video',$data);
	}

	public function update_video($id,$id_formation){

		$data = array(
				'cours' => $this->input->post('cours'),
				'pseudo' => $this->input->post('pseudo'),
				'password' => $this->input->post('password'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('video', $data);
	}

	public function delete_video($id){
		$this->db->where('id', $id);
		return $this->db->delete('video');
	}

	//qcms
	public function get_qcms($id_formation){

		$this->db->from('qcm');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_les_qcms(){
		$this->db->from('qcm');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_qcm($id_formation){

		$data = array(
				'titre' => $this->input->post('titre'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('qcm',$data);
	}

	public function update_qcm($id,$id_formation){

		$data = array(
				'titre' => $this->input->post('titre'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('qcm', $data);
	}

	public function delete_qcm($id){
		$this->db->where('id', $id);
		return $this->db->delete('qcm');
	}

	//qcms
	public function get_suports_apprenant($id_formation){
		$this->db->select('*,support_apprenant.id as id,support_apprenant.support as support, support_apprenant.apprenant as id_formation, support.nom as titre, support.link as link');
		$this->db->from('support_apprenant');
		$this->db->join('support', 'support.id = support_apprenant.support','inner');
 		$this->db->where(['apprenant'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_les_support_apprenant(){
		$this->db->select('*,support_apprenant.id as id, support_apprenant.apprenant as id_formation, support.nom as titre, support.link as link');
		$this->db->from('support_apprenant');
		$this->db->join('support', 'support.id = support_apprenant.support','inner');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_support_apprenant($id_formation){

		$data = array(
				'support' => $this->input->post('support'),
				'apprenant' => $id_formation,
			);
 		return $this->db->insert('support_apprenant',$data);
	}

	public function update_support_apprenant($id,$id_formation){

		$data = array(
				'support' => $this->input->post('support'),
				'apprenant' => $id_formation,
			);
 		$this->db->where(['id' => $id, 'apprenant' => $id_formation]);
		return $this->db->update('support_apprenant', $data);
	}

	public function delete_support_apprenant($id){
		$this->db->where('id', $id);
		return $this->db->delete('support_apprenant');
	}

	//questions
	public function add_question($id_formation){

		$data = array(
				'id_formation' => $id_formation,
				'attente_01' => $this->input->post('attente_01'),
				'service' => $this->input->post('service'),
				'poste' => $this->input->post('poste'),
				'exp' => $this->input->post('exp'),
				'activite' => $this->input->post('activite'),
				'experience' => $this->input->post('experience'),
				'atout' => $this->input->post('atout'),
				'amelioration' => $this->input->post('amelioration'),
				'objectif' => $this->input->post('objectif'),
				'attente_02' => $this->input->post('attente_02'),
				'qui' => $this->input->post('qui'),
				'remarques' => $this->input->post('remarques'),
			);
 		
 		return $this->db->insert('question',$data);
 		//print_r($this->db->last_query());die();


	}

	public function update_question($id,$id_formation){

		$data = array(
				'id_formation' => $id_formation,
				'attente_01' => $this->input->post('attente_01'),
				'service' => $this->input->post('service'),
				'poste' => $this->input->post('poste'),
				'exp' => $this->input->post('exp'),
				'activite' => $this->input->post('activite'),
				'experience' => $this->input->post('experience'),
				'atout' => $this->input->post('atout'),
				'amelioration' => $this->input->post('amelioration'),
				'objectif' => $this->input->post('objectif'),
				'attente_02' => $this->input->post('attente_02'),
				'qui' => $this->input->post('qui'),
				'remarques' => $this->input->post('remarques'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('question', $data);
		//print_r($this->db->last_query());die();
	}

	public function delete_question($id){
		$this->db->where('id', $id);
		return $this->db->delete('question');
	}

	//senarios
	public function get_scenarios($id_formation){

		$this->db->from('scenario');
		$this->db->order_by('unite');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_scenario($id_formation){

		$data = array(
				'id'=> md5(uniqid()),
				'unite' => $this->input->post('unite'),
				'titre' => $this->input->post('titre'),
				'activite' => implode(',',$this->input->post('activite')),
				//'just_activite' => $this->input->post('just_activite'),
				'media' => implode(',',$this->input->post('media')),
				'just_media' => $this->input->post('just_media'),
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('scenario',$data);
	}

	public function update_scenario($id,$id_formation){

		$data = array(
				'unite' => $this->input->post('unite'),
				'titre' => $this->input->post('titre'),
				'activite' => implode(',',$this->input->post('activite')),
				//'just_activite' => $this->input->post('just_activite'),
				'media' => implode(',',$this->input->post('media')),
				'just_media' => $this->input->post('just_media'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('scenario', $data);
	}

	public function delete_scenario($id){
		$this->db->where('id', $id);
		return $this->db->delete('scenario');
	}


	//evaluations
	public function get_evaluations($id_formation){

		$this->db->from('evaluation');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_evaluation($id_formation){

		$data = array(
				'titre' => $this->input->post('titre'),
				'niveau' => 0,
				'niveau_apres' => 0,
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('evaluation',$data);
	}

	public function update_evaluation($id,$id_formation){

		$data = array(
				'titre' => $this->input->post('titre'),
				'niveau' => $this->input->post('niveau'),
				'niveau_apres' => $this->input->post('niveau_apres'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('evaluation', $data);
	}

	public function delete_evaluation($id){
		$this->db->where('id', $id);
		return $this->db->delete('evaluation');
	}

	//contact
	public function get_contacts(){

		$this->db->from('contact');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_contact(){

		$data = array(
				'titre' => $this->input->post('titre'),
				'dept31' => $this->input->post('dept31'),
				'dept81' => $this->input->post('dept81'),
				'dept82' => $this->input->post('dept82'),
			);
 		return $this->db->insert('contact',$data);
	}

	public function update_contact($id){

		$data = array(
				'titre' => $this->input->post('titre'),
				'dept31' => $this->input->post('dept31'),
				'dept81' => $this->input->post('dept81'),
				'dept82' => $this->input->post('dept82'),
			);
 		$this->db->where(['id' => $id]);
		return $this->db->update('contact', $data);
		//print_r($this->db->last_query());die();
	}

	public function delete_contact($id){
		$this->db->where('id', $id);
		return $this->db->delete('contact');
	}


	//evaluations pro
	public function get_evaluations_pro($id_formation){

		$this->db->from('evaluation_projet');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_evaluation_pro($id_formation,$pj){

		$data = array(
				'titre' => $this->input->post('titre'),
				'category' => $this->input->post('category'),
				'url' => $this->input->post('url'),
				'commentaires' => $this->input->post('commentaires'),
				'id_formation' => $id_formation,
				'pj' => implode(',',$pj),
			);
 		return $this->db->insert('evaluation_projet',$data);
	}

	public function update_evaluation_pro($id,$id_formation,$pj){

		$data=[];

		if(!$pj==null){
			$data+=['pj'=>implode(',',$pj)];
		}

		$data+= array(
				'titre' => $this->input->post('titre'),
				'category' => $this->input->post('category'),
				'url' => $this->input->post('url'),
				'commentaires' => $this->input->post('commentaires'),
				'id_formation' => $id_formation,

			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		$this->db->update('evaluation_projet', $data);
		//print_r($this->db->last_query());die();
	}

	public function delete_evaluation_pro($id){
		$this->db->where('id', $id);
		$this->db->delete('evaluation_projet');
	}


	//evaluations à chaud
	public function get_evaluations_hot($id_formation){

		$this->db->from('evaluation_hot');
 		$this->db->or_where(['id_formation'=>$id_formation]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function add_evaluation_hot($id_formation){

		$data = array(
				'id_formation' => $id_formation,
			);
 		return $this->db->insert('evaluation_hot',$data);
	}

	public function update_evaluation_hot($id,$id_formation){

		$data = array(
				'entreprise' => $this->input->post('entreprise'),
				'eval_1' => $this->input->post('eval_1'),
				'eval_2' => $this->input->post('eval_2'),
				'eval_3' => $this->input->post('eval_3'),
				'eval_4' => $this->input->post('eval_4'),
				'eval_5' => $this->input->post('eval_5'),
				'eval_6' => $this->input->post('eval_6'),
				'eval_7' => $this->input->post('eval_7'),
				'eval_8' => $this->input->post('eval_8'),
				'eval_comm' => $this->input->post('eval_comm'),
				'eval_note' => $this->input->post('eval_note'),
				'sati_1' => $this->input->post('sati_1'),
				'sati_2' => $this->input->post('sati_2'),
				'sati_3' => $this->input->post('sati_3'),
				'sati_4' => $this->input->post('sati_4'),
				'sati_comm' => $this->input->post('sati_comm'),
			);
 		$this->db->where(['id' => $id, 'id_formation' => $id_formation]);
		return $this->db->update('evaluation_hot', $data);
	}

	
	//evaluation note
	public function update_evaluation_note($id_formation){

		$data = array(
				'note' => $this->input->post('note'),
				'comments' => $this->input->post('comments'),
			);
 		$this->db->where(['id' => $id_formation]);
		return $this->db->update('formation', $data);
		//print_r($this->db->last_query());die();
	}
	//organigramme
	public function get_organigramme(){
		$this->db->from('organigramme');
 		$this->db->or_where(['id'=>1]);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_organigramme($pj){

		$data=[];

		if(!$pj==null){
			$data+=['link'=>$pj];
		}
		
 		$this->db->where(['id', 1]);
		return $this->db->update('organigramme', $data);
		//print_r($this->db->last_query());die();
	}

}