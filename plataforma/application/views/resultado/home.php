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
                        if ($value['resposta'] != 'none') {
                            echo '<div class="card-container">';
                            echo '<div class="card">';
                            echo '<div class="card-header">';
                            echo '<h5 class="card-title">'.$key.'</h5>';
                            echo '<span class="card-title">'.$value['message'].'</span>'; 
                            echo '</div>';
                            echo '<div class="card-body">';    
                            if ($key == 'Hamada') {
                                echo '<img src="'.base_url("assets/images/hamada/".$value['resposta'].".png").'" class="img-size" alt="Hamada">';                             
                            } else{
                                echo '<p class="card-text">'.$value['resposta'].'</p>'; 
                            }        
                           
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
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