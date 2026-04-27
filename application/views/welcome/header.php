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

  <link href="<?php echo base_url('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/sb-admin-2.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/custom.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/select2.min.css') ?>" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>



<body id="page-top">

  <!--<main id="main" class="container-fluid">-->

   <!-- <div id="page-top">-->

      <div id="wrapper">



        <ul class="navbar-nav bg-nav sidebar sidebar-dark accordion" id="accordionSidebar">

          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('welcome/dashboard') ?>">

            <div class="sidebar-brand-icon">

            <img src="<?php echo base_url('assets/img/') ?>qualiopi.png" style="width:120px">

            </div>

            <div class="sidebar-brand-text mx-3">KALIOPI</div>

          </a>

          <!-- Divider -->

          <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les indicateurs de qualité Qualiopi" href="<?php echo base_url('welcome/indicateur') ?>">

                <i class="fas fa-fw fa-map-signs"></i>

                <span>Indicateurs</span>

              </a>

            </li>

         

          <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Passer un questionnaire" href="<?php echo base_url('welcome/questionnaire') ?>">

                <i class="fas fa-fw fa-question-circle"></i>

                <span>Questionnaires</span>

              </a>

            </li>

          <hr class="sidebar-divider my-0">



          <li class="nav-item">

            <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les séances de formation effectuées" href="<?php echo base_url('welcome/seance') ?>">

              <i class="fas fa-fw fa-cog"></i>

              <span>Séances</span></a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Expression des besoins du formation et des apprenants" href="<?php echo base_url('welcome/besoin') ?>">

                <i class="fas fa-fw fa-user-circle"></i>

                <span>Besoins</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les activités d'apprentissage et outils pédagogiques" href="<?php echo base_url('welcome/scenario') ?>" title="Activité d'apprentissage">

                <i class="fas fa-fw fa-wrench"></i>

                <span>Scénarios pédagogiques</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Differentes evaluation" href="<?php echo base_url('welcome/evaluation') ?>">

                <i class="fas fa-fw fa-chart-area"></i>

                <span>Evaluations</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <!-- Emargements masqué temporairement
            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Suivis et emargement" href="<?php echo base_url('welcome/emargement') ?>">

                <i class="fas fa-fw fa-list"></i>

                <span>Emargements</span>

              </a>

            </li>
            -->

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Connaitre votre formateur" href="<?php echo base_url('welcome/cv') ?>">

                <i class="fas fa-fw fa-address-card"></i>

                <!--<img class="img-profile" src="<?php echo base_url('/assets/img/prof.png') ?>">-->

                <span>CV Prof</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Rester à jour sur l'actualité du monde pédagogique" href="<?php echo base_url('welcome/veille') ?>">

                <i class="fas fa-fw fa-rss"></i>

                <span>Veille</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Faire une réclamation" href="<?php echo base_url('welcome/reclamation') ?>">

                <i class="fas fa-fw fa-comments"></i>

                <span>Difficultés - Aléas</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Méthodes pour prévenir les risques d'abandon" href="<?php echo base_url('welcome/abandon') ?>">

                <i class="fas fa-fw fa-hands-helping"></i>

                <span>Prévention d'abandon</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Guides pour les formateurs" href="<?php echo base_url('welcome/documentaire') ?>">

                <i class="fas fa-fw fa-book-reader"></i>

                <span>Espace documentaire</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Supports pour le cours" href="<?php echo base_url('welcome/support') ?>">

                <i class="fas fa-fw fa-file"></i>

                <span>Supports</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Accessibilité de nos formations et est nos établissements aux types de handicaps" href="<?php echo base_url('welcome/handicap') ?>">

                <i class="fas fa-fw fa-wheelchair"></i>

                <span>Guide Formateur handicap</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les certifications accessibles avec MAF" href="<?php echo base_url('welcome/certification') ?>">

                <i class="fas fa-fw fa-file-invoice"></i>

                <span>Certifications</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Platforme de eLearning" href="<?php echo base_url('welcome/video') ?>">

                <i class="fas fa-fw fa-video"></i>

                <span>Vidéos</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Contact" href="<?php echo base_url('welcome/contact') ?>">

                <i class="fas fa-fw fa-address-book"></i>

                <span>Contact</span>

              </a>

            </li>

          </ul>

        <?php //endif; ?>

          <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->

                <!-- Sidebar Toggle (Topbar) -->
                <div class="text-lg font-weight-bold text-uppercase mb-1"><strong><?php echo $formation['titre'] ?></strong></div>

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none mr-3">

                        <i class="fa fa-bars"></i>

                    </button>

                

                <ul class="navbar-nav ml-auto">

                  <br>

                  <br>

                  

                  <li class="nav-item dropdown no-arrow">

                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"

                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $formation['id'] ?></span>

                    <div class="d-md-none positi"><strong><?php echo $formation['id']; ?></strong></div>

                    <img class="img-profile rounded-circle"

                    src="<?php echo base_url('/assets/img/undraw_profile.svg') ?>">

                  </a>

                  <!-- Formation Info -->

                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"

                  aria-labelledby="userDropdown">

                  <a class="dropdown-item" href="#">

                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>

                    <?php echo $formation['prenom_prof']." ".$formation['nom_prof'] ?>

                  </a>

                  <a class="dropdown-item" href="#">

                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>

                    <?php echo $formation['prenom_apprenant']." ".$formation['nom_apprenant'] ?>

                  </a>

                  <a class="dropdown-item" href="#">

                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>

                    <?php echo $formation['titre'] ?>

                  </a>

                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">

                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

                    Quitter

                  </a>

                </div>

              </li>

            </ul>

          </nav>

          <!-- End of Topbar -->



          <!-- Logout Modal-->

          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

          aria-hidden="true">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Quitter ?</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">×</span>

                </button>

              </div>

              <div class="modal-body">Cliquer 'Quitter' pour sortir</div>

              <div class="modal-footer">

                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

                <a class="btn btn-danger" id="btnQuitter" href="<?php echo base_url('welcome/logout_public') ?>">Quitter</a>

              </div>

            </div>

          </div>

        </div>



        <!-- Begin Page Content -->

        <div class="container-fluid">

