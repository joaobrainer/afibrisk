<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body id="background1">
	<div class="container-fluid">

		<div class="d-flex flex-row-reverse bd-highlight mt-4 me-4">		
			<a href="<?php print_r(base_url('sobre')) ?>" class="btn">ABOUT</a>
		</div>		

		<div class="btnentrar centralizar-botao">			
			<br>
			<a href="<?php print_r(base_url('questions')) ?>" class="btn btneng">START </a>
			<div class="oval-shape"></div>
		</div>	

	</div>
</body>
<footer>
	<?php $this->load->view('footer'); ?>
</footer>
</html>