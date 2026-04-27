

<!DOCTYPE html>

<html lang="fr">

<head>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <?= csrf_meta() ?>

  <title>KALIOPI - ADMIN</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/vendor/icofont/icofont.min.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/sb-admin-2.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('/assets/css/custom.css') ?>" rel="stylesheet">
 
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
 <!-- <script src="<?php //echo base_url('assets/js/jquery-3.2.1.js'); ?>" ></script> -->
 <!--<script src="<?php //echo base_url('assets/vendor/jquery/jquery.min.js'); ?>" ></script> -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

</head>

<body id="page-top">

  <!--<main id="main" class="container-fluid">

    <div id="page-top">-->

      <div id="wrapper">

        <ul class="navbar-nav bg-nav sidebar sidebar-dark accordion" id="accordionSidebar">

          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard') ?>">

            <div class="sidebar-brand-icon">

             <img src="<?php echo base_url('assets/img/') ?>qualiopi.png" style="width:120px">

            </div>

            <div class="sidebar-brand-text mx-3"> ADMIN</div>

          </a>

          <!-- Divider -->

          <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les indicateurs de qualité Qualiopi" href="<?php echo base_url('admin/indicateur') ?>">

                <i class="fas fa-fw fa-map-signs"></i>

                <span>Indicateurs</span>

              </a>

            </li>

          <hr class="sidebar-divider my-0">

          <li class="nav-item">

            <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les formations et stages qui MAF propose" href="<?php echo base_url('admin/formation') ?>">

              <i class="fas fa-fw fa-cog"></i>

              <span>Derniers Stages</span></a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Rester à jour sur l'actualité du monde pédagogique" href="<?php echo base_url('admin/veille') ?>">

                <i class="fas fa-fw fa-rss"></i>

                <span>Veille</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les étudiants et stagiaires ayant suivi de formation chez MAF" href="<?php echo base_url('admin/apprenant') ?>">

                <!--<i class="fas fa-fw fa-user-circle"></i>-->

                <img class="img-profile" src="<?php echo base_url('/assets/img/apprenant.png') ?>">

                <span>Apprenants</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les formateurs qualifiés travaillant avec MAF" href="<?php echo base_url('admin/prof') ?>">

                <!--<i class="fas fa-fw fa-address-card"></i>-->

                 <img class="img-profile"

                    src="<?php echo base_url('/assets/img/prof.png') ?>">

                <span>Profs</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les cours et stages que MAF propose" href="<?php echo base_url('admin/cours') ?>">

                <i class="fas fa-fw fa-wrench"></i>

                <span>Cours</span>

              </a>

            </li>

              <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les cours et stages que MAF propose" href="<?php echo base_url('admin/formation') ?>">

                <i class="fas fa-fw fa-tasks"></i>

                <span>Formation</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les programmes de cours et stages que MAF propose" href="<?php echo base_url('admin/programme') ?>">

                <!--<i class="fas fa-fw fa-tasks"></i>-->

                <img class="img-profile" src="<?php echo base_url('/assets/img/prog.png') ?>">

                <span>Programmes</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les recrutements et processus associés chez MAF" href="<?php echo base_url('admin/recrutement') ?>">

                <!--<i class="fas fa-fw fa-file-signature"></i>-->

                <img class="img-profile" src="<?php echo base_url('/assets/img/rec.png') ?>">

                <span>Recrutements</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Procédures et différents protocoles observés chez MAF" href="<?php echo base_url('admin/procedure') ?>">

                <!--<i class="fas fa-fw fa-shoe-prints"></i>-->

                <img class="img-profile" src="<?php echo base_url('/assets/img/procedures.png') ?>">

                <span>Procedures</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Supports de cours pour formateur sur le site partenaire de MAF" href="<?php echo base_url('admin/support') ?>">

                <i class="fas fa-fw fa-file"></i>

                <span>Supports</span>

              </a>

            </li>

            <!--<hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Supports de cours pour formateur sur le site partenaire de MAF" href="<?php //echo base_url('admin/scenario_pedagogique') ?>">

                <i class="fas fa-fw fa-file"></i>

                <span>Scénario pédagogique</span>

              </a>

            </li>-->

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Organigramme et hiérarchie interne de MAF" href="<?php echo base_url('admin/organigramme') ?>">

                <!--<i class="fas fa-fw fa-sitemap"></i>-->

                <img class="img-profile" src="<?php echo base_url('/assets/img/orga.png') ?>">

                <span>Organigramme</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Les certifications accessibles avec MAF" href="<?php echo base_url('admin/certification') ?>">

                <i class="fas fa-fw fa-file-invoice"></i>

                <span>Certifications</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Tableau des réclamations reçu par MAF" href="<?php echo base_url('admin/reclamation') ?>">

                <i class="fas fa-fw fa-angry"></i>

                <!--<img class="img-profile" src="<?php echo base_url('/assets/img/recla.png') ?>">-->

                <span>Réclamations</span>

              </a>

            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" href="<?php echo base_url('admin/tuto') ?>">

                <i class="fas fa-fw fa-chalkboard-teacher"></i>

                <span>Tuto</span>

              </a>

            </li>

 <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" href="<?php echo base_url('admin/afficherview') ?>">

                <i class="fas fa-fw fa-user-circle"></i>

                <span>Administateur</span>

              </a>

            </li>
            <hr class="sidebar-divider">

<li class="nav-item">

  <a class="nav-link" href="<?php echo base_url('admin/audit') ?>">

    <i class="fas fa-fw fa-user-tie"></i>

    <span>Audit prof</span>

  </a>

</li>


<!--

            <hr class="sidebar-divider">

            <li class="nav-item">

              <a class="nav-link" href="<?php echo base_url('admin/contrat') ?>">

                <i class="fas fa-fw fa-file-signature"></i>

                <span>Contrat</span>

              </a>

            </li>-->

            

       

          </ul>

          <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->

                <!-- Sidebar Toggle (Topbar) -->

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none mr-3">

                        <i class="fa fa-bars"></i>

                    </button>

                <ul class="navbar-nav ml-auto">

                  <li class="nav-item dropdown no-arrow">

                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"

                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <span class="mr-2 d-none d-lg-inline text-gray-600">Administateur</span>

                    <img class="img-profile rounded-circle"

                    src="<?php echo base_url('/assets/img/undraw_profile.svg') ?>">

                  </a>

                  <!-- Formation Info -->

                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"

                  aria-labelledby="userDropdown">

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

                <a class="btn btn-danger" id="btnQuitter" href="<?php echo base_url('admin/logout_admin') ?>">Quitter</a>

              </div>

            </div>

          </div>

        </div>



        <!-- Begin Page Content -->

        <div class="container-fluid">

