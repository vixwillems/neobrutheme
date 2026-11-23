# neobrutheme — AGENTS.md

## Stack
- **Framework**: Neve v4.2.10 (forked source, committed in-place at the theme root). Full Neve functionality preserved: Customizer, HFG header/footer builder, blog layouts, WooCommerce, EDD, mega menu, block patterns, starter content.
- **Design system**: Custom neo-brutalist skin in `assets/css/brutheme.css`, loaded AFTER all Neve styles.
- Space Grotesk self-hosted (.woff2 in `assets/fonts/`) — never loaded from Google CDN.
- Neve's JS/CSS are prebuilt and committed (no composer/yarn build needed for normal use).

## Build
```bash
# Brutheme skin is plain CSS — no build step for the skin.
# Neve's own toolchain (composer + yarn) only if you modify Neve's source assets:
composer install --no-dev && yarn install --frozen-lockfile && yarn run build
```
Do NOT run that unless you change Neve's React/JS/CSS sources — it is slow and will overwrite committed prebuilt files.

## Key architecture decisions
- **Everything is Neve first, brutalist second.** Do not gut Neve's PHP. Add brutalist behavior via the skin layer or default-value overrides.
- **The skin** lives in `brutheme.php` + `assets/css/brutheme.css`. `brutheme.php` enqueues the CSS after Neve's main/Woo/EDD styles, self-hosts Space Grotesk, and removes it from the Google Fonts list.
- **brutheme.php also suppresses Neve's page-title header on static pages** (`brutheme_hide_page_title` on `neve_before_page_header`): the brutheme page templates own their H1 in content, so Neve's default title header would duplicate it. Archives/single posts keep their native title header.
- **Default values were edited** in these Neve files so fresh installs look brutalist while every Customizer control stays functional:
  - `globals/utilities.php` → `neve_get_global_colors_default()` (brutalist palette)
  - `globals/migrations.php` → `neve_get_button_appearance_default()` (4px border, 0 radius, hard shadow)
  - `inc/core/settings/mods.php` → `get_alternative_mod_default()` (Space Grotesk, 900/uppercase headings)
  - `inc/customizer/defaults/layout.php` → `get_v4_defaults()` (border radius 0, card style on)
- **CSS custom properties**: Neve outputs `--nv-*` vars on `:root` from the Customizer. The skin references `var(--nv-primary-accent)`, `var(--nv-text-color)`, etc. — never hardcode hex in the skin.
- **Header/footer** come from the HFG builder (`header-footer-grid/`). Style rows/components via their CSS classes in `brutheme.css`.
- **brutheme.css version is `filemtime()`** — editing the skin busts browser/CDN cache automatically (no `?ver=NEVE_VERSION` staleness). Never revert that.
- **brutheme.js** (vanilla, no jQuery) drives scroll-reveal: an IntersectionObserver adds `.is-in-view` to `.br-timeline` and `.br-timeline__item` to animate the timeline spine and stagger card pop-ins. Enqueued in `brutheme.php` with mtime versioning.
- **Homepage component classes** live in `brutheme.css`, referenced by content blocks: `.home-hero` (two-column hero), `.hero-composition` (photo + shapes), `.br-card` (equal-height cards with `margin-top:auto` CTA), `.br-latest` (latest-posts grid), `.standart-note`. Reuse these rather than adding inline styles.
- **About timeline markup** lives in the About page content as a raw-HTML block (`<div class="br-timeline">` with `.br-timeline__item`/`.br-timeline__card`/`.br-timeline__date` children). The styles + animation live in `brutheme.css` / `brutheme.js`. Desktop: centered spine with alternating cards; mobile: single column. Respects `prefers-reduced-motion`.
- **Editable timeline pattern**: `neve/brutheme-timeline` ("Brutheme: Animated timeline") is registered as a Gutenberg block pattern in `inc/compatibility/block-patterns/brutheme-timeline.php` (added to `Patterns::$patterns`). Insert it, then edit/duplicate/reorder the `.br-timeline__item` group blocks directly in the editor. The About page uses this structured form (not raw HTML) so items are individually editable.
- **Timeline in the block editor**: `brutheme.js` only adds `.is-in-view` on the front-end, so the editor shows items at `opacity:0`. brutheme.css includes `.editor-styles-wrapper` overrides that force the revealed state (cards opacity 1, spine scaleY(1), no animation) inside the editor while keeping the front-end scroll animation.
- **Timeline speed**: the marching-spine animation duration is `--br-timeline-duration` (default `3s`). Override per-instance with a style or use `.br-timeline--slow` (`6s`) / `.br-timeline--fast` (`1.5s`) classes. The spine (z-index 0) sits BEHIND the diamond nodes (z-index 2) and cards (z-index 1).

## Design system
Read the neobrutalism spec before modifying any UI:
```
/Users/vix/development/vix.coffee/vix.coffee/neobrutalism.md
```
Core rules: solid zero-blur shadows, `4px`/`8px` black borders on structural elements, `border-radius: 0` only (circles = `50%` for avatars/stickers), Space Grotesk at 900/uppercase for headings, mechanical push-down buttons (`:active` translates by shadow offset).

## Anti-patterns (enforce on every UI change)
- No backdrop blur, soft shadows, glow effects
- No mid-range border radii (`rounded-md`, `rounded-lg`)
- No desaturated grays (`#333`, `#666`, slate)
- No `ease-in-out` curves
- No Google Fonts CDN (font is self-hosted)
- No jQuery
- Do NOT add Google Fonts enqueue — Space Grotesk must stay self-hosted (see `brutheme.php`)

## WordPress specifics
- Neve's `functions.php` defines `NEVE_VERSION`; the theme NAME is Neobrutheme (see `style.css`). Text domain stays `neve` internally for translation compatibility.
- Full Neve feature surface is enabled by default (WooCommerce, EDD, mega menu, dashboard app).
- If you change a Neve default value, verify the corresponding Customizer control still accepts user overrides (defaults only apply when no saved mod exists).
- **On the live server (vixwillems.eu) the theme folder is `neve`, not `neobrutheme`.** This is REQUIRED: neve-pro-addon hard-checks `get_template() === 'neve'` in `neve-pro-addon.php` with no filter, and exits early (no pro modules, admin error notice) if the slug differs. The `neve` folder on the server is this brutheme (copied from `neobrutheme/`); a stock copy may sit at `neve-stock-backup/`. Deploy changes to `wp-content/themes/neve/`.
- **neve-pro-addon 3.2.9 is compatible**: active + licensed (license forced valid in its plugin file), all 15 modules load, `neve_pro/v1` REST namespace registered. The SDK compat declaration in `functions.php` (`required 2.9 / tested_up 3.2`) shows no warning for 3.2.9.
- **`style.css` `Version` is `4.2.10`** (matching the Neve lineage), NOT `1.0.0`. The pro addon's SDK checks `required 3.9 / tested_up 4.2` against the active theme version and shows an admin notice ("Neve Pro requires a newer version of Neobrutheme") if it drops below ~3.9. Keep the version ≥ 4.2.10.
