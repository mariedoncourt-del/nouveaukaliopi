<h1 class="h3 mb-2 text-gray-800">Certifications</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <a class="btn btn-primary" href="<?php echo base_url().'admin/certification' ?>">Certifications</a> 
    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_certificat' ?>">Gestion des certificats</a>
    <br>
</div>
	<div class="card-body">
		<strong>Gestion des certifications</strong>
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutCertificat">Ajouter</button>
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
					<?php foreach($certificats as $certificat): ?>
					<tr>
						<td><?php echo e($certificat['nom']) ?></td>
						<td>
							<?php if($certificat['link']!=''): ?>
							 <a class="btn btn-info" href="<?php echo base_url('/assets/certificat/').rawurlencode($certificat['link']) ?>">Télecharger</a>
							<?php endif; ?>
						</td>
						<td><button class="btn bnt-xs btn-info btnEditCertificat" data-id="<?php echo e_attr($certificat['id']) ?>" data-nom="<?php echo e_attr($certificat['nom']) ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_certificat/').rawurlencode($certificat['id']) ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutCertificat" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout certificat</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_certificat'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Titre" required>
					<p>Certification:<input type="file"  name="link"></p>
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

<div class="modal fade" id="editCertificat" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Certificat</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_certificat'); ?>

		<div class="modal-body">
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idCert" required>
					<input type="text" class="form-control" name="nom" id="nomCert" placeholder="Titre" required>
					<p>Certification:<input type="file"  name="link"></p>
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