# Relaxpp

Projet de test pour le contexte suivant : relaxpp est une plateforme hébergeant des pistes audio dédiées à la détente. Un backend Laravel gère la réception des fichiers audio et délègue leur transcodage à un worker Go.

A l'installation, il faut débuter par `docker compose build --no-cache`.

Ensuite, un simple `docker compose up -d` suffit à démarrer le projet. Il est aussi possible d'utiliser les raccourcis du justfile et d'utiliser `just start`.

> Il faut installer just avant, documentation disponible [ici](https://github.com/casey/just)

Il faut ensuite exécuter `docker compose exec api composer install` (ou `just api composer install`) à chaque démarrage du container. Ceci sera évitable en intégrant un entrypoint.sh à l'avenir.

Lors de la première installation, il faut aussi exécuter `docker compose exec api php artisan migrate` ou `just artisan migrate`.

Le site est alors accessible directement sur [https://localhost](https://locahost) et contient un dashboard Telescope sur [https://localhost/telescope](https://localhost/telescope])

## Certificats

Par défaut, Caddy génère un certificat "root" valable 10 ans et génère des certificats intermédiaires et temporaires. Comme Caddy est utilisé via Docker, il est possible qu'il n'arrive pas à installer automatiquement le certificat root sur la machine. Ce qui pousse les navigateurs à afficher un message d'avertissement qu'il faut accepter avant de pouvoir naviguer sur le site.

Pour éviter de devoir le faire à chaque lancement, il est possible d'installer manuellement le certificat root sur sa machine.

Pour le récupérer : `docker cp ${caddy-container-name}:/data/caddy/pki/authorities/local/root.crt ${dossier-cible}`
Ou la commande `just get-caddy-certificate`

Avec FrankenPHP, le container qui contient caddy est celui de l'api. Le container s'appelle `api`.

Ensuite il faut installer le certificat sur la machine.
