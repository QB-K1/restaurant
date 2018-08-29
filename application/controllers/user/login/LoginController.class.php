<?php

// Constructeur/classe HomeController
class LoginController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

        // instancie UserModel.class.php (construire User)
        $databaseLogin = new UserModel();

        // récupère les infos rentrées dans le form du login par ft signIn à qui on passe les string rentrées dans les champs du forme de Login
        $user = $databaseLogin->signIn($_POST['emailLogin'], $_POST['passwordLogin']);
            // affiche pour test les infos récupérées (toutes les infos de la BDD pour l'adresse e-mail rentrée)
            print_r($user);

        // instancie UserSession.class.php (construire session)
        $userSession = new UserSession();

        // lance méthode create de UserSession pour créer variable superglobale contenant les infos du profil (que l'on passe ici en paramètres à la fonction)
        $userSession->create(
            $user['Id'], 
            $user['FirstName'], 
            $user['LastName'], 
            $user['Address'], 
            $user['City'], 
            $user['ZipCode'],
            $user['Email']);

        // renvoie à la page home, formule type pour renvoyer à racine du DOM
        $http->redirectTo('/');
    }
}
