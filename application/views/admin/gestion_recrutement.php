<h1 class="h3 mb-2 text-gray-800">Récrutements</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
	<a class="btn btn-primary" href="<?php echo base_url().'admin/recrutement' ?>">Récrutement</a> 
    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_recrutement' ?>">Gestion de recrutement</a>
	<br>
</div>
	<div class="card-body">
		<strong>Gestion des supports</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutRecrutement">Ajouter</button>
		<br>
		<br>

		<?php 
			$categories=['site'=>'Site de récutement',
						'fiches'=>'Fiche de sélection',
					 	'templates'=>'Templates offres',
					 	'jobs'=>'Fiches Metiers',
					 	'booklet'=>'Livret d\'accueil',
					 	'contrat'=>'Contrat'];
		 ?>

		 <?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Lien / Fichier</th>
						<th>Categorie</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($recrutements as $recrutement): ?>
					<tr>
						<td><?php echo $recrutement['nom'] ?></td>
						<td>
							<?php if($recrutement['lien']!=''): ?>
							 		<a class="btn btn-info" href="<?php echo $recrutement['lien'] ?>">Voir</a>
							 	<?php else: ?>
							 		<a class="btn btn-info" href="<?php echo base_url('/assets/recrutements/').$recrutement['link'] ?>">Voir</a>
							<?php endif; ?>
						</td>
						<td><?php echo $categories[$recrutement['category']] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditRecrutement" data-id="<?php echo $recrutement['id'] ?>" data-link="<?php echo $recrutement['link'] ?>" data-lien="<?php echo $recrutement['lien'] ?>" data-nom="<?php echo $recrutement['nom'] ?>" data-category="<?php echo $recrutement['category'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_recrutement/').$recrutement['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutRecrutement" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout récrutement</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_recrutement'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Titre" required>
					<select class="form-control" name="category">
						<option value="site">Site de récutement</option>
						<option value="fiches">Fiche de sélection</option>
						<option value="templates">Templates offres</option>
						<option value="jobs">Fiches Metiers </option>
						<option value="booklet">Livret d'accueil </option>
						<option value="contrat">Contrat</option>
					</select>
					<p>Support:<input type="file"  name="link"></p>
					<input type="text" class="form-control" name="lien" placeholder="Lien">
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

<div class="modal fade" id="editRecrutement" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Evaluation</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_recrutement'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idRec" required>
					<input type="text" class="form-control" name="nom" id="nomRec" placeholder="Titre" required>
					<select class="form-control" name="category" id="categoryRec">
						<option value="site">Site de récutement</option>
						<option value="fiches">Fiche de sélection</option>
						<option value="templates">Templates offres</option>
						<option value="jobs">Fiches Metiers </option>
						<option value="booklet">Livret d'accueil </option>
						<option value="contrat">Contrat</option>
					</select>
					<p>Support:<input type="file"  name="link"></p>
					<input type="text" class="form-control" name="lien" id="lienRec" placeholder="Lien">
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