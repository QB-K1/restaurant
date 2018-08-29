<?php

// Constructeur/classe UserModel
class UserModel 
{
	// fonction pour envoyer infos du formulaire new user dans la BDD, on lui passe en paramètres tous les champs dont elle a besoin
	public function signUp($lastName, $firstName, $DOB, $address, $city, $zipCode, $phone, $email, $password) {
		
		// stocke dans variable l'instanciation de la classe Database dans laquelle il y a tout le processus pour requête SQL, et notamment la fonction query que l'on utilise dessous
			// récupère toutes les méthodes de Database
		$databaseUser = new Database();

		// requête pour identifier user (paramètres sont requête et remplacement du ?)
		$user = $databaseUser->queryOne
        (
            "SELECT Id FROM users WHERE Email = ?", [ $email ]
        );
        
        if(empty($user) == false)  // natif php => message d'erreur
        {
        	// natif pour stopper exécution du code et envoie le message
            throw new DomainException
            (
                "Il existe déjà un compte utilisateur avec cette adresse e-mail"
            );
        }

		$sql = 'INSERT INTO 
					users (LastName, FirstName, DOB, Address, City, ZipCode, Phone, Email, Password, CreationTimeStamp)
				VALUES 
					(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
				';

		// hash les MDP en remplacant les MDP par leur hash en passant par fonction hashPassword (voir plus bas à qui on passe le MDP contenu dans $password) du coup maintenant dans les values on appelle plus $password mais $passwordHash
		$passwordHash = $this->hashPassword($password);

		// stocke dans variable les éléments que l'on va passer à notre fonction query pour remplacer les ?
			// créé tableau avec les valeurs à passer en paramètres à la fonction suivante
		$valuesUser = [
			$lastName,
			$firstName,
			$DOB,
			$address,
			$city, 
			$zipCode,
			$phone, 
			$email, 
			$passwordHash
			];
		// renvoie résultat de fonction query contenu dans Database.class.php qui sert à lancer une query en auto en lui passant la requête et les remplacements de ? sou forme de tableau pour être exploités par UserForm.class.php puis UserController.class.php
		$databaseUser->executeSql($sql, $valuesUser);
	}

	private function hashPassword($password)
	{
	    /*
	    * Génération du sel, nécessite l'extension PHP OpenSSL pour fonctionner.
	    *
	    * openssl_random_pseudo_bytes() va renvoyer n'importe quel type de caractères.
	    * Or le chiffrement en blowfish nécessite un sel avec uniquement les caractères
	    * a-z, A-Z ou 0-9.
	    *
	    * On utilise donc bin2hex() pour convertir en une chaîne hexadécimale le résultat,
	    * qu'on tronque ensuite à 22 caractères pour être sûr d'obtenir la taille
	    * nécessaire pour construire le sel du chiffrement en blowfish.
	    */
	    $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

	    // Voir la documentation de crypt() : http://devdocs.io/php/function.crypt
	    return crypt($password, $salt);
	}

    private function verifyPassword($password, $hashedPassword)
	{
        // Si le mot de passe entré dans le champs par user est le même que la version hachée de la BDD alors renvoie true.
		return crypt($password, $hashedPassword) == $hashedPassword;
	}

	// fonction pour récup infos du formulaire login
	public function signIn($email, $password) {

		// stocke dans variable l'instanciation de la classe Database dans laquelle il y a tout le processus pour requête SQL, et notamment la fonction query que l'on utilise dessous
			// récupère toutes les méthodes de Database
		$databaseLogin = new Database();

		$sql = 'SELECT
					*
				FROM
					users
				WHERE
					Email = ?
				';

		// remplacement pour éviter injections SQL
		$value = [$email];

		// stocke dans user le résultat de la requête SQL (ici toutes les infos)
		$user = $databaseLogin->queryOne($sql, $value);

		// si il n'y a rien dans la variable $user renvoyée correspondant aux infos allant avec l'email rentré)
        if(empty($user) == true)
        {	
        	// natif pour stopper exécution du code et envoie le message
            throw new DomainException
            (
                "Il n'y a pas de compte utilisateur associé à cette adresse email"
            );
        }

		// condition : si le password rentré correspond au password contenu dans $user (qui contient toutes les infos de la BDD pour l'adresse e-mail rentrée) (condition est true)
		if ($this->verifyPassword($password, $user['Password'])) 
		{
			// renvoie $user (qui contient toutes les infos de la BDD pour l'adresse e-mail rentrée)
			return $user;
		// sinon
		} else {	
			// natif pour stopper exécution du code et envoie le message
			throw new DomainException
			(
				'Le mot de passe spécifié est incorrect'
			);
		}
	}
}

?>