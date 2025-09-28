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
git clone https://github.com/HamzaAbayouss/callcenter.git
cd callcenter
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
Modifier avec vos informations de base de données :
```
APP_NAME=callcenter
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=callcenter_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6️⃣ Créer la base de données
Avant de lancer les migrations, créez une base dans **MySQL** :
```sql
CREATE DATABASE callcenter CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7️⃣ Lancer les migrations
```bash
php artisan migrate
```

*Lancer les seeders*
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
