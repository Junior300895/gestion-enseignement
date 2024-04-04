
## 2) Configurer l'API
Dans le dossier _config_ se trouve la classe _Database_. C'est grâce à cette classe que l'API réussit à communiquer avec la base de données.

Les modifications à apporter à ce fichier:
~~~~
private $sHote = "localhost"; // Adresse IP du serveur MySQL
private $sNomBDD = "enseignements"; // Nom de la base de données
private $sUsername = "root"; // Nom d'utilisateur du serveur MySQL
private $sMotDePasse = ""; // Mot de passe de l'utilisateur`
~~~~

## 3) Voilà, tout est prêt!
Ce n'est pas plus compliqué que ça! Tout est prêt à être utilisé.


## Effectuer des requêtes
L'API retourne du JSON peu importe si la requête contient une erreur.

Pour effectuer une requête, voici le structure:
`http(s):// URL_OU_API_EST_HEBERGEE / DOSSIER_MENANT_VERS_API / LA_TABLE_DÉSIRÉE / TYPE_DE_REQUÊTE.php`

Note : Les noms des classes sont le même que celle des tables de la base de données.

Exemple :
`http://localhost/api-enseignements/etudiant/rechercherTous.php`

### Les types de requêtes
1) **RechercherTous** - Recherche toutes les entrées de la table
2) **RechercherUn** - Recherche un élément de la table en particulier
3) **Ajouter** - Ajouter un élément dans la table
4) **Modifier** - Modifier un élément dans la table
5) **Supprimer** - Supprimer un élément dans la table

### Les paramètres

 #### RechercherTous
 Aucun paramètre
 
 #### RechercherUn
 | Méthode | Clé                   | Valeur |
 | ------- | --------------------- | ------ |
 | GET     | id [Nom de la classe] | int    |
 
 Exemple : 
 `http://localhost/api-enseignements/etudiant/rechercherUn.php?IdEtu=1`

#### Ajouter
  Toutes les valeurs doivent être passées en méthode POST à l'aide d'un formulaire HTML ou d'une requête AJAX.

 | Méthode  | Clé                     | Valeur |
 | -------- | ----------------------- | ------ |
 | POST     | Propriétés de la classe |        |
 
 #### Modifier
   Toutes les valeurs doivent être passées en méthode POST à l'aide d'un formulaire HTML ou d'une requête AJAX.
 
  | Méthode  | Clé                     | Valeur |
  | -------- | ----------------------- | ------ |
  | POST     | Propriétés de la classe |        |
  
 #### Supprimer
 | Méthode | Clé                   | Valeur |
 | ------- | --------------------- | ------ |
 | GET     | id [Nom de la classe] | int    |
 
 Exemple : 
  `http://localhost/api-enseignements/etudiant/supprimer.php?IdEtu=1`
 
  #### RechercherTousPar...
  | Méthode | Clé                   | Valeur |
  | ------- | --------------------- | ------ |
  | GET     | iNo [Nom] | int    |
  


## Classes
Voici les listes des classes disponibles.

  ### Adresse
  La classe adresse contient l'adresse de l'utilisateur, l'adresse de facturation d'une commande ainsi que l'adresse d'expédition d'une commande

  #### Paramètres
  * `idAdresse // id de l'adresse`
  * `sRue // Numéro civique et nom de la rue`
  * `sVille // Ville`
  * `sPays // Pays`
  * `sProvince // Province`
  * `sCodePostal // Code postal`
  
  #### Requêtes disponibles
  1) Ajouter
  2) Modifier
  3) Supprimer
  4) RechercherTous
  5) RechercherUn
  
  
  ### Catégorie
  La classe catégorie contient les catégories de produits à afficher sur le site

  #### Paramètres
  * `idCategorie // id de la catégorie `
  * `sNomCategorie // Nom de la catégorie `
  * `sUrlImg // Nom du fichier de l'image représentant la catégorie `
  
  #### Requêtes disponibles
  4) RechercherTous
  5) RechercherUn
  
  
  ### Commande
  La classe commande contient les commandes effectuées par un utilisateur
  
    
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   3) RechercherTous
   4) RechercherUn


  ### ContenuCommande
   La classe ContenuCommande contient les produits ajoutés à une commande par un utilisateur
    
   #### Paramètres
   * `idContenuCommande // Id du contenu de la commande `
   * `iQteProduitCommande // Quantité de produit `
   * `fPrixCommande // Prix final du produit `
   * `iNoCommande // Id de la commande `
   * `iNoProduit // Id du produit `
      
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   2) Supprimer
   4) RechercherTous
   5) RechercherUn
   
   
  ### ContenuPanier
  La classe ContenuPanier contient les produits ajoutés à un panier par un utilisateur
    
   #### Paramètres
   * `idContenuPanier // Id du contenu du panier `
   * `iQteProduit // Quantité de produit `
   * `iNoProduit // Id du produit `
   * `iNoPanier // Id du panier `
      
   #### Requêtes disponibles
   1) Ajouter
   2) Modifier
   2) Supprimer
   4) RechercherTous
   5) RechercherUn


  ### ImgProduit
  La classe ImgProduit contient les images de produit
      
   #### Paramètres
   * `idImgProduit // Id de l'image du produit `
   * `sUrlImg // Nom du fichier de l'image `
   * `iNoProduit // Id du produit `
       
   #### Requêtes disponibles
   4) RechercherTous
   5) RechercherUn
   5) RechercherTousParProduit


  ### Panier
  La classe Panier contient les paniers temporaires d'un utilisateur anonyme
      
   #### Paramètres
   * `idPanier // Id du panier `
   * `sNumPanier // Numéro unique du panier `
   * `sDateModification // Date de modification du panier `
       
   #### Requêtes disponibles
   1) Ajouter
   1) Modifier
   1) Supprimer
   4) RechercherTous
   5) RechercherUn

