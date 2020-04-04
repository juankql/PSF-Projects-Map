<?php get_header(); ?>

<div class="slz-main-content">
    <!-- slider -->
    <div class="container">

        <?php
        $hearty_container = hearty_get_container_class( );
        ?>

        <div class="">
            <div class="row">
                <div id="page-content" class="">
                    <?php
                    while ( have_posts() ) : the_post();
                        ?>

                        <div class="page-detail-wrapper">



                            <div class="entry-content">
                                <?php
                                the_content( '<a href="%s" class="read-more">%s<i class="fa fa-angle-right"></i></a>',
                                    esc_url( get_permalink() ),
                                    esc_html__( 'Read more', 'hearty' ) );
                                ?>
                            </div>

                            <footer class="entry-footer">
                                <?php edit_post_link( esc_html__( 'Edit', 'hearty' ), '<span class="edit-link">', '</span>' ); ?>
                            </footer>
                        </div>

                    <?php endwhile; ?>

                </div>

                <div class="clearfix"></div>

            </div>

        </div>


    </div>

</div>

<?php get_footer(); ?>
