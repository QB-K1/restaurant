<?php

// Constructeur/classe HomeController
class LogoutController
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

        // instancie le User Session pour accéder à ses méthodes
        $userSession = new UserSession();

        // appelle méthode destroy pour déconnection d'une session utilisateur (vide le $_SESSION)
        $userSession->destroy();

        // renvoie à la page, formule type
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
