<h1 class="h3 mb-2 text-gray-800">Scénario pédagogique</h1>

<div class="card shadow mb-4">

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





	<div class="card-body">

		<strong>Gestion des scénarios</strong>

		<br>

		<br>

		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutSupport">Ajouter</button>

		<br>

		<br>



		<?php 

 $categorie=['gestion'=>'Gestion',

			'immobilier'=>'Immobilier',

			'vente'=>'Vente et Commerce',

		    'sociaux'=>'Réseaux sociaux',

			'informatique'=>'Informatique',

			'culinaire'=>'Culinaire',

		    'management'=>'Management',

		    'digital'=>'Marketing Digital',

		    'ecommerce'=>'Commerce en ligne',

		    'autres'=>'Autres'];

 ?>



 <?php echo $this->session->flashdata('msg'); ?>

		

		<div class="table-responsive">

			<table class="table table-bordered" width="100%" cellspacing="0">

				<thead>

					<tr>

						<th>Titre</th>

						<th>Télechargement</th>

						<th>Categorie</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($supports as $support): ?>

					<tr>

						<td><?php echo $support['nom'] ?></td>

						<td>

							<?php if($support['link']!=''): ?>

							 <a class="btn btn-info" href="<?php echo base_url('/assets/word/').$support['link'] ?>">Télecharger</a>

							<?php endif; ?>

						</td>

						<td><?php echo $support['category']//$categorie[$support['category']]; ?></td>

						<td><button class="btn bnt-xs btn-info btnEditSupport" data-id="<?php echo $support['id'] ?>" data-nom="<?php echo $support['nom'] ?>" data-category="<?php echo $support['category'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_scenario_pedagogique/').$support['id'] ?>">Supprimer</button></td>

					</tr>

					<?php endforeach; ?>

				</tbody>

			</table>

		</div>



	</div>

	

</div>



<div class="modal fade" id="ajoutSupport" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Ajout scénario pédagogique</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/create_scenario_pedagogique'); ?>



		<div class="modal-body">

			

				<div class="row">

					<input type="text" class="form-control" name="nom" placeholder="Titre" required>

					<select class="form-control" name="category">

						<option value="gestion">Gestion</option>

						<option value="immobilier">Immobilier</option>

						<option value="vente">Vente et Commerce</option>

						<option value="sociaux">Réseau Sociaux</option>

						<option value="management">Management</option>

						<option value="informatique">Informatique</option>

						<option value="culinaire">Culinaire</option>

						<option value="digital">Marketing Digital</option>

						<option value="Commerce en ligne">Commerce en Ligne</option>

						<option value="autres">Autres</option>

					</select>

					<p>Support:<input type="file"  name="link"></p>

                 </div>

				

			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

				<button class="btn btn-success" type="submit">Ajouter</button>

			</div>

		</form>

		</div>

	</div>

</div>



<div class="modal fade" id="editSupport" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Evaluation</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/update_scenario_pedagogique'); ?>



		<div class="modal-body">

				<div class="row">

					<input type="hidden" class="form-control" name="id" id="idSup" required>

					<input type="text" class="form-control" name="nom" id="nomSup" placeholder="Titre" required>

					<select class="form-control" name="category" id="categorySup">

						<option value="gestion">Gestion</option>

						<option value="immobilier">Immobilier</option>

						<option value="vente">Vente et Commerce</option>

						<option value="sociaux">Réseau Sociaux</option>

						<option value="management">Management</option>

						<option value="informatique">Informatique</option>

						<option value="culinaire">Culinaire</option>

						<option value="digital">Marketing Digital</option>

						<option value="ecommerce">Commerce en Ligne</option>

						<option value="autres">Autres</option>

					</select>

					<p>Scénario :<input type="file"  name="link"></p>

                 </div>

				

			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

				<button class="btn btn-success" type="submit">Modifier</button>

			</div>

		</form>

		</div>

	</div>

</div>