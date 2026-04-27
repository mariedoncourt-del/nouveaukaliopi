<h1 class="h3 mb-2 text-gray-800">Supports</h1>
<div class="card shadow mb-4">
<style>

	.parent{
		margin-left: 25px;
	}

	.sup-category{
		border: 3px solid black;
		margin: 10px;
		writing-mode: vertical-lr;
		text-orientation: upright;
		text-align: center;
		vertical-align: middle;
		padding: 15px;
		font-size: 18px;
		font-weight: bolder;
		text-transform: uppercase;
		color: black;
	}

	.sup-formation{
		margin: 10px;
		padding: 15px;
		border: 3px solid black;
	}

	.sup-formation a{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: none;
	}
	.sup-formation a:hover{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: underline;
	}

	.sup-formation a::before {
  		content: "■ ";
	}
</style>
<div class="card-header py-3">
	<a class="btn btn-primary" href="<?php echo base_url().'admin/support_video' ?>">Supports Vidéo</a> 
	

	<a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_video' ?>">Gestion des Supports vidéo - Apprenant</a>
	<br>
</div>

<div class="card-body parent">
	<h3>Supports Vidéos</h3>
	<a class="btn btn-success" href="#" id="video">Ajouter</a> 
    <br><br>
    <div class="table-responsive text-left">
              <table id="maTable" class="table table-bordered table-striped">
              <tr>
                 
                  <th>Cours</th>
                  <th>Lien</th>   
                  
              </tr>
            <?php
             foreach($videos as $row)
             {
                echo '<tr><td>'.$row->cours.'</td><td><a href="'.$row->lien.'" target="_blank">'.$row->lien.'</a></td></tr>';
             }
             ?>
             </table>
            </div>
	
</div>    
</div>


<div class="modal" id="monModal3">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajouter vidéo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post">
                    
                    <div class="form-group row">
                           <label class="col-lg-2 col-form-label">Cours</label>
                            <div class="col-lg-10">
                              <input type="text" name="cours" id="cours" class="form-control" placeholder="Cours">
                            </div>
                   </div>
                   <div class="form-group row">
                           <label class="col-lg-2 col-form-label">Lien</label>
                            <div class="col-lg-10">
                              <input type="text" name="lien" id="lien" class="form-control" placeholder="Lien">
                            </div>
                   </div>
                   
                  
                  
             
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btn_enregistrer">Enregistrer</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
      </div>
    </form>

    </div>
  </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){

    $('#video').click(function(){

        $('#monModal3').modal('show');
    });

    $('#btn_enregistrer').click(function(){
   
    
   var form_data = {
        cours : $('#cours').val(),
        lien : $('#lien').val(),
        
       
    };
  
    $.ajax({
        url: "<?php echo site_url('admin/insertion_video'); ?>",
        type: 'POST',
        data: form_data,
        success: function(data) {
           
             alert(data);
             // $('#monModal2').modal('hide');
        },
    error : function(msg){
      $('#afficher').html('<div class="alert alert-danger text-center">Erreur</div>');
    }
    });

    
  });


 
});
</script>
