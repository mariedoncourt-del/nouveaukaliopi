<h1 class="h3 mb-2 text-gray-800">Procedures</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <?php include('procedure_header.php'); ?>
    <br>
</div>
	<div class="card-body">
		<strong>Gestion des QCM Attribué aux stages</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutQCM">Ajouter</button>
		<br>
		<br>

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Lien</th>
						<th>ID Formation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($qcms as $qcm): ?>
					<tr>
						<td><?php echo $qcm['titre'] ?></td>
						<td>
							<?php if($qcm['link']!=''): ?>
							 		<a class="btn btn-info" href="<?php echo $qcm['link'] ?>">Voir</a>
							 	<?php else: ?>
							 		<a class="btn btn-info" href="<?php echo base_url('/assets/qcms/').$qcm['link'] ?>">Voir</a>
							<?php endif; ?>
						</td>
						<td><?php echo $qcm['id_formation'] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditQcm" data-id="<?php echo $qcm['id'] ?>" data-titre="<?php echo $qcm['titre'] ?>" data-link="<?php echo $qcm['link'] ?>" data-id_formation="<?php echo $qcm['id_formation'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_qcm/').$qcm['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutQCM" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout QCM</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_qcm'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="titre" placeholder="Titre" required>
					<textarea class="form-control" name="link" placeholder="Lien QCM"></textarea>
					<select name="id_formation">
						<option value="">--ID FORMATION--</option>
						<?php foreach($formations as $formation): ?>
							<option value="<?php echo $formation['id'] ?>"><?php echo $formation['id'] ?></option>
						<?php endforeach; ?>
					</select>
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

<div class="modal fade" id="editQcm" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Procedure</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_qcm'); ?>

		<div class="modal-body">
                 <div class="row">
                 	<input type="hidden" class="form-control" name="id" id="idQcm" required>
					<input type="text" class="form-control" name="titre" id="titre" placeholder="Titre" required>
					<textarea class="form-control" name="link" id="link" placeholder="Lien QCM"></textarea>
					<select name="id_formation" id="idFormation" class="form-control">
						<option value="">--ID FORMATION--</option>
						<?php foreach($formations as $formation): ?>
							<option value="<?php echo $formation['id'] ?>"><?php echo $formation['id'] ?></option>
						<?php endforeach; ?>
					</select>
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