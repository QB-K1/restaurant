<?php

class ValidateController
{
    // fonction qui 
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        //check si bien connecté pour laisser accéder à l'URL de Order (sinon pourrait le rentrer à la main sans être connecté)
            // si le user de la superglobale session est vide
        
        if(empty($_SESSION['user']) == true)
        {
            // Redirige sur page du login : on ne peut pas commander sans être connecté
            $http->redirectTo('/user/login');
        }
        
    }


    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

        // stocke dans variable ce qu'on récupère en POST depuis formulaire page payment dans index 'items' (input caché) où il y a toutes les infos de la commande
        $itemsPHP = json_decode($_POST['items']);

        //test print_r($items);

        // instancie OrderModel dans variable pour accéder à méthode validateOrderId
        $orderModel = new OrderModel();

        // appelle méthode pour récup OrderId et enregistrer commande dans BDD
            // appelle validateOrder qui enregistre détails généraux de la commande dans la BDD et lui passe le User_Id et les produits du panier décodés en JSON (voir plus haut)
        $createOrderId = $orderModel->validateOrder(
                                                $_SESSION['user']['UserId'],
                                                $itemsPHP
                                                    );
    }
}