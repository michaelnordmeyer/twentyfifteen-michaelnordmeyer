<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 *
 * Template Name: Archives
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
          <table class="zh-archives">
          <?php
            $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) as `month`, DAYOFMONTH(post_date) as `dayofmonth`, ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC";
            $key = md5( $query );
            $cache = wp_cache_get( 'zh_archives', 'general' );

            if ( isset( $cache[$key] ) ) {
              $results = $cache[$key];
            } else {
              $results = $wpdb->get_results( $query );
              $cache[$key] = $results;
              wp_cache_add( 'zh_archives', $cache, 'general' );
            }

            if ( $results ) {
              $last_year = 0;
              $last_month = 0;

              foreach( $results as $result ) {
                if ( $result->year != $last_year ) {
                  if ( $last_year != 0 ) {
          ?>
            <tr><th>&nbsp;</th><td>&nbsp;</td>
          <?php
                  }
                  $last_year = $result->year;
                  $last_month = 0;
          ?>
            <tr><th class="year"><?php echo $result->year; ?></th><th>&nbsp;</th></tr>
          <?php
                }

                if ( $result->month != $last_month ) {
                  $last_month = $result->month;
          ?>
            <tr><th class="month"><?php echo $wp_locale->get_month( $result->month ); ?></th><td>&nbsp;</td></tr>
          <?php
                }
          ?>
            <tr>
              <th><?php echo $result->dayofmonth; ?></th>
              <td>
            <?php if ( ! is_user_logged_in() && ! current_user_can( 'administrator' ) && ! current_user_can( 'editor' ) && ! current_user_can( 'author' ) && ! current_user_can( 'contributor' ) ) { ?>
                <a href="<?php echo get_permalink( $result->ID ); ?>" onclick="javascript:_paq.push(['trackEvent', 'Navigation', 'Archives', 'Archives']);"><?php echo wp_strip_all_tags( apply_filters( 'the_title', $result->post_title ) ); ?></a>
            <?php } else { ?>
                <a href="<?php echo get_permalink( $result->ID ); ?>"><?php echo wp_strip_all_tags( apply_filters( 'the_title', $result->post_title ) ); ?></a>
            <?php } ?>
                <br>
            <?php echo $result->post_excerpt; ?>
                <br>
                <small style="color: #686868;"><?php echo "Reading time " . mn_reading_time( $result->ID ); ?></small>
              </td>
            </tr>
          <?php
              }
            }
          ?>
          </table>
        </div><!-- .entry-content -->

        <?php edit_post_link( __( 'Edit', 'twentysixteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>
      </article>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
