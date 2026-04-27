<h1 class="h3 mb-2 text-gray-800">Procedures</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <?php include('procedure_header.php'); ?>
    <br>
</div>
	<div class="card-body">
		<strong>Gestion des procedures</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutProcedure">Ajouter</button>
		<br>
		<br>

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Télechargement</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($procedures as $procedure): ?>
					<tr>
						<td><?php echo $procedure['nom'] ?></td>
						<td>
							<?php if($procedure['link']!=''): ?>
							 <a class="btn btn-info" href="<?php echo base_url('/assets/procedures/').$procedure['link'] ?>">Télecharger</a>
							<?php endif; ?>
						</td>
						<td><button class="btn bnt-xs btn-info btnEditProcedure" data-id="<?php echo $procedure['id'] ?>" data-nom="<?php echo $procedure['nom'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_procedure/').$procedure['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutProcedure" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout procedure</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_procedure'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Titre" required>
					<p>Procedure:<input type="file"  name="link"></p>
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

<div class="modal fade" id="editProcedure" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Procedure</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_procedure'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idProcess" required>
					<input type="text" class="form-control" name="nom" id="nomProcess" placeholder="Titre" required>
					<p>Procedure:<input type="file"  name="link"></p>
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