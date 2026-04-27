<h1 class="h3 mb-2 text-gray-800">Procedures</h1>

<div class="card shadow mb-4">

<div class="card-header py-3">

    <?php include('procedure_header.php'); ?>

    <br>

</div>

	<div class="card-body">

		<strong>Gestion des accès video</strong>

		<br>

		<br>

		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutVideo">Ajouter</button>

		<br>

		<br>



		<?php echo $this->session->flashdata('msg'); ?>

		

		<div class="table-responsive">

			<table class="table table-bordered" width="100%" cellspacing="0">

				<thead>

					<tr>

						<th>Titre</th>

						<th>Lien</th>

						<th>ID Formation</th>

						<th>Utilisateur</th>

						<th>Mot de passe</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($videos as $video): ?>

					<tr>

						<td><?php echo e($video['cours']) ?></td>

						<td><?php echo e($video['link']) ?></td>

						<td><?php echo e($video['id_formation']) ?></td>

						<td><?php echo e($video['pseudo']) ?></td>

						<td><?php echo e($video['password']) ?></td>

						<td><button class="btn bnt-xs btn-info btnEditVideo" data-id="<?php echo e_attr($video['id']) ?>" data-cours="<?php echo e_attr($video['cours']) ?>" data-pseudo="<?php echo e_attr($video['pseudo']) ?>" data-password="<?php echo e_attr($video['password']) ?>" data-link="<?php echo e_attr($video['link']) ?>" data-id_formation="<?php echo e_attr($video['id_formation']) ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/admin/delete_video/').rawurlencode($video['id']) ?>">Supprimer</button></td>

					</tr>

					<?php endforeach; ?>

				</tbody>

			</table>

		</div>



	</div>

	

</div>



<div class="modal fade" id="ajoutVideo" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Ajout video</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/create_video'); ?>



		<div class="modal-body">

			

				<div class="row">

					<input type="text" class="form-control" name="cours" placeholder="Titre" required>

					<input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur" required>

					<input type="text" class="form-control" name="password" placeholder="Mot de passe" required>

					<!--<textarea name="links" rows="4" cols="" class="form-control" placeholder="Lien"></textarea> -->
					<select name="link">

						<option value="">--LIEN--</option>

						<?php foreach($videoss as $video): ?>

							<option value="<?php echo e_attr($video->lien) ?>"><?php echo e($video->cours) ?></option>

						<?php endforeach; ?>

					</select>


					<select name="id_formation">

						<option value="">--ID FORMATION--</option>

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



<div class="modal fade" id="editVideo" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"

aria-hidden="true">

<div class="modal-dialog" role="document">

	<div class="modal-content">

		<div class="modal-header">

			<h5 class="modal-title" id="profModalLabel">Procedure</h5>

			<button class="close" type="button" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">×</span>

			</button>

		</div>

		<?php echo form_open_multipart('admin/update_video'); ?>



		<div class="modal-body">

                 <div class="row">

                 	<input type="hidden" class="form-control" name="id" id="idVideo" required>

					<input type="text" class="form-control" name="cours" id="cours" placeholder="Titre" required>

					<input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Nom d'utilisateur" required>

					<input type="text" class="form-control" name="password" id="password" placeholder="Mot de passe" required>

					<textarea name="link" rows="4" cols="" class="form-control" id="link" placeholder="Lien"></textarea>

					<select name="id_formation" id="idFormation" class="form-control">

						<option value="">--ID FORMATION--</option>

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