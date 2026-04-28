#!/usr/bin/env bash
set -euo pipefail

# Copy this file to deploy.sh and fill values below.

LOCAL_THEME_DIR="/Users/rajat/pgroup-wp-theme/wp-content/themes/pgroup-child/"
REMOTE_USER="your_ssh_user"
REMOTE_HOST="your_server_host"
REMOTE_THEME_DIR="/path/to/wordpress/wp-content/themes/pgroup-child/"

echo "Deploying theme to ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_THEME_DIR}"
rsync -avz --delete "$LOCAL_THEME_DIR" "${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_THEME_DIR}"
echo "Done."
