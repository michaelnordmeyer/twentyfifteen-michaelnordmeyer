<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		<?php if ( ! is_user_logged_in() && ! current_user_can( 'administrator' ) && ! current_user_can( 'editor' ) && ! current_user_can( 'author' ) && ! current_user_can( 'contributor' ) ) { ?>
			&copy; 2008&ndash;<?php echo date('Y'); ?> <a href="/about" onclick="javascript:_paq.push(['trackEvent', 'Navigation', 'Footer', 'About']);">Michael Nordmeyer</a>
		<?php } else { ?>
			&copy; 2008&ndash;<?php echo date('Y'); ?> <a href="/about">Michael Nordmeyer</a>
		<?php } ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>