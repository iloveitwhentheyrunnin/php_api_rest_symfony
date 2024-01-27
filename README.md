# Symfony ToDoApp API - BACKEND

Bienvenue dans la documentation de l'API Symfony 6 pour le projet flutter_todoApp. 
Cette API REST backend fournit les fonctionnalités nécessaires pour la gestion des tâches de l'application ToDoApp développée en Flutter.
Il y'a donc une entité Task, et un TaskUpdateController.

## Configuration Requise
- PHP 8.0 ou supérieur
- Composer
- Symfony CLI
- MySQL (ou autre système de gestion de base de données pris en charge par Symfony)
- BDD : todoapp_bdd (dans le repo)

## Installation

1. Clonez le référentiel depuis GitHub :

 ```bash
 git clone https://github.com/votre-utilisateur/php_api_rest_symfony.git
 ```

2. Accédez au répertoire du projet :

```bash
cd php_api_rest_symfony

```

3. Installez les dépendances avec Composer :

```bash
composer install
```

Configurez votre base de données MYSQL avec les paramètres de connexion appropriés.

Importez la base de données et exécutez les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Si des problèlmes se présentes (manques de migrations...), vous pouvez faire : 

```bash
php bin/console doctrine:schema:update --force
```

Lancez votre api : 
```bash
symfony serve
```
