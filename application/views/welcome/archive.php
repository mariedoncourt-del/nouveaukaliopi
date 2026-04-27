<h1 class="h3 mb-2 text-gray-800">Veilles</h1>
<div class="card shadow mb-4">
    <div class="card-body">

        <strong>Archives</strong>
        <br>
        
        <select id="archiveVeille" class="form-control">
            <option value="0">-Archives-</option>
            <option value="1">Actualités Pédagogiques</option>
            <option value="2">Actualités Juridiques</option>
            <option value="3">Actualités Marketing</option>
            <option value="4">Veille outils technologiques</option>
            <option value="6">Hygiènes et sécurité alimentaires</option>
            <option value="5">Actualités</option>
        </select>

        <br>

        <div>

            <?php 
             foreach ($veilles as $veille) {
                 echo '<li><a href="'.$veille['url'].'" target="_blank">'.$veille['title'].'</a></li>';
             }
            ?>
            
        </div>

        <br>
    </div>    
</div>