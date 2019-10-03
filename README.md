# Humansix Test Technique
*Romain Boudot*

## Prérequis

+ [Vagrant](https://www.vagrantup.com/)
+ Port 8888 ouvert

## Installation

Tout d'abord cloner le repo :

via ssh

    git clone git@github.com:Yumi-Romain/humansix.git

via http

    git clone https://github.com/Yumi-Romain/humansix.git

Entrer simplement dans le repo

    cd humansix

Puis installer la VM en utilisant Vagrant (cela peu prendre un certain temps)

    vagrant up

Le projet est installer !
rendez vous sur [localhost:8888](http://localhost:8888) pour tester le projet

## Api

### liste des routes public de l'api

+ POST [http://localhost:8888/api/register](http://localhost:8888/api/register) : créée un compte sur l'api
    + contenue du body (format json ou x-www-form-urlencoded)
        >username : \<username>,
        >password : \<password>
+ POST [http://localhost:8888/api/login](http://localhost:8888/api/login) : Renvoie un token d'authentification pour appeler les routes privées de l'api
    + contenue du body (format json ou x-www-form-urlencoded)
        >username : \<username>,
        >password : \<password>
+ GET [http://localhost:8888/api/orders](http://localhost:8888/api/orders) : Affiche toute les commandes
+ GET [http://localhost:8888/api/order/{id}](http://localhost:8888/api/orders) : Affiche une commande en fonction de son id
+ GET [http://localhost:8888/api/products](http://localhost:8888/api/orders) : Affiche toutes les produits
+ GET [http://localhost:8888/api/product/{sku}](http://localhost:8888/api/orders) : Affiche un produit en fonction de son sku

### liste des routes privées

Ces routes nécessitent le header `Authorization` avec le contenue suivant :
    
    Bearer {token}

+ GET [http://localhost:8888/api/renew](http://localhost:8888/api/renew) : Affiche un nouveau token d'authentification
+ GET [http://localhost:8888/api/customers](http://localhost:8888/api/customers) : Affiche tous les acheteurs
+ POST [http://localhost:8888/api/createorder](http://localhost:8888/api/createorder) : Enregistre une nouvelle commande
    + contenue du body (format json)
    > { 
    >    customer : \<customerId>,
    >    products : [ { sku: \<productSku>, quantity: \<quantity> } ]
    > }
+ POST [http://localhost:8888/api/uploadorder](http://localhost:8888/api/uploadorder) : Enregistre toutes les commandes / Produits / Acheteur présent dans le xml
    + contenue du body (format x-www-form-urlencoded)
    > xml : \<xmlFile>

## Outils utilisé

### Front

Pour le front-end j'ai utilisé [VueJS](https://vuejs.org/) et [Bootstrap](https://getbootstrap.com/) Pour la feuille de style.

### Back

Pour le back-end j'ai utilisé [Lumen](https://lumen.laravel.com/), un micro-framework de [Laravel](https://laravel.com/), et une base de donnée sous [MySql](https://www.mysql.com/fr/)