<h1 class="h3 mb-2 text-gray-800">Programmes</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
	 <a class="btn btn-primary" href="<?php echo base_url().'admin/programme' ?>">Les programmes</a> 
    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_programme' ?>">Gestion des programmes</a>
	<br>
</div>
	<div class="card-body">

		<strong>Gestion des supports</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutProgramme">Ajouter</button>
		<br>
		<br>

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Vue</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($programmes as $programme): ?>
					<tr>
						<td><?php echo $programme['nom'] ?></td>
						<td>
							<?php if($programme['link']!=''): ?>
							 <img src="<?php echo base_url('/assets/programmes/').$programme['link'] ?>" style="width:165px;height: 165px;">
							<?php endif; ?>
						</td>
						<td><button class="btn bnt-xs btn-info btnEditProgramme" data-id="<?php echo $programme['id'] ?>" data-nom="<?php echo $programme['nom'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_programme/').$programme['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutProgramme" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout programme</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_programme'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Titre" required>
					<p>Programme:<input type="file"  name="link"></p>
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

<div class="modal fade" id="editProgramme" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Programme</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_programme'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idProg" required>
					<input type="text" class="form-control" name="nom" id="nomProg" placeholder="Titre" required>
					<p>Programme:<input type="file"  name="link"></p>
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