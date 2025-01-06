<?php
require_once 'includes/header.php';
get_header();
?>

<div class="wrapper portfolio">
    <div class="portfolio-section">
        <h2>Работы мастера Алисы</h2>
        <div class="grid flex">
            <div class="portfolio-card flex-col">
                <video src="uploads\A1.MP4" controls="controls" class="portfolio-image" />
                <span>Окрашивание блонд</span>
            </div>
            <div class="portfolio-card flex-col">
                <video src="uploads\A2.MP4" controls="controls" class="portfolio-image" />
                <span>Окрашивание блонд</span>
            </div>
        </div>
    </div>
    <div class="portfolio-section">
        <h2>Работы Евгении</h2>
        <div class="grid flex">
            <div class="portfolio-card flex-col">
                <video src="uploads\E1.MP4" controls="controls" class="portfolio-image" />
                <span>Окрашивание блонд</span>
            </div>
        </div>
    </div>
    <div class="portfolio-section">
        <h2>Юмор</h2>
        <div class="grid flex">
            <div class="portfolio-card flex-col">
                <video src="uploads\H1.MP4" controls="controls" class="portfolio-image" />
                <span>Окрашивание блонд</span>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>