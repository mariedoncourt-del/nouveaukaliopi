<h1 class="h3 mb-2 text-gray-800">Resumé</h1>
<div class="card shadow mb-4">
<style>
div, table, tr, td{
	color: black;
}
.badge{
	font-size: 24px;
	margin-top: 2px;
}
.table-striped>tbody>tr:nth-child(odd)>td, 
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: lightgrey; 
 }
</style>
	<div class="card-body">

		<strong class="badge badge-secondary">Formation</strong>
		<br>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>ID Formation</th>
						<th>Apprenant</th>
						<th>Prof</th>
						<th>Cours</th>
						<th>Note</th>
						<th>Commentaire</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $formation['id'] ?></td>
						<td><?php echo $formation['prenom_apprenant']." ".$formation['nom_apprenant'] ?></td>
						<td><?php echo $formation['prenom_prof']." ".$formation['nom_prof'] ?></td>
						<td><?php echo $formation['cours'] ?></td>
						<td><?php echo $formation['note'] ?></td>
						<td><?php echo $formation['comments'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<hr>

		<?php if(count($questions) >= 1): ?>
		<strong class="badge badge-secondary">Questionnaires</strong><br><br>
		<p>Les réponses aux questionnaires</p>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Attente</th>
                        <th>Service</th>
                        <th>Role</th>
                        <th>Expériences</th>
                        <th>Activité</th>
                        <th>Avant</th>
                        <th>Atouts</th>
                        <th>Améliorations</th>
                        <th>Objectifs</th>
                        <th>Resultats</th>
                        <th>Initiative</th>
                        <th>Remarques</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($questions as $question): ?>
						<tr>
							<td><?php echo $question['attente_01'] ?></td>
							<td><?php echo $question['service'] ?></td>
							<td><?php echo $question['poste'] ?></td>
							<td><?php echo $question['exp'] ?></td>
							<td><?php echo $question['activite'] ?></td>
							<td><?php echo $question['experience'] ?></td>
							<td><?php echo $question['atout'] ?></td>
							<td><?php echo $question['amelioration'] ?></td>
							<td><?php echo $question['objectif'] ?></td>
							<td><?php echo $question['attente_02'] ?></td>
							<td><?php echo $question['qui'] ?></td>
							<td><?php echo $question['remarques'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<?php if(count($besoins) >= 1): ?>
		<strong class="badge badge-secondary">Besoins</strong><br><br>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Contexte</th>
						<th>Caracteristiques</th>
						<th>Contenu</th>
						<th>Ressource</th>
						<th>Planning</th>
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
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>

		<strong class="badge badge-secondary">Seances</strong><br><br>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Numero</th>
						<th>Date</th>
						<th>Lieu</th>
						<th>Horaire</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($seances as $seance): ?>
					<tr>
						<td><?php echo $seance['numero'] ?></td>
						<td><?php echo $seance['date_seance'] ?></td>
						<td><?php echo $seance['lieu'] ?></td>
						<td><?php echo $seance['horaire'] ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<?php if(count($scenarios) >= 1): ?> 

		<strong class="badge badge-secondary">Scénarios pédagogiques</strong><br><br>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Unité</th>
						<th>Titre - Theme</th>
						<th>Activités</th>
						<!--<th>Justification</th>-->
						<th>Média</th>
						<th>Justification</th>
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
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		<?php endif; ?>

		<strong class="badge badge-secondary">Evaluations</strong>
		<br>
		<br>
		<strong style="text-decoration: underline;">Auto-evaluation:</strong>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Intitulé de la connaissance évaluée</th>
						<th>Niveau Avant</th>
						<th>Niveau Après</th>
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
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php if(count($eval_pros) >= 1): ?>
		<strong style="text-decoration: underline;">Evaluation par Projet:</strong>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Titre</th>
						<th>Category</th>
						<th>Lien</th>
						<th>Commentaires</th>
						<th>Pièces jointes</th>
					</tr>
				</thead>
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
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>
		<strong style="text-decoration: underline;">Evaluation à chaud:</strong>
		<p>Votre evaluation</p>
		<div class="table-responsive">
			<table class="table table-bordered table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Elements</th>
						<th>Evaluation</th>
					</tr>
				</thead>
				<?php $eval_hot_one=['-Non evalué-','Insatisfaisant',
								'Peu satisfaisant',	
								'Satisfaisant',
							    'Très satisfaisant'];

					 $field_eval=['eval_1','eval_2','eval_3','eval_4','eval_5','eval_6','eval_7','eval_8'] ?>
				<tbody>
					<?php for($i=0;$i<count($eval_field_name);$i++): ?>
					<tr>
						<td><?php echo $eval_field_name[$i] ?></td>
						<td><?php echo $eval_hot_one[$eval_hot[$field_eval[$i]]]; ?></td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
		<br>
		<p>Evaluation Global : <?php echo $eval_hot['eval_note']; ?></p> 
		<p>Commentaire : <?php echo $eval_hot['eval_comm']; ?></p>
		
		<br>
		<br>
		<p>Votre satisfaction</p>
		<br>
		<div class="table-responsive">
			<table class="table table- table-striped" width="100%" cellspacing="0">
				<thead style='background-color: orange'>
					<tr>
						<th>Elements</th>
						<th>Evaluation</th>
					</tr>
				</thead>
				<?php $sati_hot_one=['-Non evalué-','Non, pas du tout',
								'Non, pas vraiment',	
								'Oui, en partie',
							    'Oui, tout à fait'];

					 $field_sati=['sati_1','sati_2','sati_3','sati_4'] ?>
				<tbody>
					<?php for($i=0;$i<count($sati_field_name);$i++): ?>
					<tr>
						<td><?php echo $sati_field_name[$i] ?></td>
						<td><?php echo $sati_hot_one[$eval_hot[$field_sati[$i]]]; ?></td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
		<br>
		<p>Commentaire : <?php echo $eval_hot['sati_comm']; ?></p>
		<br>

	</div>
	
</div>