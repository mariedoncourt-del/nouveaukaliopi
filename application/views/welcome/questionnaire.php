<h1 class="h3 mb-2 text-gray-800">Questionnaire</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-success" data-toggle="modal" data-target="#ajoutQuestion">Ajouter</button>
    </div>
    <div class="card-body">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Attente</th>
                        <th>Service</th>
                        <th>Role</th>
                        <th>Expériences</th>
                        <th>Activité</th>
                        <th>Avant</th>
                        <th>Atouts</th>
                        <th>Améliorations</th>
                        <th>Objectifs</th>
                        <th>Resultats</th>
                        <th>Initiative</th>
                        <th>Remarques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($questions as $question): ?>
                        <tr>
                            <td><?php echo $question['attente_01'] ?></td>
                            <td><?php echo $question['service'] ?></td>
                            <td><?php echo $question['poste'] ?></td>
                            <td><?php echo $question['exp'] ?></td>
                            <td><?php echo $question['activite'] ?></td>
                            <td><?php echo $question['experience'] ?></td>
                            <td><?php echo $question['atout'] ?></td>
                            <td><?php echo $question['amelioration'] ?></td>
                            <td><?php echo $question['objectif'] ?></td>
                            <td><?php echo $question['attente_02'] ?></td>
                            <td><?php echo $question['qui'] ?></td>
                            <td><?php echo $question['remarques'] ?></td>
                            <td>
                                <button class="btn bnt-xs btn-info btnEditQuestion" data-id="<?php echo $question['id'] ?>" data-attente_01="<?php echo $question['attente_01'] ?>" data-service="<?php echo $question['service'] ?>" data-poste="<?php echo $question['poste'] ?>" data-exp="<?php echo $question['exp'] ?>" data-activite="<?php echo $question['activite'] ?>" data-experience="<?php echo $question['experience'] ?>" data-atout="<?php echo $question['atout'] ?>" data-amelioration="<?php echo $question['amelioration'] ?>" data-objectif="<?php echo $question['objectif'] ?>" data-attente_02="<?php echo $question['attente_02'] ?>" data-qui="<?php echo $question['qui'] ?>" data-remarques="<?php echo $question['remarques'] ?>">Editer</button>|<a class="btn bnt-xs btn-danger" href="<?php echo base_url('/welcome/delete_question/').$question['id'] ?>">Supprimer</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <!--<a class="btn btn-primary" href="https://docs.google.com/forms/d/e/1FAIpQLSfgRm_dwI968AQ0Sw_dOi4W9V1cL7loDgNZQkxVQOGTj5VAKw/viewform?usp=pp_url&entry.1487038492=<?php echo $formation['id'] ?>" target="_blank">Repondre à quelques questions</a>-->

   <div class="modal fade" id="ajoutQuestion" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profModalLabel">Ajout questionnaire</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo form_open_multipart('welcome/create_question'); ?>

            <div class="modal-body">

                <div class="row">
                    
                        <textarea name="attente_01" rows="4" cols="" class="form-control" placeholder="Quel est votre attente ?"></textarea>
                    
                        <textarea name="service" rows="4" cols="" class="form-control" placeholder="Quel est votre services ?"></textarea>
            
                        <textarea name="poste" rows="4" cols="" class="form-control" placeholder="Votre responsabilité ?"></textarea>
                    
                        <textarea name="exp" rows="4" cols="" class="form-control" placeholder="Expérience"></textarea>
                    
                        <textarea name="activite" rows="4"  class="form-control" placeholder="Votre Role"></textarea>

                        <textarea name="experience" rows="4"  class="form-control" placeholder="Votre expérience ou activité qui cadre avec votre ativités actuels"></textarea>

                        <textarea name="atout" rows="4"  class="form-control" placeholder="Vos atout pour méner à bien vos activités"></textarea>

                        <textarea name="amelioration" rows="4"  class="form-control" placeholder="Les amélioration à faire"></textarea>

                        <textarea name="objectif" rows="4"  class="form-control" placeholder="Votre objectif à court terme"></textarea>

                        <textarea name="attente_02" rows="4"  class="form-control" placeholder="Quel est votre attente en terme de resultats"></textarea>

                        <textarea name="qui" rows="4"  class="form-control" placeholder="Qui a eu l'initiative de suivre le stage"></textarea>

                        <textarea name="remarques" rows="4"  class="form-control" placeholder="Votre remarques"></textarea>                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <button class="btn btn-success" type="submit">Ajouter</button>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="editQuestion" tabindex="-1" role="dialog" aria-labelledby="besoinModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profModalLabel">Modifier besoin</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo form_open_multipart('welcome/update_question'); ?>

            <div class="modal-body">

                <div class="row">
                        <input type="hidden" id="idQuest" name="id">
                        <textarea name="attente_01" id="attente_01" rows="4" cols="" class="form-control" placeholder="Quel est votre attente ?"></textarea>
                    
                        <textarea name="service" id="service" rows="4" cols="" class="form-control" placeholder="Quel est votre services ?"></textarea>
            
                        <textarea name="poste" id="poste" rows="4" cols="" class="form-control" placeholder="Votre responsabilité ?"></textarea>
                    
                        <textarea name="exp" id="exp" rows="4" cols="" class="form-control" placeholder="Expérience"></textarea>
                    
                        <textarea name="activite" id="activiteQ" rows="4"  class="form-control" placeholder="Votre Role"></textarea>

                        <textarea name="experience" id="experience" rows="4"  class="form-control" placeholder="Votre expérience ou activité qui cadre avec votre ativités actuels"></textarea>

                        <textarea name="atout" id="atout" rows="4"  class="form-control" placeholder="Vos atout pour méner à bien vos activités"></textarea>

                        <textarea name="amelioration" id="amelioration" rows="4"  class="form-control" placeholder="Les amélioration à faire"></textarea>

                        <textarea name="objectif" id="objectif" rows="4"  class="form-control" placeholder="Votre objectif à court terme"></textarea>

                        <textarea name="attente_02" rows="4" id="attente_02" class="form-control" placeholder="Quel est votre attente en terme de resultats"></textarea>

                        <textarea name="qui"  id="qui" rows="4"  class="form-control" placeholder="Qui a eu l'initiative de suivre le stage"></textarea>

                        <textarea name="remarques" id="remarques" rows="4"  class="form-control" placeholder="Votre remarques"></textarea>                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <button class="btn btn-success" type="submit">Modifier</button>
            </div>
        </form>
    </div>
</div>
</div>