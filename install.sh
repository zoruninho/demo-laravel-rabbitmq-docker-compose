#!/usr/bin/env sh
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env created from .env.example."
    exit 1
else
    echo "✅ .env already exists, skipping."
fi
