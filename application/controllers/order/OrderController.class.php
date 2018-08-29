<?php

// Constructeur/classe Reservationontroller
class OrderController
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

        // pour récup les noms des plats on utilise MealModel
        $mealModel = new MealModel();
        // on appelle la méthode listAll contenue dans MealModel maintenant contenu dans $mealModel pour récupérer toute la liste des meals depuis la BDD (voir MealModel.class.php)
        $meals = $mealModel->listAll();
        
        // renvoie tableau associatif (demandé par framework) où associe les valeurs de meals à la clé meals
        return [
            'meals' => $meals 
        ];
    }


    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

        // instancie l'objet OrderModel
        $orderModel = new OrderModel();

        // utilise méthode addOrder (fonction pour envoyer infos du formulaire de commande)
        $orderModel->addOrder(
            // récupère les deux premiers car récup dans variable superglobale $_SESSION
            $_SESSION['user']['UserId'],
            $_SESSION['user']['LastName'],
            $_SESSION['user']['Adress'],
            $_SESSION['user']['City'],
            $_SESSION['user']['ZipCode']
            // récupère le reste depuis les champs du form
        );
        // renvoie à la page home, formule type
        $http->redirectTo('/');
    }
}