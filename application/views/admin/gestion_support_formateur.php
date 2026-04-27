<h1 class="h3 mb-2 text-gray-800">Supports</h1>

<div class="card shadow mb-4">

	<div class="card-header py-3">

	<a class="btn btn-primary" href="<?php echo base_url().'admin/support' ?>">Supports de formation</a> 

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support' ?>">Gestion des supports</a>

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_apprenant' ?>">Gestion des Supports - Apprenant</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/supports' ?>">Gestion des scénarios pédagogiques</a>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/ajouter_scenario_pedagogique' ?>">Ajouter des Scénarios pédagogiques</a>

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_support_formateur' ?>">Gestion des Supports - Formateur</a><br>
	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_scenario_formateur' ?>">Scénario pédagogique - Formateur</a>



</div>





	<div class="card-body">

		<strong>Gestion des supports pour prof</strong>

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
						<th>Mail</th>

						<th>Prof</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($support_profs as $support_prof): ?>

					<tr>

						<td><?php echo $support_prof['titre'] ?></td>

						<td>

							<?php if($support_prof['link']!=''): ?>

							 <a class="btn btn-info" href="<?php echo base_url('/assets/support/').$support_prof['link'] ?>">Télecharger</a>

							<?php endif; ?>

						</td>

						<td>

							<?php if($support_prof['link']!=''): ?>

								<!--<button class="btn bnt-xs btn-warning envoyerMail">Envoyer mail</button>-->
								<button class="btn btn-warning" data-toggle="modal" data-target="#envoyerMail">Envoyer Mail</button>

							<?php endif; ?>

						</td>


						<td><?php echo $this->FormationModel->rechercher_prenom_prof($support_prof['prof'])." ".$this->FormationModel->rechercher_nom_prof($support_prof['prof']); ?></td>

						<td><button class="btn bnt-xs btn-info btnEditSupportA" data-id="<?php echo $support_prof['id'] ?>" data-prof="<?php echo $support_prof['prof'] ?>" data-support="<?php echo $support_prof['support'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_support_prof/').$support_prof['id'] ?>">Supprimer</button></td>

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

			<h5 class="modal-title" id="profModalLabel">Ajout support prof</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/create_support_prof'); ?>



		<div class="modal-body">

			

				<div class="row">

					<select class="form-control" name="support">

						<?php foreach($supports as $support): ?>

						 <option value="<?php echo $support['id'] ?>"><?php echo $support['nom'] ?></option>

						<?php endforeach; ?>

					</select>

					<select class="form-control" name="prof">

						<?php foreach($profs as $prof): ?>

						 <option value="<?php echo $prof['id'] ?>"><?php echo $prof['nom']." ".$prof['prenom'] ?></option>

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


<div class="modal fade" id="envoyerMail" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Envoyer support prof au mail</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/upload_pdf'); ?>



		<div class="modal-body">

			
				<div class="row">

					<input type="text" class="form-control" name="nomprof" id="nomprof" placeholder="Nom formateur">

				</div>

				<div class="row">

					<input type="text" class="form-control" name="mail" id="mail" placeholder="Mail formateur">

                 </div>
				 <div class="row">

					<input type="text" class="form-control" name="message" id="message" placeholder="Titre de la formation">

                 </div>
				 <div class="row">
				 	<input type="file" name="pdf_file[]" multiple>

				</div>

			</div>

			<div class="modal-footer">

				<button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

				<button class="btn btn-success" type="submit">Envoyer</button>

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

					<select class="form-control" name="prof" id="prof">

						<?php foreach($profs as $prof): ?>

						 <option value="<?php echo $prof['id'] ?>"><?php echo $prof['nom']." ".$prof['prenom'] ?></option>

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


