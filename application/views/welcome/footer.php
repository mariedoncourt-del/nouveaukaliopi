                  </div>
            </div>

        <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                         <span>Copyright &copy; MAF <?php echo date("Y"); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<!--</div>
</main>-->
<?php $fiche=base_url('/assets/files/fiche'); ?>
<?php $doc=base_url('/assets/files/espace_doc_'); ?>
<?php $cert=base_url('/assets/files/certificat/certification-'); ?>
<?php $indic=base_url('/assets/files/fiche_indicateur/Indicateur-'); ?>
<?php $progra=base_url('/assets/files/programmes/'); ?>

<script src="<?php echo base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/select2.min.js') ?>"></script>

<script type="text/javascript">
    
    $('#video').on('change', function() {
      var affichageFiche=document.getElementById('ficheDisplay');
      listVideo=['',
      'https://www.youtube.com/embed/MsL63P6_IDw',
      'https://www.youtube.com/embed/JDEiY2MpimI',
      'https://www.youtube.com/embed/d7-qANd8iQI',
      'https://www.youtube.com/embed/nHF2q8GKlZw',
      'https://www.youtube.com/embed/tRiavnuZbVM',
      'https://www.youtube.com/embed/ElDzE1MgdTQ',
      'https://www.youtube.com/embed/CvUhvM9Nm-M',
      'https://www.youtube.com/embed/PVUmjnjSZ1Q',
      'https://www.youtube.com/embed/Mp34KBYYYbs',
      'https://www.youtube.com/embed/nwSHPa0GEUc']
      output='<center><iframe class="embed-responsive-item" src="'+this.value+'" style="width:70%;height:700px;"></iframe></center>';
      affichageFiche.innerHTML=output;
      if(this.value==0){
        $('#ficheDisplay').hide();
         $('#first').show();
      }
      else{
        $('#ficheDisplay').show();
         $('#first').hide();
      }
    });

    $('#docVideo').on('change', function() {
      var affichageFiche=document.getElementById('docDisplay');
      output='<center><iframe class="embed-responsive-item" src="'+this.value+'" style="width:70%;height:700px;"></iframe></center>';
      affichageFiche.innerHTML=output;
      if(this.value==0){
        $('#docDisplay').hide();
         $('#first').show();
      }
      else{
        $('#docDisplay').show();
         $('#first').hide();
      }
    });

    $('#fiche').on('change', function() {
      var affichageFiche=document.getElementById('ficheDisplay');
      output='<iframe id="fiche" style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url='+this.value+'&embedded=true"></iframe>';
      affichageFiche.innerHTML=output;
      if(this.value==0){
        $('#ficheDisplay').hide();
         $('#first').show();
      }
      else{
        $('#ficheDisplay').show();
         $('#first').hide();
      }
    });


     $('#doc').on('change', function() {
      var affichageDoc=document.getElementById('docDisplay');
      output='<iframe id="doc" style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url='+this.value+'&embedded=true"></iframe>';
      affichageDoc.innerHTML=output;
      if(this.value==0){
        $('#docDisplay').hide();
         $('#first').show();
      }
      else{
        $('#docDisplay').show();
         $('#first').hide();
      }
    });

     $('#cert').on('change', function() {
      var affichageDoc=document.getElementById('certDisplay');
      output='<iframe id="cert" style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url='+this.value+'&embedded=true"></iframe>';
      affichageDoc.innerHTML=output;
      if(this.value==0){
        $('#certDisplay').hide();
         $('#first').show();
      }
      else{
        $('#certDisplay').show();
         $('#first').hide();
      }
    });

     $('#indic').on('change', function() {
      var affichagePro=document.getElementById('indicDisplay');
      output='<center><img style="width:80%" src="<?php echo $indic; ?>'+this.value+'.png"></center>';
      affichagePro.innerHTML=output;
      if(this.value==0){
        $('#indicDisplay').hide();
         $('#first').show();
      }
      else{
        $('#indicDisplay').show();
         $('#first').hide();
      }
    });

      $('#progra').on('change', function() {
      var affichagePro=document.getElementById('prograDisplay');
      output='<center><img style="width:80%" src="<?php echo $progra; ?>'+this.value+'"></center>';
      affichagePro.innerHTML=output;
      if(this.value==0){
        $('#prograDisplay').hide();
         $('#first').show();
      }
      else{
        $('#prograDisplay').show();
         $('#first').hide();
      }
    });

     $('#archiveVeille').on('change', function() {
      window.location.assign("<?php echo base_url('admin/archive/') ?>" + this.value);
    });

    $(document).ready(function(){

        $('a').tooltip();

        $(".activite").select2({
            tags: true
        });

        $(".media").select2({
            tags: true
        });

         $('#addForm').on('submit',function(){

            /*//activité
            var selected = [];
            for (var option of document.getElementById('activite').options)
            {
              if (option.selected) {
                  selected.push(option.value);
              }
            }
            //alert(selected);
            var activites="";
            for(var i=0; i<selected.length; i++){
                activites+=selected[i]+",";
            }
            $('#activites').val(activites);

            //media
            var selected = [];
            for (var option of document.getElementById('media').options)
            {
              if (option.selected) {
                  selected.push(option.value);
              }
            }
            //alert(selected);
            var medias="";
            for(var i=0; i<selected.length; i++){
                medias+=selected[i]+",";
            }
            $('#medias').val(medias);*/
        });

        $('#editForm').on('submit',function(){
            var selected = [];
            for (var option of document.getElementById('media_mod').options)
            {
              if (option.selected) {
                  selected.push(option.value);
              }
            }
            //alert(selected);
            var medias="";
            for(var i=0; i<selected.length; i++){
                medias+=selected[i]+",";
            }
            $('#medias_mod').val(medias);
        });
 
        // get Edit Cours
        $('.btnEditSeance').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const numero = $(this).data('numero');
            const dateSeance = $(this).data('date');
            const lieu = $(this).data('lieu');
             const horaire = $(this).data('horaire');
            // Set data to Form Edit
            $('#idSeance').val(id);
            $('#numero').val(numero);
            $('#dateSeance').val(dateSeance);
            $('#lieu').val(lieu);
            $('#horaire').val(horaire);
            // Call Modal Edit
            $('#editSeance').modal('show');
        });

        // get Edit Cours
        $('.btnEditBesoin').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const context = $(this).data('context');
            const caractere = $(this).data('caractere');
            const contenu = $(this).data('contenu');
            const ressource = $(this).data('ressource');
            const planning = $(this).data('planning');
            // Set data to Form Edit
            $('#idBesoin').val(id);
            $('#contextBesoin').val(context);
            $('#caractereBesoin').val(caractere);
            $('#contenuBesoin').val(contenu);
            $('#ressourceBesoin').val(ressource);
            $('#planningBesoin').val(planning);
            // Call Modal Edit
            $('#editBesoin').modal('show');
        });

        // get Edit Cours
        $('.btnEditQuestion').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const attente_01 = $(this).data('attente_01');
            const service = $(this).data('service');
            const poste = $(this).data('poste');
            const exp = $(this).data('exp');
            const activite = $(this).data('activite');
            const experience = $(this).data('experience');
            const atout = $(this).data('atout');
            const amelioration = $(this).data('amelioration');
            const objectif = $(this).data('objectif');
            const attente_02 = $(this).data('attente_02');

            const qui = $(this).data('qui');
            const remarques = $(this).data('remarques');

            // Set data to Form Edit
            $('#idQuest').val(id);
            $('#attente_01').val(attente_01);
            $('#service').val(service);
            $('#poste').val(poste);
            $('#exp').val(exp);
            $('#activiteQ').val(activite);
            $('#experience').val(experience);
            $('#atout').val(atout);
            $('#amelioration').val(amelioration);
            $('#objectif').val(objectif);
            //$('#ressource').val(ressource);
            $('#attente_02').val(attente_02);
            $('#qui').val(qui);
            $('#remarques').val(remarques);
            // Call Modal Edit
            $('#editQuestion').modal('show');
        });

        // get Edit Cours
        $('.btnEditScenario').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const unite = $(this).data('unite');
            const titre = $(this).data('titre');
            const activite = $(this).data('activite');
            //const just_activite = $(this).data('just-activite');
            const media = $(this).data('media');
            const just_media = $(this).data('just-media');
            // Set data to Form Edit
            $('#idScenario').val(id);
            $('#unite').val(unite);

            $('#titre').val(titre);

            //document.getElementById('activite_mod').value=activite;
            //$('#just_activite').val(just_activite).trigger('change');

            array_activite=activite.split(",");
            $('#activite_mod').val(null).trigger('change');

            // Set the value, creating a new option if necessary
            for(var i=0; i<array_activite.length;i++){
                 /*if ($('#activite_mod').find("option[value='" + escape(array_activite[i]) + "']").length) {
                     $('#activite_mod').val(array_activite[i]).trigger('change');
                } else { */
                // Create a DOM Option and pre-select by default
                var newOption = new Option(array_activite[i], array_activite[i], true, true);
                // Append it to the select
                $('#activite_mod').append(newOption).trigger('change');
                }
            //}
            

           /* $('#activite_mod').val(array_activite);
            $('#activite_mod').trigger('change');*/

            array_media=media.split(",");
            $('#media_mod').val(null).trigger('change');

            // Set the value, creating a new option if necessary
            for(var i=0; i<array_media.length;i++){
                 /*if ($('#activite_mod').find("option[value='" + escape(array_activite[i]) + "']").length) {
                     $('#activite_mod').val(array_activite[i]).trigger('change');
                } else { */
                // Create a DOM Option and pre-select by default
                var newOption = new Option(array_media[i], array_media[i], true, true);
                // Append it to the select
                $('#media_mod').append(newOption).trigger('change');
                }
            //}


            /*mediaMod=document.getElementById('media_mod');

            for (var i = 0; i < mediaMod.options.length-1; i++) {
                mediaMod.options[i].selected=false;
            }
            for (var i = 0; i < mediaMod.options.length-1; i++) {
                if(media.indexOf(mediaMod.options[i].value) > -1){
                mediaMod.options[i].selected=true;
            }}*/

            $('#just_media_mod').val(just_media).trigger('change');
            // Call Modal Edit
            $('#editScenario').modal('show');
        });

         // get Edit Cours
        $('.btnEditEvaluation').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const titre = $(this).data('titre');
            const niveau = $(this).data('niveau');
            const niveau_apres = $(this).data('niveau_apres');

            $('#id').val(id);
            $('#titre').val(titre);
            $('#niveau').val(niveau).trigger('change');
             $('#niveau_apres').val(niveau_apres).trigger('change');
            // Call Modal Edit
            $('#editEvaluation').modal('show');
        });

        // get Edit Cours
        $('.btnEditEvaluationPro').on('click',function(){
            // get data from button edit
            var id = $(this).data('id');
            const titre = $(this).data('titre');
            const category = $(this).data('category');
            const url = $(this).data('link');
            const commentaire = $(this).data('commentaire');


            $('#id').val(id);
            $('#titreEval').val(titre);
            $('#categoryEval').val(category).trigger('change');
            $('#urlEval').val(url);
            $('#commentairesEval').val(commentaire);
            // Call Modal Edit
            $('#editEvaluationPro').modal('show');
        });
         
    });
</script>
<script src="<?php echo base_url('/assets/js/main.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/sb-admin-2.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>