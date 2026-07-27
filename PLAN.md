# Neobrutheme — Implementation Plan

A neo-brutalist WordPress theme. Thick borders, solid zero-blur shadows, high-saturation colors, mechanical push-down interactions. Anti-corporate, maximalist, raw.

Visual style adapted from [vix.coffee](https://vix.coffee). Content is original.

---

## Technology Decisions

| Decision | Choice | Rationale |
|---|---|---|
| Framework | Vanilla WordPress | Aligns with vix.coffee's DIY philosophy. No abstractions between you and the markup. |
| CSS | Tailwind CSS v4 + custom design system | Tailwind for utility classes; custom CSS for the neo-brutalist design tokens (shadows, textures, animations). |
| Build Tool | Vite + @tailwindcss/vite | Fast HMR in dev, optimized production builds. Same stack as vix.coffee. |
| Custom Fields | ACF Free (bundled as must-use plugin) | Flexible Content for composable page layouts; custom fields for CPTs and global options. |
| Templates | PHP (WordPress template hierarchy) | No Twig/Blade. Raw PHP templates with `get_header()`/`get_footer()` pattern. |
| Font | Space Grotesk (self-hosted .woff2) | No Google Fonts dependency. Better performance, better privacy. |
| JavaScript | Vanilla (no jQuery) | Scroll animations, mobile menu, counters — all hand-written. |

---

## Design System

Adapted from vix.coffee's `neobrutalism.md` spec and `assets/css/style.css`.

### Colors (Customizable via ACF Options Page)

| Token | Default Hex | Usage |
|---|---|---|
| `background` | `#FFFFFF` | Page canvas |
| `foreground` | `#000000` | Text, borders, shadows |
| `accent-red` | `#FF5C5C` | Primary actions, badges, active states |
| `secondary-yellow` | `#FFDE59` | Highlights, nav active, focus states |
| `accent-cyan` | `#5CE1E6` | Card headers, structural depth, table alternation |
| `white` | `#FFFFFF` | Card interiors |

Colors are stored as ACF options and output as CSS custom properties on `:root`:
```css
:root {
  --color-bg: #FFFFFF;
  --color-fg: #000000;
  --color-red: #FF5C5C;
  --color-yellow: #FFDE59;
  --color-cyan: #5CE1E6;
  --color-white: #FFFFFF;
}
```

Tailwind arbitrary values reference these: `bg-[var(--color-red)]`, `text-[var(--color-fg)]`, etc.

### Typography

- **Font**: Space Grotesk (400, 500, 700, 900) — self-hosted
- **Base weight**: 700 (bold). Regular (400) is avoided.
- **Headlines**: `font-black` (900), `uppercase`, `tracking-tighter`
- **Display**: `text-5xl` to `text-8xl` with `-webkit-text-stroke` for hollow text effect
- **Labels**: `text-xs font-black uppercase tracking-widest`

### Shadows (Solid, Zero-Blur)

- Small: `shadow-[4px_4px_0_0_#000]`
- Medium: `shadow-[8px_8px_0_0_#000]`
- Large: `shadow-[12px_12px_0_0_#000]`
- Massive: `shadow-[16px_16px_0_0_#000]`

### Buttons (Mechanical Push-Down)

```css
.btn:active {
  transform: translate(4px, 4px) !important;
  box-shadow: none !important;
}
```

### Background Texture

Triple-layer pattern on `body`:
1. Halftone dots: `radial-gradient(rgba(0,0,0,.13) 1.5px, transparent 1.5px)` at 20x20px
2. Horizontal grid: `linear-gradient(to right, rgba(0,0,0,.06) 1px, transparent 1px)` at 40x40px
3. Vertical grid: `linear-gradient(to bottom, rgba(0,0,0,.06) 1px, transparent 1px)` at 40x40px

### Anti-Patterns (Forbidden)

- No backdrop blur, soft shadows, or glow effects
- No opacity transitions or translucent backdrops
- No smooth gradients (hard color breaks only)
- No mid-range corner radii (`rounded-md`, `rounded-lg`)
- No desaturated grays (`#333`, `#666`, slate colors)
- No `ease-in-out` curves

---

## Theme Structure

```
neobrutheme/
├── style.css                          # Theme metadata + CSS imports
├── functions.php                      # Bootstrap: requires inc/ files, enqueues assets
├── header.php                         # Sticky nav, geometric logo, mobile menu
├── footer.php                         # Black footer, logo, social links
├── index.php                          # Main loop fallback
├── single.php                         # Single post
├── single-portfolio.php               # Portfolio item detail
├── single-team.php                    # Team member detail
├── single-service.php                 # Service detail
├── page.php                           # Generic page (ACF Flexible Content)
├── archive.php                        # Generic archive
├── archive-portfolio.php              # Portfolio grid
├── archive-team.php                   # Team grid
├── archive-service.php                # Services grid
├── search.php                         # Search results
├── 404.php                            # 404 page
├── sidebar.php                        # Optional sidebar
│
├── template-parts/
│   ├── content-post.php               # Blog post card
│   ├── content-portfolio.php          # Portfolio card
│   ├── content-team.php               # Team member card
│   ├── content-service.php            # Service card
│   ├── content-none.php               # No results state
│   ├── hero.php                       # Hero section partial
│   ├── marquee.php                    # Scrolling ticker
│   ├── stat-cards.php                 # Stat cards grid
│   ├── badge.php                      # Sticker badge
│   └── nav.php                        # Nav links
│
├── flexible-layouts/                  # ACF Flexible Content templates
│   ├── layout-hero.php                # Hero + display-stroke + composition panel
│   ├── layout-marquee.php             # Scrolling text ticker
│   ├── layout-stat-cards.php          # Colored stat shapes with counters
│   ├── layout-content-grid.php        # Dynamic post/CPT grid
│   ├── layout-team-grid.php           # Team member cards
│   ├── layout-services.php            # Services listing
│   ├── layout-text-image.php          # Two-column text + image
│   ├── layout-testimonials.php        # Testimonial cards
│   └── layout-cta.php                 # Call-to-action banner
│
├── assets/
│   ├── css/
│   │   ├── app.css                    # Tailwind v4 entry
│   │   ├── tailwind.css               # Compiled output (served from site)
│   │   └── style.css                  # Neo-brutalist design system
│   ├── js/
│   │   └── interactions.js            # Vanilla JS: animations, counters, menu
│   ├── fonts/
│   │   ├── space-grotesk-400.woff2
│   │   ├── space-grotesk-500.woff2
│   │   ├── space-grotesk-700.woff2
│   │   └── space-grotesk-900.woff2
│   └── images/
│       └── (theme images)
│
├── inc/
│   ├── theme-setup.php                # Theme supports, menus, image sizes
│   ├── acf-setup.php                  # ACF bundled loader + field registration
│   ├── post-types.php                 # CPT registrations
│   ├── color-settings.php             # CSS custom properties from ACF options
│   └── template-tags.php              # Helper functions
│
├── acf-json/                          # ACF field group JSON sync
│   ├── group-options-homepage.json
│   ├── group-options-colors.json
│   ├── group-options-general.json
│   ├── group-portfolio.json
│   ├── group-team.json
│   └── group-service.json
│
├── mu-plugins/
│   └── acf/                           # ACF Free (bundled)
│       ├── advanced-custom-fields.php
│       └── ... (ACF plugin files)
│
├── package.json                       # Vite + Tailwind deps
├── vite.config.js                     # Build config
├── screenshot.png                     # Theme screenshot (1200x900)
└── README.md                          # Install + dev docs
```

---

## Implementation Phases

### Phase 1: Build Pipeline

**Files:** `package.json`, `vite.config.js`, `assets/css/app.css`, `.gitignore`

1. Create `package.json` with:
   - `tailwindcss` v4
   - `@tailwindcss/vite` plugin
   - `vite`
   - Scripts: `dev` (watch), `build` (production)

2. Create `vite.config.js`:
   - Input: `assets/css/app.css`
   - Output: `assets/css/tailwind.css`
   - Tailwind Vite plugin

3. Create `assets/css/app.css`:
   ```css
   @import "tailwindcss";
   @source "../../template-parts/";
   @source "../../flexible-layouts/";
   @source "../../assets/js/";
   ```

4. Update `.gitignore`:
   - Add `node_modules/`
   - Ensure `assets/css/tailwind.css` is NOT ignored

---

### Phase 2: Design System CSS

**Files:** `assets/css/style.css`, `assets/fonts/`

1. Download Space Grotesk woff2 files (weights 400, 500, 700, 900) into `assets/fonts/`

2. Create `assets/css/style.css` — port from vix.coffee with these sections:
   - `@font-face` declarations (self-hosted Space Grotesk)
   - CSS custom properties for colors (`:root` variables)
   - Body background texture (halftone + grid)
   - Display stroke effect
   - Brutalist shadow utility classes
   - Geometric shape classes (circle, triangle, diamond)
   - Hero composition panel styles
   - Stat shape styles
   - Button mechanical push-down (`.btn`)
   - Form input focus states
   - Table styling (alternating rows, hover)
   - Card hover lift effect
   - Insight card hover rotation
   - Timeline component
   - Fade-in / stagger animation base states
   - Marquee keyframe animation
   - Responsive overrides (shadow reduction, composition panel hide)
   - WordPress-specific selectors (`.wp-caption`, `.screen-reader-text`)

---

### Phase 3: Theme Foundation

**Files:** `style.css`, `functions.php`, `inc/theme-setup.php`, `inc/template-tags.php`

1. Create `style.css` (WordPress theme metadata header + CSS imports)

2. Create `functions.php`:
   - `require` all `inc/*.php` files
   - Enqueue `tailwind.css` and `style.css` on `wp_enqueue_scripts`
   - Enqueue `interactions.js` on `wp_enqueue_scripts`
   - Register menus: `primary`, `footer`
   - Add theme supports via `after_setup_theme`

3. Create `inc/theme-setup.php`:
   - `add_theme_support('title-tag')`
   - `add_theme_support('post-thumbnails')`
   - `add_theme_support('custom-logo', ...)`
   - `add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'])`
   - `add_theme_support('editor-styles')`
   - `add_theme_support('responsive-embeds')`
   - `register_nav_menus(['primary' => 'Primary Navigation', 'footer' => 'Footer Navigation'])`
   - `add_image_size('portfolio-thumb', 600, 400, true)`
   - `add_image_size('team-photo', 400, 400, true)`
   - `add_image_size('service-icon', 200, 200, true)`

4. Create `inc/template-tags.php`:
   - `neobrutheme_posted_on()` — post date
   - `neobrutheme_posted_by()` — author
   - `neobrutheme_entry_footer()` — categories, tags
   - `neobrutheme_badge_rotation()` — returns random rotation class
   - `neobrutheme_stat_shape()` — returns random shape (circle/diamond)
   - `neobrutheme_color_class($color)` — maps color name to Tailwind class

---

### Phase 4: Header & Footer

**Files:** `header.php`, `footer.php`

1. Create `header.php`:
   - DOCTYPE, `<html <?php language_attributes()>>`, `<head>` with `wp_head()`
   - `<body <?php body_class() ?>>`
   - Sticky nav bar: `sticky top-0 z-50 bg-white border-b-8 border-black`
   - Three-shape logo (red circle + yellow square + cyan triangle) using CSS, linked to `home_url()`
   - Primary nav via `wp_nav_menu(['theme_location' => 'primary', ...])`
   - Mobile hamburger button (vanilla JS toggle)
   - `<main id="primary" class="site-main">`

2. Create `footer.php`:
   - `</main>` closes main
   - `<footer>` with black bg, white text
   - Logo repeated with white borders
   - Footer nav via `wp_nav_menu(['theme_location' => 'footer'])`
   - Social links (from ACF options)
   - `wp_footer()`
   - Closing `</body></html>`

---

### Phase 5: Custom Post Types

**Files:** `inc/post-types.php`

Register three CPTs via `register_post_type()` on `init`:

**Portfolio** (`portfolio`):
```
Labels: Portfolio Item / New Item / Edit Item / View Item
Supports: title, editor, thumbnail, excerpt, custom-fields
Public: true, Has Archive: true
Menu Icon: dashicons-portfolio
Rewrite Slug: portfolio
```

**Team** (`team`):
```
Labels: Team Member / New Member / Edit Member / View Member
Supports: title, editor, thumbnail, excerpt, custom-fields
Public: true, Has Archive: true
Menu Icon: dashicons-groups
Rewrite Slug: team
```

**Service** (`service`):
```
Labels: Service / New Service / Edit Service / View Service
Supports: title, editor, thumbnail, excerpt, custom-fields
Public: true, Has Archive: true
Menu Icon: dashicons-megaphone
Rewrite Slug: services
```

---

### Phase 6: ACF Integration

**Files:** `inc/acf-setup.php`, `inc/color-settings.php`, `acf-json/`, `mu-plugins/acf/`

#### 6.1 Bundle ACF Free

- Download ACF Free plugin
- Extract into `mu-plugins/acf/`
- Create `mu-plugins/acf-mu-loader.php` that checks if ACF is loaded and shows admin notice if not

#### 6.2 ACF Setup (`inc/acf-setup.php`)

- Register ACF local JSON path (`acf-json/`)
- Add `acf/settings/save_json` and `acf/settings/load_json` filters
- Register all field groups via `acf_add_local_field_group()` (fallback if JSON not loaded)

#### 6.3 ACF Options Pages

Register via `acf_add_options_page()`:

| Options Page | Slug | Purpose |
|---|---|---|
| General Settings | `theme-general` | Site tagline, social links, footer text |
| Color Settings | `theme-colors` | All 6 color tokens (customizable) |
| Homepage Layout | `theme-homepage` | Flexible Content for homepage composition |

#### 6.4 ACF Field Groups

**Group: General Options** (`theme-general`)
- `site_tagline` (text) — tagline below logo
- `social_links` (repeater → link: url + label)
- `footer_text` (textarea)
- `google_analytics_id` (text) — optional tracking

**Group: Color Options** (`theme-colors`)
- `color_bg` (color_picker) — default `#FFFFFF`
- `color_fg` (color_picker) — default `#000000`
- `color_red` (color_picker) — default `#FF5C5C`
- `color_yellow` (color_picker) — default `#FFDE59`
- `color_cyan` (color_picker) — default `#5CE1E6`
- `color_white` (color_picker) — default `#FFFFFF`

**Group: Homepage Layout** (`theme-homepage`) — Flexible Content

| Layout | Fields |
|---|---|
| `hero` | heading (text), subheading (text), bg_color (select: red/yellow/cyan/white), show_composition (true/false) |
| `marquee` | text (text), speed (select: slow/medium/fast), color (select: red/cyan/yellow) |
| `stat_cards` | stats (repeater → number, label, color, shape) |
| `content_grid` | heading (text), post_type (select: post/portfolio/team/service), count (number), columns (select: 2/3/4) |
| `team_grid` | heading (text), count (number) |
| `services` | heading (text), style (select: grid/list) |
| `text_image` | heading (text), content (wysiwyg), image (image), alignment (select: left/right) |
| `testimonials` | heading (text), testimonials (repeater → quote, author, role) |
| `cta` | heading (text), button_text (text), button_url (url), color (select: red/yellow/cyan) |

**Group: Portfolio Item** (`portfolio` CPT)
- `client_name` (text)
- `project_date` (date_picker)
- `project_url` (url)
- `technologies` (repeater → text)
- `is_featured` (true/false)

**Group: Team Member** (`team` CPT)
- `role` (text)
- `bio` (textarea)
- `email` (email)
- `social_links` (repeater → link)

**Group: Service** (`service` CPT)
- `service_icon` (text) — emoji or icon class
- `short_description` (textarea)
- `price_range` (text)
- `is_featured` (true/false)

#### 6.5 Color Settings (`inc/color-settings.php`)

- Hook into `wp_head` to output CSS custom properties from ACF options
- Falls back to defaults if ACF options not set
- Outputs:
  ```css
  :root {
    --color-bg: {color_bg};
    --color-fg: {color_fg};
    --color-red: {color_red};
    --color-yellow: {color_yellow};
    --color-cyan: {color_cyan};
    --color-white: {color_white};
  }
  ```
- Updates `style.css` to use `var(--color-*)` instead of hardcoded hex values

---

### Phase 7: Core Templates

**Files:** `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`, `sidebar.php`

**Files:** `single-portfolio.php`, `single-team.php`, `single-service.php`, `archive-portfolio.php`, `archive-team.php`, `archive-service.php`

1. `index.php` — standard WordPress loop, uses `template-parts/content-post.php`

2. `page.php` — checks for ACF Flexible Content field `page_layouts`:
   - If layouts exist: loops `while(have_rows('page_layouts'))` and includes `flexible-layouts/layout-{type}.php`
   - Falls back to `the_content()`

3. `single.php` — featured image hero, title in display-stroke, post content, tags with sticker rotation, related posts

4. `single-portfolio.php` — full-width hero image, title, details grid (client, date, URL, technologies), content

5. `single-team.php` — circular photo with border, name, role, bio, social links

6. `single-service.php` — icon in bordered box, title, description, price, CTA button

7. `archive.php` — archive header, loop of cards, pagination

8. `archive-portfolio.php` — 3-column grid of portfolio cards

9. `archive-team.php` — grid of team cards

10. `archive-service.php` — grid of service cards

11. `search.php` — search form, results loop, no-results state

12. `404.php` — large "404" in display-stroke, search form, link to home

---

### Phase 8: Template Parts

**Files:** `template-parts/*.php`

All partials use Tailwind utility classes + custom CSS classes from `style.css`.

1. `content-post.php` — blog card: `border-8 border-black shadow-[8px_8px_0_0_#000]`, featured image with grayscale hover, title, excerpt, date badge

2. `content-portfolio.php` — portfolio card: image with `group-hover:scale-105`, title, client name, technology tags

3. `content-team.php` — team card: circular photo `rounded-full border-8 border-black`, name, role, hover lift

4. `content-service.php` — service card: icon in bordered box, title, short description, price badge

5. `content-none.php` — "Nothing found" message with search form

6. `hero.php` — reusable hero: heading, subheading, optional composition panel

7. `marquee.php` — scrolling ticker: continuous horizontal text, configurable color and speed

8. `stat-cards.php` — stat shapes: circle/diamond with number + label, animated counter

9. `badge.php` — sticker badge: rotated `bg-[#FF5C5C]` with text

10. `nav.php` — nav link items with active/hover states

---

### Phase 9: Flexible Content Layouts

**Files:** `flexible-layouts/layout-*.php`

Each layout reads ACF sub-fields via `get_sub_field()` and outputs neo-brutalist HTML.

1. `layout-hero.php` — two-panel flex layout:
   - Left: display-stroke heading, subheading, CTA button
   - Right: composition panel with CSS geometric shapes (circle, square, triangle) on colored bg
   - `border-8 border-black shadow-[12px_12px_0_0_#000]`

2. `layout-marquee.php` — `position: sticky` scrolling ticker dividers

3. `layout-stat-cards.php` — yellow bg panel, grid of stat shapes with animated counters

4. `layout-content-grid.php` — dynamic grid:
   - Uses `WP_Query` to pull from selected post type
   - Responsive columns (1/2/3/4)
   - Uses appropriate `template-parts/content-*.php` based on post type

5. `layout-team-grid.php` — queries `team` CPT, renders `content-team.php` cards

6. `layout-services.php` — queries `service` CPT, renders `content-service.php` cards (grid or list)

7. `layout-text-image.php` — two-column:
   - Left or right image with `grayscale hover:grayscale-0`
   - Text with heading and wysiwyg content
   - `border-8 border-black shadow-[8px_8px_0_0_#000]`

8. `layout-testimonials.php` — grid of testimonial cards with quote text, author, role

9. `layout-cta.php` — full-width banner:
   - Colored background (red/yellow/cyan)
   - Large heading
   - Button with mechanical push-down
   - `border-8 border-black shadow-[12px_12px_0_0_#000]`

---

### Phase 10: JavaScript

**File:** `assets/js/interactions.js`

Vanilla JS, no jQuery. All animations triggered by IntersectionObserver.

1. **Fade-in elements**: `[data-fade-in]` elements fade up from 12px below on scroll entry
2. **Stagger groups**: `[data-stagger]` children appear sequentially with 60ms delay
3. **Number counters**: `[data-count]` attributes animate from 0 to target with cubic ease-out
4. **Progress bars**: `[data-bar-value]` fill from 0% to target width on scroll
5. **Mobile menu toggle**: hamburger button toggles `.mobile-menu-open` class on body
6. **Tab switching**: `[data-tab-group]` tabs toggle active panel visibility
7. **Card hover**: CSS handles this (no JS needed — `:hover` transforms)
8. **Marquee**: CSS `@keyframes marquee` handles scrolling (no JS needed)

---

### Phase 11: Polish & Documentation

**Files:** `screenshot.png`, `README.md`

1. Create `screenshot.png` (1200x900) — capture a styled page showing the neo-brutalist aesthetic
2. Update `README.md`:
   - Theme description
   - Installation instructions (upload to `wp-content/themes/`, activate)
   - Development setup (`npm install`, `npm run dev`, `npm run build`)
   - ACF field documentation
   - Customization guide (colors via Appearance > Customizer or ACF Options)
3. Run `npm run build` to compile production CSS
4. Test all templates and responsive breakpoints
5. Verify all Tailwind classes are compiled (no missing utilities)

---

## ACF Options Page Structure

```
Appearance > Neobrutheme Settings
├── General
│   ├── Site Tagline
│   ├── Social Links (repeater)
│   ├── Footer Text
│   └── Google Analytics ID
├── Colors
│   ├── Background Color (default: #FFFFFF)
│   ├── Foreground Color (default: #000000)
│   ├── Accent Red (default: #FF5C5C)
│   ├── Secondary Yellow (default: #FFDE59)
│   ├── Accent Cyan (default: #5CE1E6)
│   └── White (default: #FFFFFF)
└── Homepage
    └── Flexible Content layouts (drag-and-drop composition)
```

---

## ACF Field Group JSON Sync

Field groups are stored in `acf-json/` for version control. To enable sync:

1. In `inc/acf-setup.php`, register paths:
   ```php
   add_filter('acf/settings/save_json', function() { return get_stylesheet_directory() . '/acf-json'; });
   add_filter('acf/settings/load_json', function($paths) { $paths[] = get_stylesheet_directory() . '/acf-json'; return $paths; });
   ```

2. When field groups are created/updated in WP admin, they auto-save to `acf-json/`
3. On theme deploy, field groups load from JSON (no database dependency for field definitions)

---

## WordPress Requirements

- WordPress 6.0+
- PHP 8.0+
- No required plugins beyond bundled ACF
- Permalinks must be set to anything except "Plain" for CPT rewrite rules to work

---

## Development Workflow

```bash
# Install dependencies
npm install

# Start dev server (watches for changes, hot reloads)
npm run dev

# Build production CSS (minified, no sourcemaps)
npm run build

# Download Space Grotesk fonts (one-time setup)
# Manually download from Google Fonts or use npm package
# Place .woff2 files in assets/fonts/
```

---

## File Creation Order

1. `package.json`, `vite.config.js`, `assets/css/app.css` — build pipeline
2. `assets/fonts/` — self-hosted Space Grotesk
3. `assets/css/style.css` — design system
4. `style.css`, `functions.php`, `inc/theme-setup.php`, `inc/template-tags.php` — foundation
5. `header.php`, `footer.php` — layout shell
6. `inc/post-types.php` — custom post types
7. `inc/acf-setup.php`, `inc/color-settings.php`, `mu-plugins/acf/`, `acf-json/` — ACF integration
8. `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`, `sidebar.php` — core templates
9. `single-portfolio.php`, `single-team.php`, `single-service.php`, `archive-portfolio.php`, `archive-team.php`, `archive-service.php` — CPT templates
10. `template-parts/*.php` — reusable components
11. `flexible-layouts/layout-*.php` — ACF layout templates
12. `assets/js/interactions.js` — JavaScript
13. `screenshot.png`, `README.md` — polish
