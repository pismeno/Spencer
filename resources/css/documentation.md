Spencer — CSS utilities & migration guide
======================================

Summary
-------
This project stylesheet was refactored to add a small set of reusable utility classes for quick prototyping and consistent UI building. Old component-specific styles are preserved for compatibility, but you should prefer the new utilities when creating new views.

Goals
- Provide small, composable utilities: layout, spacing, buttons, forms, cards, grids, modals, avatars.
- Keep IDs and JS hooks intact (no renames for IDs like `#content`, `#modal-overlay`, `#attendance-panel`).
- Provide a migration table so existing markup can be updated incrementally.

Quick usage (examples)
----------------------
1) Page container and centered header

Use `.container` to limit content width and `.centerer` to center items.

Example:

<div class="container">
  <header class="flex items-center justify-between">
    <h1 class="text-primary">Spencer</h1>
    <nav class="flex gap-md">
      <a class="btn btn-ghost">Link</a>
    </nav>
  </header>
</div>

2) Card component

<div class="card card--rounded card--shadow">
  <h3>Card title</h3>
  <p class="text-muted">Small description</p>
  <button class="btn btn-primary">Primary action</button>
</div>

3) Form field

<div class="form-group">
  <label class="label">Email</label>
  <div class="input-wrap">
    <input class="input" type="email" placeholder="you@example.com">
    <span class="input-icon"><img src="/path/to/icon.svg" /></span>
  </div>
</div>

4) Grid of cards

<div class="grid grid-auto-fill">
  <div class="card">Item 1</div>
  <div class="card">Item 2</div>
</div>

5) Modal

<div class="modal-overlay"> <!-- keep existing ID if JS uses it -->
  <div class="modal">
    <div class="modal-header">
      <h2>Modal title</h2>
      <button class="modal-close">×</button>
    </div>
    <div class="card">Modal body</div>
  </div>
</div>

Core utility list (short)
-------------------------
Layout & helpers
- .container — center content, max-width
- .centerer — horizontally + vertically center content
- .row / .col — simple flex row/column helpers
- .flex / .flex-row / .flex-column
- .justify-between, .items-center
- .gap-sm / .gap-md / .gap-lg

Buttons
- .btn — base button
- .btn-primary — primary (green) fill
- .btn-outline — bordered button
- .btn--pill — rounded pill
- .btn-large — larger padding

Form
- .input — base input/textarea styling
- .label — label above field
- .input-wrap — relative wrapper for icons
- .input-icon — absolute positioned icon inside inputs

Cards & UI blocks
- .card — white panel with subtle border
- .card--rounded — larger radius
- .card--shadow — soft shadow

Grid
- .grid — css grid wrapper
- .grid-auto-fill — responsive auto-fill grid

Modal & overlay
- .modal-overlay — full-screen overlay (use existing `#modal-overlay` if JS expects that id)
- .modal — centered panel

Other
- .avatar — circular avatar box
- .text-primary / .text-muted

Legacy classes kept (and migration mapping)
-----------------------------------------
The stylesheet keeps many legacy class names for compatibility. Prefer the new utilities for new work. The table below maps common legacy classes to the new recommended utilities.

- .pill-button, .pill -> .pill (or .btn.btn--pill)
- .search-pill -> .search-pill + .input (input inside should use .input)
- .group-pill -> .group-pill (use .card or add .card for shadow/border)
- .modal-search -> .modal-search (use .input inside)
- .member-row -> .member-row (no change) — you can wrap with .card
- .settings-card -> .settings-card or .card
- .save-btn -> .save-btn (kept) or prefer .btn .btn-primary
- .btn-interested / .btn-not-interested -> .btn.btn-primary / .btn.btn-outline

Notes & best practices
----------------------
- IDs used in JS were preserved. If you rename an ID, update the JavaScript that references it.
- The `.input` class should be applied to all input and textarea elements for consistent sizing and focus style.
- Prefer composition: combine `.card.card--rounded.card--shadow` for a raised rounded panel.
- Use `.grid-auto-fill` for responsive card grids instead of custom media queries.

Accessibility reminders
- Always provide an associated `<label>` (or aria-label) for form fields. The refactor adds styling only — semantic accessibility is still your responsibility.

Migration checklist (suggested)
- [ ] Start new components with utilities above.
- [ ] Replace buttons with `.btn` and `.btn-primary` / `.btn-outline`.
- [ ] Apply `.input` to text fields and `.input-wrap` if an icon is present.
- [ ] Gradually drop very specific presentational classes in favor of utilities.

Appendix: Examples mapping from previous pages
---------------------------------------------
- Preferences (settings.php)
  - `.name-card` uses `.card.card--rounded`
  - inputs now use `.input`
  - profile avatar uses `.avatar`

- Event page (event.php)
  - `.event-details-card` kept but you can simplify to `.card`
  - `.save-btn` mapped to `.btn.btn-primary`
  - member list uses `.member-row` and `.avatar`

If you want, I can:
- Create small partial templates (header/footer/sidebar) using the new utilities.
- Extract common JS hooks into a single `ui.js` file and document expected IDs/classes.

-- End of documentation --

