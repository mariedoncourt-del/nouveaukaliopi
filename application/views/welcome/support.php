<h1 class="h3 mb-2 text-gray-800">Supports</h1>
<div class="card shadow mb-4">
<style>

	.parent{
		margin-left: 25px;
	}

	.sup-category{
		border: 3px solid black;
		margin: 10px;
		writing-mode: vertical-lr;
		text-orientation: upright;
		text-align: center;
		vertical-align: middle;
		padding: 15px;
		font-size: 18px;
		font-weight: bolder;
		text-transform: uppercase;
		color: black;
	}

	.sup-formation{
		margin: 10px;
		padding: 15px;
		border: 3px solid black;
	}

	.sup-formation a{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: none;
	}
	.sup-formation a:hover{
		font-weight: bolder;
		text-transform: uppercase;
		color: darkorange;
		text-decoration: underline;
	}

	.sup-formation a::before {
  		content: "■ ";
	}
</style>
<div class="card-body parent">
	<strong>Vos supports de cours</strong>
		<br>
		<br>
	<div class="row">
		<div class="col-md-10 sup-formation">
			<div class="row">
			<?php foreach($supports as $support) :?>
				
				<div class="col-md-3">
					<a href="<?php echo base_url('/assets/support/').$support['link']; ?>"><?php echo $support['nom']; ?></a>
				</div>
				
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>    
</div>