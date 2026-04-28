# PGroup WordPress Theme Repo

This repository contains the custom WordPress child theme used for PGroup.

## Theme path

`wp-content/themes/pgroup-child`

## Git workflow (Option B)

1. Work locally in this repo.
2. Commit changes.
3. Push to remote (GitHub/GitLab/Bitbucket).
4. Deploy to server by pulling repo or syncing the theme folder.

## First-time remote setup

```bash
git remote add origin <your-repository-url>
git branch -M main
git push -u origin main
```

## Suggested deployment approaches

- **Server pull** (if repo exists on server)
  - SSH into server, go to repo, `git pull`.
- **Rsync deploy** (recommended for simple hosting)
  - Sync only `wp-content/themes/pgroup-child/` to server path.
