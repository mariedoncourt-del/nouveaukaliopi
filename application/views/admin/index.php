<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>

<html lang="fr">

<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KALIOPI - MAF</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/vendor/icofont/icofont.min.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/style.css') ?>" rel="stylesheet">



  <link href="<?php echo base_url('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/sb-admin-2.css') ?>" rel="stylesheet">

</head>

<body>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

  <header id="header-landing" class="align-items-center header-landing">

    <div class="container">

      <div class="row icons">

        <div class="col-md-2 col-sm-2 col-xs-2 text-left"><a href="https://maf-formation.org/cias/"><img src="<?php echo base_url('assets/img/') ?>maf-blanc.png" style="width:200px;"></a></div>

        <div class="offset-md-8 offset-sm-8 offset-xs-8 col-md-2 col-sm-2 col-xs-8 text-right"><img src="<?php echo base_url('assets/img/') ?>qualiopi.png" style="width:200px"></div>

      </div>

    </div>

    <div class="container d-flex flex-column align-items-center">

      <h1>Bienvenue l'interface administrateur Qualiopi</h1>

      <div class="subscribe">

        <form method="post" role="form" class="php-email-form" action="<?php base_url('admin/index') ?>">

          <div class="">

            <input type="text" name="login" placeholder="Login" class="form-control">

            <input type="password" name="password"  class="form-control" placeholder="Mot de passe">

          </div><br>

           <input type="submit" class="btn btn-primary" value="Connexion">

          <div class="mt-2">

            <div class="loading">Chargement</div>

            <div class="error-message">

              <?php echo validation_errors(); ?>

              <?php echo $message; ?> 

              </div>

            <div class="sent-message"></div>

          </div>

        </form>

      </div>

      <div class="container aide">

        <div class="row">

          <ul>

            <li><a href="<?php echo base_url('/welcome/index') ?>">Apprenant / Prof</a></li>

            <!--<li><a href="#" data-toggle="modal" data-target="#aboutModal">A propos</a></li>-->

          </ul>

        </div>

      </div>

    </div>

  </header>



  <!-- Aide Modal-->

    <div class="modal fade" id="aideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Aide video</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>

                <div class="modal-body">

                  <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/582541439?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Kaliopi-Prof-Apprenant.mp4"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

                </div>

            </div>

        </div>

    </div>



    <!-- About Modal-->

    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">A propos</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>

                <div class="modal-body">

                  <div>

                    <?php $livret=base_url('/assets/files/Livret.php') ?>

                    <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo $livret; ?>&embedded=true"></iframe>

                  </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

                </div>

            </div>

        </div>

    </div>





  



<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<script src="<?php echo base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>





<script src="<?php echo base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?php echo base_url('/assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>



</body>



</html>