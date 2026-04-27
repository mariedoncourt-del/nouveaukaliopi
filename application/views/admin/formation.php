<style>
    .card, .card-body, .table-responsive {
        width: 100% !important;
        max-width: none !important;
    }
    
    .table {
        width: 100% !important;
    }
    
    body .card-body .table-responsive {
        overflow-x: visible !important;
        max-width: none !important;
        width: auto !important;
    }
    
    html, body, #wrapper, #content-wrapper, #content, .container, .container-fluid {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: visible !important;
    }
</style>

<h1 class="h3 mb-2 text-gray-800">Formations</h1>

<div class="card shadow mb-4">

	<div class="card-header py-3">

		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutFormation">Ajouter</button>

	</div>

	<div class="card-body">



		 <?php echo $this->session->flashdata('msg'); ?>

		

		<div class="table-responsive">

			<table class="table table-bordered" width="100%" cellspacing="0">

				<thead>

					<tr>

						<th>ID FORMATION</th>

						<th>Apprenant</th>

						<th>Prof</th>

						<th>Cours</th>

						<th>Résumé</th>

						<th>Emargement</th>

						<th>Attestation</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($formations as $formation): ?>

						<?php if($formation['active']>=1): ?>

					<tr>

						<td><?php echo $formation['id'] ?></td>

						<td><?php echo $formation['prenom_apprenant']." ".$formation['nom_apprenant'] ?></td>

						<td><?php echo $formation['prenom_prof']." ".$formation['nom_prof'] ?></td>

						<td><?php echo $formation['cours'] ?></td>

						<td><a class="btn bnt-xs btn-secondary" href="<?php echo site_url('/admin/resume_formation/').$formation['id'] ?>" target="_blank">Resumé</a></td>

						<td>

							<?php if($formation['suivi']!=''): ?>

								<a class="btn bnt-xs btn-info" href="<?php echo $formation['suivi'] ?>" target="_blank">Emargement</a>

							<?php endif; ?>

						</td>

						<td>

							<?php if($formation['drive']!=''): ?>

								<a class="btn bnt-xs btn-info" href="<?php echo $formation['drive'] ?>" target="_blank">Attestation</a>

							<?php endif; ?>

						</td>

						<td><button class="btn bnt-xs btn-info btnEditFormation" data-id="<?php echo $formation['id'] ?>" data-cours="<?php echo $formation['cours_id'] ?>" data-prof="<?php echo $formation['prof_id'] ?>" data-apprenant="<?php echo $formation['apprenant_id'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_formation/').$formation['id'] ?>">Supprimer</button></td>

					</tr>

						<?php endif; ?>

					<?php endforeach; ?>

				</tbody>

			</table>

		</div>



	</div>

	

</div>



<div class="modal fade" id="ajoutFormation" tabindex="-1" role="dialog" aria-labelledby="formationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Ajout formation</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/create_formation'); ?>



		<div class="modal-body">

			

				<div class="row">



					<select class="form-control" name="apprenant">

						<?php foreach($apprenants as $apprenant): ?>

							<option value="<?php echo $apprenant['id'] ?>"><?php echo $apprenant['prenom']." ".$apprenant['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="prof">

						<?php foreach($profs as $prof): ?>

							<option value="<?php echo $prof['id'] ?>"><?php echo $prof['prenom']." ".$prof['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="cours">

						<?php foreach($les_cours as $cours): ?>

							<option value="<?php echo $cours['id_key'] ?>"><?php echo $cours['titre'] ?></option>

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



<div class="modal fade" id="editFormation" tabindex="-1" role="dialog" aria-labelledby="formationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Modifier formation</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/update_formation'); ?>



		<div class="modal-body">

			

				<div class="row">



					<input type="hidden" name="id" id="idFormation">



					<select class="form-control" name="apprenant" id="apprenant">

						<?php foreach($apprenants as $apprenant): ?>

							<option value="<?php echo $apprenant['id'] ?>"><?php echo $apprenant['prenom']." ".$apprenant['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="prof" id="prof">

						<?php foreach($profs as $prof): ?>

							<option value="<?php echo $prof['id'] ?>"><?php echo $prof['prenom']." ".$prof['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="cours" id="cours">

						<?php foreach($les_cours as $cours): ?>

							<option value="<?php echo $cours['id_key'] ?>"><?php echo $cours['titre'] ?></option>

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