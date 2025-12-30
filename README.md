# WhatsMark - WhatsApp Marketing Platform

Application Laravel pour la gestion de marketing WhatsApp avec intégration de l'API WhatsApp Cloud, gestion des contacts, automatisation et analytics.

## Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM ou Yarn
- MySQL >= 8.0
- Redis (optionnel mais recommandé pour les queues)

## Installation

### 1. Cloner le projet

```bash
git clone <repository-url>
cd upload
```

### 2. Installer les dépendances

```bash
# Dépendances PHP
composer install

# Dépendances JavaScript
npm install
```

### 3. Configuration de l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé de l'application
php artisan key:generate
```

### 4. Configuration de la base de données

Éditer le fichier `.env` et configurer les paramètres de la base de données:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

### 5. Migrations et Seeders

```bash
# Exécuter les migrations
php artisan migrate

# Exécuter les seeders
php artisan db:seed
```

#### Seeders disponibles

Le projet inclut les seeders suivants (exécutés automatiquement avec `php artisan db:seed`):

- **SourceSeeder** : Données initiales des sources (Facebook, WhatsApp, SaaS)
- **StatusSeeder** : Statuts pour les contacts et campagnes
- **PermissionSeeder** : Permissions et rôles via Spatie Permission
- **EmailTemplatesSeeder** : Templates d'emails par défaut
- **LanguageSeeder** : Langues supportées par l'application

Seeders optionnels (à exécuter manuellement si nécessaire):

```bash
# Seeders de test/développement
php artisan db:seed --class=UsersSeeder
php artisan db:seed --class=ContactSeeder
php artisan db:seed --class=ChatSeeder
php artisan db:seed --class=ChatMessagesSeeder
php artisan db:seed --class=ContactNotesSeeder
php artisan db:seed --class=NotificationSeeder
php artisan db:seed --class=CannedRepliesTableSeeder
php artisan db:seed --class=AiPromptsTableSeeder
```

### 6. Configuration WhatsApp Cloud API

Dans le fichier `.env`, ajouter vos credentials WhatsApp:

```env
WHATSAPP_LOGGING_ENABLED=true
# Ajouter vos credentials WhatsApp Cloud API
```

### 7. Générer les assets

```bash
# En développement
npm run dev

# Pour la production
npm run build
```

### 8. Générer les icônes et caches

```bash
# Générer le cache des icônes
php artisan icons:cache

# Générer le cache des permissions
php artisan permission:cache-reset
```

## Démarrage

### Développement

Le projet inclut un script Composer pour démarrer tous les services en parallèle:

```bash
composer dev
```

Cette commande lance:
- Le serveur de développement Laravel (`php artisan serve`)
- Le worker de queue (`php artisan queue:listen`)
- Les logs en temps réel (`php artisan pail`)
- Vite pour les assets (`npm run dev`)

### Démarrage manuel

Si vous préférez démarrer les services séparément:

```bash
# Serveur Laravel
php artisan serve

# Worker de queue (dans un autre terminal)
php artisan queue:work

# Vite dev server (dans un autre terminal)
npm run dev
```

## Configuration Redis (Optionnel)

Pour améliorer les performances, configurer Redis dans `.env`:

```env
CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Configuration Broadcasting (Pusher)

Pour les notifications en temps réel, configurer Pusher dans `.env`:

```env
BROADCAST_CONNECTION=pusher

PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-cluster
```

## Scripts disponibles

### Composer Scripts

```bash
# Nettoyer tous les caches
composer clear-all

# Lancer l'environnement de développement complet
composer dev

# Formater le code avec Laravel Pint
composer pint
```

### NPM Scripts

```bash
# Développement avec hot reload
npm run dev

# Build de production
npm run build

# Formater le code
npm run format

# Vérifier le formatage
npm run format:check
```

## Artisan Commands personnalisés

```bash
# Nettoyer le cache compilé
php artisan clear-compiled

# Nettoyer le cache de l'application
php artisan cache:clear

# Nettoyer le cache des routes
php artisan route:clear

# Nettoyer le cache des vues
php artisan view:clear

# Nettoyer le cache de configuration
php artisan config:clear

# Réinitialiser le cache des permissions
php artisan permission:cache-reset

# Générer le cache des icônes
php artisan icons:cache
```

## Stack Technique

### Backend
- Laravel 11.x
- Livewire 3.x pour les composants interactifs
- Spatie Laravel Permission pour la gestion des rôles
- WhatsApp Cloud API (netflie/whatsapp-cloud-api)
- Laravel Breeze pour l'authentification
- PowerGrid pour les tables de données
- Redis pour le cache et les queues

### Frontend
- Tailwind CSS
- Alpine.js (via Livewire)
- Blade Components
- Vite pour le build
- ApexCharts pour les graphiques
- Quill Editor pour l'édition riche

### Icônes
- Heroicons
- Feather Icons
- Carbon Icons

## Structure du projet

```
.
├── app/                    # Code de l'application
├── bootstrap/              # Fichiers de démarrage
├── config/                 # Fichiers de configuration
├── database/
│   ├── migrations/         # Migrations de base de données
│   ├── seeders/           # Seeders
│   └── factories/         # Factories pour les tests
├── platform/              # Packages et modules personnalisés
│   ├── core/             # Modules core
│   └── packages/         # Packages (installer, etc.)
├── public/               # Assets publics
├── resources/
│   ├── views/           # Vues Blade
│   ├── css/             # Fichiers CSS
│   └── js/              # Fichiers JavaScript
├── routes/              # Fichiers de routes
├── storage/             # Fichiers générés
└── tests/               # Tests

```

## Environnement de production

### 1. Optimisations

```bash
# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Mettre en cache les configurations
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache

# Build des assets
npm run build
```

### 2. Configuration `.env`

```env
APP_ENV=production
APP_DEBUG=false
QUEUE_CONNECTION=redis
CACHE_STORE=redis
SESSION_DRIVER=redis
```

### 3. Permissions

```bash
# Définir les bonnes permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Troubleshooting

### Erreur de permissions

```bash
chmod -R 775 storage bootstrap/cache
```

### Réinitialiser complètement la base de données

```bash
php artisan migrate:fresh --seed
```

### Problèmes de cache

```bash
composer clear-all
```

### Erreur avec les assets

```bash
npm run build
php artisan config:clear
```

## Support

Pour toute question ou problème, créer une issue dans le repository.

## Licence

MIT License
