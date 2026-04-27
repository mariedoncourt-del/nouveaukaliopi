<h1 class="h3 mb-2 text-gray-800">Veille</h1>
<p><a class="btn btn-primary" href="<?php echo base_url('welcome/archive') ?>">Archives</a></p>
<?php 

$compare=[];

 		foreach($archives as $archive){
 			$compare[]=$archive['url'];
 		}

function render_feed($feed, $compare, $category, $label, $formationModel) {
	if (!$feed || !isset($feed->channel->item)) return;
	echo '<strong class="titre-veille">'.$label.'</strong>';
	$items = $feed->channel->item;
	$count = min(10, count($items));
	for($i=0; $i<$count; $i++) {
		$url   = (string)$items[$i]->link;
		$title = (string)$items[$i]->title;
		if (!$url || !$title) continue;
		echo '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';
		if(!in_array($url, $compare)){
			$veille=['url'=>$url,'title'=>$title,'category'=>$category];
			$formationModel->add_veille($veille);
		}
	}
}

?>
<div class="card shadow mb-4">
	<div class="card-body">

		<ul>
			<?php
			render_feed($feed_one,   $compare, 1, 'Actualités Pédagogiques',          $this->FormationModel);
			render_feed($feed_ginter,$compare, 7, 'Actualités Pédagogiques (Interactions)', $this->FormationModel);
			render_feed($feed_two,   $compare, 2, 'Actualités Juridiques',             $this->FormationModel);
			render_feed($feed_three, $compare, 3, 'Actualités Marketing',              $this->FormationModel);
			render_feed($feed_tech,  $compare, 4, 'Veille outils technologiques',      $this->FormationModel);
			render_feed($feed_hyg,   $compare, 6, 'Hygiènes et sécurité alimentaires', $this->FormationModel);
			render_feed($feed_four,  $compare, 5, 'Actualités',                        $this->FormationModel);
			?>

			<strong class="titre-veille">Veille Handicap</strong>
			<?php echo '<li><a href="'.$handicap_url.'" target="_blank">'.$handicap_title.'</a></li>'; ?>

			<strong class="titre-veille">Veille Comptabilité</strong>
			<?php echo '<li><a href="'.$compta_url.'" target="_blank">'.$compta_title.'</a></li>'; ?>

			<strong class="titre-veille">Veille Certification</strong>
			<?php foreach($certif_urls as $certif_url){ echo '<li><a href="'.$certif_url['url'].'" target="_blank">'.$certif_url['title'].'</a></li>'; } ?>
		</ul>

	</div>    
</div>
