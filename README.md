# 🌐 Projet Laravel 10.10

## 📌 Prérequis
Avant d’installer le projet, assurez-vous d’avoir installé sur votre machine :

- **PHP** `8.2.12` ou supérieur  
- **Composer** (gestionnaire de dépendances PHP)  
- **MySQL** ou **MariaDB** (ou un autre SGBD compatible)  
- **Node.js** et **NPM** (pour la gestion du front-end)  
- **Git** (facultatif, pour cloner le projet)  

---

## ⚙️ Étapes d’installation

### 1️⃣ Cloner le projet depuis GitHub
```bash
git clone https://github.com/utilisateur/nom-du-projet.git
cd nom-du-projet
```

### 2️⃣ Installer les dépendances Laravel
```bash
composer install
```

### 3️⃣ Copier le fichier d’environnement
```bash
cp .env.example .env
```

### 4️⃣ Générer la clé de l’application
```bash
php artisan key:generate
```

### 5️⃣ Configurer le fichier `.env`
Modifier avec vos informations de base de données et Pusher :

```
APP_NAME="NomDuProjet"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_base
DB_USERNAME=nom_utilisateur
DB_PASSWORD=mot_de_passe

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=2055869
PUSHER_APP_KEY=44645a364d82245506b1
PUSHER_APP_SECRET=0476610d6a846030aa5a
PUSHER_APP_CLUSTER=ap1
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
```

### 6️⃣ Créer la base de données
Avant de lancer les migrations, créez une base dans **MySQL** :
```sql
CREATE DATABASE nom_base CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7️⃣ Lancer les migrations
```bash
php artisan migrate
```

*(Optionnel : si vous avez des seeders, lancez-les aussi)*
```bash
php artisan db:seed
```

### 8️⃣ Installer les dépendances front-end
```bash
npm install
```

### 9️⃣ Compiler les assets
En mode développement :
```bash
npm run dev
```

### 🔟 Lancer le serveur Laravel
```bash
php artisan serve
```

Le projet sera accessible sur :  
👉 [http://localhost:8000](http://localhost:8000)

---

## 🔧 Commandes utiles

### Vérifier la version Laravel
```bash
php artisan --version
```

### Nettoyer les caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Rafraîchir la base de données
Supprime toutes les tables et relance les migrations :
```bash
php artisan migrate:fresh --seed
```





