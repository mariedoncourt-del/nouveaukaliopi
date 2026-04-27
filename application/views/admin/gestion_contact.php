<h1 class="h3 mb-2 text-gray-800">Procedures</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <?php include('procedure_header.php'); ?>
    <br>
</div>
	<div class="card-body">
		<strong>Gestions des contact</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutContact">Ajouter</button>
		<br>
		<br>

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Organisme / Agence</th>
						<th>Dept 31</th>
						<th>Dept 81</th>
						<th>Dept 82</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($contacts as $contact): ?>
					<tr>
						<td><?php echo e($contact['titre']) ?></td>
						<td>
							<?php echo e($contact['dept31']) ?>
						</td>
						<td>
							<?php echo e($contact['dept81']) ?>
						</td>
						<td>
							<?php echo e($contact['dept82']) ?>
						</td>
						<td><button class="btn bnt-xs btn-info btnEditContact" data-id="<?php echo e_attr($contact['id']) ?>" data-titre="<?php echo e_attr($contact['titre']) ?>" data-dept31="<?php echo e_attr($contact['dept31']) ?>" data-dept81="<?php echo e_attr($contact['dept81']) ?>" data-dept82="<?php echo e_attr($contact['dept82']) ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_contact/').rawurlencode($contact['id']) ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutContact" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout contact</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_contact'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="titre" placeholder="Organisme ou Agence" required>
					<textarea name="dept31" class="form-control" placeholder="Dans le 31"></textarea>
					<textarea name="dept81" class="form-control" placeholder="Dans le 81"></textarea>
					<textarea name="dept82" class="form-control" placeholder="Dans le 82"></textarea>
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

<div class="modal fade" id="editContact" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Contact</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_contact'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" name="id" id="idContact">
					<input type="text" class="form-control" name="titre" id="titreContact" placeholder="Organisme ou Agence" required>
					<textarea name="dept31" class="form-control" placeholder="Dans le 31" id="dept31"></textarea>
					<textarea name="dept81"  class="form-control"placeholder="Dans le 81" id="dept81"></textarea>
					<textarea name="dept82" class="form-control" placeholder="Dans le 82" id="dept82"></textarea>
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