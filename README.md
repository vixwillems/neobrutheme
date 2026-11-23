# Neobrutheme

A neo-brutalist WordPress theme built on the **Neve** framework. Thick borders, solid zero-blur shadows, high-saturation colors, mechanical push-down interactions. Anti-corporate, maximalist, raw.

Visual style adapted from [vix.coffee](https://vix.coffee). Framework: [Neve](https://themeisle.com/themes/neve/) (GPL).

This theme keeps **100% of Neve's functionality** — Customizer options, the drag-and-drop Header/Footer Grid (HFG) builder, blog layout options, WooCommerce, Easy Digital Downloads, block patterns, mega menu, starter content, and the admin dashboard — and overlays the brutheme neo-brutalist design system on top.

## Requirements

- WordPress 5.5+
- PHP 7.0+

## Installation

1. Upload the `neobrutheme` folder to `wp-content/themes/`
2. Activate the theme in **Appearance > Themes**

No build step is required — all compiled assets are committed. Neve ships with its own composer/yarn toolchain if you want to rebuild its JS/CSS from source; the brutheme skin is plain CSS with no compilation.

## What changed vs. stock Neve

Everything is additive. Neve's codebase is untouched apart from **default values** (so a fresh install looks brutalist out of the box, while every Customizer control still works):

| File | Change |
|---|---|
| `globals/utilities.php` | Default color palette → brutalist (red `#FF5C5C`, yellow `#FFDE59`, cyan `#5CE1E6`, black/white) |
| `globals/migrations.php` | Button defaults → `4px` black border, `0` radius, hard offset shadow |
| `inc/core/settings/mods.php` | Body/heading fonts → Space Grotesk; heading weight `900`, uppercase, tight tracking; larger display sizes |
| `inc/customizer/defaults/layout.php` | Blog card border radius → `0`, card style on |
| `brutheme.php` | Enqueues the skin, self-hosts Space Grotesk, removes it from the Google Fonts CDN |
| `assets/css/brutheme.css` | The neo-brutalist design system (loaded after all Neve styles) |
| `style.css` | Theme metadata (Theme Name: Neobrutheme) |

### The skin layer

`brutheme.php` does three things:

1. **Enqueues `assets/css/brutheme.css`** after Neve's main CSS, WooCommerce and EDD styles.
2. **Self-hosts Space Grotesk** — the `.woff2` files in `assets/fonts/` are referenced via `@font-face`. Space Grotesk is removed from the Google Fonts CDN list so it is never fetched from `fonts.googleapis.com`, and it's offered under "System fonts" in the Customizer instead.
3. **Adds the skin to the block editor** so editing matches the front-end look.

The default global colors are the brutalist palette, but users can change any color in **Appearance > Customize > Colors** and the whole theme re-tints (the skin references the `--nv-*` CSS custom properties).

## Key architecture

```
style.css                    # WordPress metadata (Theme Name: Neobrutheme)
functions.php                # Neve bootstrap + loads brutheme.php
brutheme.php                 # Brutheme skin: enqueue, fonts, editor style
assets/
  css/
    brutheme.css             # Neo-brutalist design system (THE skin)
    style-main-new.css       # Neve core CSS (committed, prebuilt)
    woocommerce.css          # Neve WooCommerce CSS
    easy-digital-downloads.css
    mega-menu.css
  apps/                      # Neve Customizer controls, dashboard (prebuilt React)
  js/build/modern/frontend.js# Neve front-end JS (prebuilt)
  fonts/
    space-grotesk-400.woff2  # Self-hosted Space Grotesk
    space-grotesk-500.woff2
    space-grotesk-700.woff2

header-footer-grid/          # HFG builder (drag-and-drop header/footer)
inc/                         # Neve core (customizer options, styles, views)
globals/                     # Neve global helpers + defaults (edited)
views/                       # Neve template-part views
template-parts/              # Neve content templates
woocommerce/                 # Neve WooCommerce templates
```

## Functionality (all from Neve)

- **Customizer** — colors, typography, layout, buttons, forms, blog, single post, shop
- **Header/Footer Grid builder** — drag-and-drop logo, nav, search, social, buttons, widgets
- **Blog layouts** — grid, list, alternative, covers; card style; meta ordering
- **WooCommerce + Easy Digital Downloads** — full template overrides
- **Block patterns & starter content** — Neve's built-in patterns and demo import
- **Mega menu**, **off-canvas cart**, **scroll to top**, **PWA**, AMP

## Design system

Neo-brutalist aesthetic. Core rules (enforced in `assets/css/brutheme.css`):

- **Shadows**: Solid, zero-blur, bottom-right offset (`8px 8px 0 0 #000`)
- **Borders**: `4px`/`8px` black on all structural elements, always `var(--nv-text-color)`
- **Radius**: `0` everywhere (circles use `50%` for avatars/stickers)
- **Typography**: Space Grotesk, headings `900` uppercase with `-0.02em` tracking
- **Colors**: Driven by Neve's global colors (defaults shown above), fully customizable
- **Interactions**: Mechanical push-down buttons (`:active` swallows the shadow), card hover lift, grayscale-to-color images

### Anti-patterns (never do)

- No backdrop blur, soft shadows, glow effects
- No mid-range border radii (`rounded-md`, `rounded-lg`)
- No desaturated grays (`#333`, `#666`, slate)
- No `ease-in-out` curves
- No Google Fonts CDN (Space Grotesk is self-hosted)
- No jQuery

## Customization

### Colors

**Appearance > Customize > Colors** — same palette Neve uses (currently labeled Base/Dark Mode). The brutalist defaults are:

| Token | Default | Usage |
|---|---|---|
| `nv-primary-accent` | `#FF5C5C` | Primary accent (red) |
| `nv-secondary-accent` | `#FFDE59` | Highlights, focus states (yellow) |
| `nv-site-bg` | `#FFFFFF` | Page canvas |
| `nv-light-bg` | `#FFFFFF` | Light surfaces |
| `nv-dark-bg` | `#000000` | Dark surfaces |
| `nv-text-color` | `#000000` | Text, borders, shadows |
| `nv-text-dark-bg` | `#FFFFFF` | Text on dark |
| `nv-c-1` | `#5CE1E6` | Cyan accent |

### Fonts

Space Grotesk (400/500/700) is self-hosted and is the default body + heading font. In **Customize > Typography** you can pick any other system/Google font — Space Grotesk stays available under System.

### Header / Footer

**Customize > Header / Footer** — full HFG builder. Rows render with the brutalist border treatment automatically.

### Menus

Register menus in **Appearance > Menus** (the HFG "Navigation" component picks them up):
- **Primary Menu** — top nav
- **Footer Menu** — footer links

## License

GPL v2 or later — https://www.gnu.org/licenses/gpl-2.0.html

Neve, Copyright 2018 ThemeIsle — https://themeisle.com/themes/neve/
