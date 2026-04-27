<h1 class="h3 mb-2 text-gray-800">Scénario pédagogique</h1>
<div class="card shadow mb-4">
<style>

	.parent{
		margin-left: 25px;
	}

	.sup-category{
		border: 3px solid black;
		margin: 10px;
		writing-mode: vertical-lr;
		text-orientation: upright;
		text-align: center;
		vertical-align: middle;
		padding: 15px;
		font-size: 18px;
		font-weight: bolder;
		text-transform: uppercase;
		color: black;
	}

	.sup-formation{
		margin: 10px;
		padding: 15px;
		border: 3px solid black;
	}

	.sup-formation a{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: none;
	}
	.sup-formation a:hover{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: underline;
	}

	.sup-formation a::before {
  		content: "■ ";
	}
</style>
<?php 
$categorie=[
	'gestion'=>'Gestion',
	'immobilier'=>'Immobilier',
	'vente'=>'Vente et Commerce',
	'sociaux'=>'Réseau Sociaux',
	'management'=>'Management',
	'digital'=>'Marketing Digital',
	'ecommerce'=>'Commerce en Ligne',
	'autres'=>'Autres',
];

$categories=[];
foreach ($supports as $support){
	array_push($categories, $support['category']);
}
?>
<div class="card-header py-3">
	<a class="btn btn-primary" href="<?php echo base_url().'admin/support' ?>">Supports de formation</a> 
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support' ?>">Gestion des supports</a>

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_apprenant' ?>">Gestion des Supports - Apprenant</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/supports' ?>">Gestion des scénarios pédagogiques</a>
    <a class="btn btn-primary" href="<?php echo base_url().'admin/ajouter_scenario_pedagogique' ?>">Ajouter des Scénarios pédagogiques</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_formateur' ?>">Gestion des Supports - Formateur</a>
    
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_scenario_formateur' ?>">Scénario pédagogique - Formateur</a>
	<br>
</div>

<?php 
	$uniques=(array_unique($categories));
   // print_r($uniques);
?>
<div class="card-body parent">
	<strong>Scénario pédagogique</strong>
		<br>
		<br>
	<?php foreach($uniques as $unique): ?>
	<div class="row">
		<div class="col-md-auto sup-category">
			<?php echo $unique//$categorie[$unique] ?>
		</div>
		<div class="col-md-10 sup-formation">
			<div class="row">
			<?php foreach($supports as $support) :?>
				<?php if($support['category']==$unique): ?>
				<div class="col-md-3">
					<a href="<?php echo base_url('admin/download_word/').$support['link']; ?>"><?php echo $support['nom']; ?></a>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>    
</div>