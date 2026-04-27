<?php

 class WelcomeModel extends CI_Model{

 	public function login_public($id_formation){

		$this->db->where('id', $id_formation);



		$result = $this->db->get('formation');



		if($result->num_rows() == 1){

			return $result->row(0)->id;

		}else{

			return false;

		}

	}


public function get_cours(){

		$query = $this->db->query("select * from cours");
      
            return $query->result() ;
		
	}

	public function add_courss(){

		$data = array(
				'id' => 'MAR',
				'titre' => 'MARKETING 3.0',
			);
 		return $this->db->insert('cours',$data);
	}


	public function insert_admin($datas=array())
	{
		$this->db->insert('admin',$datas);
	}

public function listadmin()
	{
			$query= $this->db->query("Select * from admin");
			return $query;
	}

	public function supprimerAdmin($login)
	{
		
		$query = $this->db->query("delete from admin where login like '".$login."'");
       
            return $query ;
               
      
	}
	

	public function modifier_admin($login,$password)
	{
		$query = $this->db->query("update admin set password= '".md5($password)."' where login='".$login."'");
      
            return $query ;
               
	}

	public function login_admin($login, $password){

		$this->db->where('login', $login);

		$this->db->where('password', $password);



		$result = $this->db->get('admin');



		if($result->num_rows() == 1){

			return $result->row(0)->login;

		}else{

			return false;

		}

	}



	public function eval_hot_exist($id_formation){

		$this->db->where('id_formation',$id_formation);

		$result = $this->db->get('evaluation_hot');



		if($result->num_rows() >= 1 ){

			return true;

		}else{

			return false;

		}

	}

 }