<h1 class="h3 mb-2 text-gray-800">Procedures</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php include('procedure_header.php'); ?>
    <br>
</div>
	<div class="card-body">

        <select id="process" class="form-control">
            <option value="">- Procedures -</option>
            <?php foreach($procedures as $procedure) :?>
            
            <option value="<?php echo base_url('/assets/procedures/').$procedure['link']; ?>"><?php echo $procedure['nom']; ?></option>
            
            <?php endforeach; ?>
        </select>            

        <br>

        <div id="processDisplay">
            <p></p>
        </div>
	</div>    
</div>