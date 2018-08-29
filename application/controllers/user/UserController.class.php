<?php

// Constructeur/classe HomeController
class UserController
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
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */

        // stocke dans userModel instanciation de UserModel qui lance notre requête SQL
        $userModel = new UserModel();
        // utilise la fonction AddUser de UserModel pour lui envoyer les valeurs du formulaire qui sont contenues dans formFields sous forme de tableau associatif (voir UserForm.class.php) et stockées dans variable newUser
        $userModel->signUp(
            $formFields['lastName'],
            $formFields['firstName'],
            $formFields['year'].'-'.$formFields['month'].'-'.$formFields['day'],
            $formFields['address'],
            $formFields['city'],
            $formFields['zipCode'],
            $formFields['phone'],
            $formFields['email'],
            $formFields['password']
        );

        // renvoie à la page, formule type
        $http->redirectTo('/');

        // raffiche le contenu de variable formFields (voir Form.class.php) (là où seront stockés les infos rentrées par user)
        print_r($formFields);
    }
}
