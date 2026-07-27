<?php
$heading  = $attributes['heading'] ?? '';
$bg_color = $attributes['bgColor'] ?? 'yellow';
$color_class = 'bg-[var(--color-' . $bg_color . ')]';
?>
<section class="<?php echo esc_attr( $color_class ); ?> border-b-8 border-[var(--color-fg)] px-6 md:px-12 py-12">
  <div class="max-w-2xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <form class="space-y-4" action="#" method="post">
      <div>
        <label class="block text-xs font-black uppercase tracking-wider mb-1">Name</label>
        <input type="text" name="name" required placeholder="Your name">
      </div>
      <div>
        <label class="block text-xs font-black uppercase tracking-wider mb-1">Email</label>
        <input type="email" name="email" required placeholder="you@example.com">
      </div>
      <div>
        <label class="block text-xs font-black uppercase tracking-wider mb-1">Message</label>
        <textarea name="message" rows="4" required placeholder="Your message..."></textarea>
      </div>
      <button type="submit" class="btn bg-[var(--color-red)] text-[var(--color-white)] brutalist-shadow-sm">
        Send Message
      </button>
    </form>
  </div>
</section>
