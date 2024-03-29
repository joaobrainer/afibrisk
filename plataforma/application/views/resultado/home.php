<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body id="background3">

    <div class="row title">
        <div class="col-md-12">
            <span>Results</span>
        </div>
        <div class="retangular-shape"></div>
    </div>

	<div class="container container-resultado">

        <div class="subcontainer-resultado">

            <?php 
                $resultado = $this->session->userdata('resultados'); 

                if($resultado != null){
                    foreach ($resultado as $key => $value) {
                        echo '<div class="row">';
                        echo '<div class="col-md-12">';
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">'.$key.'</h5>';
                        echo '<p class="card-text">'.$value.'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            
            ?>
        </div>

		

	</div>
</body>
<footer>
	<?php $this->load->view('footer'); ?>
</footer>
</html>