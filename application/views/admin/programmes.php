<h1 class="h3 mb-2 text-gray-800">Programmes de formation</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <a class="btn btn-primary" href="<?php echo base_url().'admin/programme' ?>">Les programmes</a> 
    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_programme' ?>">Gestion des programmes</a>
    <br>
</div>
	<div class="card-body">
        <select id="progra" class="form-control">
            <option value="">- Programmes -</option>
            <?php foreach ($programmes as $programme): ?>
                <option value="<?php echo base_url('assets/programmes/').$programme['link'] ?>">
                	<?php echo e($programme['nom']); ?>
				</option>
            <?php endforeach; ?>
        </select>
        </select>

        <br>

        <div id="prograDisplay">
            <p></p>
        </div>
	</div>    
</div>