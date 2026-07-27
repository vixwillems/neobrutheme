<?php
$heading = $attributes['heading'] ?? '';
$tiers   = $attributes['tiers'] ?? [];

if ( empty( $tiers ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8 text-center"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="grid grid-cols-1 md:grid-cols-<?php echo count( $tiers ) > 2 ? '3' : '2'; ?> gap-6">
      <?php foreach ( $tiers as $tier ) : ?>
        <div class="card p-6 <?php echo ! empty( $tier['highlighted'] ) ? 'bg-[var(--color-yellow)]' : ''; ?>">
          <h3 class="text-xl font-black uppercase tracking-tight mb-2"><?php echo esc_html( $tier['name'] ?? '' ); ?></h3>
          <p class="text-3xl font-black mb-4"><?php echo esc_html( $tier['price'] ?? '' ); ?></p>
          <?php if ( ! empty( $tier['description'] ) ) : ?>
            <p class="text-sm font-bold opacity-70 mb-4"><?php echo esc_html( $tier['description'] ); ?></p>
          <?php endif; ?>
          <?php if ( ! empty( $tier['features'] ) ) : ?>
            <ul class="space-y-2 mb-6">
              <?php foreach ( $tier['features'] as $f ) : ?>
                <li class="text-sm font-bold flex items-center gap-2">
                  <span class="w-2 h-2 bg-[var(--color-red)]"></span>
                  <?php echo esc_html( $f['feature'] ?? '' ); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
