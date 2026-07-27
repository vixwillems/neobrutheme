<?php
$heading = neo_sub( 'heading' );
$url     = neo_sub( 'url' );
$aspect  = neo_sub( 'aspect_ratio', '16/9' );

if ( ! $url ) return;

// Convert YouTube/Vimeo URLs to embed.
$embed_url = $url;
if ( strpos( $url, 'youtube.com/watch' ) !== false ) {
  parse_str( parse_url( $url, PHP_URL_QUERY ), $params );
  $embed_url = 'https://www.youtube.com/embed/' . ( $params['v'] ?? '' );
} elseif ( strpos( $url, 'youtu.be/' ) !== false ) {
  $embed_url = 'https://www.youtube.com/embed/' . basename( $url );
} elseif ( strpos( $url, 'vimeo.com/' ) !== false ) {
  $embed_url = 'https://player.vimeo.com/video/' . basename( $url );
}

$aspect_class = 'aspect-video';
if ( $aspect === '4/3' ) $aspect_class = 'aspect-[4/3]';
if ( $aspect === '1/1' ) $aspect_class = 'aspect-square';
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-4xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="border-4 border-[var(--color-fg)] brutalist-shadow overflow-hidden <?php echo esc_attr( $aspect_class ); ?>">
      <iframe src="<?php echo esc_url( $embed_url ); ?>" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
    </div>
  </div>
</section>
