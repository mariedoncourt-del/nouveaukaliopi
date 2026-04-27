<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <header id="header-landing" class="align-items-center header-landing">
    <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-2 col-xs-2 text-left"><a href="https://maf-formation.org/cias/"><b>Rédirigé vers CIAS</b></a></div>
    </div>
      <div class="row">
         <a href="<?php echo base_url('/admin') ?>" class="admin">Administration</a>
      </div>
      <div class="row icons">
        <div class="col-md-2 col-sm-2 col-xs-2 text-left"><img src="<?php echo base_url('assets/img/') ?>maf-blanc.png" style="width:200px;"></div>
        <div class="offset-md-8 offset-sm-8 offset-xs-8 col-md-2 col-sm-2 col-xs-8 text-right"><img src="<?php echo base_url('assets/img/') ?>qualiopi.png" style="width:200px">
      </div>
    </div>
    <div class="container d-flex flex-column align-items-center">
      <h1>Bienvenue dans votre interface Qualiopi</h1>
      <h4>Merci de saisir les informations nécessaires au suivi de votre action de formation</h4>
      <div class="subscribe">
        <form method="post" role="form" class="php-email-form" action="<?php base_url('welcome/index') ?>">
          <div class="subscribe-form">
            <input type="text" name="idformation" placeholder="ID-FORMATION">
            <input type="submit" value="Vérifier">
          </div>
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
            <li><a href="#" data-toggle="modal" data-target="#aideModal">Aide</a></li>
            <li><a href="#" data-toggle="modal" data-target="#aboutModal">A propos</a></li>
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
                    <?php $livret=base_url('/assets/files/Livret.pdf') ?>
                    <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo $livret; ?>&embedded=true"></iframe>
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>


  
