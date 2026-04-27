<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kami extends CI_Controller {

	public function index(){
			$formations=$this->FormationModel->get_formations();
 			$profs=$this->FormationModel->get_profs();
 			$les_cours=$this->FormationModel->get_cours();
 			$apprenant=$this->FormationModel->get_apprenants();

			foreach ($formations as $formation) {
				echo $formation['id'].' => <br>';

				$formation_single=$this->FormationModel->get_formation($formation['id']);
				//$data['formation']=$this->FormationModel->get_formation($id_formation);

				echo $formation_single['prenom_apprenant'].' '.$formation_single['nom_apprenant'].'<br>';
				echo $formation_single['cours'].'<br>';

				$id_formation='ATTESTATION-'.$formation['id'];
 				$id_formation=str_replace(' ','',$id_formation);

	 			$attestation="";
	 			$apprenant_name=str_replace(' ','%20',$formation_single['nom_apprenant']);
	 			$apprenant_pre=str_replace(' ','%20',$formation_single['prenom_apprenant']);				

				$url = 'https://script.google.com/macros/s/AKfycbwynC9lClkdbezE8sOaub9sCOYMbbOX3dmp1fdEpcn5LfaE3cACv2tIW90mqwRj_YrG/exec?idFormation='.$id_formation.'&apprenantName='.$apprenant_name.'&apprenantPre='.$apprenant_pre;


				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
				$attestation = curl_exec($curl);			

				if($attestation==""){
					echo '<p style="color:red">NO</p><br>';
				}else{
					echo '<p style="color:green">OK</p><br>';
					$this->FormationModel->update_drive($formation['id'], $attestation);
				}
				echo '<br>';
				}

				curl_close($curl);

		}
 	}