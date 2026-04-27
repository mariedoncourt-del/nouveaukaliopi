<h1 class="h3 mb-2 text-gray-800">Récrutement <?php echo date('Y'); ?></h1>

<div class="card shadow mb-4">

<style>



  strong{

  	color: black !important;

  }



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

<div class="card-header py-3">

    <a class="btn btn-primary" href="<?php echo base_url().'admin/recrutement' ?>">Récrutement</a> 

    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_recrutement' ?>">Gestion de recrutement</a>

    <br>

</div>

	<div class="card-body parent">

	<strong>Sites de récrutement <?php echo date('Y'); ?></strong>

	<div class="col-md-10 sup-formation">

			<div class="row">

			<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='site'): ?>

				<div class="col-md-3">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php endforeach; ?>

			</div>

		</div>

	</div>



	<div class="card-body parent">

	<strong>Fiche de sélection <?php echo date('Y'); ?></strong>

		<div class="col-md-10 sup-formation">

			<div class="row">

				<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='fiches'): ?>

				<div class="col-md-6">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

				<?php endif; ?>

			<?php endforeach; ?>



       </div>

     </div>

  </div>



  <div class="card-body parent">

	<strong>Templates offres <?php echo date('Y'); ?></strong>

	<div class="col-md-10 sup-formation">

			<div class="row">

			<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='templates'): ?>

				<div class="col-md-6">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php endforeach; ?>

			</div>

		</div>

	</div>



	<div class="card-body parent">

	<strong>Fiches Metiers <?php echo date('Y'); ?></strong>

	<div class="col-md-10 sup-formation">

			<div class="row">

			<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='jobs'): ?>

				<div class="col-md-6">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php endforeach; ?>

			</div>

		</div>

	</div>



	<div class="card-body parent">

	<strong>Livret d'accueil <?php echo date('Y'); ?></strong>

		<div class="col-md-10 sup-formation">

			<div class="row">

				<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='booklet'): ?>

				<div class="col-md-6">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

				<?php endif; ?>

			<?php endforeach; ?>

       </div>

     </div>

  </div>



  <div class="card-body parent">

	<strong>Contrat <?php echo date('Y'); ?></strong>

		<div class="col-md-10 sup-formation">

			<div class="row">

				<?php foreach($recrutements as $recrutement): ?>

				<?php if($recrutement['category']=='contrat'): ?>

				<div class="col-md-6">

					<?php if($recrutement['lien']!=''): ?>

							 		<a target="_blank"  href="<?php echo $recrutement['lien'] ?>"><?php echo $recrutement['nom'] ?></a>

							 	<?php else: ?>

							 		<a target="_blank" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>"><?php echo $recrutement['nom'] ?></a>

							<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php endforeach; ?>

       </div>

     </div>

  </div>  

  <div class="card-body parent">

<strong>Charte et protocole formateur <?php echo date('Y'); ?></strong>

	<div class="col-md-10 sup-formation">

		<div class="row">

			

			<div class="col-md-6">
				<a target="_blank" href="<?php echo base_url('/assets/pdf/MAF PROTOCOLE FORMATEUR INDEPENDANT 2022.pdf') ?>">Protocole formateur indépendant</a>
			</div>
			<div class="col-md-6">
				<a target="_blank" href="<?php echo base_url('/assets/pdf/charte maf.pdf') ?>">Charte MAF</a>
			</div>

			

			</div>

		

   </div>

 </div>

</div>  






</div>