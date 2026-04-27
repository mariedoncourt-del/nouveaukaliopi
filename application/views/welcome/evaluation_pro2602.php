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
		Evaluation - Par projet 
		<br>
		<br>
		<button class="btn btn-success" data-toggle="modal" data-target="#ajoutEvaluationPro">Ajouter</button>
		<br>
		<br>
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Categorie</th>
						<th>Lien</th>
						<th>Commentaires</th>
						<th>Pièces jointes</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php $niveau=['Pas de connaissance',
								'Initié',	
								'Peut le faire avec aide',
							    'Peut le faire sans aide',
							    'Maitrise']; ?>
				<tbody>
					<?php foreach($eval_pros as $eval_pro): ?>
					<tr>
						<td><?php echo $eval_pro['titre'] ?></td>
						<td><?php echo $eval_pro['category'] ?></td>
						<td><?php echo $eval_pro['url'] ?></td>
						<td><?php echo $eval_pro['commentaires'] ?></td>
						
						<td><ul>
							<?php
								$pjs=explode(',',$eval_pro['pj']);
							 	foreach($pjs as $pj):
							 ?>
							<?php  echo '<li><a href="'.base_url('/assets/pj/').$pj.'">'.$pj.'</a></li>'; ?>
							<?php endforeach; ?>
							</ul>
						</td>
						<td><button class="btn bnt-xs btn-info btnEditEvaluationPro" data-id="<?php echo $eval_pro['id'] ?>" data-titre="<?php echo $eval_pro['titre'] ?>" data-category="<?php echo $eval_pro['category'] ?>" data-link="<?php echo $eval_pro['url'] ?>" data-commentaire="<?php echo $eval_pro['commentaires'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_evaluation_pro/').$eval_pro['id'] ?>">Supprimer</button></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

	</div>
	
</div>

<div class="modal fade" id="ajoutEvaluationPro" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Ajout evaluation</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/create_evaluation_pro'); ?>

		<div class="modal-body">
			
				<div class="row">

					<input type="text" class="form-control" name="titre" placeholder="Titre Projet" required>
					<select class="form-control" id="data-list-category" name="category">
							<option value="">-Categorie-</option>
							<option value="Siteweb">Siteweb</option>
							<option value="Page - Facebook">Page - Facebook</option>
							<option value="Page - Instagram">Page - Instagram</option>
							<option value="Page - Twitter">Page - Twitter</option>
							<option value="Page - LinkedIn">Page - LinkedIn</option>
							<option value="Tableau de bord Gestion">Tableau de bord Gestion</option>
							<option value="Dessert">Dessert</option>
							<option value="SEO">SEO</option>
							<option value="Place du marché">Place du marché</option>
					</select>
					<textarea name="url" rows="4" cols="" class="form-control" placeholder="Lien"></textarea>
					<textarea name="commentaires" rows="4" cols="" class="form-control" placeholder="Commentaires"></textarea>
					<input type="file" multiple=""  name="pj[]">
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

<div class="modal fade" id="editEvaluationPro" tabindex="-1" role="dialog" aria-labelledby="evaluationModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="profModalLabel">Editer evaluation</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
		<?php echo form_open_multipart('welcome/update_evaluation_pro'); ?>

		<div class="modal-body">
			
				<div class="row">

					<input type="text" class="form-control" name="titre" id="titreEval" placeholder="Titre Projet" required>
					<input type="hidden" class="form-control" name="id" id="id" placeholder="Titre Projet" required>
					<select class="form-control" id="categoryEval" name="category">
							<option value="">-Categorie-</option>
							<option value="Siteweb">Siteweb</option>
							<option value="Page - Facebook">Page - Facebook</option>
							<option value="Page - Instagram">Page - Instagram</option>
							<option value="Page - Twitter">Page - Twitter</option>
							<option value="Page - LinkedIn">Page - LinkedIn</option>
							<option value="Tableau de bord Gestion">Tableau de bord Gestion</option>
							<option value="Dessert">Dessert</option>
							<option value="SEO">SEO</option>
							<option value="Place du marché">Place du marché</option>
					</select>
					<textarea name="url" id="urlEval" rows="4" cols="" class="form-control" placeholder="Lien"></textarea>
					<textarea name="commentaires" id="commentairesEval" rows="4" cols="" class="form-control" placeholder="Commentaires"></textarea>
					<input type="file" multiple=""  name="pj[]">
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