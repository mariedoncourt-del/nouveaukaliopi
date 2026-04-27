<h1 class="h3 mb-2 text-gray-800">Cours</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutCours">Ajouter</button>
	</div>
	<div class="card-body">

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Titre</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($les_cours as $cours): ?>
					<tr>
						<td><?php echo $cours['id'] ?></td>
						<td><?php echo $cours['titre'] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditCours" data-key="<?php echo $cours['id_key'] ?>" data-id="<?php echo $cours['id'] ?>" data-titre="<?php echo $cours['titre'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('admin/delete_cours/').$cours['id'] ?>">Supprimer</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutCours" tabindex="-1" role="dialog" aria-labelledby="coursModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="coursModalLabel">Ajout Cours</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_cours'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="id_cours" placeholder="ID-COURS" required>
					<input type="text" class="form-control" name="titre" placeholder="Titre" required>
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

<div class="modal fade" id="editCours" tabindex="-1" role="dialog" aria-labelledby="editCoursModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="editCoursModalLabel">Edit Cours</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_cours'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="id_cours" id="idCours" placeholder="ID-COURS" required>
					<input type="hidden" class="form-control" name="id_key" id="idKey"  required>
					<input type="text" class="form-control" name="titre" id="titreCours" placeholder="Titre" required>
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