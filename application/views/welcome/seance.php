<h1 class="h3 mb-2 text-gray-800">Seances</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutSeance">Ajouter</button>
	</div>
	<div class="card-body">

		<?php echo $this->session->flashdata('msg'); ?>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Numero</th>
						<th>Date</th>
						<th>Lieu</th>
						<th>Horaire</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($seances as $seance): ?>
					<tr>
						<td><?php echo $seance['numero'] ?></td>
						<td><?php echo $seance['date_seance'] ?></td>
						<td><?php echo $seance['lieu'] ?></td>
						<td><?php echo $seance['horaire'] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditSeance" data-id="<?php echo $seance['id'] ?>" data-numero="<?php echo $seance['numero'] ?>" data-date="<?php echo $seance['date_seance'] ?>" data-lieu="<?php echo $seance['lieu'] ?>" data-horaire="<?php echo $seance['horaire'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_seance/').$seance['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutSeance" tabindex="-1" role="dialog" aria-labelledby="seanceModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout seance</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/create_seance'); ?>

		<div class="modal-body">
			
				<div class="row">

					<input type="text" class="form-control" name="numero" placeholder="Numero" required>
					<input type="date" class="form-control" name="date_seance" placeholder="Date" required>
					<input type="text" class="form-control" name="lieu" placeholder="Lieu" required>
					<input type="text" class="form-control" name="horaire" placeholder="Horaire" required>
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

<div class="modal fade" id="editSeance" tabindex="-1" role="dialog" aria-labelledby="seanceModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Modifier seance</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/update_seance'); ?>

		<div class="modal-body">
			
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="idSeance" placeholder="Numero" required>
					<input type="text" class="form-control" name="numero" id="numero" placeholder="Numero" required>
					<input type="date" class="form-control" name="date_seance" id="dateSeance" placeholder="Date" required>
					<input type="text" class="form-control" name="lieu" id="lieu" placeholder="Lieu" required>
					<input type="text" class="form-control" name="horaire" id="horaire" placeholder="Horaire" required>
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