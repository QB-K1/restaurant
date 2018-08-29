<?php

// Pour ajouter un plat sur page admin
class MealController
{
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

        /* $_FILES variable superglobale pour récup fichiers envoyés depuis formulaires sous forme d'array (infos du fichier)
        print_r($_FILES);*/


        // condition pour enregistrer image upload par user dans le form admin
            // vérifie si a upload un fichier par fonction hasUploadedFile contenu dans Http.class.php dans la librairie
        if($http->hasUploadedFile('photoNewProduct') == true) 
        {   
            // fonction préprogrammée pour upload file dans le path spécifié et stocké dans variable
            $photoNewProduct = $http->moveUploadedFile('photoNewProduct', '/images/meals');

        } else {
            // sinon stocke no-photo.png dans la variable pour l'afficher (image de meals toute blanche)
            $photoNewProduct = 'no-photo.png';
        }

        /* test pour afficher les détails du fichier uploadé
        var_dump($photoNewProduct);*/

        // instancie classe MealModel
        $mealModel = new MealModel();

        // appelle méthode createMeal pour créer entrée pour nouveau produit dans la BDD par méthode createMeal de MealModel en lui passant tout ce que le user a rentré dans le formulaire
        $mealModel->createMeal(
                            $_POST['nameNewProduct'],
                            $_POST['descriptionNewProduct'],
                            $photoNewProduct,
                            $_POST['initialStockNewProduct'],
                            $_POST['buyPriceNewProduct'],
                            $_POST['salePriceNewProduct']
                            );

        // redirection à la fin de l'action vers home
            $http->redirectTo('/');
    }
}