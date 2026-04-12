# Deployment Guide — Sith Gym

How to deploy the Sith Gym child theme and core plugin from this repository
into a WordPress installation.

---

## What gets deployed

This repository contains two artifacts:

| Artifact | Repo location | WordPress destination |
|---|---|---|
| **Sith Gym** (child theme) | `theme/sith-gym/` | `wp-content/themes/sith-gym/` |
| **Sith Gym Core** (plugin) | `plugin/sith-gym-core/` | `wp-content/plugins/sith-gym-core/` |

Both are deployed independently. You can update one without touching the other.

---

## Prerequisites

Before deploying, make sure:

1. **WordPress is installed and running** on your server.
2. **GeneratePress** (the parent theme) is installed in WordPress.
   - Appearance → Themes → Add New → search "GeneratePress" → Install.
   - Do **not** activate GeneratePress directly — you will activate the child
     theme instead, which uses GeneratePress automatically.

---

## Method 1: ZIP upload through WordPress admin

This method requires no server access. You only need a WordPress admin account.

### Create the ZIP files

On your computer, create a ZIP archive of each artifact. The ZIP must contain
the folder itself at the top level (not loose files).

**Theme:**

Right-click the `theme/sith-gym/` folder and compress it to a ZIP file.
The resulting ZIP should have this structure when opened:

```
sith-gym.zip
└── sith-gym/
    ├── functions.php
    └── style.css
```

**Plugin:**

Right-click the `plugin/sith-gym-core/` folder and compress it to a ZIP file.
The resulting ZIP should have this structure when opened:

```
sith-gym-core.zip
└── sith-gym-core/
    ├── assets/
    ├── includes/
    └── sith-gym-core.php
```

> **Tip:** Do not include `.gitkeep` files in the ZIP. They are only meaningful
> to Git and serve no purpose on the WordPress server. Most ZIP tools will
> include them automatically — that is harmless but unnecessary.

### Upload and activate the child theme

1. Log in to WordPress admin.
2. Go to **Appearance → Themes → Add New → Upload Theme**.
3. Choose `sith-gym.zip` and click **Install Now**.
4. After installation completes, click **Activate**.
5. Visit the front end of your site and confirm it loads without errors.

If you are **updating** an existing installation, WordPress will ask whether
you want to replace the current version. Click **Replace current with uploaded**
to proceed.

### Upload and activate the plugin

1. Go to **Plugins → Add New → Upload Plugin**.
2. Choose `sith-gym-core.zip` and click **Install Now**.
3. After installation completes, click **Activate**.
4. Go to **Plugins** and confirm "Sith Gym Core" appears in the active list
   with no error notices.

If you are **updating** an existing installation, WordPress will ask whether
you want to replace the current version. Click **Replace current with uploaded**
to proceed.

---

## Method 2: Direct file deployment

This method copies files directly onto the server. You need access to the
WordPress file system via SFTP, SSH, or a hosting file manager.

### Deploy the child theme

Copy the **contents** of `theme/sith-gym/` into the WordPress themes directory
so the final server path is:

```
wp-content/themes/sith-gym/
├── functions.php
└── style.css
```

Using command-line tools (adjust paths to match your server):

```bash
# From the repository root:
rsync -av --delete theme/sith-gym/ user@server:/path/to/wp-content/themes/sith-gym/
```

Or with SFTP, upload the `theme/sith-gym/` folder into `wp-content/themes/`.

Then activate in WordPress admin: **Appearance → Themes → Sith Gym → Activate**.

### Deploy the plugin

Copy the **contents** of `plugin/sith-gym-core/` into the WordPress plugins
directory so the final server path is:

```
wp-content/plugins/sith-gym-core/
├── assets/
├── includes/
└── sith-gym-core.php
```

Using command-line tools:

```bash
# From the repository root:
rsync -av --delete plugin/sith-gym-core/ user@server:/path/to/wp-content/plugins/sith-gym-core/
```

Or with SFTP, upload the `plugin/sith-gym-core/` folder into `wp-content/plugins/`.

Then activate in WordPress admin: **Plugins → Sith Gym Core → Activate**.

> **Note on `--delete`:** The `rsync --delete` flag removes files on the server
> that no longer exist in the repo. This keeps the server in sync with the
> repository. If you are not comfortable with this, omit `--delete` — but be
> aware that old files may linger on the server after updates.

---

## Activation order

The child theme and plugin are independent. You can activate them in any order.

However, the child theme **requires GeneratePress** to be installed (not
necessarily activated). If GeneratePress is missing, WordPress will show:
*"The parent theme is missing."*

---

## Rollback

If a deployment causes problems, you can revert to the previous version.

### Option A: Restore from a previous ZIP or backup

If you saved a copy of the previous version before deploying (recommended),
re-upload or re-copy that version using the same steps above.

**Before every deployment, save a backup:**

- **ZIP method:** Download the current theme/plugin from the server before
  uploading the new version. In WordPress admin, there is no built-in
  download button — use your hosting file manager or SFTP to grab the folder.
- **Direct method:** Before running `rsync`, copy the current server folder
  to a backup location:

  ```bash
  # Backup the theme before deploying:
  ssh user@server "cp -r /path/to/wp-content/themes/sith-gym /path/to/backups/sith-gym-$(date +%Y%m%d)"

  # Backup the plugin before deploying:
  ssh user@server "cp -r /path/to/wp-content/plugins/sith-gym-core /path/to/backups/sith-gym-core-$(date +%Y%m%d)"
  ```

### Option B: Restore from Git

Because this repository is version-controlled, you can always check out a
previous commit and redeploy from there.

```bash
# See recent commits:
git log --oneline -10

# Check out the previous version:
git checkout <commit-hash>

# Deploy from this state using Method 1 or Method 2 above.

# Return to the latest version when done:
git checkout main
```

### Option C: Deactivate without removing

If you need to stop a broken plugin or theme immediately while you investigate:

- **Plugin:** Go to **Plugins → Sith Gym Core → Deactivate**. The plugin
  files remain on the server but stop executing.
- **Theme:** Go to **Appearance → Themes** and activate a different theme
  (e.g., GeneratePress directly, or Twenty Twenty-Five). The child theme
  files remain on the server but are no longer in use.

---

## Checklist

Use this checklist each time you deploy:

- [ ] Backed up the current server version of the artifact being updated
- [ ] Created the ZIP or prepared the files for direct copy
- [ ] Uploaded / copied files to the correct WordPress directory
- [ ] Activated (or confirmed still active) in WordPress admin
- [ ] Visited the front end of the site and confirmed no errors
- [ ] Checked the WordPress admin dashboard for any error notices
