<?php

// Constructeur/classe Database pour tout ce qui a rapport à requête SQL
class Database
{
	private $pdo;


	public function __construct()
	{
		$configuration = new Configuration();

		$this->pdo = new PDO
		(
			$configuration->get('database', 'dsn'),
			$configuration->get('database', 'user'),
			$configuration->get('database', 'password')
		);

		$this->pdo->exec('SET NAMES UTF8');
	}

	public function executeSql($sql, array $values = array())
	{
		$query = $this->pdo->prepare($sql);

		$query->execute($values);

		return $this->pdo->lastInsertId();
	}

	// fonction qui va nous permettre de lancer requête SQL simple, on lui passe en paramètre sql, qui contient notre requête SQL (voir MealModel.class.php)
    public function query($sql, array $criteria = array())
    {
    	// stocke dans variable query la préparation de la requête SQL prenant en compte le pdo et pointant sur l'élément sélectionné (this)
        $query = $this->pdo->prepare($sql);

        // on exécute la requête
        $query->execute($criteria);

        // retourne la requête qui contient la formule type pour remplir la variable query avec le contenu complet de la requête (fetAll)
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql, array $criteria = array())
    {
        $query = $this->pdo->prepare($sql);

        $query->execute($criteria);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}