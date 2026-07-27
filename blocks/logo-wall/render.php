<?php
$heading = $attributes['heading'] ?? '';
$logos   = $attributes['logos'] ?? [];

if ( empty( $logos ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8 text-center"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="flex flex-wrap items-center justify-center gap-8">
      <?php foreach ( $logos as $logo ) : ?>
        <?php if ( ! empty( $logo['image'] ) ) : ?>
          <img src="<?php echo esc_url( $logo['image']['url'] ); ?>" alt="<?php echo esc_attr( $logo['name'] ?? '' ); ?>" class="h-12 w-auto opacity-60 hover:opacity-100 transition-opacity duration-100" loading="lazy">
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
