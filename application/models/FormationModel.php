
<?php

class FormationModel extends CI_Model
{

	function creation_table_videos()
   {
        $q = $this->db->query("CREATE TABLE videos (id int primary key auto_increment, cours varchar(200) null, lien varchar(200) null) engine=innoDB");
        return $q;
   }

   public function creation_table_support_prof()
   {
	$q = $this->db->query("CREATE TABLE support_prof (id int(11) NOT NULL primary key AUTO_INCREMENT, support int(11) DEFAULT NULL,prof varchar(190) DEFAULT NULL) engine=innoDB");
        return $q;
   }

   public function afficher_scenario()
   {
	$query = $this->db->query("select * from scenario_pedagogique");
	return $query->result();
   }

   public function get_les_scenario_prof()
   {
	$query = $this->db->query("select * from scenario_pedagogique_formateur");
	return $query->result_array();
   }
   function creation_table_scenario()
   {
        $q = $this->db->query("CREATE TABLE scenario_pedagogique (id int primary key auto_increment, nom varchar(200) null, category varchar(200) null, link varchar(200) null) engine=innoDB");
        return $q;
   }

   function creation_table_scenarioss()
   {
        $q = $this->db->query("CREATE TABLE scenario_pedagogique_formateur (id int primary key auto_increment, prof varchar(200) null, link varchar(200) null) engine=innoDB");
        return $q;
   }

   public function inserer_scenario_pedagogique_formateur($data=array())
   {
		return $this->db->insert('scenario_pedagogique_formateur',$data);
   }


   function creation_table_task_list()
   {
        $q = $this->db->query("CREATE TABLE task_list (id int primary key auto_increment, mois varchar(50) null, texte varchar(200) null) engine=innoDB");
        return $q;
   }

   public function enregistrer_task_list($data=array())
   {
	$this->db->insert('task_list', $data);
   }

   public function afficher_mois()
   {
	$query = $this->db->query("select distinct(mois) as mois from task_list order by id asc");
	return $query->result();
   }

   public function afficher_texte($mois)
   {
	$query = $this->db->query("select texte from task_list where mois like ?", array($mois));
	return $query->result();
   }


   function creation_table_cocher()
   {
        $q = $this->db->query("CREATE TABLE resultat_question (id int primary key auto_increment, id_formation varchar(100) null, question varchar(100) null, resultat_1 int default 0 null, resultat_2 int default 0 null, resultat_3 int default 0 null, resultat_4 int default 0 null) engine=innoDB");
        return $q;
   }

   public function ajouter_qualiopi($data=array())
   {
	   $this->db->insert('qualiopi',$data);
   }

   public function supprimer_qualiopi()
   {
	$query = $this->db->query("delete from qualiopi");
	return $query;
   }
 

