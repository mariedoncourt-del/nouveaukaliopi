<h1 class="h3 mb-2 text-gray-800">QCM</h1>
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
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Lien</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($qcms as $qcm): ?>
						<tr>
							<td><?php echo $qcm['titre'] ?></td>
							<td><a href="<?php echo $qcm['link'] ?>" class="btn btn-primary" target="_blank">CQM</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>
</div>