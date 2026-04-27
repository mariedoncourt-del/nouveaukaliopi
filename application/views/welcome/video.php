<h1 class="h3 mb-2 text-gray-800">Cours vidéos</h1>
<div class="card shadow mb-4">
	<div class="card-body">
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Titre</th>
						<th>Lien</th>
						<th>Utilisateur</th>
						<th>Mot de passe</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($videos as $video): ?>
						<tr>
							<td><?php echo $video['cours'] ?></td>
							<td><a href="<?php echo $video['link'] ?>" class="btn btn-primary" target="_blank">Cours Moodle</a></td>
							<td><?php echo $video['pseudo'] ?></td>
							<td><?php echo $video['password'] ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>

	</div>

</div>
</div>
</div>
</div>