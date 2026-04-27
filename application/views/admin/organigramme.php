<h1 class="h3 mb-2 text-gray-800">Organigramme MAF</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button class="btn btn-success" data-toggle="modal" data-target="#ajoutOrga">Modifier</button>
    </div>
    <div class="card-body">

        <?php if($organigramme['link']!=''): ?>
            <img src="<?php echo base_url('assets/organigramme/').$organigramme['link']; ?>" width="100%" alt="">
        <?php endif; ?>
    </div>    
</div>
<div class="modal fade" id="ajoutOrga" tabindex="-1" role="dialog" aria-labelledby="apprenantModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="apprenantModalLabel">Mettre à jour Organigramme</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <?php echo form_open_multipart('admin/update_organigramme'); ?>
        <div class="modal-body">
            
                <div class="row">
                    Organigramme
                    <input type="hidden" name="id" value="1">
                    <input type="file" class="form-control" name="orga">
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