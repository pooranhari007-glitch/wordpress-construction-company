#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ENV_FILE="${ROOT_DIR}/.deploy.env"

if [[ ! -f "${ENV_FILE}" ]]; then
  echo "Missing ${ENV_FILE}"
  echo "Create it from .deploy.env.example first."
  exit 1
fi

# shellcheck source=/dev/null
source "${ENV_FILE}"

: "${LOCAL_THEME_DIR:?LOCAL_THEME_DIR is required}"
: "${REMOTE_USER:?REMOTE_USER is required}"
: "${REMOTE_HOST:?REMOTE_HOST is required}"
: "${REMOTE_THEME_DIR:?REMOTE_THEME_DIR is required}"

if [[ ! -d "${LOCAL_THEME_DIR}" ]]; then
  echo "Local theme directory not found: ${LOCAL_THEME_DIR}"
  exit 1
fi

REMOTE_TARGET="${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_THEME_DIR}"
SSH_PORT="${SSH_PORT:-22}"
EXTRA_RSYNC_FLAGS="${EXTRA_RSYNC_FLAGS:-}"

echo "Deploying theme..."
echo "From: ${LOCAL_THEME_DIR}"
echo "To:   ${REMOTE_TARGET}"

rsync -az --delete \
  -e "ssh -p ${SSH_PORT}" \
  ${EXTRA_RSYNC_FLAGS} \
  "${LOCAL_THEME_DIR}/" \
  "${REMOTE_TARGET}"

echo "Deploy complete."
