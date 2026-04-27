<h1 class="h3 mb-2 text-gray-800">Apprenants</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutApprenant">Ajouter</button>
	</div>
	<div class="card-body">

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prenom</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($apprenants as $apprenant): ?>
						<tr>
							<td><?php echo e($apprenant['nom']) ?></td>
							<td><?php echo e($apprenant['prenom']) ?></td>
							<td><button data-nom="<?php echo e_attr($apprenant['nom']) ?>" data-id="<?php echo e_attr($apprenant['id']) ?>" data-prenom="<?php echo e_attr($apprenant['prenom']) ?>" class="btn bnt-xs btn-info btnEditApprenant">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('admin/delete_apprenant/').rawurlencode($apprenant['id']) ?>">Supprimer</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutApprenant" tabindex="-1" role="dialog" aria-labelledby="apprenantModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="apprenantModalLabel">Nouvel apprenant</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<form action="<?php echo base_url('admin/create_apprenant') ?>" method="post">
		<div class="modal-body">
			
				<div class="row">
					<input type="text" class="form-control" name="nom" placeholder="Nom" required>
					<input type="text" class="form-control" name="prenom" placeholder="Prenom" required>
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

<div class="modal fade" id="editApprenant" tabindex="-1" role="dialog" aria-labelledby="apprenantModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="apprenantModalLabel">Modifier Apprenant</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<form action="<?php echo base_url('admin/update_apprenant') ?>" method="post">
		<div class="modal-body">
			
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idApprenant" placeholder="Nom" required>
					<input type="text" class="form-control" name="nom" id="nomApprenant" placeholder="Nom" required>
					<input type="text" class="form-control" name="prenom" id="prenomApprenant" placeholder="Prenom" required>
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