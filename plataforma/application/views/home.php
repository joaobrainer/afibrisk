<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body>

	<div class="home">
		<div class="container">

			<div class="row">
				<div class="col-md-12 btnmenu">
					<a href="<?php print_r(base_url('sobre')) ?>"><img src="assets/images/menu.png"></a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 divlogo">
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 btnentrar">
					<a href="<?php print_r(base_url('questions')) ?>" class="btn btnpt" style="margin-bottom: 1rem;">Iniciar <i class="fas fa-angle-right"></i></a>
					<br>
					<a href="<?php print_r(base_url('questions')) ?>" class="btn btneng">Start <i class="fas fa-angle-right"></i></a>
				</div>
			</div>

		</div>
	</div>

</body>
<footer>
	<?php $this->load->view('footer'); ?>
</footer>
</html>