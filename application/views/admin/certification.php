<h1 class="h3 mb-2 text-gray-800">Certifications</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <a class="btn btn-primary" href="<?php echo base_url().'admin/certification' ?>">Certifications</a> 
    <a class="btn btn-primary" href="<?php echo base_url().'admin/gestion_certificat' ?>">Gestion des certificats</a>
    <br>
</div>
    <div class="card-body">
        <select id="cert" class="form-control">
            <option value="">- Certificats -</option>
            <?php foreach($certificats as $certificat) :?>
            
            <option value="<?php echo base_url('/assets/certificat/').$certificat['link']; ?>"><?php echo $certificat['nom']; ?></option>
            
            <?php endforeach; ?>
        </select> 
        <br>
        <div id="certDisplay">
            <p></p>
        </div>

        <div id="first" style="color: black;">
            <center><h2>Communication sur le taux d’obtention des certifications</h2></center>
            <p>Pour l’année 2022, les taux d’obtention et les indicateurs liés à la trajectoire professionnelle des apprenant·e·s sont les suivants :</p>


<p>Taux d’obtention des certifications ou titres professionnels :</p>

Sur 2 stagiaires ayant suivi une certification, la répartition de la performance aux épreuves certificatives est la suivante :
<ul>

<li>Obtention de la certification : 100 %</li>

<li>Non-obtention de la certification : 0 %</li>
</ul>


<p>Ces certifications peuvent être obtenues également par l’obtention des blocs de compétences qui les composent et qui se retrouvent sur la fiche RNCP de la certification :
</p>
<p>Intitulé de la certification RNCP n° RS2289 , composée des blocs de compétences suivants :</p>
<ul>
<li>Présenter son entreprise / organisation / école / précédent employeur / etc.</li>

<li>Présenter son propre rôle au sein de cette structure</li>

<li>Répondre à des questions portant sur ces deux sujets.</li>
</ul>

</p>
        </div>

    </div>    
</div>