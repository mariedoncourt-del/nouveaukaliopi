<h1 class="h3 mb-2 text-gray-800">Professeur qualifié</h1>

<div class="card shadow mb-4">

    <div class="card-body">



    	


         <iframe style="width:100%;height:900px" src="https://docs.google.com/viewerng/viewer?url=<?php echo urlencode(base_url('assets/cv/').$cv) ?>&embedded=true"></iframe>
            

         <br>

         <?php if($prof['maj']!=''): ?>

            <strong>Mise à jour (CV , Certificat, Formation...)</strong>

            <iframe style="width:100%;height:700px" src="https://docs.google.com/viewerng/viewer?url=<?php echo $maj ?>&embedded=true"></iframe>


         <?php endif; ?>



    </div>    

</div>