<h1 class="h3 mb-2 text-gray-800">Prévention d'abandon</h1>
<div class="card shadow mb-4">
<style>
.badge{
    font-size: 18px;
    margin-top: 2px;
}
</style>
    <div class="card-body">    
        <?php $doc_abandon=base_url('/assets/files/doc_abandon.pdf') ?>
        <?php $doc_abandon1=base_url('/assets/files/doc_abandon1.pdf') ?>

        <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo $doc_abandon1; ?>&embedded=true"></iframe>

        <a href="<?php echo $doc_abandon ?>" class="badge badge-primary">Mesures pour favoriser l’engagement </a>
    </div>
</div>