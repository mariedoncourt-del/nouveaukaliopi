<h1 class="h3 mb-2 text-gray-800">Indicateur Qualité</h1>
<div class="card shadow mb-4">
	<div class="card-body">

        <select id="indic" class="form-control">
            <option value="">- Numero -</option>
            <?php for($i=1;$i<=32;$i++): ?>
                <option value="<?php echo $i ?>">N° <?php echo $i ?></option>
            <?php endfor; ?>
        </select>
        </select>

        <br>

        <div id="indicDisplay">
            <p></p>
        </div>

        <div id="first">
            <img src="<?php echo base_url('assets/img/cartographie.jpg') ?>" width="100%" alt="">
        </div>
	</div>    
</div>