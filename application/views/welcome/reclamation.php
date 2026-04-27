<h1 class="h3 mb-2 text-gray-800">Difficultés - Aléas</h1>
<div class="card shadow mb-4">
    <div class="card-body">

    	<strong>Vous rencontrez des difficultés particulières , merci de nous en faire part via le formulaire ci dessous</strong>

     <div class="row">
        <div class="col-lg-6">
            <?php echo $this->session->flashdata('msg'); ?>
            <form action="<?php echo base_url('welcome/reclamation'); ?>" method="post">
                <div class="form-group">
                    <br>
                    <p>Votre difficulté est liée à ...</p>
                </div>
                <div class="form-group">
                    <select class="form-control" name="reclamation">
                        <option value="Le profil de l'apprenant (disponibilité, qualification)">Le profil de l'apprenant ( disponibilité, qualification)</option>
                        <option value="Le profil de l'apprenant (disponibilité, pré-requis, motivation)">Le profil de l'apprenant ( disponibilité, pré requis, motivation)</option>
                        <option value="La durée de la formation">La durée de la formation</option>
                        <option value="La pérennité et l'actualisation de votre contenu pédagogique">La pérennité et l'actualisation de votre contenu pédagogique</option>
                         <option value="Votre profil de formateur (qualification, disponibilité)">Votre profil de formateur ( qualification, disponibilité)</option>
                         <option value="Autre">Autres</option>
                    </select>
                </div>
                
                <div class="form-group">
                    
                    <input name="email" placeholder="Votre email" type="text" value="<?php echo set_value('email'); ?>" class="form-control" />
                    <?php echo form_error('email', '<span class="text-danger">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input name="objet" placeholder="Objet" type="text" value="<?php echo set_value('objet'); ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <textarea name="message" rows="4" class="form-control" placeholder="Votre message"><?php echo set_value('message'); ?></textarea>
                    <?php echo form_error('message', '<span class="text-danger">','</span>'); ?>
                </div>
                <button name="submit" type="submit" class="btn btn-primary" />Envoyer</button>
            </form>
        </div>
    </div>

</div>    
</div>