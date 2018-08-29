<?php


class PaymentController
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // framework bloque affichage du numéro de commande dans page payment

        // instanciation de OrderModel
        $orderModel = new OrderModel;

        // récupère Id le + grand dans la BDD Orders et le nommme orderId
        $orderId = $orderModel->addNewOrderId();

        // pour gérer cas et récup bonne valeur pour numéroter order en cours
            // si BDD vide alors MaxID est nul
        if ($orderId['MaxID'] == null) {
            // du coup on numérote order 1 car aura Id 1 une fois inscrite dans la BDD
            $orderId['MaxID'] = 1;
        } else {
            // sinon on lui numérote order en prenant le numéro de la pls grande acutelle et lui ajoutant 1 pour inscrire numéro sur page dans le HTML 
                // intval permet de transformer un chiffre récup comme une string en chiffre exploitable dans un calcul
            $orderId['MaxID'] = intval($orderId['MaxID']) + 1;  
        }

        //test
        print_r($orderId['MaxID']);
        
        // renvoie tableau où orderId vaut le numéro déterminé dessus
        return [
            // renvoie tableau associatif (demandé par framework) où associe le MaxId contenu dans orderId à la clé orderId
            'orderId' => $orderId['MaxID']
        ];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    }


    public function httpPostMethod(Http $http)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $hôttp est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}