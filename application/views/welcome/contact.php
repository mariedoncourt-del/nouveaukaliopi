<h1 class="h3 mb-2 text-gray-800">Contact</h1>
<div class="card shadow mb-4">
	<div class="card-body">
		
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Organisme / Agence</th>
						<th>Dans le 31</th>
						<th>Dans le 81</th>
						<th>Dans le 82</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($contacts as $contact): ?>
						<tr>
							<td><?php echo $contact['titre'] ?></td>
							<td><?php echo $contact['dept31'] ?></td>
							<td><?php echo $contact['dept81'] ?></td>
							<td><?php echo $contact['dept82'] ?></td>
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