================================================================
  SITH GYM — THEME UPDATE PACKAGE
  Application instructions
================================================================

Repo root (your machine):
    C:\Users\keith\OneDrive\Documents\GitHub\Sith-Gym

----------------------------------------------------------------
  FILES IN THIS PACKAGE
----------------------------------------------------------------

Drop-in replacements (copy directly into the repo):

  1. theme/sith-gym/style.css
     → replaces: theme/sith-gym/style.css
     → Version header already reads 0.2.0
     → @import line already removed

  2. theme/sith-gym/sg-homepage.css
     → NEW FILE
     → place at: theme/sith-gym/sg-homepage.css
     → @import line already removed; comments preserved

  3. theme/sith-gym/front-page.php
     → replaces: theme/sith-gym/front-page.php

Manual edits (I don't have your existing files, so these come
as snippets/instructions):

  4. snippets/functions-php-additions.php
     → apply the five changes (5a–5e) inside
       theme/sith-gym/functions.php
     → for 5d: if you can't find an existing
       sith_gym_sidebar_layout() function, STOP AND ASK
       before adding the new version.

  5. snippets/plugin-version-bump.txt
     → two find/replace edits inside
       plugin/sith-gym-core/sith-gym-core.php
       (header + constant, both → 0.1.2)

----------------------------------------------------------------
  VERIFICATION (Step 7)
----------------------------------------------------------------

From the repo root, run each of these and confirm output:

  # 1. Theme version
  grep -n "^Version:" theme/sith-gym/style.css
      → expect: Version:      0.2.0

  # 2. sg-homepage.css exists and is non-empty
  ls -l theme/sith-gym/sg-homepage.css
      → expect: file present, size > 0

  # 3. front-page.php contains the new positioning copy
  grep -n "Discipline creates control" theme/sith-gym/front-page.php
      → expect: one match

  # 4. All five hooks present in functions.php
  grep -nE "sith_gym_enqueue_fonts|sith_gym_editor_fonts|sith_gym_enqueue_homepage_styles|sith_gym_sidebar_layout|sith_gym_front_page_post_layout" theme/sith-gym/functions.php
      → expect: at least 5 matches (one per function definition,
        plus possibly add_action/add_filter lines)

  # 5. No Google Fonts @import anywhere in theme CSS
  grep -rn "@import url.*fonts.googleapis" theme/sith-gym/
      → expect: NO output

  # 6. Plugin version
  grep -n "0.1.2" plugin/sith-gym-core/sith-gym-core.php
      → expect: two matches (header + constant)

----------------------------------------------------------------
  STAGE, COMMIT, PUSH (Step 8)
----------------------------------------------------------------

From the repo root:

  git add theme/sith-gym/style.css
  git add theme/sith-gym/sg-homepage.css
  git add theme/sith-gym/front-page.php
  git add theme/sith-gym/functions.php
  git add plugin/sith-gym-core/sith-gym-core.php

  git commit -m "feat(theme): homepage redesign, Bebas Neue typography, v0.2.0" -m "- Replace front-page.php with full marketing homepage layout
  - Add sg-homepage.css for homepage-specific styles
  - Update style.css: Bebas Neue heading font, sans-serif body, token cleanup
  - Update functions.php: font enqueue, homepage CSS enqueue, GP layout filters
  - Move Google Fonts load from @import to wp_enqueue_style
  - Bump theme to 0.2.0, plugin to 0.1.2"

  # Push — branch TBD (awaiting your answer on which branch).
  # If current branch: git push
  # If named branch:   git push origin <branch-name>
  # If new branch:     git checkout -b <name> && git push -u origin <name>
