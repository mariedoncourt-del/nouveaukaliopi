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
		<?php echo $this->session->flashdata('msg'); ?>
	<?php echo form_open_multipart('welcome/update_eval_hot'); ?>
		Evaluation  à chaud
		<br>

		<br>
		<input type="hidden" class="form-control" name="id" value="<?php echo $eval_hot['id'] ?>" placeholder="Unité" required>
		<br>
		<input type="text" class="form-control" name="entreprise" value="<?php echo $eval_hot['entreprise']; ?>" placeholder="Entreprise">
		<br>

		<strong>Evaluer votre formation</strong>

		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
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
						<td>
							<select name="<?php echo $field_eval[$i] ?>" id="<?php echo $field_eval[$i] ?>">

								<?php 
									$j=0;
									foreach($eval_hot_one as $eval_hot_one_one): ?>
										<option value="<?php echo $j; ?>" 
											<?php 
											if($j == $eval_hot[$field_eval[$i]]){
												echo 'selected';} ?>
											><?php echo $eval_hot_one_one; ?></option>
									<?php $j++;
									endforeach; ?>
							</select>
						</td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
		<br>
		<strong>Evaluation Global</strong>
		<br>
		<input type="text" class="form-control" name="eval_note" value="<?php echo $eval_hot['eval_note']; ?>" placeholder="Note">
		<br>
		<strong>Votre commentaire</strong>
		<br>
		<textarea name="eval_comm" rows="4" cols="" class="form-control"><?php echo $eval_hot['eval_comm']; ?>
		</textarea>
		<br>
		<strong>Votre satisfaction</strong>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
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
						<td>
							<select name="<?php echo $field_sati[$i] ?>" id="<?php echo $field_sati[$i] ?>">

								<?php 
									$j=0;
									foreach($sati_hot_one as $sati_hot_one_one): ?>
										<option value="<?php echo $j; ?>" 
											<?php 
											if($j == $eval_hot[$field_sati[$i]]){
												echo 'selected';} ?>
											><?php echo $sati_hot_one_one; ?></option>
									<?php $j++;
									endforeach; ?>
							</select>
						</td>
					</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
		<br>
		<strong>Votre commentaire</strong>
		<br>
		<textarea name="sati_comm" rows="4" cols="" class="form-control"><?php echo $eval_hot['sati_comm']; ?>
		</textarea>
		<br>
		<br>
		<button class="btn btn-success" type="submit">Evaluer</button>
	</form>

	</div>
	
</div>