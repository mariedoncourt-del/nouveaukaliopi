<?php
// Protection feeds null
foreach(['feed_one','feed_two','feed_three','feed_four','feed_tech','feed_hyg','feed_ginter','ia','ia1'] as $_fn){
    if(!isset($$_fn) || !$$_fn || !is_object($$_fn)) $$_fn = null;
}
?>
<h1 class="h3 mb-2 text-gray-800">Veille</h1>

<p><a class="btn btn-primary" href="<?php echo base_url('admin/archive') ?>">Archives</a></p>

<?php 



$compare=[];



 		foreach($archives as $archive){

 			$compare[]=$archive['url'];

 		}



?>

<div class="card shadow mb-4">

	<div class="card-body">



		<ul>

			<strong class="titre-veille">Actualités Pédagogiques</strong>



			<?php

			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_one) && $feed_one && isset($feed_one->channel->item[$i]->link) ? (string)$feed_one->channel->item[$i]->link : "#";

				$title = isset($feed_one) && $feed_one && isset($feed_one->channel->item[$i]->title) ? (string)$feed_one->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>1];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}



			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_ginter) && $feed_ginter && isset($feed_ginter->channel->item[$i]->link) ? (string)$feed_ginter->channel->item[$i]->link : "#";

				$title = isset($feed_ginter) && $feed_ginter && isset($feed_ginter->channel->item[$i]->title) ? (string)$feed_ginter->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>7];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}

			?>	



			<strong class="titre-veille">Actualités Juridiques</strong>



			<?php

			

			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_two) && $feed_two && isset($feed_two->channel->item[$i]->link) ? (string)$feed_two->channel->item[$i]->link : "#";

				$title = isset($feed_two) && $feed_two && isset($feed_two->channel->item[$i]->title) ? (string)$feed_two->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>2];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}

			?>



			<strong class="titre-veille">Actualités Marketing</strong>



			<?php

			

			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_three) && $feed_three && isset($feed_three->channel->item[$i]->link) ? (string)$feed_three->channel->item[$i]->link : "#";

				$title = isset($feed_three) && $feed_three && isset($feed_three->channel->item[$i]->title) ? (string)$feed_three->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>3];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}

			?>



		<!--	<strong class="titre-veille">Veille outils technologiques</strong> -->


			<?php

			
/*
			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_tech) && $feed_tech && isset($feed_tech->channel->item[$i]->link) ? (string)$feed_tech->channel->item[$i]->link : "#";

				$title = isset($feed_tech) && $feed_tech && isset($feed_tech->channel->item[$i]->title) ? (string)$feed_tech->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>4];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}*/

			?>



			<strong class="titre-veille">Hygiènes et sécurité alimentaires</strong>



			<?php

			

			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_hyg) && $feed_hyg && isset($feed_hyg->channel->item[$i]->link) ? (string)$feed_hyg->channel->item[$i]->link : "#";

				$title = isset($feed_hyg) && $feed_hyg && isset($feed_hyg->channel->item[$i]->title) ? (string)$feed_hyg->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>6];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}

			?>



			<strong class="titre-veille">Veille Handicap</strong>



			<?php

				echo '<li><a href="'.$handicap_url.'" target="_blank">'.$handicap_title.'</a></li>';

			?>



			<strong class="titre-veille">Veille Comptabilité</strong>



			<?php

				echo '<li><a href="'.$compta_url.'" target="_blank">'.$compta_title.'</a></li>';

			?>



			<strong class="titre-veille">Veille Certification</strong>



			<?php

				foreach($certif_urls as $certif_url){

					echo '<li><a href="'.$certif_url['url'].'" target="_blank">'.$certif_url['title'].'</a></li>';

				}

			?>		



			<strong class="titre-veille">Actualités</strong>



			<?php

			

			for($i=0; $i<10; $i++)

			{

				$url = isset($feed_four) && $feed_four && isset($feed_four->channel->item[$i]->link) ? (string)$feed_four->channel->item[$i]->link : "#";

				$title = isset($feed_four) && $feed_four && isset($feed_four->channel->item[$i]->title) ? (string)$feed_four->channel->item[$i]->title : "Article indisponible";

				echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

				if(in_array($url,$compare)){

 				//

	 			}else{

	 				$veille=['url' => $url, 'title'=>$title, 'category'=>5];

	 				$this->FormationModel->add_veille($veille);

	 			}

			}

			?>																




<strong class="titre-veille">IA</strong>



<?php
/*


for($i=0; $i<10; $i++)

{

	$url = isset($ia) && $ia && isset($ia->channel->item[$i]->link) ? (string)$ia->channel->item[$i]->link : "#";

	$title = isset($ia) && $ia && isset($ia->channel->item[$i]->title) ? (string)$ia->channel->item[$i]->title : "Article indisponible";

	echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

	if(in_array($url,$compare)){

	 //

	 }else{

		 $veille=['url' => $url, 'title'=>$title, 'category'=>5];

		 $this->FormationModel->add_veille($veille);

	 }

}
*/

?>																

<?php



for($i=0; $i<10; $i++)

{

	$url = isset($ia1) && $ia1 && isset($ia1->channel->item[$i]->link) ? (string)$ia1->channel->item[$i]->link : "#";

	$title = isset($ia1) && $ia1 && isset($ia1->channel->item[$i]->title) ? (string)$ia1->channel->item[$i]->title : "Article indisponible";

	echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';

	if(in_array($url,$compare)){

	 //

	 }else{

		 $veille=['url' => $url, 'title'=>$title, 'category'=>5];

		 $this->FormationModel->add_veille($veille);

	 }

}

?>																


		</ul>



	</div>    

</div>