<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('header'); ?>
</head>
<body>
    <header class="topbar">
        <a href="<?php echo base_url(); ?>" class="brand">AFibRisk</a>
        <nav>
            <a href="<?php echo base_url('about'); ?>">About</a>
        </nav>
    </header>

    <main class="home-hero">
        <div class="hero-copy">
            <div class="eyebrow">Clinical Risk Assessment</div>
            <h1>AFibRisk</h1>
            <p class="lead">A research tool that aggregates 17 clinical scores for Atrial Fibrillation risk prediction from published literature.</p>
            <div class="actions">
                <a href="<?php echo base_url('questions'); ?>" class="btn btn-primary">Start assessment</a>
                <a href="<?php echo base_url('about'); ?>" class="btn btn-secondary">About</a>
            </div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <img src="<?php echo base_url('assets/images/bg-1.jpg'); ?>" alt="">
        </div>
    </main>

    <?php $this->load->view('footer'); ?>
</body>
</html>
