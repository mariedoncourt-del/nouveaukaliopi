<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamo extends CI_Controller {

	public function index(){
			$formations=$this->FormationModel->get_formations();

			foreach ($formations as $formation) {
				echo $formation['id'].' => <br>';

				if($this->WelcomeModel->eval_hot_exist($formation['id'])){
 					echo 'Existing<br>';
 				}else{
 					echo 'Not existing<br>';
 					if($this->FormationModel->add_evaluation_hot($formation['id'])){
 						echo '<p style="color:green">[Yes]</p>';
 					}else{
 						echo '<p style="color:red">[No]</p>';
 					}
 				}
			}

		}
 	}