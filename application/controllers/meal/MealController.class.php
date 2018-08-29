<?php

// Pour réccupérer infos sur un plat en particulier quand choisi dans commande
class MealController
{
	public function httpGetMethod(Http $http, array $queryFields)
	{
        // si l'id existe dans les champs de la query (correspond bien à Id de la BDD Meals)
        if(array_key_exists('id', $_GET) == true)
        {
        	//ctype_digit — Vérifie qu'une chaîne est un entier
        	if(ctype_digit($_GET['id']) == true)
            {
				// Récupération des informations sur l'aliment.
                $mealModel = new MealModel();
				$meal      = $mealModel->findMeal($_GET['id']);

				// Sérialisation de l'aliment (qui est un tableau PHP) en une chaîne de caractères JSON puis envoi de la réponse HTTP.
				$http->sendJsonResponse($meal);
            }
        }

        // En cas d'erreur, redirection vers la page d'accueil.
        $http->redirectTo('/');
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