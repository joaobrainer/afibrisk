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
        <svg class="sparkle s1" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 0l2.2 8.2L22 10l-7.8 2.2L12 24l-2.2-11.8L2 10l7.8-1.8z"/></svg>
        <svg class="sparkle s2" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 0l2.2 8.2L22 10l-7.8 2.2L12 24l-2.2-11.8L2 10l7.8-1.8z"/></svg>
        <svg class="sparkle s3" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 0l2.2 8.2L22 10l-7.8 2.2L12 24l-2.2-11.8L2 10l7.8-1.8z"/></svg>
        <svg class="sparkle s4" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M12 0l2.2 8.2L22 10l-7.8 2.2L12 24l-2.2-11.8L2 10l7.8-1.8z"/></svg>

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