   function creation_table_cocher_depart()
   {
        $q = $this->db->query("CREATE TABLE resultat_question_depart (id int primary key auto_increment, id_formation varchar(100) null, question varchar(100) null, resultat_1 int default 0 null, resultat_2 int default 0 null, resultat_3 int default 0 null, resultat_4 int default 0 null) engine=innoDB");
        return $q;
   }
   function recherche_resultat_question_1($id,$question)
   {
	$query = $this->db->query("SELECT resultat_1 as resultat from resultat_question where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }

   function recherche_resultat_question_depart_1($id,$question)
   {
	$query = $this->db->query("SELECT resultat_1 as resultat from resultat_question_depart where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }

   function supprimer_resultat_question()
   {
	$query = $this->db->query("delete from resultat_question");
	return $query;
   }

   public function modifier_resultat($id,$question)
   {
	$query = $this->db->query("update resultat_question set resultat_1 =1, resultat_3=0 where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	return $query;
   }

   function parcours_resultat_question($id,$question)
   {
	$query = $this->db->query("SELECT * from resultat_question where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		if($row->resultat_1==1)
		{
			return 1;
		}
		else
		{
			if($row->resultat_2==1)
				{
					return 1;
				}
			else{
				if($row->resultat_3==1)
				{
					return 1;
				}


			}
		}

   }
}
   function recherche_resultat_question_2($id,$question)
   {
	$query = $this->db->query("SELECT resultat_2 as resultat from resultat_question where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }

   public function afficher_resultat_question_depart()
   {
	$query = $this->db->query("SELECT * from resultat_question_depart");
	return $query->result();

   }

   function recherche_resultat_question_depart_2($id,$question)
   {
	$query = $this->db->query("SELECT resultat_2 as resultat from resultat_question_depart where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }

   public function afficher_resultat_question()
   {
	$query = $this->db->query("SELECT * from resultat_question");
	return $query->result();
   }

   function recherche_resultat_question_3($id,$question)
   {
	$query = $this->db->query("SELECT resultat_3 as resultat from resultat_question where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }

   function recherche_resultat_question_depart_3($id,$question)
   {
	$query = $this->db->query("SELECT resultat_3 as resultat from resultat_question_depart where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }
   function recherche_resultat_question_4($id,$question)
   {
	$query = $this->db->query("SELECT resultat_4 as resultat from resultat_question where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }


   function recherche_resultat_question_depart_4($id,$question)
   {
	$query = $this->db->query("SELECT resultat_4 as resultat from resultat_question_depart where id_formation like ? and substr(question,1,10) like ?", array($id, $question));
	foreach($query->result() as $row)
	{
		$data = $row->resultat;
	}
	return $data;
   }




   function insert_resultat_question($data=array())
   {
	$this->db->insert('resultat_question',$data);
   }

   function insert_resultat_question_depart($data=array())
   {
	$this->db->insert('resultat_question_depart',$data);
   }

   public function insertion_video($data=array()){
		$this->db->insert('videos',$data);
   }

   public function lire_base_qcm()
   {
    $query = $this->db->query("select * from Base_qcm");
    return $query->result();
   }

   public function suprimer_base_qcm()
   {
	$query = $this->db->query("delete from Base_qcm");
	return $query;
   }

   public function creation_base_qcm()
   {
    $q = $this->db->query("CREATE TABLE Base_qcm (id int primary key auto_increment, fichier varchar(200) not null, id_formation varchar(100) null, nom_formation varchar(100) null) engine=innoDB");
        return $q;
   }

   public function enregistrer_base_qcm($data=array())
   {
    $this->db->insert('Base_qcm', $data);
   }

   public function supprimer_video()
   {
	$query = $this->db->query("delete from videos");
	return $query;
   }

   public function afficher_videos()
   {
	$query = $this->db->query("select * from videos");
	return $query->result();
   }

   public function get_profss()
   {
	$query = $this->db->query("select * from prof order by nom asc");
	return $query->result_array();
   }
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


	public function modifier_reponse($id)
	{
		$query = $this->db->query("update Reponse set reponse = 1 where id = ?", array($id));
		return $query;
	}

	public function recherche_courss($titre)
	{
		$query = $this->db->query("select id as id from cours where titre like ?", array($titre));
		foreach($query->result() as $row)
		{
			$data = $row->id;
		}

		return $data;
	}

	public function afficher_reponsess()
	{
		$query = $this->db->query("select * from Reponse");
		return $query->result();
	}

	public function afficher_questionss()
	{
		$query = $this->db->query("select * from Questionnaire");
		return $query->result();	
	}

	public function modifier_questionnaire($id,$quest)
	{
		$query = $this->db->query("update Questionnaire set question = ? where id_questionnaire like ?", array($quest, $id));
		return $query;
	}

	public function supprimer_questions($id)
	{
		$query = $this->db->query("delete from Questionnaire where id_questionnaire like ?", array($id));
		return $query;
	}

	public function supprimer_reponse_depart_1($id)
	{
		$query = $this->db->query("delete from Reponse_depart where id like ?", array($id));
		return $query;
	}
	public function supprimer_reponses($id)
	{
		$query = $this->db->query("delete from Reponse where id like ?", array($id));
		return $query;
	}

	

	public function supprimer_question_departs($id)
	{
		$query = $this->db->query("delete from Questionnaire_depart where id_questionnaire like ?", array($id));
		return $query;
	}
	public function recherche_reponse($id)
	{
		$query = $this->db->query("select * from Reponse where id_questionnaire like ?", array($id));
		return $query->result();
	}

	public function recherche_reponses($id,$rang)
	{
		$query = $this->db->query("select * from Reponse where id_questionnaire like ? and rang like ?", array($id, $rang));
		return $query->result();
	}

	public function recherche_reponses_depart($id,$rang)
	{
		$query = $this->db->query("select * from Reponse_depart where id_questionnaire like ? and rang like ?", array($id, $rang));
		return $query->result();
	}



	public function recherche_reponse_depart($id)
	{
		$query = $this->db->query("select * from Reponse_depart where id_questionnaire like ?", array($id));
		return $query->result();
	}

	public function recherche_formationss($id)
	{
		$query = $this->db->query("select cours.id as id from formation,cours where formation.cours_id=cours.id_key and formation.id like ?", array($id));
		foreach($query->result() as $row)
		{
			$data = $row->id;
		}

		return $data;
	}

	public function nombre_etudiant_réussi($titre)
	{
		$query = $this->db->query("select  count(*) as compte from formation,cours,evaluation_hot where formation.cours_id=cours.id_key and formation.id = evaluation_hot.id_formation and cours.titre like ? and evaluation_hot.eval_note>=10 group by cours.titre", array($titre));
		foreach($query->result() as $row)
		{
			$data = $row->compte;
		}
		return $data;
	}

	public function nombre_formations()
	{
	$query = $this->db->query("select count(cours.titre) as compte from formation,cours,evaluation_hot where formation.cours_id=cours.id_key and formation.id = evaluation_hot.id_formation");
		foreach($query->result() as $row)
		{
			$data = $row->compte;
		}
		return $data;
	}

	public function evaluation_formation()
	{
		$query = $this->db->query("select cours.titre,sum(evaluation_hot.eval_note) as note, sum(evaluation_hot.sati_1) as sati_1,sum(evaluation_hot.sati_2) as sati_2,sum(evaluation_hot.sati_3) as sati_3,sum(evaluation_hot.sati_4) as sati_4, sum(evaluation_hot.eval_1) as eval_1, sum(evaluation_hot.eval_2) as eval_2, sum(evaluation_hot.eval_3) as eval_3, sum(evaluation_hot.eval_4) as eval_4, sum(evaluation_hot.eval_5) as eval_5, sum(evaluation_hot.eval_6) as eval_6, sum(evaluation_hot.eval_7) as eval_7, sum(evaluation_hot.eval_8) as eval_8, count(*) as compte from formation,cours,evaluation_hot where formation.cours_id=cours.id_key and formation.id = evaluation_hot.id_formation group by cours.titre");
		return $query->result();
	}

	public function nombre_formation()
	{
		$query = $this->db->query("select count(cours.titre) as compte from formation,cours,evaluation_hot where formation.cours_id=cours.id_key and formation.id = evaluation_hot.id_formation group by cours.titre");
		return $query->result();
	}

	public function moyenne_formation()
	{
		$query = $this->db->query("select cours.titre,avg(evaluation_hot.eval_note) as note, avg(evaluation_hot.sati_1) as sati_1,avg(evaluation_hot.sati_2) as sati_2,avg(evaluation_hot.sati_3) as sati_3,avg(evaluation_hot.sati_4) as sati_4, avg(evaluation_hot.eval_1) as eval_1, avg(evaluation_hot.eval_2) as eval_2, avg(evaluation_hot.eval_3) as eval_3, sum(evaluation_hot.eval_4) as eval_4, sum(evaluation_hot.eval_5) as eval_5, sum(evaluation_hot.eval_6) as eval_6, sum(evaluation_hot.eval_7) as eval_7, sum(evaluation_hot.eval_8) as eval_8, count(*) as compte from formation,cours,evaluation_hot where formation.cours_id=cours.id_key and formation.id = evaluation_hot.id_formation group by cours.titre");
		return $query->result();
	}

	public function recherche_formations_stagiaire($id)
	{
		$query = $this->db->query("select cours.titre as titre from formation,cours where formation.cours_id=cours.id_key and formation.id like ?", array($id));
		foreach($query->result() as $row)
		{
			$data = $row->titre;
		}

		return $data;
	}



	public function display_question_depart()
	{
		$query = $this->db->query("select * from Questionnaire_depart");
		return $query->result();
	}

	public function display_reponse_depart()
	{
		$query = $this->db->query("select * from Reponse_depart");
		return $query->result();
	}

	public function recherche_formationss_depart($id)
	{
		$query = $this->db->query("select cours.id as id from formation,cours where formation.cours_id=cours.id_key and formation.id like ?", array($id));
		foreach($query->result() as $row)
		{
			$data = $row->id;
		}

		return $data;
	}

	public function supprimer_question_depart()
	{
		$query = $this->db->query("delete from Questionnaire_depart");
		return $query;
	}

	public function supprimer_question_fin()
	{
		$query = $this->db->query("delete from Questionnaire");
		return $query;
	}


	public function supprimer_reponse_depart()
	{
		$query = $this->db->query("delete from Reponse_depart");
		return $query;
	}

	public function supprimer_reponse_fin()
	{
		$query = $this->db->query("delete from Reponse");
		return $query;
	}

	public function display_formations(){

		$this->db->select('*,formation.id as id, apprenant.nom as nom_apprenant, apprenant.prenom as prenom_apprenant, prof.nom as nom_prof, prof.prenom as prenom_prof, cours.titre as cours');
		$this->db->from('formation');
 		$this->db->join('apprenant', 'apprenant.id = formation.apprenant_id','inner');
 		$this->db->join('prof', 'prof.id = formation.prof_id','inner');
 		$this->db->join('cours', 'cours.id_key = formation.cours_id','inner');
 		//$this->db->where(array('formation.id' => $id_formation));

 		$query = $this->db->get();
		return $query->result();
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

	public function recherche_nom_stagiaire($idformation)
	{
		$query = $this->db->query("select apprenant.nom as nom from apprenant, formation where apprenant.id = formation.apprenant_id and formation.id like ?", array($idformation));
		foreach($query->result() as $row)
		{
			$data = $row->nom;
		}

		return $data;
	}

	public function recherche_prenom_stagiaire($idformation)
	{
		$query = $this->db->query("select apprenant.prenom as prenom from apprenant, formation where apprenant.id = formation.apprenant_id and formation.id like ?", array($idformation));
		foreach($query->result() as $row)
		{
			$data = $row->prenom;
		}

		return $data;
	}

	public function afficher_coursss()
	{
		$query = $this->db->query("select formation.*, cours.id from formation,apprenant,cours where formation.apprenant_id = apprenant.id and cours.id_key = formation.cours_id and apprenant.nom like 'LANDELLE' and apprenant.prenom like 'CLEMENTINE'");
		return $query->result();
	}

	public function afficher_id_formation($nom,$prenom,$id)
	{
		$query = $this->db->query("select formation.id as id from formation,apprenant,cours where cours.id_key = formation.cours_id  and formation.apprenant_id = apprenant.id and apprenant.nom like ? and apprenant.prenom like ? and cours.id like ?", array($nom, $prenom, $id));
		foreach($query->result() as $row)
		{
			$data = $row->id;
		}

		return $data;
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

	public function afficher_cours()
	{
		$query = $this->db->query("select * from cours");
		return $query->result();
	}

	public function afficher_apprenant()
	{
		$query = $this->db->query("select * from apprenant");
		return $query->result();
	}

	public function recherche_stagiaires($nom,$prenom)
	{
		$query = $this->db->query("select * from apprenant WHERE nom LIKE ? and prenom like ?", array($nom, $prenom));
    	if($query->num_rows()>0) {
                return true;
            }
		else{
			return false;
		}
	}

	public function ajouter_stagiaire_qualiopi($data=array())
	{
		$this->db->insert('apprenant',$data);
	}

	public function ajouter_formation_qualiopi($data=array())
	{
		 $this->db->insert('cours',$data);
	}

	public function recherche_cours($id)
	{
		$query = $this->db->query("select * from cours WHERE id LIKE ?", array($id));
    	if($query->num_rows()>0) {
                return true;
            }
		else{
			return false;
		}
           

	}

	public function recherche_titre($nom)
	{
		$query = $this->db->query("select id_key as id_key from cours WHERE titre LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->id_key;
            }
            return $data;

	}

	public function recherche_id($nom)
	{
		$query = $this->db->query("select id_key as id_key from cours WHERE id LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->id_key;
            }
            return $data;

	}

	public function recherche_titre_cours($nom)
	{
		$query = $this->db->query("select titre as titre from cours WHERE id_key LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->titre;
            }
            return $data;

	}
	public function recherche_apprenant($nom)
	{
		$query = $this->db->query("select id as id from apprenant WHERE nom LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->id;
            }
            return $data;

	}

	public function recherche_nom_apprenant($id)
	{
		$query = $this->db->query("select nom as nom from apprenant WHERE id LIKE ?", array($id));
    	foreach ($query->result() as $row) {
                $data = $row->nom;
            }
            return $data;

	}

	public function Afficher_formations_prof($id)
	{
		$query = $this->db->query("select * from formation WHERE prof_id LIKE ?", array($id));
		return $query->result();
	}

	public function recherche_id_prof($nom)
	{
		$query = $this->db->query("select id as id from prof WHERE nom LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->id;
            }
            return $data;

	}

	public function recherche_nom_prof_apprenant($id)
	{
		$query = $this->db->query("select nom as nom from prof WHERE id LIKE ?", array($id));
    	foreach ($query->result() as $row) {
                $data = $row->nom;
            }
            return $data;

	}

	public function recherche_prenom_prof_apprenant($id)
	{
		$query = $this->db->query("select prenom as prenom from prof WHERE id LIKE ?", array($id));
    	foreach ($query->result() as $row) {
                $data = $row->prenom;
            }
            return $data;

	}



	public function recherche_prenom_apprenant($id)
	{
		$query = $this->db->query("select prenom as prenom from apprenant WHERE id LIKE ?", array($id));
    	foreach ($query->result() as $row) {
                $data = $row->prenom;
            }
            return $data;

	}

	public function supprimer_formation($id)
	{
		$query = $this->db->query("delete from formation where id like ?", array($id));
		return $query;
	}

	public function afficher_formations()
	{
		$query = $this->db->query("select * from formation");
		return $query->result();
	}

	public function recherche_prof($nom)
	{
		$query = $this->db->query("select id as prof_id from prof WHERE nom LIKE ?", array($nom));
    	foreach ($query->result() as $row) {
                $data = $row->prof_id;
            }
            return $data;

	}
	public function recherche_prof_or_create($nom,$pren)
	{
		$query = $this->db->query("select id as prof_id from prof WHERE nom LIKE ?", array($nom));
		if($query->num_rows() > 0){

    	foreach ($query->result() as $row) {
                $data = $row->prof_id;
        }
    	}else{
    		$p = array(
				'nom' => $nom,
				'prenom' => $pren,
				'profile'=>"",
				'charte'=>"",
				'maj'=>""
			);
    		$this->db->insert('prof', $p);
    		$data = $this->db->insert_id();

    	}
            return $data;
    	

	}

	public function ajouter_formation($data=array())
	{
		$this->db->insert('formation', $data);
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

	public function enregistrement_video($data=array()){

		/*$data = array(
				'cours' => $this->input->post('cours'),
				'pseudo' => $this->input->post('pseudo'),
				'password' => $this->input->post('password'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
			);*/
 		return $this->db->insert('video',$data);
	}

	public function recherche_cv_prof($id)
	{
		$query = $this->db->query("select prof.profile as profile from prof,formation where prof.id = formation.prof_id and formation.id like ?", array($id));
		//return $query->result();
		foreach($query->result() as $row)
		{
			$data = $row->profile;
		}
		return $data;
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
	public function get_supportsss(){

		$this->db->from('scenario_pedagogique');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_scenario_pedagogique(){

		$this->db->from('scenario_pedagogique');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_supportss(){

		$this->db->from('support');
		$this->db->order_by('nom');
		$query = $this->db->get();
		return $query->result();
	}

	function getSupports($searchTerm=""){

    	// Fetch users
        $this->db->select('*');
        $this->db->where("nom like '%".$searchTerm."%' ");
        $fetched_records = $this->db->get('support');
        $users = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($users as $user){
            $data[] = array("id"=>$user['id'], "text"=>$user['nom']);
        }
        return $data;
    }

	public function add_support($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('support',$data);
	}

	public function add_scenario_pedagogique($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('scenario_pedagogique',$data);
	}

	/*public function add_scenario_pedagogique($link){

		$data = array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
				'link'=>$link
			);
 		return $this->db->insert('scenario_pedagogique',$data);
	}*/

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

	public function update_scenario_pedagogique($link,$id){
		$data=[];
		if($link!=null){
			$data+=['link'=>$link];
		}

		$data += array(
				'nom' => $this->input->post('nom'),
				'category' => $this->input->post('category'),
			);

 		$this->db->where('id', $id);
		return $this->db->update('scenario_pedagogique', $data);
	}

	public function delete_support($id){
		$this->db->where('id', $id);
		return $this->db->delete('support');
	}

	public function delete_scenario_pedagogique($id){
		$this->db->where('id', $id);
		return $this->db->delete('scenario_pedagogique');
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

	public function afficher_courss()
	{
		$query = $this->db->query("select * from cours");
		return $query->result();
	}

	public function update_cours($id){

		$data = array(
				'id' => $this->input->post('id_cours'),
				'titre' => $this->input->post('titre'),
			);
 		$this->db->where('id_key', $id);
		return $this->db->update('cours', $data);
	}

	public function Afficher_formation()
	{
		$query = $this->db->query("select * from formation");
		return $query->result();
	}

	public function afficher_resultats()
	{
		$query = $this->db->query("select * from Resultat");
		return $query->result();
	}

	public function delete_cours($id){
		$this->db->where('id', $id);
		return $this->db->delete('cours');
	}

	public function nombre_seance($id)
	{
		$query = $this->db->query("select * from seance where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_scenario($id)
	{
		$query = $this->db->query("select * from scenario where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_evaluation($id)
	{
		$query = $this->db->query("select * from evaluation where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_questionnaire($id)
	{
		$query = $this->db->query("select * from question where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_besoin($id)
	{
		$query = $this->db->query("select * from besoin where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_qcm($id)
	{
		$query = $this->db->query("select * from qcm where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

	}

	public function nombre_qcms($id)
	{
		$query = $this->db->query("select * from Resultat where id_formation like ?", array($id));
		if($query->num_rows()>0)
		{
			return "OK";
		}
		else{
			return "Non OK";
		}

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

	public function liste_video()
	{
		$query = $this->db->query("select * from video");
		return $query->result();
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
	public function get_qcms($id_formation,$type){

		$this->db->from('qcm');
 		$this->db->where(['id_formation'=>$id_formation,'type'=>$type]);
		$query = $this->db->get();
		return $query->result_array();
	}

public function supprimer_question()
{
	$query = $this->db->query("DELETE FROM Questionnaire");
	return $query;
}

public function modifier_question($id,$question,$q)
{
	$query = $this->db->query("update Questionnaire set question=? where id_questionnaire like ? and substr(question,1,10) like ?", array($question, $q, $id));
	return $query;
}

function modifier_table_questionnaire()
{
	 $q = $this->db->query("ALTER TABLE Questionnaire MODIFY question varchar(200)");
	 return $q;
}

function modifier_table_resultat()
{
	 $q = $this->db->query("ALTER TABLE Resultat MODIFY note double");
	 return $q;
}

public function afficher_reponse()
{
	$query = $this->db->query("select * from Reponse");
	return $query->result();
}

 

public function afficher_questions($id,$question)
{
	$query = $this->db->query("select * from Questionnaire where id_formation like ? and substr(question,1,11) like ?", array($id, $question));
	return $query->result();
}

public function afficher_questions_depart($id,$question)
{
	$query = $this->db->query("select * from Questionnaire_depart where id_formation like ? and substr(question,1,11) like ?", array($id, $question));
	return $query->result();
}

public function afficher_questions_departs()
{
	$query = $this->db->query("select * from Questionnaire_depart");
	return $query->result();
}

public function afficher_reponses_departs()
{
	$query = $this->db->query("select * from Reponse_depart");
	return $query->result();
}

public function afficher_note($id)
{
	$query = $this->db->query("select note as note from Resultat where id_formation like ?", array($id));
	foreach($query->result() as $row)
	{
		$data = $row->note;
	}
	return $data;
}

public function afficher_note_depart($id)
{
	$query = $this->db->query("select note as note from Resultat_depart where id_formation like ?", array($id));
	foreach($query->result() as $row)
	{
		$data = $row->note;
	}
	return $data;
}

public function inserer_resultat($datas=array())
{
	$this->db->insert('Resultat', $datas);
}

public function afficher_resultat_departs()
{
	$query = $this->db->query("select * from Resultat_depart");
	return $query->result();
}

public function inserer_resultat_depart($datas=array())
{
	$this->db->insert('Resultat_depart', $datas);
}

public function recherche_resultat($idformation)
{
	$query = $this->db->query("select * from Resultat where id_formation like ?", array($idformation));
	if($query->num_rows()>0)
		{
			return true;
		}
	else{
		return false;
	}
}

public function recherche_resultat_departs($idformation)
{
	$query = $this->db->query("select * from Resultat_depart where id_formation like ?", array($idformation));
	if($query->num_rows()>0)
		{
			return true;
		}
	else{
		return false;
	}
}

public function recherche_resultat_depart($idformation)
{
	$query = $this->db->query("select * from Resultat_depart where id_formation like ?", array($idformation));
	if($query->num_rows()>0)
		{
			return true;
		}
	else{
		return false;
	}
}

public function supprimer_resultat()
{
	$query = $this->db->query("DELETE FROM Resultat");
	return $query;
}

function creation_table_resultat_depart()
   {
        $q = $this->db->query("CREATE TABLE Resultat_depart (id int primary key auto_increment, nom_stagiaire varchar(100) null, prenom_stagiaire varchar(100) null, id_formation varchar(100) null, note int null) engine=innoDB");
        return $q;
   }
   function creation_table_qcm_depart()
   {
        $q = $this->db->query("CREATE TABLE Questionnaire_depart (id_questionnaire int primary key auto_increment, question varchar(200) not null, id_formation varchar(100) null) engine=innoDB");
        return $q;
   }

   function creation_table_reponse_qcm_depart()
   {
        $q = $this->db->query("CREATE TABLE Reponse_depart (id int auto_increment primary key, id_questionnaire int, libelle_reponse varchar(200) not null, reponse  int null, index(id_questionnaire), foreign key(id_questionnaire) references Questionnaire_depart(id_questionnaire) on delete cascade on update cascade)  engine=innoDB");
        return $q;
   }

   function supprimer_table()
   {
	$query = $this->db->query("DROP TABLE Reponse_depart");
	return $query;

   }

   public function supprimer_reponse_departs()
   {
	 $query = $this->db->query("delete from Resultat_depart");
	 return $query;
   }

   public function supprimer_reponse_fins()
   {
	 $query = $this->db->query("delete from Resultat");
	 return $query;
   }
function Supprimer_Formations($id)
{
	$query = $this->db->query("DELETE FROM formation WHERE id like ?", array($id));
	return $query;
}

function modifier_suivi()
{
	$query = $this->db->query("Update formation set suivi = 'https://docs.google.com/document/d/19xUPF42wHAPa1TS2xbYk-kbykxyT7Pff1ADJ0lks-B8/edit?usp=drivesdk' where id like 'MEYER-3-MERCH-01'");
	return $query;

}

function modifier_suivi_attestation()
{
	$query = $this->db->query("Update formation set drive = 'https://docs.google.com/document/d/1WRU2E_fARXQd7S-uF0kb3F5GwNga0JgqUOeGv8cReF4/edit?usp=drivesdk' where id like 'MEYER-3-MERCH-01'");
	return $query;

}
function modifier_table_resultats()
{

}
function creation_table_resultat()
   {
        $q = $this->db->query("CREATE TABLE Resultat (id int primary key auto_increment, nom_stagiaire varchar(100) null, prenom_stagiaire varchar(100) null, id_formation varchar(100) null, note int null) engine=innoDB");
        return $q;
   }
function creation_table_qcm()
   {
        $q = $this->db->query("CREATE TABLE Questionnaire (id_questionnaire int primary key auto_increment, question varchar(100) not null, id_formation varchar(100) null) engine=innoDB");
        return $q;
   }

function creation_table_reponse_qcm()
   {
        $q = $this->db->query("CREATE TABLE Reponse (id int auto_increment primary key, id_questionnaire int, libelle_reponse varchar(100) not null, reponse  int null, index(id_questionnaire), foreign key(id_questionnaire) references Questionnaire(id_questionnaire) on delete cascade on update cascade)  engine=innoDB");
        return $q;
   }

function afficher_questionnaires()
{
	$query = $this->db->query("select * from Questionnaire");
	return $query->result();

}

function Recherche_reponsess($id_formation,$question)
{
	$query = $this->db->query("select Reponse.reponse as reponse from Questionnaire, Reponse where Questionnaire.id_questionnaire = Reponse.id_questionnaire and Questionnaire.id_formation like ? and substr(Questionnaire.question,1,11) like ? And Reponse.reponse like 1", array($id_formation, $question));
	foreach($query->result() as $row)
	{
		$data = $row->reponse;
	}
	return $data;
}

function modifier_rang($id,$rang)
{
	$q = $this->db->query("Update Reponse set rang = ? where id like ?", array($rang, $id));
	return $q;
}

function modifier_rang_depart($id,$rang)
{
	$q = $this->db->query("Update Reponse_depart set rang = ? where id like ?", array($rang, $id));
	return $q;
}

function modifier_table_reponse()
{
	$q = $this->db->query("ALTER TABLE Reponse ADD COLUMN rang int null");
	return $q;

}


function modifier_table_reponse_depart()
{
	$q = $this->db->query("ALTER TABLE Reponse_depart ADD COLUMN rang int null");
	return $q;

}

   public function maximum()
   {
	 $query = $this->db->query("select max(id_questionnaire) as maxi from Questionnaire");
	 foreach($query->result() as $row)
	 {
		$data = $row->maxi;
	 }
	 return $data;
   }

   public function maximum_depart()
   {
	 $query = $this->db->query("select max(id_questionnaire) as maxi from Questionnaire_depart");
	 foreach($query->result() as $row)
	 {
		$data = $row->maxi;
	 }
	 return $data;
   }

   public function enregistrer_question($data=array())
   {
	$this->db->insert('Questionnaire', $data);
   }

   public function enregistrer_question_fin($data=array())
   {
	$this->db->insert('Questionnaire', $data);
   }

   public function enregistrer_reponse_fin($data=array())
   {
	$this->db->insert('Reponse', $data);
   }
   public function enregistrer_question_depart($data=array())
   {
	$this->db->insert('Questionnaire_depart', $data);
   }
   public function enregistrer_reponse($data=array())
   {
	$this->db->insert('Reponse', $data);
   }

   public function enregistrer_reponse_depart($data=array())
   {
	$this->db->insert('Reponse_depart', $data);
   }

   

	public function get_les_qcms(){
		$this->db->from('qcm');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add_qcm($id_formation,$type){

		$data = array(
				'titre' => $this->input->post('titre'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
				'type'=>$type,
			);
 		return $this->db->insert('qcm',$data);
	}

	public function update_qcm($id,$id_formation){

		$data = array(
				'titre' => $this->input->post('titre'),
				'link' => $this->input->post('link'),
				'id_formation' => $id_formation,
				'type'=>$type,
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

	public function get_les_support_prof()
	{
		$this->db->select('*,support_prof.id as id, support_prof.prof as prof, support.nom as titre, support.link as link');
		$this->db->from('support_prof');
		$this->db->join('support', 'support.id = support_prof.support','inner');
		
		$query = $this->db->get();
		//$query = $this->db->query("select support_prof.id as id, support_prof.prof as prof, support.nom as titre, support.link as link, prof.nom as nom from support,support_prof,prof where support.id = support_prof.support and support_prof.support = prof.id");
		return $query->result_array();
	}
	public function get_les_support_apprenant(){
		$this->db->select('*,support_apprenant.id as id, support_apprenant.apprenant as id_formation, support.nom as titre, support.link as link');
		$this->db->from('support_apprenant');
		$this->db->join('support', 'support.id = support_apprenant.support','inner');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function rechercher_nom_prof($id)
	{
		$query = $this->db->query("select * from prof where id like ?", array($id));
		foreach($query->result() as $row)
		{
			$data = $row->nom;
		}
		return $data;
	}

	public function rechercher_prenom_prof($id)
	{
		$query = $this->db->query("select * from prof where id like ?", array($id));
		foreach($query->result() as $row)
		{
			$data = $row->prenom;
		}
		return $data;
	}

	public function liste_support_prof()
	{
		$query = $this->db->query("select * from support_prof");
		return $query->result();
	}

	public function add_support_apprenant($id_formation){

		$data = array(
				'support' => $this->input->post('support'),
				'apprenant' => $id_formation,
			);
 		return $this->db->insert('support_apprenant',$data);
	}

	public function add_support_prof($prof){

		$data = array(
				'support' => $this->input->post('support'),
				'prof' => $prof,
			);
 		return $this->db->insert('support_prof',$data);
	}

	public function add_support_apprenants($data=array()){

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

	public function delete_support_prof($id){
		$this->db->where('id', $id);
		return $this->db->delete('support_prof');
	}

	public function delete_scenario_prof($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('scenario_pedagogique_formateur');
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


	public function evaluation_chaud(){

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

	

	public function evaluation_a_chaud()
	{
		$query = $this->db->query("select * from evaluation_hot");
		return $query->result();
	}

public function supprimer_evaluation_a_chaud($id)
{
	$query = $this->db->query("delete from evaluation_hot where id_formation like ?", array($id));
	return $query;
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