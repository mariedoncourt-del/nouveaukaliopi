<h1 class="h3 mb-2 text-gray-800">Espace documentaire</h1>
<div class="card shadow mb-4">
<style>
    .badge{
    font-size: 18px;
    margin-top: 2px;
}
</style>
    <div class="card-body">

        <select id="doc" class="form-control">
            <option value="">- Espace Documents -</option>
            <?php foreach($documents as $document): ?>
                <?php if($document['category']=='document'): ?>
                <?php if($document['link']!=''): ?>
                    <option value="<?php echo base_url('/assets/documents/').$document['link'] ?>"><?php echo $document['nom'] ?></option>
                    <?php else: ?>
                <?php endif; ?>
            <?php endif ?>
            <?php endforeach; ?>
        </select>

        <br>
        <strong>Tuto videos</strong>

        <select id="docVideo" class="form-control">
            <option value="">- Videos -</option>
            <?php foreach($documents as $document): ?>
                <?php if($document['category']=='video'): ?>
                <?php if($document['lien']!=''): ?>
                    <option value="<?php echo $document['lien'] ?>"><?php echo $document['nom'] ?></option>
                <?php endif; ?>
            <?php endif ?>
            <?php endforeach; ?>
        </select>

        <br>

        <div id="docDisplay">
            <p></p>
        </div>

        <div id="first">
            <?php foreach($documents as $document): ?>
                <?php if($document['category']=='couverture'): ?>
                    <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo base_url('/assets/documents/').$document['link'] ?>&embedded=true"></iframe>
                    <?php break; ?>
                <?php endif; ?>
                <?php endforeach ?>
        </div>

    </div>    
</div>