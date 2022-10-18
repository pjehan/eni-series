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
