<?php

// cette classe implémente dans la config InterceptingFilter qui est dans la librairie
	// retourne dès le démarrage du site une variable userSession qui est une instanciation de UserSession qui est contenu dans UserSession.class.php (sert à initialiser $_SESSION, qui est initialisé vide (variable superglobale))
class UserSessionFilter implements InterceptingFilter
{
	public function run(Http $http, array $queryFields, array $formFields)
	{
		return
        [
            'userSession' => new UserSession()
        ];
	}
}
