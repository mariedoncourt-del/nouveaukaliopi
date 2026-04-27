<h1 class="h3 mb-2 text-gray-800">ENREGISTREMENT QCM DEPART</h1>

<div class="card shadow mb-4">

	<div class="card-header py-3">

		<!-- <button class="btn btn-success" id="essai" data-toggle="modal" data-target="#ajoutProf">Ajouter</button> -->

	</div>

	<div class="card-body">



		<?php //echo $this->session->flashdata('msg'); ?>

        <form method="post" action="<?php echo site_url('admin/fichierexcel'); ?> ">
        
                 <div class="form-group text-left">
                     <label for="nom_formateur">Questionnaire</label>
                     <input type="text" class="form-control" id="question" name="question" placeholder="Question" autocomplete="off">
                     <span id="idformation" class="text-danger"></span>
                 </div>
                 <div class="form-group text-left">
                     <label for="nom_formation">Cours</label>
                     <select name="id_formation" class="form-control" id="id_formation">
                        <?php
                            foreach($dataformation as $row)
                            {
                                echo "<option value='".$row->id."'>".$row->titre."</option>";
                            }


                        ?>
                        </select>
                 </div>
                 <div class="form-group text-left">
                     
                     <input type="button" class="form-control col-md-2 btn btn-success" id="Enregistrers" name="Enregistrers" value="Enregistrer Question">
                      
                 </div>
                 <div class="form-group text-left">
                     <label for="reponse">Réponse</label>
                     <input type="text" class="form-control" id="reponse" name="reponse" placeholder="Réponse" autocomplete="off">
                      <span id="prixformation" class="text-danger"></span>
                 </div>
                 <div class="form-group text-left">
                     <label for="valeur">Valeur</label>
                     <input type="text" class="form-control" id="valeur" name="valeur" placeholder="Valeur" autocomplete="off">
                      <span id="prixformation" class="text-danger"></span>
                 </div>
                 <div class="form-group text-left">
                     
                     <input type="button" class="form-control col-md-2 btn btn-primary" id="Enregistrer" name="Enregistrer" value="Enregistrer">
                      
                 </div>

                 </form>
		
		<!--<div id="resultat"></div> -->


	<!-- Modal --><div id="monModal2" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                
	            </div>
	            <div class="modal-body">
				<form method="post">
	              <div class="form-group row">
                         
                           <label class="col-md-4 col-form-label">Login</label>
                            <div class="col-md-8">
                              <input type="text" name="login" id="login" class="form-control" placeholder="Login" readonly>
                           
                   			</div>
                   </div>
                   <div class="form-group row">
                         
                           <label class="col-md-4 col-form-label">Mot de passe</label>
                            <div class="col-md-8">
                              <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                           
                   			</div>
                   </div>
	            </div>
	            <div class="modal-footer">
					 <button type="button" class="btn btn-primary" id="modifier" name="modifier" data-dismiss="modal">Oui</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
	                
	            </div>
				</form>
	        </div>
	    </div>
	</div>



	<!-- Modal --><div id="monModal3" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            </div>
	            <div class="modal-body">
				<form method="post">
	              <div class="form-group row">
                           <label class="col-md-6 col-form-label">Voulez-vous supprimer?</label>
                            <div class="col-md-6">
                              <input type="text" name="logins" id="logins" class="form-control" placeholder="Login" readonly>
                            </div>
                   </div>
	            </div>
	            <div class="modal-footer">
					 <button type="button" class="btn btn-primary" id="supprimer" name="supprimer" data-dismiss="modal">Oui</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
	                
	            </div>
				</form>
	        </div>
	    </div>
	</div>

		
	</div>
	

</div>


