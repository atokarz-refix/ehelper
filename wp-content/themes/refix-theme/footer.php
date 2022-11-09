</div><!-- .site-content -->

<footer class="site-footer">
    <!-- stopa -->

    <?php 
    if ( is_active_sidebar( 'footer-1' ) ) : ?>

        <aside class="widget-area">
            <?php dynamic_sidebar( 'footer-1' ); ?>
        </aside><!-- .widget-area -->
    
    <?php endif; ?>

</footer>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>

</html>