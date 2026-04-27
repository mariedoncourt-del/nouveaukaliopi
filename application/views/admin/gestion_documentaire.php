<h1 class="h3 mb-2 text-gray-800">Procedures</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
	<?php include('procedure_header.php'); ?>
	<br>
</div>
	<div class="card-body">
		<strong>Gestion des documents pédagogiques</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutDocument">Ajouter</button>
		<br>
		<br>

		<?php 
			$categories=['document'=>'Document',
						'video'=>'Video',
					    'couverture'=>'Couverture'];
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
					<?php foreach($documents as $document): ?>
					<tr>
						<td><?php echo $document['nom'] ?></td>
						<td>
							<?php if($document['lien']!=''): ?>
							 		<a class="btn btn-info" href="<?php echo $document['lien'] ?>">Voir</a>
							 	<?php else: ?>
							 		<a class="btn btn-info" href="<?php echo base_url('/assets/documents/').$document['link'] ?>">Voir</a>
							<?php endif; ?>
						</td>
						<td><?php echo $categories[$document['category']] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditDocument" data-id="<?php echo $document['id'] ?>" data-link="<?php echo $document['link'] ?>" data-lien="<?php echo $document['lien'] ?>" data-nom="<?php echo $document['nom'] ?>" data-category="<?php echo $document['category'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_document/').$document['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutDocument" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout document</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_document'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Titre" required>
					<select class="form-control" name="category">
						<option value="document">Document</option>
						<option value="video">Video</option>
						<option value="couverture">Couverture</option>
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

<div class="modal fade" id="editDocument" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Document</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_document'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idDoc" required>
					<input type="text" class="form-control" name="nom" id="nomDoc" placeholder="Titre" required>
					<select class="form-control" name="category" id="categoryDoc">
						<option value="document">Document</option>
						<option value="video">Video</option>
						<option value="couverture">Couverture</option>
					</select>
					<p>Document:<input type="file"  name="link"></p>
					<input type="text" class="form-control" name="lien" id="lienDoc" placeholder="Lien">
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