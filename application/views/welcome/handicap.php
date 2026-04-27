<h1 class="h3 mb-2 text-gray-800">Handicap</h1>
<div class="card shadow mb-4">
    <div class="card-body">

        <strong style="line-height: 2.4;">Voici comment faciliter l'organisation de vos sessions en apportant des illustrations et des exemples de mise en œuvre d'aménagement répondant aux besoins de personnes en situation de handicap ou présentant un trouble de santé invalidant.<br>Vous y trouverez des réponses techniques pertinentes pour les personnes concernées.</strong>
        <br>
        

        <select id="fiche" class="form-control">
            <option value="0">- Fiche -</option>
            <?php foreach($documents as $document): ?>
                <?php if($document['category']=='document'): ?>
                <?php if($document['link']!=''): ?>
                    <option value="<?php echo base_url('/assets/handicap/').$document['link'] ?>"><?php echo $document['nom'] ?></option>
                    <?php else: ?>
                <?php endif; ?>
            <?php endif ?>
            <?php endforeach; ?>
        </select>

        <br>
        <strong>Tuto videos</strong>

        <select id="video" class="form-control">
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

        <div id="ficheDisplay">
            <p></p>
        </div>

        <strong>Referent Handicap</strong>
        <div id="first">
           <?php foreach($documents as $document): ?>
                <?php if($document['category']=='couverture'): ?>
                    <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo base_url('/assets/handicap/').$document['link'] ?>&embedded=true"></iframe>
                    <?php break; ?>
                <?php endif; ?>
                <?php endforeach ?>
        </div>

        <br>
    </div>    
</div>