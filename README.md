# FitConnect

## Description

FitConnect est une application backend développée en PHP orienté objet permettant de gérer un réseau de salles de sport.

Le projet respecte une architecture en couches (Entities, Repositories, Services, Controllers) et utilise MySQL avec PDO pour la gestion des données.

---

## Technologies utilisées

- PHP 8
- MySQL
- PDO
- HTML
- MVC
- Merise (MCD / MLD)

---

## Fonctionnalités

- Gestion des adhérents
- Gestion des abonnements
- Tableau de bord
- Connexion sécurisée avec PDO
- Architecture en couches
- Requêtes préparées

---

## Structure du projet

```
FITCONNECT/

│
├── app/
│   ├── Controllers/
│   ├── Entities/
│   ├── Repositories/
│   └── Services/
│
├── config/
│
├── public/
│
├── views/
│   ├── adherents/
│   ├── abonnements/
│   └── dashboard/
│
├── README.md
└── .gitignore
```

---

## Base de données

La base de données contient les tables suivantes :

- SALLE
- ADHERENT
- ABONNEMENT
- SEANCE

Les relations ont été conçues avec Merise (MCD puis MLD) avant l'implémentation MySQL.

---

## Auteur

Projet réalisé dans le cadre de la formation Développeur Web et Web Mobile.
