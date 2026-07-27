<?php
$heading      = $attributes['heading'] ?? '';
$testimonials = $attributes['testimonials'] ?? [];

if ( empty( $testimonials ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-stagger>
      <?php foreach ( $testimonials as $t ) : ?>
        <div class="card p-6">
          <blockquote class="text-lg font-bold italic mb-4">&ldquo;<?php echo esc_html( $t['quote'] ?? '' ); ?>&rdquo;</blockquote>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[var(--color-red)] border-4 border-[var(--color-fg)] rounded-full flex items-center justify-center">
              <span class="text-sm font-black text-[var(--color-white)]"><?php echo esc_html( mb_substr( $t['author'] ?? '', 0, 1 ) ); ?></span>
            </div>
            <div>
              <p class="text-sm font-black uppercase"><?php echo esc_html( $t['author'] ?? '' ); ?></p>
              <?php if ( ! empty( $t['role'] ) ) : ?>
                <p class="text-xs font-bold opacity-60"><?php echo esc_html( $t['role'] ); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
