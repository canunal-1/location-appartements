# 🏡 Site de Location d'Appartements - Projet BTS SIO SLAM

Ce projet est une application web développée dans le cadre de l’épreuve **E6 - BTS SIO SLAM 2025**. Il permet à un **propriétaire** de publier des appartements à louer, et à un **demandeur** de faire une demande de location.

## 🎯 Fonctionnalités principales

- 🔐 **Système d’authentification** (connexion / inscription)
- 👤 Gestion des **rôles utilisateurs** : propriétaire, demandeur, locataire
- 🏠 **Ajout, modification et suppression d’appartements** par le propriétaire
- 📅 **Demande de location** possible uniquement si la **date de disponibilité** n’est pas dépassée
- ✅ Le propriétaire peut **accepter** ou **refuser** une demande
  - Si acceptée ➜ le demandeur devient **locataire**
- ❌ Blocage des demandes hors délai

## 🛠️ Technologies utilisées

- PHP 8 avec MVC (programmation orientée objet)
- MySQL pour la base de données
- HTML / CSS
- JavaScript (fonctionnalités mineures)
- XAMPP ou Laragon pour l’environnement local

## 🔐 Sécurité

- Mots de passe **hachés avec `password_hash()`**
- Vérification avec `password_verify()`
- Gestion de session sécurisée avec `$_SESSION`

## 📷 Captures d’écran

*(Tu peux ajouter ici des captures d'écran du site : page d'accueil, formulaire, tableau de bord, etc.)*

## 🧱 Architecture MVC

- `controllers/` – Logique des actions
- `models/` – Requêtes SQL et gestion des données
- `views/` – Affichage HTML
- `config/` – Connexion BDD, paramètres globaux

## 📁 Export PDF (bonus)

Possibilité d’**exporter un récapitulatif PDF** de la demande de location via la bibliothèque `FPDF` (ou `TCPDF`).

## 🚀 Lancer le projet en local

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/canunal-1/location-appartements.git
