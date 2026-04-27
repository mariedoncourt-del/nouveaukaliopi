<h1 class="h3 mb-2 text-gray-800">Scénarios pédagogiques</h1>

<div class="card shadow mb-4">

	<div class="card-header py-3">

		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutScenario">Ajouter</button>

	</div>

	<div class="card-body">



		<?php echo $this->session->flashdata('msg'); ?>

		

		<div class="table-responsive">

			<table class="table table-bordered" width="100%" cellspacing="0">

				<thead>

					<tr>

						<th>Unité</th>

						<th>Titre - Theme</th>

						<th>Activité d'apprentissage</th>

						<!--<th>Justification</th>-->

						<th>Média(s) utilisés</th>

						<th>Justification du choix du média</th>

						<th>Action</th>

					</tr>

				</thead>

				<tbody>

					<?php foreach($scenarios as $scenario): ?>

						<tr>

							<td><?php echo $scenario['unite'] ?></td>

							<td><?php echo $scenario['titre'] ?></td>

							<td><?php echo $scenario['activite'] ?></td>

							<!--<td><?php echo $scenario['just_activite'] ?></td>-->

							<td><?php echo $scenario['media'] ?></td>

							<td><?php echo $scenario['just_media'] ?></td>

							<td><button class="btn bnt-xs btn-info btnEditScenario" data-id="<?php echo $scenario['id'] ?>" data-unite="<?php echo $scenario['unite'] ?>" data-titre="<?php echo $scenario['titre'] ?>" data-activite="<?php echo $scenario['activite'] ?>" data-media="<?php echo $scenario['media'] ?>" data-just-media="<?php echo $scenario['just_media'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_scenario/').$scenario['id'] ?>">Supprimer</button></td>

							</tr>

						<?php endforeach; ?>

					</tbody>

				</table>

			</div>



		</div>



	</div>



	<div class="modal fade" id="ajoutScenario" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"

	aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title" id="profModalLabel">Ajout scénario pedagogique</h5>

				<button class="close" type="button" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">×</span>

				</button>

			</div>

			<?php $attributes = array('id' => 'addForm'); ?>

			<?php echo form_open_multipart('welcome/create_scenario',$attributes); ?>



			<div class="modal-body">



				<div class="row">

					<input type="text" class="form-control" name="unite" placeholder="Unité" required>

					<input type="text" class="form-control" name="titre" placeholder="Titre" required>



					<label for="activite" style="width: 100%;">

						Activites - Cliquer pour choisir les activités ou taper diréctement

					<select class="form-control activite" placeholder="Activité" name="activite[]" id="activite" multiple="multiple" style="width: 100%">

  						<option value="Observation d'un diaporama">Observation d'un diaporama</option>

                        <option value="Observation d'une video">Observation d'une video</option>

                        <option value="Lecture d'un texte">Lecture d'un texte</option>

                        <option value="QCM">QCM</option>

                        <option value="Etude de cas">Etude de cas</option>

                        <option value="Question - Réponse">Question - Réponse</option>

                        <option value="Jeux de role">Jeux de role</option>

						

						

						

						

					</select>

					</label>



                    <!--<select class="form-control"  name="just_activite" id="just_activite"  required>

                            <option value="Mise en application pratique des concepts">Mise en application pratique des concepts</option>

                            <option value="Présenter le contenu">Présenter le contenu</option>

                            <option value="Mémoriser les informations délivrées">Mémoriser les informations délivrées</option>

                            <option value="Proposer une information générale">Proposer une information générale</option>

                            <option value="Expositive">Expositive</option>

                     </select>-->



                     <label for="media" >

						Médias - Cliquer pour choisir les activités ou taper diréctement

                     <select class="form-control media"  id="media" name="media[]" multiple style="width: 100%;">

                     	    <option value="Text">Text</option>

                            <option value="Image">Image</option>

                            <option value="Diaporama">Diaporama</option>

                            <option value="Son">Son</option>

                            <option value="Video">Video</option>

                            <option value="Echanges Verbales">Echanges Verbales</option>
							<option value="Présentation du cours">Présentation du cours</option>

						<option value="Approche théorique">Approche théorique</option>

						<option value="Utilisation concréte">Utilisation concréte</option>

						<option value="Présentation du cours">Présentation du cours</option>

                      </select>

                  	 </label>



                     <select class="form-control"  id="just_media" name="just_media" placeholder="Media utilisé" required>

                     		<option value="">--Justification--</option>

                            <option value="Stratégie receptive - Absorption des connaissances">Stratégie receptive - Absorption des connaissances</option>

                            <option value="Pédagogie active - L'apprenant est en position d'acteur">Pédagogie active - L'apprenant est en position d'acteur</option>

                            <option value="Stratégie créative - L'apprenant conçoit un projet">Stratégie créative - L'apprenant conçoit un projet</option>

                            <option value="Stratégie co-créative - Travaux de création en groupe">Stratégie co-créative - Travaux de création en groupe</option>

							<option value="Images grand écran">Images grand écran</option>

							<option value="Nécessaire pour cuisiner">Nécessaire pour cuisiner</option>

							<option value="Visualiser et goûter">Visualiser et goûter</option>



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



