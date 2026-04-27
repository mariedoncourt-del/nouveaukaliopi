<h1 class="h3 mb-2 text-gray-800">Profs</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutProf">Ajouter</button>
	</div>
	<div class="card-body">

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prenom</th>
						<th>CV</th>
						<th>Charte</th>
						<th>Mise à jour (Diplome,Certificats)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($profs as $prof): ?>
					<tr>
						<td><?php echo e($prof['nom']) ?></td>
						<td><?php echo e($prof['prenom']) ?></td>
						<td><a href="<?php echo base_url('/assets/cv/').rawurlencode($prof['profile']) ?>">
							<?php if($prof['profile']!='') echo 'CV'; ?>
						</a></td>
						<td>
							<?php if($prof['charte']!=''): ?>
							 <a class="btn btn-info" href="<?php echo base_url('/assets/charte/').rawurlencode($prof['charte']) ?>">Charte Qualité</a>
							<?php endif; ?>
						</td>
						<td>
							<?php if($prof['maj']!=''): ?>
							 <a class="btn btn-primary" href="<?php echo base_url('/assets/maj/').rawurlencode($prof['maj']) ?>">Mise à jour</a>
							<?php endif; ?>
						</td>
						<td><button data-nom="<?php echo e_attr($prof['nom']) ?>" data-id="<?php echo e_attr($prof['id']) ?>" data-prenom="<?php echo e_attr($prof['prenom']) ?>" class="btn bnt-xs btn-info btnEditProf">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('admin/delete_prof/').rawurlencode($prof['id']) ?>">Supprimer</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutProf" tabindex="-1" role="dialog" aria-labelledby="profModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout Prof</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/create_prof'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Nom" required>
					<input type="text" class="form-control" name="prenom" placeholder="Prenom" required>
					<p>CV:<input type="file"  name="cv"></p>
					<p>Charte:<input type="file"  name="charte"></p>
					<p>Maj:<input type="file"  name="maj"></p>
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

<div class="modal fade" id="editProf" tabindex="-1" role="dialog" aria-labelledby="profModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Modifier Prof</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('admin/update_prof'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="hidden" name="id" id="idProf">
					<input type="text" class="form-control" name="nom" id="nomProf" placeholder="Nom" required>
					<input type="text" class="form-control" name="prenom" id="prenomProf" placeholder="Prenom" required>
					<p>CV:<input type="file"  name="cv"></p>
					<p>Charte:<input type="file"  name="charte"></p>
					<p>Maj:<input type="file"  name="maj"></p>
                 </div>
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
				<button class="btn btn-success" type="submit">Modifier</button>
			</div>
		</form>
		</div>
	</div>
</div