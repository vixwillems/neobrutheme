# Neobrutheme

A neo-brutalist WordPress theme. Thick borders, solid zero-blur shadows, high-saturation colors, mechanical push-down interactions. Anti-corporate, maximalist, raw.

Visual style adapted from [vix.coffee](https://vix.coffee). Content is original.

## Requirements

- WordPress 6.0+
- PHP 8.0+

## Installation

1. Upload the `neobrutheme` folder to `wp-content/themes/`
2. Activate the theme in **Appearance > Themes**
3. Go to **Settings > Permalinks** and click **Save** (flushes rewrite rules for custom post types)
4. ACF Free is bundled as a must-use plugin — no additional plugin install needed

## Development

```bash
npm install          # install Tailwind v4 + Vite
npm run dev          # watch mode with HMR
npm run build        # compile production CSS
```

Compiled `assets/css/tailwind.css` is committed and served from the theme (not fetched from CDN).

### Build pipeline

The theme uses Vite + `@tailwindcss/vite` to compile Tailwind utilities. The entry point is `assets/js/app.js` which imports `assets/css/app.css`. The `@source` directives in `app.css` scan template files for class usage.

Output: `assets/css/tailwind.css` (committed to repo).

Design system styles live in `assets/css/style.css` (hand-written, not compiled).

## Theme structure

```
style.css                    # WordPress metadata + CSS imports
functions.php                # Bootstrap: requires inc/ files, enqueues assets
theme.json                   # Site Editor settings: colors, typography, spacing, layout
header.php                   # Sticky nav, geometric logo, mobile menu
footer.php                   # Black footer, logo, social links
index.php                    # Main loop fallback
page.php                     # ACF Flexible Content layouts
single.php                   # Single post
archive.php                  # Archive pages
single-portfolio.php         # Portfolio item detail
single-team.php              # Team member detail
single-service.php           # Service detail
archive-portfolio.php        # Portfolio grid
archive-team.php             # Team grid
archive-service.php          # Services grid
search.php                   # Search results
404.php                      # 404 page
sidebar.php                  # Widget area

template-parts/              # Reusable card components
  content-post.php           # Blog post card
  content-portfolio.php      # Portfolio card
  content-team.php           # Team member card
  content-service.php        # Service card
  content-none.php           # No results state

flexible-layouts/            # ACF Flexible Content templates
  layout-hero.php            # Hero + composition panel
  layout-marquee.php         # Scrolling text ticker
  layout-stat-cards.php      # Stat shapes with counters
  layout-content-grid.php    # Dynamic post/CPT grid
  layout-team-grid.php       # Team member cards
  layout-services.php        # Services listing
  layout-text-image.php      # Two-column text + image
  layout-testimonials.php    # Testimonial cards
  layout-cta.php             # Call-to-action banner

assets/
  css/
    app.css                  # Tailwind v4 entry (source directives)
    tailwind.css             # Compiled output (committed)
    style.css                # Neo-brutalist design system
  js/
    interactions.js          # Vanilla JS: counters, fade-in, stagger, tabs
  fonts/
    space-grotesk-400.woff2  # Self-hosted Space Grotesk
    space-grotesk-500.woff2
    space-grotesk-700.woff2

inc/
  theme-setup.php            # Theme supports, menus, image sizes
  acf-setup.php              # ACF JSON sync, options pages, field groups
  post-types.php             # CPT registrations (portfolio, team, service)
  color-settings.php         # CSS custom properties from ACF options
  template-tags.php          # Helper functions

acf-json/                    # ACF field group JSON (auto-synced)
tools/
  import-demo.php            # Sample homepage + content importer
mu-plugins/
  acf-mu-loader.php          # Loads bundled ACF
  acf/                       # ACF Free (bundled)
```

## Custom post types

| CPT | Slug | Archive | Description |
|---|---|---|---|
| Portfolio | `/portfolio` | Yes | Project showcases |
| Team | `/team` | Yes | Team member profiles |
| Service | `/services` | Yes | Service offerings |

After activation: **Settings > Permalinks > Save** to register rewrite rules.

### Sample homepage import

Load a demo homepage with all 9 layouts, sample content, and default colors:

```bash
wp eval-file tools/import-demo.php
```

This creates a Home page, sets it as the front page, populates all Flexible Content layouts, creates sample Portfolio/Team/Service items, and applies the default color palette. It will not overwrite existing content.

## Site Editor (appearance-tools)

The theme registers `theme.json` (v3) with:

- **Color palette** — matches the ACF color options (Background, Foreground, Accent Red, Secondary Yellow, Accent Cyan, White). Edit these in the Site Editor or via ACF > Colors — both update the same CSS custom properties.
- **Typography** — Space Grotesk registered as the theme font family with all 3 weights (400, 500, 700) self-hosted. Font sizes from Small to Giant.
- **Layout** — content: 720px, wide: 1200px.
- **Spacing** — 9-step scale from X-Small (0.25rem) to XXX-Large (6rem).
- **Button defaults** — 4px solid black border, Space Grotesk 700, uppercase, hover → red background.
- **Heading defaults** — 900 weight, uppercase, tight tracking.

The Site Editor's global styles panel, template editing, and block patterns all work out of the box.

## ACF options pages

Navigate to **Neobrutheme** in the admin sidebar:

- **General** — Site tagline, social links, footer text, analytics ID
- **Colors** — All 6 color tokens (customizable, output as CSS custom properties)
- **Homepage** — Flexible Content for composable page layouts

### Homepage Flexible Content layouts

Drag and drop these layout blocks to compose the homepage:

| Layout | Description |
|---|---|
| Hero | Display-stroke heading + CSS geometric composition panel |
| Marquee | Scrolling text ticker (configurable speed/color) |
| Stat Cards | Yellow panel with animated stat shapes |
| Content Grid | Dynamic grid from any post type |
| Team Grid | Team member cards |
| Services | Service cards (grid or list) |
| Text + Image | Two-column with grayscale hover |
| Testimonials | Quote cards with rotation |
| CTA | Full-width colored banner with button |

## Design system

Neo-brutalist aesthetic. Core rules:

- **Shadows**: Solid, zero-blur, bottom-right offset (`8px 8px 0 0 #000`)
- **Borders**: `border-4` / `border-8` on all structural elements, always black
- **Radius**: `rounded-none` only (no mid-range radii). `rounded-full` for circles
- **Typography**: Space Grotesk at weight 700+ baseline, uppercase headlines
- **Colors**: Customizable via ACF (CSS custom properties on `:root`)
- **Interactions**: Mechanical push-down buttons, grayscale-to-color images

### Anti-patterns (never do)

- No backdrop blur, soft shadows, glow effects
- No mid-range border radii (`rounded-md`, `rounded-lg`)
- No desaturated grays (`#333`, `#666`, slate)
- No `ease-in-out` curves
- No Google Fonts CDN
- No jQuery

## Customization

### Colors

Go to **Neobrutheme > Colors** in the admin. All 6 colors are customizable:

| Property | Default | Usage |
|---|---|---|
| `--color-bg` | `#FFFFFF` | Page canvas |
| `--color-fg` | `#000000` | Text, borders, shadows |
| `--color-red` | `#FF5C5C` | Primary accent |
| `--color-yellow` | `#FFDE59` | Highlights, focus states |
| `--color-cyan` | `#5CE1E6` | Card headers, depth |
| `--color-white` | `#FFFFFF` | Card interiors |

In templates, use `bg-[var(--color-red)]` or `text-[var(--color-fg)]` — never hardcoded hex.

### Menus

Register menus in **Appearance > Menus**:
- **Primary Navigation** — top nav bar
- **Footer Navigation** — footer links

## License

GPL v2 or later — https://www.gnu.org/licenses/gpl-2.0.html
