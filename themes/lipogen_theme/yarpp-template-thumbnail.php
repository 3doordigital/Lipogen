<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3><span>You may also like:</span></h3>
<div class="row">
<?php if (have_posts()):?>
	<?php while (have_posts()) : the_post(); ?>
    	<div class="col-md-8">
			<?php if (has_post_thumbnail()):?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('blog-small', array('class' => 'img-responsive')); ?></a>
            <h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
            <?php endif; ?>
        </div>
	<?php endwhile; ?>
<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
