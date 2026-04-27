<h1 class="h3 mb-2 text-gray-800">Evaluations</h1>
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
	
	<?php echo $this->session->flashdata('msg'); ?>

	<?php echo form_open_multipart('welcome/update_eval_note'); ?>
		Note
		<br>
		<br>
		<input type="text" class="form-control" name="note" value="<?php if(isset($formation['note']) || $formation['note']!=0) echo $formation['note']; ?>" placeholder="Note">
		<textarea class="form-control" name="comments" placeholder="Commentaire"><?php if(isset($formation['comments'])) echo $formation['comments'] ?></textarea>
		<br>
		<button class="btn btn-success" type="submit">Evaluer</button>
	</form>

	</div>
	
</div>