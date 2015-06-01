<?php
    global $lipo_options;
?>
<div class="container jumbotron-container">
    <div class="row">
        <div class="jumbotron">
            <h1>
                <?php echo str_replace(strtoupper($lipo_options['home_jumbotron_name']), '<span>' . strtoupper($lipo_options['home_jumbotron_name']) . '</span>', strtoupper($lipo_options['home_jumbotron_header'])); ?>
                <a href="<?php bloginfo('url'); echo $lipo_options['home_jumbotron_link']; ?>" class="btn btn-primary">
                    <?php echo $lipo_options['home_jumbotron_text']; ?>
                </a>
            </h1>
        </div>
    </div>
</div>