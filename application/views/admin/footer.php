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



<?php $process=base_url('/assets/files/procedure_'); ?>

<?php $indic=base_url('/assets/files/fiche_indicateur/Indicateur-'); ?>

<?php $cert=base_url('/assets/files/certificat/certification-'); ?>

<?php $progra=base_url('/assets/files/programmes/'); ?>



<script src="<?php echo base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>

<script type="text/javascript">



    $('#process').on('change', function() {

      var affichagePro=document.getElementById('processDisplay');

      output='<iframe id="doc" style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url='+this.value+'&embedded=true"></iframe>';

      affichagePro.innerHTML=output;

      if(this.value==0){

        $('#processDisplay').hide();

         $('#first').show();

      }

      else{

        $('#processDisplay').show();

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

    //   output='<center><img style="width:80%" src="'+this.value+'"></center>';
      output='<p><a class="btn btn-sm btn-danger" href="'+this.value+'" download="programme"><i style="font-size:16px;" class="fas fa-download"></i>  TELECHARGER JPEG </a></p> <center><img style="width:80%" src="'+this.value+'"></center>';


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



    $('#archiveVeille').on('change', function() {

      window.location.assign("<?php echo base_url('admin/archive/') ?>" + this.value);

    });

   



    $(document).ready(function(){



        $('a').tooltip()

 

        // cours

        $('.btnEditCours').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const titre = $(this).data('titre');

            const key = $(this).data('key');

            // Set data to Form Edit

            $('#idCours').val(id);

            $('#titreCours').val(titre);

            $('#idKey').val(key);

            // Call Modal Edit

            $('#editCours').modal('show');

        });



        // contact

        $('.btnEditContact').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const titre = $(this).data('titre');

            const dept31 = $(this).data('dept31');

            const dept81 = $(this).data('dept81');

            const dept82 = $(this).data('dept82');

            // Set data to Form Edit

            $('#idContact').val(id);

            $('#titreContact').val(titre);

            $('#dept31').val(dept31);

            $('#dept81').val(dept81);

            $('#dept82').val(dept82);

            // Call Modal Edit

            $('#editContact').modal('show');

        });



        // apprenant

        $('.btnEditApprenant').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const prenom = $(this).data('prenom');

            // Set data to Form Edit

            $('#idApprenant').val(id);

            $('#nomApprenant').val(nom);

            $('#prenomApprenant').val(prenom);

            // Call Modal Edit

            $('#editApprenant').modal('show');

        });



        // prof

        $('.btnEditProf').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const prenom = $(this).data('prenom');

            // Set data to Form Edit

            $('#idProf').val(id);

            $('#nomProf').val(nom);

            $('#prenomProf').val(prenom);

            // Call Modal Edit

            $('#editProf').modal('show');

        });



        // support

        $('.btnEditSupport').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const category = $(this).data('category');

            // Set data to Form Edit

            $('#idSup').val(id);

            $('#nomSup').val(nom);

            $('#categorySup').val(category).trigger('change');

            // Call Modal Edit

            $('#editSupport').modal('show');

        });



        // support

        $('.btnEditSupportA').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const support = $(this).data('support');

            const apprenant = $(this).data('apprenant');



            //alert(id+" "+support+" "+apprenant);

            // Set data to Form Edit

            $('#idSupA').val(id);

            $('#support').val(support).trigger('change');

            $('#apprenant').val(apprenant).trigger('change');

            // Call Modal Edit

            $('#editSupportA').modal('show');

        });



        // recrutement

        $('.btnEditRecrutement').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const category = $(this).data('category');

            const link = $(this).data('link');

            const lien = $(this).data('lien');



            $('#lienRec').val(lien);

            

            // Set data to Form Edit

            $('#idRec').val(id);

            $('#nomRec').val(nom);

            $('#categoryRec').val(category).trigger('change');

            // Call Modal Edit

            $('#editRecrutement').modal('show');

        });



        // recrutement

        $('.btnEditVideo').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const cours = $(this).data('cours');

            const pseudo = $(this).data('pseudo');

            const password = $(this).data('password');

            const link = $(this).data('link');

            const idFormation = $(this).data('id_formation');



            $('#idVideo').val(id);

            

            // Set data to Form Edit

            $('#cours').val(cours);

            $('#pseudo').val(pseudo);

            $('#password').val(password);

            $('#link').val(link);

            $('#idFormation').val(idFormation).trigger('idFormation');

            // Call Modal Edit

            $('#editVideo').modal('show');

        });



        // recrutement

        $('.btnEditQcm').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const titre = $(this).data('titre');

            const link = $(this).data('link');

            const idFormation = $(this).data('id_formation');
            const idtype = $(this).data('id_type');



            $('#idQcm').val(id);

            

            // Set data to Form Edit

            $('#titre').val(titre);

            $('#link').val(link);

            $('#idFormation').val(idFormation).trigger('idFormation');
            $('#id_type').val(idtype).trigger('id_type');

            // Call Modal Edit

            $('#editQcm').modal('show');

        });



        // documents

        $('.btnEditDocument').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const category = $(this).data('category');

            const link = $(this).data('link');

            const lien = $(this).data('lien');



            $('#lienDoc').val(lien);

            

            // Set data to Form Edit

            $('#idDoc').val(id);

            $('#nomDoc').val(nom);

            $('#categoryDoc').val(category).trigger('change');

            // Call Modal Edit

            $('#editDocument').modal('show');

        });



        // handicap

        $('.btnEditHandicap').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            const category = $(this).data('category');

            const link = $(this).data('link');

            const lien = $(this).data('lien');



            $('#lienHandi').val(lien);

            

            // Set data to Form Edit

            $('#idHandi').val(id);

            $('#nomHandi').val(nom);

            $('#categoryHandi').val(category).trigger('change');

            // Call Modal Edit

            $('#editHandicap').modal('show');

        });



        // programmes

        $('.btnEditProgramme').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            //const category = $(this).data('category');

            // Set data to Form Edit

            $('#idProg').val(id);

            $('#nomProg').val(nom);

            //$('#categorySup').val(category).trigger('change');

            // Call Modal Edit

            $('#editProgramme').modal('show');

        });



        // procedure

        $('.btnEditProcedure').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            //const category = $(this).data('category');

            // Set data to Form Edit

            $('#idProcess').val(id);

            $('#nomProcess').val(nom);

            //$('#categorySup').val(category).trigger('change');

            // Call Modal Edit

            $('#editProcedure').modal('show');

        });



        // certifications

        $('.btnEditCertificat').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const nom = $(this).data('nom');

            //const category = $(this).data('category');

            // Set data to Form Edit

            $('#idCert').val(id);

            $('#nomCert').val(nom);

            //$('#categorySup').val(category).trigger('change');

            // Call Modal Edit

            $('#editCertificat').modal('show');

        });



        // formation

        $('.btnEditFormation').on('click',function(){

            // get data from button edit

            let id = $(this).data('id');

            const apprenant_id = $(this).data('apprenant');

            const prof_id = $(this).data('prof');

            const cours_id = $(this).data('cours');

            // Set data to Form Edit

            $('#idFormation').val(id).trigger('change');

            $('#prof').val(prof_id).trigger('change');

            $('#apprenant').val(apprenant_id).trigger('change');

            $('#cours').val(cours_id).trigger('change');

            // Call Modal Edit

            $('#editFormation').modal('show');

        });





         

    });

</script>

<script src="<?php echo base_url('/assets/js/main.js') ?>"></script>

<script src="<?php echo base_url('/assets/js/sb-admin-2.min.js') ?>"></script>

<script src="<?php echo base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?php echo base_url('/assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>

<script>
// SECURITY P0.2 - Intercepteur global jQuery pour injecter le token CSRF
(function() {
    var tokenName = document.querySelector('meta[name="csrf-token-name"]');
    var tokenHash = document.querySelector('meta[name="csrf-token"]');
    if (tokenName && tokenHash && window.jQuery) {
        var name = tokenName.getAttribute('content');
        var hash = tokenHash.getAttribute('content');
        window.KALIOPI_CSRF = { name: name, hash: hash };
        jQuery.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': hash },
            beforeSend: function(xhr, settings) {
                if (settings.type && settings.type.toUpperCase() !== 'GET') {
                    if (typeof settings.data === 'string' && settings.data.indexOf(name + '=') === -1) {
                        settings.data += (settings.data ? '&' : '') + name + '=' + encodeURIComponent(hash);
                    }
                }
            }
        });
    }
})();
</script>
