<h1 class="h3 mb-2 text-gray-800">Supports</h1>

<div class="card shadow mb-4">

	<div class="card-header py-3">

	<a class="btn btn-primary" href="<?php echo base_url().'admin/support' ?>">Supports de formation</a> 

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support' ?>">Gestion des supports</a>

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_apprenant' ?>">Gestion des Supports - Apprenant</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/supports' ?>">Gestion des scénarios pédagogiques</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/ajouter_scenario_pedagogique' ?>">Ajouter des Scénarios pédagogiques</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_formateur' ?>">Gestion des Supports - Formateur</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_scenario_formateur' ?>">Scénario pédagogique - Formateur</a>

	<br>

</div>





	<div class="card-body">

		<strong>Gestion des supports pour apprenant</strong>

		<br>

		<br>

		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutSupportA">Ajouter</button>

		<br>

		<br>



		<?php echo $this->session->flashdata('msg'); ?>

		

		<div class="table-responsive">

			<table class="table table-bordered" width="100%" cellspacing="0">

				<thead>

					<tr>

						<th>Titre</th>

						<th>Télecharger</th>

						<th>Formation</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($support_as as $support_a): ?>

					<tr>

						<td><?php echo $support_a['titre'] ?></td>

						<td>

							<?php if($support_a['link']!=''): ?>

							 <a class="btn btn-info" href="<?php echo base_url('/assets/support/').$support_a['link'] ?>">Télecharger</a>

							<?php endif; ?>

						</td>

						<td><?php echo $support_a['apprenant']; ?></td>

						<td><button class="btn bnt-xs btn-info btnEditSupportA" data-id="<?php echo $support_a['id'] ?>" data-apprenant="<?php echo $support_a['id_formation'] ?>" data-support="<?php echo $support_a['support'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_support_apprenant/').$support_a['id'] ?>">Supprimer</button></td>

					</tr>

					<?php endforeach; ?>

				</tbody>

			</table>

		</div>



	</div>

	

</div>



<div class="modal fade" id="ajoutSupportA" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Ajout support</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/create_support_apprenant'); ?>



		<div class="modal-body">

			

				<div class="row">

					<select class="form-control" name="support">

						<?php foreach($supports as $support): ?>

						 <option value="<?php echo $support['id'] ?>"><?php echo $support['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="apprenant">

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



<div class="modal fade" id="editSupportA" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Evaluation</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/update_support_apprenant'); ?>



		<div class="modal-body">

				<div class="row">

					<input type="hidden" name="id" id="idSupA">

					<select class="form-control" name="support" id="support">

						<?php foreach($supports as $support): ?>

						 <option value="<?php echo $support['id'] ?>"><?php echo $support['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="apprenant" id="apprenant">

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