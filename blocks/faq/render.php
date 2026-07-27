<?php
$heading = $attributes['heading'] ?? '';
$items   = $attributes['items'] ?? [];

if ( empty( $items ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-4xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="space-y-0">
      <?php foreach ( $items as $item ) : ?>
        <details class="group border-4 border-[var(--color-fg)] border-b-0 last:border-b-4">
          <summary class="flex items-center justify-between px-6 py-4 cursor-pointer font-black uppercase text-sm tracking-wider hover:bg-[var(--color-yellow)] transition-colors duration-100">
            <?php echo esc_html( $item['question'] ?? '' ); ?>
            <span class="text-xl group-open:rotate-45 transition-transform duration-100">+</span>
          </summary>
          <div class="px-6 py-4 border-t-4 border-[var(--color-fg)] bg-[var(--color-bg)]">
            <p class="text-sm font-bold opacity-80 leading-relaxed"><?php echo esc_html( $item['answer'] ?? '' ); ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
