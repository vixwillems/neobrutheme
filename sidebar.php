<?php
/**
 * The sidebar template.
 *
 * @package Neobrutheme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;
}
?>

<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'neobrutheme' ); ?>">
  <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
