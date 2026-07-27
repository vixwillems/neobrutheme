# neobrutheme — AGENTS.md

## Stack
- Vanilla WordPress theme (no Timber, no Sage, no Composer)
- Tailwind CSS v4 + custom neo-brutalist CSS design system
- Vite + @tailwindcss/vite for build pipeline
- ACF Free bundled as must-use plugin (in `mu-plugins/acf/`)
- Space Grotesk self-hosted (.woff2 in `assets/fonts/`)
- Vanilla JS (no jQuery)

## Project status
Early stage. Only `PLAN.md` and `.gitignore` exist. No theme files, no `node_modules`, no build output yet. Follow `PLAN.md` file creation order when implementing.

## Build
```bash
npm install          # install Tailwind v4 + Vite
npm run dev          # watch mode with HMR
npm run build        # compile production CSS to assets/css/tailwind.css
```
Compiled `assets/css/tailwind.css` is committed and served from the site (not fetched from CDN).

## Key architecture decisions
- **Colors are customizable**: stored as ACF options, output as CSS custom properties (`--color-red`, `--color-yellow`, etc.) on `:root`. Use `bg-[var(--color-red)]` not hardcoded hex.
- **Homepage is ACF Flexible Content**: `flexible-layouts/layout-*.php` files render each layout block. `page.php` loops `get_field('page_layouts')`.
- **ACF field groups** live in `acf-json/` for version control. Registered in `inc/acf-setup.php`.
- **Three custom post types**: `portfolio`, `team`, `service`. Registered in `inc/post-types.php`.

## Design system
Adapted from vix.coffee's `neobrutalism.md` spec. Read that file before modifying any UI:
```
/Users/vix/development/vix.coffee/vix.coffee/neobrutalism.md
```
Core rules: solid zero-blur shadows, `border-4`/`border-8` on all structural elements, `rounded-none` only (no mid-range radii), Space Grotesk at weight 700+ baseline, mechanical push-down buttons (`:active` translates by shadow offset).

## Anti-patterns (enforce on every UI change)
- No backdrop blur, soft shadows, glow effects
- No mid-range border radii (`rounded-md`, `rounded-lg`)
- No desaturated grays (`#333`, `#666`, slate)
- No `ease-in-out` curves
- No Google Fonts CDN (font is self-hosted)
- No jQuery

## WordPress specifics
- Custom post types need permalink flush after registration: Settings > Permalinks > Save
- ACF bundled in `mu-plugins/acf/` — WordPress auto-loads from this directory
- Theme must declare supports in `inc/theme-setup.php` (title-tag, post-thumbnails, custom-logo, html5)
