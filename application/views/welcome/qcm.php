<h1 class="h3 mb-2 text-gray-800">QCM</h1>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/evaluation' ?>">Auto-evaluation</a> 
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_pro' ?>">Evaluation par projet</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_hot' ?>">Evaluation à chaud</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/qcm' ?>">QCM Fin</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/test' ?>">Test</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/qcm_depart' ?>">QCM Début</a>
		<a class="btn btn-primary" href="<?php echo base_url().'welcome/eval_note' ?>">Note Formateur</a>
		<br>
	</div>
	<div class="card-body">
		
		<!--
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Lien</th>
					</tr>
				</thead>
				<tbody>
					<?php /*foreach($qcms as $qcm): ?>
						<tr>
							<td><?php echo $qcm['titre'] ?></td>
							<td><a href="<?php echo $qcm['link'] ?>" class="btn btn-primary" target="_blank">CQM</a></td>
							</tr>
						<?php endforeach;*/ ?>
					</tbody>
				</table>
		</div>-->

		<?php error_reporting(0); ?>
		<ul style="list-style-type:none">
		<?php foreach($question as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 1')==0)
													{
														echo "<input type='radio' name='question1' class='cquestion1' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question1' class='cquestion1' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
												
											if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 1')==0)
											{
												echo "<input type='radio' name='question1' class='cquestion11' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
											}
											else{
												echo "<input type='radio' name='question1' class='cquestion11' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
											}			
											
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									


<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
												
											if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 1')==0)
											{
												echo "<input type='radio' name='question1' class='cquestion12' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
											}
											else{
												echo "<input type='radio' name='question1' class='cquestion12' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
											}			
											
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
												
											if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 1')==0)
											{
												echo "<input type='radio' name='question1' class='cquestion13' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
											}
											else{
												echo "<input type='radio' name='question1' class='cquestion13' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
											}			
											
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

							
                            </div>
                           </div>






		<?php } ?>
		</ul>

		<ul style="list-style-type:none">
		<?php foreach($question2 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 2')==1)
													{
														echo "<input type='radio' name='question2' class='cquestion2' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question2' class='cquestion2' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 2')==1)
													{
														echo "<input type='radio' name='question2' class='cquestion21' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question2' class='cquestion21' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 2')==1)
													{
														echo "<input type='radio' name='question2' class='cquestion22' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question2' class='cquestion22' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 2')==1)
													{
														echo "<input type='radio' name='question2' class='cquestion23' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question2' class='cquestion23' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							
							
                            </div>
                           </div>






		<?php } ?>
		</ul>


		<ul style="list-style-type:none">
		<?php foreach($question3 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 3')==1)
													{
														echo "<input type='radio' name='question3' class='cquestion3' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question3' class='cquestion3' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 3')==1)
													{
														echo "<input type='radio' name='question3' class='cquestion31' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question3' class='cquestion31' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 3')==1)
													{
														echo "<input type='radio' name='question3' class='cquestion32' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question3' class='cquestion32' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 4')==1)
													{
														echo "<input type='radio' name='question3' class='cquestion33' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question3' class='cquestion33' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									
							
                            </div>
                           </div>






		<?php } ?>
		</ul>



		<ul style="list-style-type:none">
		<?php foreach($question4 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 4')==1)
													{
														echo "<input type='radio' name='question4' class='cquestion4' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question4' class='cquestion4' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 4')==1)
													{
														echo "<input type='radio' name='question4' class='cquestion41' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question4' class='cquestion41' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 4')==1)
													{
														echo "<input type='radio' name='question4' class='cquestion42' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question4' class='cquestion42' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 4')==1)
													{
														echo "<input type='radio' name='question4' class='cquestion43' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question4' class='cquestion43' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							
							


                            </div>
                           </div>






		<?php } ?>
		</ul>


		<ul style="list-style-type:none">
		<?php foreach($question5 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 5')==1)
													{
														echo "<input type='radio' name='question5' class='cquestion5' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question5' class='cquestion5' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 5')==1)
													{
														echo "<input type='radio' name='question5' class='cquestion51' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question5' class='cquestion51' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 5')==1)
													{
														echo "<input type='radio' name='question5' class='cquestion52' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question5' class='cquestion52' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 5')==1)
													{
														echo "<input type='radio' name='question5' class='cquestion53' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question5' class='cquestion53' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

									
							
                            </div>
                           </div>






		<?php } ?>
		</ul>


		<ul style="list-style-type:none">
		<?php foreach($question6 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 6')==1)
													{
														echo "<input type='radio' name='question6' class='cquestion6' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question6' class='cquestion6' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 6')==1)
													{
														echo "<input type='radio' name='question6' class='cquestion61' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question6' class='cquestion61' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>	

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 6')==1)
													{
														echo "<input type='radio' name='question6' class='cquestion62' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question6' class='cquestion62' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 6')==1)
													{
														echo "<input type='radio' name='question6' class='cquestion63' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question6' class='cquestion63' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
                            </div>
                           </div>






		<?php } ?>
		</ul>

		<ul style="list-style-type:none">
		<?php foreach($question7 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 7')==1)
													{
														echo "<input type='radio' name='question7' class='cquestion7' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question7' class='cquestion7' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 7')==1)
													{
														echo "<input type='radio' name='question7' class='cquestion71' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question7' class='cquestion71' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 7')==1)
													{
														echo "<input type='radio' name='question7' class='cquestion72' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question7' class='cquestion72' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 7')==1)
													{
														echo "<input type='radio' name='question7' class='cquestion73' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question7' class='cquestion73' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									
							
                            </div>
                           </div>






		<?php } ?>
		</ul>

		<ul style="list-style-type:none">
		<?php foreach($question8 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 8')==1)
													{
														echo "<input type='radio' name='question8' class='cquestion8' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question8' class='cquestion8' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 8')==1)
													{
														echo "<input type='radio' name='question8' class='cquestion81' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question8' class='cquestion81' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 8')==1)
													{
														echo "<input type='radio' name='question8' class='cquestion82' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question8' class='cquestion82' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 8')==1)
													{
														echo "<input type='radio' name='question8' class='cquestion83' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question8' class='cquestion83' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
							
							
							
							
                            </div>
                           </div>






		<?php } ?>
		</ul>

		<ul style="list-style-type:none">
		<?php foreach($question9 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 9')==1)
													{
														echo "<input type='radio' name='question9' class='cquestion9' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question9' class='cquestion9' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 9')==1)
													{
														echo "<input type='radio' name='question9' class='cquestion91' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question9' class='cquestion91' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 9')==1)
													{
														echo "<input type='radio' name='question9' class='cquestion92' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question9' class='cquestion92' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 9')==1)
													{
														echo "<input type='radio' name='question9' class='cquestion93' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question9' class='cquestion93' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									
							
                            </div>
                           </div>






		<?php } ?>
		</ul>

		<ul style="list-style-type:none">
		<?php foreach($question10 as $row){
			echo "<li><h6><b>".$row->question."</b></h6></li>";
			?>
			
			<div class="form-group row">
							
                            <div class="col-md-12">
                             
									
							<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 1) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_1($id_formation,'Question 10')==1)
													{
														echo "<input type='radio' name='question10' class='cquestion10' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question10' class='cquestion10' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>

<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 2) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_2($id_formation,'Question 10')==1)
													{
														echo "<input type='radio' name='question10' class='cquestion101' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question10' class='cquestion101' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 3) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_3($id_formation,'Question 10')==1)
													{
														echo "<input type='radio' name='question10' class='cquestion102' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question10' class='cquestion102' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>
									<?php
										foreach($this->FormationModel->recherche_reponses($row->id_questionnaire, 4) as $row1)
										{
											?>
									<div class="list-group-item radio form-control">
											<label>
										<?php
											
													if($this->FormationModel->recherche_resultat_question_4($id_formation,'Question 10')==1)
													{
														echo "<input type='radio' name='question10' class='cquestion103' value=\"".$row1->reponse."\" checked> ".$row1->libelle_reponse."<br>";
													}
													else{
														echo "<input type='radio' name='question10' class='cquestion103' value=\"".$row1->reponse."\"> ".$row1->libelle_reponse."<br>";
													}			
													
													
											
										
											
										?>
										</label>
									</div>
									
								<?php
									}
									
									?>



									
							
                            </div>
                           </div>






		<?php } ?>
		</ul>
		
		
		<form>
		<div class="form-group row">
		<div class="col-md-3"></div>
			
				<div class="col-md-2">
				<input type="button" class="form-control btn btn-success" id="Validers" name="Validers" value="Tester">
				</div>
								
		<div class="col-md-3"></div>
		</div>
		<div class="form-group row">
				<div id="resultat" class="col-md-12"></div>
		</div>
		<div class="form-group row">
				<div id="notes" class="col-md-12 alert alert-primary text-center" ></div>
		</div>
		</form>

	</div> 


</div>

<script type="text/javascript">
$(document).ready(function(){

	load_data();

			function load_data()
    {
      $.ajax({
        url: "<?php echo site_url('welcome/afficher_note'); ?>",
        type: 'POST',
        success: function(data) {
           $('#notes').html(data);
		  // alert(data);
            
        },
    error : function(msg){
      $('#afficher').html('<div class="alert alert-danger text-center">Erreur</div>');
    }
    });
    return false;
    }
	$('#Validers').click(function(){
		//alert("aaaaa")
		var checkbox1 = $('.cquestion1:checked');
		var c1 = $('.cquestion1').val();
		
		if(checkbox1.length>0)
		{
			a = 1;
		}
		else{
			a = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox11 = $('.cquestion11:checked');
		var c11 = $('.cquestion11').val();
		
		if(checkbox11.length>0)
		{
			a1 = 1;
		}
		else{
			a1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox12 = $('.cquestion12:checked');
			var c12 = $('.cquestion12').val();
		
			if(checkbox12.length>0)
		{
			a2 = 1;
		}
		else{
			a2 = 0;
		}

			var checkbox13 = $('.cquestion13:checked');
		
			if(checkbox13.length>0)
		{
			a3 = 1;
		}
		else{
			a3 = 0;
		}
		
	

		



			var checkbox2 = $('.cquestion2:checked');
		if(checkbox2.length>0)
		{
			b = 1;
		}
		else{
			b = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox21 = $('.cquestion21:checked');
		if(checkbox21.length>0)
		{
			b1 = 1;
		}
		else{
			b1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox22 = $('.cquestion22:checked');
		
			if(checkbox22.length>0)
		{
			b2 = 1;
		}
		else{
			b2 = 0;
		}

			var checkbox23 = $('.cquestion23:checked');
		
			if(checkbox23.length>0)
		{
			b3 = 1;
		}
		else{
			b3 = 0;
		}
		
	


		


		


			var checkbox3 = $('.cquestion3:checked');
		if(checkbox3.length>0)
		{
			c = 1;
		}
		else{
			c = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox31 = $('.cquestion31:checked');
		if(checkbox31.length>0)
		{
			c1 = 1;
		}
		else{
			c1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox32 = $('.cquestion32:checked');
		
			if(checkbox32.length>0)
		{
			c2 = 1;
		}
		else{
			c2 = 0;
		}

			var checkbox33 = $('.cquestion33:checked');
		
			if(checkbox33.length>0)
		{
			c3 = 1;
		}
		else{
			c3 = 0;
		}
		
	




		
			var checkbox4 = $('.cquestion4:checked');
		if(checkbox4.length>0)
		{
			d = 1;
		}
		else{
			d = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox41 = $('.cquestion41:checked');
		if(checkbox41.length>0)
		{
			d1 = 1;
		}
		else{
			d1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox42 = $('.cquestion42:checked');
		
			if(checkbox42.length>0)
		{
			d2 = 1;
		}
		else{
			d2 = 0;
		}

			var checkbox43 = $('.cquestion43:checked');
		
			if(checkbox43.length>0)
		{
			d3 = 1;
		}
		else{
			d3 = 0;
		}
		
	



		
			var checkbox5 = $('.cquestion5:checked');
		if(checkbox5.length>0)
		{
			e = 1;
		}
		else{
			e = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox51 = $('.cquestion51:checked');
		if(checkbox51.length>0)
		{
			e1 = 1;
		}
		else{
			e1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox52 = $('.cquestion52:checked');
		
			if(checkbox52.length>0)
		{
			e2 = 1;
		}
		else{
			e2 = 0;
		}

			var checkbox53 = $('.cquestion53:checked');
		
			if(checkbox53.length>0)
		{
			e3 = 1;
		}
		else{
			e3 = 0;
		}
		
	



		
			var checkbox6 = $('.cquestion6:checked');
		if(checkbox6.length>0)
		{
			f = 1;
		}
		else{
			f = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox61 = $('.cquestion61:checked');
		if(checkbox61.length>0)
		{
			f1 = 1;
		}
		else{
			f1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox62 = $('.cquestion62:checked');
		
			if(checkbox62.length>0)
		{
			f2 = 1;
		}
		else{
			f2 = 0;
		}

			var checkbox63 = $('.cquestion63:checked');
		
			if(checkbox63.length>0)
		{
			f3 = 1;
		}
		else{
			f3 = 0;
		}
		
	


		
			var checkbox7 = $('.cquestion7:checked');
		if(checkbox7.length>0)
		{
			g = 1;
		}
		else{
			g = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox71 = $('.cquestion71:checked');
		if(checkbox71.length>0)
		{
			g1 = 1;
		}
		else{
			g1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox72 = $('.cquestion72:checked');
		
			if(checkbox72.length>0)
		{
			g2 = 1;
		}
		else{
			g2 = 0;
		}

			var checkbox73 = $('.cquestion73:checked');
		
			if(checkbox73.length>0)
		{
			g3 = 1;
		}
		else{
			g3 = 0;
		}
		
	



			var checkbox8 = $('.cquestion8:checked');
		if(checkbox8.length>0)
		{
			h = 1;
		}
		else{
			h = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox81 = $('.cquestion81:checked');
		if(checkbox81.length>0)
		{
			h1 = 1;
		}
		else{
			h1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox82 = $('.cquestion82:checked');
		
			if(checkbox82.length>0)
		{
			h2 = 1;
		}
		else{
			h2 = 0;
		}

			var checkbox83 = $('.cquestion83:checked');
		
			if(checkbox83.length>0)
		{
			h3 = 1;
		}
		else{
			h3 = 0;
		}
		
			



			var checkbox9 = $('.cquestion9:checked');
		if(checkbox9.length>0)
		{
			i = 1;
		}
		else{
			i = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox91 = $('.cquestion91:checked');
		if(checkbox91.length>0)
		{
			i1 = 1;
		}
		else{
			i1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox92 = $('.cquestion92:checked');
		
			if(checkbox92.length>0)
		{
			i2 = 1;
		}
		else{
			i2 = 0;
		}

			var checkbox93 = $('.cquestion93:checked');
		
			if(checkbox93.length>0)
		{
			i3 = 1;
		}
		else{
			i3 = 0;
		}
		
			


			var checkbox10 = $('.cquestion10:checked');
		if(checkbox10.length>0)
		{
			j = 1;
		}
		else{
			j = 0;
		}
	
		
	/*	if(checkbox1.length>0)
		{
			var checkbox_value1 = [];
			$(checkbox1).each(function(){
				 //alert($(this).val());
				 a = $(this).val();
				checkbox_value1.push($(this).val());
				
			});
		}
		else{
			a = 0;
		}*/

		var checkbox101 = $('.cquestion101:checked');
		if(checkbox101.length>0)
		{
			j1 = 1;
		}
		else{
			j1 = 0;
		}
	/*
		if(checkbox11.length>0)
		{
			var checkbox_value11 = [];
			$(checkbox11).each(function(){
				 //alert($(this).val());
				 a1 = $(this).val();
				checkbox_value11.push($(this).val());
				
			});
		}
		else{
			a1 = 0;
		}
	*/	


			var checkbox102 = $('.cquestion102:checked');
		
			if(checkbox102.length>0)
		{
			j2 = 1;
		}
		else{
			j2 = 0;
		}

			var checkbox103 = $('.cquestion103:checked');
		
			if(checkbox103.length>0)
		{
			j3 = 1;
		}
		else{
			j3 = 0;
		}
		//x = $("input[type=radio][name=question1]:checked").attr("value"); 
		x1 = $("input[type=radio][name=question1]:checked").attr("value");
		x2 = $("input[type=radio][name=question2]:checked").attr("value");
		x3 = $("input[type=radio][name=question3]:checked").attr("value");
		x4 = $("input[type=radio][name=question4]:checked").attr("value");
		x5 = $("input[type=radio][name=question5]:checked").attr("value");
		x6 = $("input[type=radio][name=question6]:checked").attr("value");
		x7 = $("input[type=radio][name=question7]:checked").attr("value");
		x8 = $("input[type=radio][name=question8]:checked").attr("value");
		x9 = $("input[type=radio][name=question9]:checked").attr("value");
		x10 = $("input[type=radio][name=question10]:checked").attr("value");
		if(x1==1)
		{
			valeur1 = 1;
		}
		else{
			valeur1 = 0;
		}

		if(x2==1)
		{
			valeur2 = 1;
		}
		else{
			valeur2 = 0;
		}
		if(x3==1)
		{
			valeur3 = 1;
		}
		else{
			valeur3 = 0;
		}
		if(x4==1)
		{
			valeur4 = 1;
		}
		else{
			valeur4 = 0;
		}
		if(x5==1)
		{
			valeur5 = 1;
		}
		else{
			valeur5 = 0;
		}
		if(x6==1)
		{
			valeur6 = 1;
		}
		else{
			valeur6 = 0;
		}
		if(x7==1)
		{
			valeur7 = 1;
		}
		else{
			valeur7 = 0;
		}
		if(x8==1)
		{
			valeur8 = 1;
		}
		else{
			valeur8 = 0;
		}
		if(x9==1)
		{
			valeur9 = 1;
		}
		else{
			valeur9 = 0;
		}
		if(x10==1)
		{
			valeur10 = 1;
		}
		else{
			valeur10 = 0;
		}
		//alert(x) ;

		//alert(valeur1 + " - " + valeur10);
		
		form_data = {
			valeur_1 : valeur1,
			valeur_2 : valeur2,
			valeur_3 : valeur3,
			valeur_4 : valeur4,
			valeur_5 : valeur5,
			valeur_6 : valeur6,
			valeur_7 : valeur7,
			valeur_8 : valeur8,
			valeur_9 : valeur9,
			valeur_10 : valeur10,
			checkbox_value1 : a,
			checkbox_value11 : a1,
			checkbox_value12 : a2,
			checkbox_value13 : a3,
			checkbox_value2 : b,
			checkbox_value21 : b1,
			checkbox_value22 : b2,
			checkbox_value23 : b3,
			checkbox_value3 : c,
			checkbox_value31 : c1,
			checkbox_value32 : c2,
			checkbox_value33 : c3,
			checkbox_value4 : d,
			checkbox_value41 : d1,
			checkbox_value42 : d2,
			checkbox_value43 : d3,
			checkbox_value5 : e,
			checkbox_value51 : e1,
			checkbox_value52 : e2,
			checkbox_value53 : e3,
			checkbox_value6 : f,
			checkbox_value61 : f1,
			checkbox_value62 : f2,
			checkbox_value63 : f3,
			checkbox_value7 : g,
			checkbox_value71 : g1,
			checkbox_value72 : g2,
			checkbox_value73 : g3,
			checkbox_value8 : h,
			checkbox_value81 : h1,
			checkbox_value82 : h2,
			checkbox_value83 : h3,
			checkbox_value9 : i,
			checkbox_value91 : i1,
			checkbox_value92 : i2,
			checkbox_value93 : i3,
			checkbox_value10 : j,
			checkbox_value101 : j1,
			checkbox_value102 : j2,
			checkbox_value103 : j3,







		};

		$.ajax({
				url: "<?php echo site_url('welcome/afficher_resultat'); ?>",
				type: 'POST',
				data : form_data,
				 success: function(data) {
					
						$('#resultat').html(data);
            //$('#tableau').html(data);
            
					}
				
			});

			
			


		/*	var idpierres = $('#idpierres').val();
			$.ajax({
				url: "<?php //echo site_url('admin/pierre/insert_decoration_pierre'); ?>",
				type: 'POST',
				data : {checkbox_value : checkbox_value, idpierres : idpierres},
				 success: function(data) {
					
						$('#pierres').html(data);
            //$('#tableau').html(data);
            
					}
				
			});*/


		
	});

});
	

</script>