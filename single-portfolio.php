<?php
/**
 * The template for displaying single portfolio items.
 *
 * @package Neobrutheme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="mb-10 border-8 border-black shadow-[12px_12px_0_0_var(--color-fg)] overflow-hidden">
    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto grayscale hover:grayscale-0 transition-all duration-200' ) ); ?>
  </div>
  <?php endif; ?>

  <header class="mb-8">
    <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-4">
      <?php the_title(); ?>
    </h1>

    <?php if ( function_exists( 'get_field' ) ) : ?>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
      <?php $client = get_field( 'client_name' ); ?>
      <?php if ( $client ) : ?>
      <div class="border-4 border-black bg-[var(--color-cyan)] p-4">
        <div class="text-xs font-black uppercase tracking-widest mb-1">Client</div>
        <div class="font-bold"><?php echo esc_html( $client ); ?></div>
      </div>
      <?php endif; ?>

      <?php $date = get_field( 'project_date' ); ?>
      <?php if ( $date ) : ?>
      <div class="border-4 border-black bg-[var(--color-yellow)] p-4">
        <div class="text-xs font-black uppercase tracking-widest mb-1">Date</div>
        <div class="font-bold"><?php echo esc_html( $date ); ?></div>
      </div>
      <?php endif; ?>

      <?php $url = get_field( 'project_url' ); ?>
      <?php if ( $url ) : ?>
      <div class="border-4 border-black bg-white p-4">
        <div class="text-xs font-black uppercase tracking-widest mb-1">URL</div>
        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener" class="font-bold underline underline-offset-3 hover:text-[var(--color-red)]">Visit Project &rarr;</a>
      </div>
      <?php endif; ?>

      <?php $tech = get_field( 'technologies' ); ?>
      <?php if ( $tech ) : ?>
      <div class="border-4 border-black bg-white p-4">
        <div class="text-xs font-black uppercase tracking-widest mb-1">Technologies</div>
        <div class="flex flex-wrap gap-1">
          <?php foreach ( $tech as $item ) : ?>
            <span class="text-xs font-bold bg-[var(--color-red)] text-white px-2 py-0.5 border border-black"><?php echo esc_html( $item['name'] ); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </header>

  <div class="rich-text text-lg mb-10">
    <?php the_content(); ?>
  </div>

  <div class="flex justify-between items-center border-t-4 border-black pt-6">
    <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>" class="btn bg-white shadow-[4px_4px_0_0_var(--color-fg)]">
      &larr; All Projects
    </a>
  </div>

</article>

<?php endwhile; ?>

<?php
get_footer();
