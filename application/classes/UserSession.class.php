<?php

// cette classe sera appellée non stop, sert à avoir un session_start() sur tout le site ()
	// pour initialiser $_SESSION, qui est initialisé vide (variable superglobale)
class UserSession
{
	public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
            // Démarrage du module PHP de gestion des sessions
			session_start();
		}
	}

	// création d'une session utilisateur et remplissage variable superglobale
    public function create($userId, $firstName, $lastName, $address, $city, $zipCode, $email)
    {
        // Construction de la session utilisateur
        $_SESSION['user'] =
        [
            'UserId'    => $userId,
            'FirstName' => $firstName,
            'LastName'  => $lastName,
            'Address'   => $address,
            'City'      => $city,
            'ZipCode'   => $zipCode,
            'Email'     => $email
        ];

        print_r($_SESSION['user']);
    }

    // pour déconnection d'une session utilisateur
    public function destroy()
    {
        // Destruction de l'ensemble de la session (vide le $_SESSION)
        $_SESSION = array();
        session_destroy();
    }
    
    // récupère nom et prénom du user
    public function getFullName()
    {
        if($this->isAuthenticated() == false)
        {
            return null;
        }

        return $_SESSION['user']['FirstName'].' '.$_SESSION['user']['LastName'];
    }

    // vérifie si user connecté
    public function isAuthenticated()
	{
		// vérifie si il y a bien un user dans variable superglobale
			// renverra true si pas connecté, false si connecté
		if(array_key_exists('user', $_SESSION) == true)
		{
			if(empty($_SESSION['user']) == false)
			{
				return true;
			}
		}

		return false;
	}
}