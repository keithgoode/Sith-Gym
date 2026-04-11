# Sith Gym

Source repository for the Sith Gym WordPress site.

This repo contains **only** the custom theme and plugin code for the site.
It does **not** contain WordPress core, third-party plugins, the database,
or uploaded media. Those are managed on the WordPress install itself.

## Repository structure

```
.
├── theme/    # Custom WordPress theme (presentation: templates, styles)
├── plugin/   # Custom WordPress plugin (functionality: logic, features)
├── docs/     # Project documentation
├── .gitignore
└── README.md
```

### Separation of concerns

- **`theme/`** — presentation only. Templates, styles, and markup.
- **`plugin/`** — functionality only. Custom post types, shortcodes, business logic.
- **`docs/`** — notes, decisions, and setup instructions for the project.

Keeping functionality in the plugin (not the theme) means the site's features
survive a theme change.

## Deployment

The theme and plugin directories are designed to be deployed into a standard
WordPress install:

- `theme/` → `wp-content/themes/<theme-folder>/`
- `plugin/` → `wp-content/plugins/<plugin-folder>/`

The exact deployment method (manual upload, rsync, CI, etc.) is documented
in `docs/` as the project evolves.
