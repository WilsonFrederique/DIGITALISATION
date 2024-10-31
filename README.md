# APPLICATION WEB 

## Description & Installation

## Etap 1 : Description

Bienvenue :
![Chargement](./README_IMAGES/P.png)

======================================
PAGE POUR ADMINISTRATEUR 
======================================
![Chargement](./README_IMAGES/L.png)

Admin
![Chargement](./README_IMAGES/0.png)

Page des employés (mode sombre)
![Chargement](./README_IMAGES/1.png)

Page des employés (mode clair)
![Chargement](./README_IMAGES/2.png)

Page pour le formulaire 1er etap
![Chargement](./README_IMAGES/3.png)

Page pour le formulaire 2em etap
![Chargement](./README_IMAGES/4.png)

Page pour générer des codes QR (mode sombre)
![Chargement](./README_IMAGES/5.png)

Page pour Scanner un codes QR 
![Chargement](./README_IMAGES/scan.png)

Page pour générer des codes QR (mode clair)
![Chargement](./README_IMAGES/6.png)

======================================
PAGE POUR UTILISATEUR 
======================================
Page pour CONNEXION
![Chargement](./README_IMAGES/c1.png)
Page pour S'inscrire
![Chargement](./README_IMAGES/c2.png)
-------------------------------------
![Chargement](./README_IMAGES/c3.png)


## Etap 2 : Installation

========== INSTALLATION =============

Quelques commandes à executer dans le terminal du vs code avant de demarrer votre projet

1 : Veuillez ouvrir Git Bash et taper la commande suivante : 
    git clone https://github.com/WilsonFrederique/DIGITALISATION.git
    ![Chargement](./README_IMAGES/g.png)

    ou bien téléchargez le fichier en format .zip, puis extrayez-le.
    ![Chargement](./README_IMAGES/10.png)


2 : composer install

3 : php artisan key:generate

4 : créez un fichier .env sous dossier DIGITALISATION puis copiez les contenu de fichier .env.example et collez dans le nouveau fichier .env, en suite: 

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=digitalisation ( Nom de la base de donnée )
    DB_USERNAME=root
    DB_PASSWORD=

modifiez-les par rapport à votre SGBD

5 : php artisan migrate  

6 : php artisan serve

    Ex : PS C:\xampp\htdocs\PROJET\LARAVEL\DIGITALISATION> php artisan serve

         INFO  Server running on [http://127.0.0.1:8000].  

         Press Ctrl+C to stop the server

Maintenant copiez ce lien : http://127.0.0.1:8000 et collez dans votre navigateur

---------------------------------------