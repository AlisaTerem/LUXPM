<?php
require_once 'includes/header.php';
get_header();
?>

<div class="wrapper portfolio">
    <div class="flex-col">
        <h2>Работы мастера Алисы</h2>
        <div class="flex video-container">
            <div class="flex-col">
                <video src="uploads\A1.MP4" controls="controls" class="video"></video>
            </div>
            <div class="flex-col">
                <video src="uploads\A2.MP4" controls="controls" class="video"></video>
            </div>
        </div>
    </div>
    <div class="flex-col">
        <h2>Работы Евгении</h2>
        <div class="flex video-container">
            <div class="flex-col">
                <video src="uploads\E1.MP4" controls="controls" class="video"></video>
            </div>
        </div>
    </div>
    <div class="flex-col">
        <h2>Юмор</h2>
        <div class="flex video-container">
            <div class="flex-col">
                <video src="uploads\H1.MP4" controls="controls" class="video"></video>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>