<div class="modal fade" id="editScenario" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"

	aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title" id="profModalLabel">Modifier scénario pedagogique</h5>

				<button class="close" type="button" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">×</span>

				</button>

			</div>

			<?php $attributes_edit = array('id' => 'editForm'); ?>

			<?php echo form_open_multipart('welcome/update_scenario',$attributes_edit); ?>



			<div class="modal-body">



				<div class="row">

					<input type="hidden" class="form-control" name="id" id="idScenario" placeholder="Unité" required>

					<input type="text" class="form-control" name="unite" id="unite" placeholder="Unité" required>

					<input type="text" class="form-control" name="titre" id="titre" placeholder="Titre" required>



					<label for="activite" style="width: 100%;">

						Activites - Cliquer pour choisir les activités ou taper diréctement

					<select class="form-control activite" placeholder="Activité" name="activite[]" id="activite_mod" multiple="multiple" style="width: 100%">

  						<option value="Observation d'un diaporama">Observation d'un diaporama</option>

                        <option value="Observation d'une video">Observation d'une video</option>

                        <option value="Lecture d'un texte">Lecture d'un texte</option>

                        <option value="QCM">QCM</option>

                        <option value="Etude de cas">Etude de cas</option>

                        <option value="Question - Réponse">Question - Réponse</option>

                        <option value="Jeux de role">Jeux de role</option>

					</select>

					</label>



                    <!--<select class="form-control"  name="just_activite" id="just_activite"  required>

                            <option value="Mise en application pratique des concepts">Mise en application pratique des concepts</option>

                            <option value="Présenter le contenu">Présenter le contenu</option>

                            <option value="Mémoriser les informations délivrées">Mémoriser les informations délivrées</option>

                            <option value="Proposer une information générale">Proposer une information générale</option>

                            <option value="Expositive">Expositive</option>

                     </select>-->



                     <label for="media" >

						Médias - Cliquer pour choisir les activités ou taper diréctement

                     <select class="form-control media"  id="media_mod" name="media[]" multiple style="width: 100%;">

                     	    <option value="Text">Text</option>

                            <option value="Image">Image</option>

                            <option value="Diaporama">Diaporama</option>

                            <option value="Son">Son</option>

                            <option value="Video">Video</option>

                            <option value="Echanges Verbales">Echanges Verbales</option>

                      </select>

                  	 </label>



                     <select class="form-control"  id="just_media_mod" name="just_media" placeholder="Media utilisé" required>

                     		<option value="">--Justification--</option>

                            <option value="Stratégie receptive - Absorption des connaissances">Stratégie receptive - Absorption des connaissances</option>

                            <option value="Pédagogie active - L'apprenant est en position d'acteur">Pédagogie active - L'apprenant est en position d'acteur</option>

                            <option value="Stratégie créative - L'apprenant conçoit un projet">Stratégie créative - L'apprenant conçoit un projet</option>

                            <option value="Stratégie co-créative - Travaux de création en groupe">Stratégie co-créative - Travaux de création en groupe</option>

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