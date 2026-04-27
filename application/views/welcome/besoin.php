<h1 class="h3 mb-2 text-gray-800">Besoins</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutBesoin">Ajouter</button>
	</div>
	<div class="card-body">

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Contexte</th>
						<th>Caracteristiques</th>
						<th>Contenu</th>
						<th>Ressource</th>
						<th>Planning</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($besoins as $besoin): ?>
						<tr>
							<td><?php echo $besoin['context'] ?></td>
							<td><?php echo $besoin['caractere'] ?></td>
							<td><?php echo $besoin['contenu'] ?></td>
							<td><?php echo $besoin['ressource'] ?></td>
							<td><?php echo $besoin['planning'] ?></td>
							<td><button data-id="<?php echo $besoin['id'] ?>" data-context="<?php echo $besoin['context'] ?>" data-contenu="<?php echo $besoin['contenu'] ?>" data-caractere="<?php echo $besoin['caractere'] ?>" data-ressource="<?php echo $besoin['ressource'] ?>" data-planning="<?php echo $besoin['planning'] ?>" class="btn bnt-xs btn-info btnEditBesoin">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_besoin/').$besoin['id'] ?>">Supprimer</button></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>

	</div>

	<div class="modal fade" id="ajoutBesoin" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="profModalLabel">Ajout besoin</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<?php echo form_open_multipart('welcome/create_besoin'); ?>

			<div class="modal-body">

				<div class="row">
					
						<textarea name="context" rows="4" cols="" class="form-control" placeholder="Context"></textarea>

						<textarea name="caractere" rows="4" cols="" class="form-control" placeholder="Caracteristiques"></textarea>
				
			
						<textarea name="contenu" rows="4" cols="" class="form-control" placeholder="Contenu"></textarea>
					
						<textarea name="ressource" rows="4" cols="" class="form-control" placeholder="Ressources"></textarea>
					
					
						<textarea name="planning" rows="4"  class="form-control" placeholder="Planning"></textarea>
					
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

<div class="modal fade" id="editBesoin" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="profModalLabel">Modifier besoin</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<?php echo form_open_multipart('welcome/update_besoin'); ?>

			<div class="modal-body">

				<div class="row">
					<input type="hidden" name="id" id="idBesoin">
					
						<textarea name="context" id="contextBesoin" rows="4" cols="" class="form-control" placeholder="Context"></textarea>
					
					
						<textarea name="caractere" id="caractereBesoin" rows="4" cols="" class="form-control" placeholder="Caracteristiques"></textarea>
					
						<textarea name="contenu" id="contenuBesoin" rows="4" cols="" class="form-control" placeholder="Contenu"></textarea>
					
						<textarea name="ressource" id="ressourceBesoin" rows="4" cols="" class="form-control" placeholder="Ressources"></textarea>
					
						<textarea name="planning" id="planningBesoin" rows="4"  class="form-control" placeholder="Planning"></textarea>
					
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