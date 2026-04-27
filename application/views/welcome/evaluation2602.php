<h1 class="h3 mb-2 text-gray-800">Evaluations</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/evaluation' ?>">Auto-evaluation</a> 
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_pro' ?>">Evaluation par projet</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_hot' ?>">Evaluation à chaud</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/qcm' ?>">QCM</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_note' ?>">Note</a>
		<br>
	</div>
	<div class="card-body">
		Auto - évaluation 
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutEvaluation">Ajouter</button>
		<br>
		<br>

		<?php echo $this->session->flashdata('msg'); ?>

		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Intitulé de la connaissance évaluée</th>
						<th>Niveau Avant</th>
						<th>Niveau Après</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php $niveau=['-Non Evalué-','Pas de connaissance',
								'Initié',	
								'Peut le faire avec aide',
							    'Peut le faire sans aide',
							    'Maitrise']; ?>
				<tbody>
					<?php foreach($evaluations as $evaluation): ?>
					<tr>
						<td><?php echo $evaluation['titre'] ?></td>
						<td><?php echo $niveau[$evaluation['niveau']] ?></td>
						<td><?php echo $niveau[$evaluation['niveau_apres']] ?></td>
						<td><button class="btn bnt-xs btn-info btnEditEvaluation" data-id="<?php echo $evaluation['id'] ?>" data-titre="<?php echo $evaluation['titre'] ?>" data-niveau="<?php echo $evaluation['niveau'] ?>" data-niveau_apres="<?php echo $evaluation['niveau_apres'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_evaluation/').$evaluation['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutEvaluation" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout evaluation</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/create_evaluation'); ?>

		<div class="modal-body">
			
				<div class="row">

					<input type="text" class="form-control" name="titre" placeholder="Intitulé de la connaissance" required>
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

<div class="modal fade" id="editEvaluation" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Evaluation</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/update_evaluation'); ?>

		<div class="modal-body">
			<?php $niveau=['-Non Evalué-','Pas de connaissance',
								'Initié',	
								'Peut le faire avec aide',
							    'Peut le faire sans aide',
							    'Maitrise']; ?>
				<div class="row">
					<input type="hidden" class="form-control" name="id" id="id" placeholder="Intitulé de la connaissance" required>
					<input type="text" class="form-control" name="titre" id="titre" placeholder="Intitulé de la connaissance" required>
					<br>Avant<br>
					<select id="niveau" name="niveau">
					<?php for($i=0; $i<=5; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $niveau[$i] ?></option>
					<?php } ?>
					</select><br>
					<br>Après<br>
					<select id="niveau_apres" name="niveau_apres">
					<?php for($i=0; $i<=5; $i++) { ?>
						<option value="<?php echo $i ?>"><?php echo $niveau[$i] ?></option>
					<?php } ?>
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