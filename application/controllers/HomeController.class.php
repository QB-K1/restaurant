<?php

// Constructeur/classe HomeController
class HomeController
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

        // instanciation de constructeur MealModel(voir MealModel.class.php) pour créer objet mealModel
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
    }
}