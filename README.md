# Series Symfony

## Création du projet

```shell
composer create-project symfony/skeleton series
```

OU

```shell
symfony new series
```

### Webapp (version full)

Installation de l'ensemble des packages (Doctrine, Twig, Form...)

```shell
composer require webapp
```

### Apache-pack

Si vous utilisez Apache pour rediriger toutes les requêtes vers le controlleur frontal (public/index.php).

```shell
composer require symfony/apache-pack
```

### Doctrine

```shell
composer require symfony/orm-pack
```

Créer le fichier .env.local et ajouter la ligne `DATABASE_URL`

Créer la base de données

```shell
php bin/console doctrine:database:create
```

Créer une entité (c'est la partie qui demande de la concentration donc on éteind la TV, on coupe la musique et on ferme la porte à clé !)

```shell
php bin/console make:entity
```

Mettre à jour la base de données directement

```shell
php bin/console doctrine:schema:update --force
```

OU bien en passant par des migrations :

Générer les migrations

```shell
php bin/console make:migration
```

Exécuter les migrations

```shell
php bin/console doctrine:migration:migrate
```

En cas de problème dans l'exécution des migrations (problème de synchronisation entre les fichiers PHP et la base de données) :

Supprimer les fichiers PHP de migration puis :

```shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration # Cette commande va générer 1 seul fichier de migration contenant l'ensemble des requêtes SQL pour créer la base de données
php bin/console doctrine:migration:migrate
```

### Doctrine fixtures

```shell
composer require --dev orm-fixtures
```

Générer un fichier de fixtures

```shell
php bin/console make:fixture
```

Exécuter les fixtures

```shell
php bin/console doctrine:fixtures:load
```

## Installation

### Mettre en place l'environnement (une seule fois, après avoir récupéré le projet)

Créer le fichier .env.local

```shell
composer install
npm install
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate # ou si il n'y a pas de fichier de migration : php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/series?serverVersion=8&charset=utf8mb4"
```

Créer la base de données

```shell
php bin\console doctrine:database:create
```

### Démarrer le serveur PHP

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```