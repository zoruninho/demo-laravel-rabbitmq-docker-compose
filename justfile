# justfile — project task runner
# Run `just` or `just --list` to see all available recipes

default:
    just --list

# -------------------------
# Docker
# -------------------------

# Start app (optional: just start <service>)
[group('docker')]
start *args:
    docker compose up -d {{ args }}

# Stop app (optional: just stop <service>)
[group('docker')]
stop *args:
    docker compose down {{ args }}

# Restart app (optional: just restart <service>)
[group('docker')]
restart *args:
    docker compose restart {{ args }}

# Tail container logs (optional: just logs <service>)
[group('docker')]
logs *args:
    docker compose logs -f {{ args }}

# -------------------------
# Backend
# -------------------------

# Execute a command inside the API container (e.g. just api php -v)
[group('backend')]
api *args:
    docker compose exec api {{ args }}

alias a := api

# Execute a artisan command inside the API container (e.g. just artisan migrate)
[group('backend')]
artisan *args:
    just api php artisan {{ args }}

# Copy self-signed Caddy certificate to ~/Downloads
[group('backend')]
get-caddy-certificate:
    docker compose cp api:/data/caddy/pki/authorities/local/root.crt ~/Downloads/caddy-root.crt

# Copy vendor folder from Docker container to local
[group('backend')]
sync-vendor:
    rm -rf ./api/vendor/*
    docker compose cp api:/app/vendor ./api/

# -------------------------
# Testing
# -------------------------

# Run Laravel Pint (PHP CS Fixer based) (e.g. just pint --test => equivalent to dry-run)
[group('testing')]
pint *args:
    just api ./vendor/bin/pint {{ args }}
