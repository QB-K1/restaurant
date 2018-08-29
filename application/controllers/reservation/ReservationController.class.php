<?php

// Constructeur/classe Reservationontroller
class ReservationController
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

        //check si bien connecté pour laisser accéder à l'URL de Reservation (sinon pourrait le rentrer à la main sans être connecté)
            // si le user de la superglobale session est vide
        if(empty($_SESSION['user']) == true)
        {
            // Redirige sur page du login : on ne peut pas réserver sans être connecté
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

        // instancie l'objet ReservationModel
        $reservationModel = new ReservationModel();

        // utilise méthode addReservation (fonction pour envoyer infos du formulaire de reservation d'une table)
        $reservationModel->addReservation(
            // récupère les deux premiers car récup dans variable superglobale $_SESSION
            $_SESSION['user']['UserId'],
            $_SESSION['user']['LastName'],
            // récupère le reste depuis les champs du form
            $_POST['yearReservation'].'-'.$_POST['monthReservation'].'-'.$_POST['dayReservation'],
            $_POST['hourReservation'].':'.$_POST['quarterReservation'],
            $_POST['numberOfSeats']
        );
        // renvoie à la page, formule type
        $http->redirectTo('/');
    }
}