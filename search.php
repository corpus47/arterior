<?php
 
get_header();

?>
<div class="single-page-post">
<div class="search-ret-container">    
<?php
 
if ( have_posts() ) :
	?>
    <h2><?php echo __('A keresés eredménye erre:',"arterior");?> "<?php the_search_query(); ?>"</h2>
	<?php
	while ( have_posts() ) : the_post(); ?>
 
        <article class="post">
			<?php if ( has_post_thumbnail() ) { ?>
                <div class="small-thumbnail">
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'small-thumbnail' ); ?></a>
                </div>
			<?php } ?>
            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
            <p class="post-meta"><?php the_time( 'Y.m.d' ); ?> | <a
                        href="<?php //echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php //the_author(); ?></a>
                | <?php
				$categories = get_the_category();
				$comma      = ', ';
				$output     = '';
				
				if ( $categories ) {
					foreach ( $categories as $category ) {
						$output .= '<a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>' . $comma;
					}
					echo trim( $output, $comma );
				} ?>
            </p>
            <p>
                <?php echo get_the_excerpt() ?>
                <br />
                <a href="<?php the_permalink() ?>"><?php echo __('Tovább',"arterior");?> &raquo</a>
            </p>
        </article>
	
    <?php endwhile;
    
    echo paginate_links();
 
else :
	echo '<p>'.__('Nincs a keresésnek megfelelő tartalom!',"arterior").'</p>';
 
endif;

?>
</div><!-- end search-ret-container -->
</div><!-- end single-page-post -->
<?php
 
get_footer();
 
?>