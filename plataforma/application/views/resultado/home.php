<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
</head>
<body id="background3">

    <div class="row title results">
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
                            if ($value['message']) {
                                $id = str_replace(' ', '', $key);
                                echo '<i class="fas fa-info-circle" id="'.$id.'"></i>'; 
                            }
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

            <div class="d-flex justify-content-end mt-5 div-btn-calculate">
                <button type="button" name="submit" class="btn btn-primary btn-calculate" data-translate="repeat">Repeat</button>
            </div>    

        </div>

		

	</div>
</body>
<footer>
	<?php $this->load->view('footer'); ?>
</footer>

<script>
    $(document).ready(function(){
        $('.btn-calculate').click(function(){
            window.location.href = "<?php echo base_url('home'); ?>";
        });
    });

    tippy('#STAF', {
        content: 'A total score of ≥5 enabled the identification of patients with AF in 3 months with a sensitivity of 89% (95% CI, 83 to 94) and a specificity of 88% (95% CI, 84 to 91)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#ASAS', {
        content: 'The AUC for the predicted probabilities of the ASAS was 0.78 [95%CI 0.70-0.86], excluding patients with a previous diagnosis of atrial fibrillation.',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#CHA2DS2-VASC', {
        content: 'Predicting a new-onset atrial fibrillation in 2-years follow-up (AUC 0.744 (95% CI, 0.741-0.747)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HAVOC', {
        content: 'Chance (%) of Afib in 3 years (AUC 0.77)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#CHARGE-AF', {
        content: 'Chance (%) of Afib in 5 year',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HARMS2-AF', {
        content: 'Hazard ratio (HR) for Afib detection in up to 10 years. Performance with a 5-year AUC 0.757 (95% CI 0.735–0.779) and 10-year AUC 0.753 (95% CI 0.732–0.775)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#Hamada', {
        content: 'A 7-year risk of atrial fibrillation (AUC 0.78)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#MayoScore', {
        content: 'Predicting incidente AFib in about 8-years follow-up (AUC 0.812 (95% CI, 0.805-0.820))',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#HATCH', {
        content: 'Chance of AFib detection in about 10 years (AUC 0.716 (95% CI 0.710–0.723). Results from an external validation in a Taiwanese cohort.',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#MHSScore', {
        content: 'A 10-years predicted risk of AFib (AUC 0.749 (0.740–0.758)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#ARICScore', {
        content: 'Chance (%) of Afib in 10 years (The point-based score developed from coefficients in the Cox model had an AUC of 0.76.)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#Suita', {
        content: 'Predicted 10-Year Risk of Incident AF (AUC 0.749; 95% CI 0.724−0.774)',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

    tippy('#TaiwanAFScore', {
        content: 'Cumulative Incidence of AFib in a 1 to 16-years follow-up. AUC ranged from 0.857 (0.855–0.860) to 0.756 (0.755–0.757) in follow-up of 1 or 16 years, respectively',
        theme: 'customTooltipCssTema', 
        arrow: false,
        placement: 'auto',
    });

</script>
</html>