<script type="text/javascript">
$(document).ready(function(){

	$('#btn_rechercher').click(function(){
    var nom = $('#nom_formateur').val();
     load_data_recherche(nom);
 });

 $('#nom_formateur').keypress(function(){
      if($('#nom_formateur').val()=="")
      {
        load_data();
      }

    });

 function load_data_recherche($nom)
    {
      var form_data = {
        nom_formateur: $('#nom_formateur').val(),
       // prenom_formateur: $('#prenom_formateur').val(),
    };

      $.ajax({
        url: "<?php echo site_url('admin/Afficher_formations_prof'); ?>",
        type: 'POST',
        data : {nom_formateur:$nom},
        success: function(data) {
           $('#resultat').html(data);
            
        },
    error : function(msg){
      $('#afficher').html('<div class="alert alert-danger text-center">Erreur</div>');
    }
    });
    return false;
    }

	$('#essai').click(function(){
			alert("bbbbbb");
	//	load_data();
		});	
	
		load_data();
		
		function load_data()
		{
			
			$.ajax({
       // url: "<?php //echo site_url('index.php/admin/afficheradmin'); ?>",
       url : "https://maf-formation.org/kaliopi/admin/afficher_formations",
        type: 'POST',
        success: function(data) {
           $('#resultat').html(data);
            
        },
		error : function(msg){
			$('#alert-msg').html('<div class="alert alert-danger text-center">Erreur</div>');
		}
    });
    return false;
		}

$(document).on('click','.btn_edit',function(){
           // var login = $(this).attr('id');
			/*$('#maTable tr').each(function() {
				nom = $(this).find('td:first').html();
				alert(""+ nom);
			});
        */
			//alert(personne_id)
			var login      = $(this).data('login');
			var password      = $(this).data('password');
			//alert(datanaissances);
			$('[name="login"]').val(login);
			$('[name="password"]').val(password);
			
			$('[name="password"]').text();

            $('#monModal2').modal('show');
        });
$(document).on('click','.btn_delete',function(){
           // var login = $(this).attr('id');
			/*$('#maTable tr').each(function() {
				nom = $(this).find('td:first').html();
				alert(""+ nom);
			});
        */
			//alert(personne_id)
			var logins      = $(this).data('login');
		
			//alert(datanaissances);
			$('[name="logins"]').val(logins);
			
			
			

            $('#monModal3').modal('show');
        });

$('#Enregistrer').click(function(){
		/*var daty = $('#daty').attr('value');
		var libelle = $('#libelledepenseachat').val();
		var qtedepenseachat = $('#qtedepenseachat').val();
		var pudepenseachat = $('#pudepenseachat').val();
		var montantdepenseachat = $('#montantdepenseachat').val();
		*/

        
		
		var form_data = {
        question: $('#question').val(),
        reponse: $('#reponse').val(),
        id_cours : $('#id_formation').val(),
        valeur :  $('#valeur').val()
        
    };
	
    $.ajax({
        url: "<?php echo site_url('admin/enregistrer_qcm_depart'); ?>",
        type: 'POST',
        data: form_data,
        success: function(data) {
           // $('#result_tableau').html(data);
		  // load_data();
		  // $('#monModal2').modal('hide');
          alert("Enregistrement réponse départ OK" + data);
            
        },
		error : function(msg){
			$('#alert-msg').html('<div class="alert alert-danger text-center">Erreur</div>');
		}
    });
	});


    $('#Enregistrers').click(function(){
		/*var daty = $('#daty').attr('value');
		var libelle = $('#libelledepenseachat').val();
		var qtedepenseachat = $('#qtedepenseachat').val();
		var pudepenseachat = $('#pudepenseachat').val();
		var montantdepenseachat = $('#montantdepenseachat').val();
		*/

        
		
		var form_data = {
        question: $('#question').val(),
        id_cours : $('#id_formation').val(),
        
        
    };
	
    $.ajax({
        url: "<?php echo site_url('admin/enregistrer_question_depart'); ?>",
        type: 'POST',
        data: form_data,
        success: function(data) {
           // $('#result_tableau').html(data);
		  // load_data();
		  // $('#monModal2').modal('hide');
          alert("Enregistrement question départ OK");
            
        },
		error : function(msg){
			$('#alert-msg').html('<div class="alert alert-danger text-center">Erreur</div>');
		}
    });
	});

$('#supprimer').click(function(){
		/*var daty = $('#daty').attr('value');
		var libelle = $('#libelledepenseachat').val();
		var qtedepenseachat = $('#qtedepenseachat').val();
		var pudepenseachat = $('#pudepenseachat').val();
		var montantdepenseachat = $('#montantdepenseachat').val();
		*/
		
		var form_data = {
        login: $('#logins').val(),
        
    };
	
    $.ajax({
        url: "<?php echo site_url('admin/supprimerAdmin'); ?>",
        type: 'POST',
        data: form_data,
        success: function(data) {
           // $('#result_tableau').html(data);
		   load_data();
		   $('#monModal3').modal('hide');
            
        },
		error : function(msg){
			$('#alert-msg').html('<div class="alert alert-danger text-center">Erreur</div>');
		}
    });
	});


	
});
</script>
