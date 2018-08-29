<?php

// Constructeur/classe MealModel
class MealModel 
{
	// fonction pour récupérer toute la liste des meals depuis la BDD
	public function listAll() {
		// instanciation de constructeur Database (contenu dans Database.class.php) pour création d'objet contenu dans la variable database
    	$database = new Database();
    	// stocke dans variable sql la requête SQL qui va servir à récupérer intégralité de la BDD Meal
        $sql = 'SELECT * FROM meal';
        //renvoie la variable database sur laquelle on applique la fonction query (contenu dans constructeur Database) à qui on passe en paramètre notre requête SQL (voir HomeController.class.php pour la suite) 
       	return $database->query($sql);
    }


    // fonction pour trouver les infos d'un meal en particulier en lui passant le mealId
    public function findMeal($mealId)
    {
    	// instancie Database
        $database = new Database();

        // requête SQL pour récupérer les infos
        $sql = 'SELECT
                    *
                FROM meal
                WHERE Id = ?';

        // Récupération du produit alimentaire spécifié en évitant injonction SQL
        return $database->queryOne($sql, [$mealId]);
    }


    // fonction pour rajouter un meal depuis l'admin
    public function createMeal($nameNewProduct, $descriptionNewProduct, $photoNewProduct, $initialStockNewProduct, $buyPriceNewProduct, $salePriceNewProduct)
    {
        // requêtes SQL 
        $sql = 'INSERT INTO 
                    meal(
                        Name,
                        Description,
                        Photo,
                        QuantityInStock,
                        BuyPrice,
                        SalePrice
                        ) 
                VALUES (?, ?, ?, ?, ?, ?)';

        // Insertion du produit alimentaire dans la base de données.
        $database = new Database();

        // exécute requête SQL par la méthode executeSql en lui passant les champs remplis par l'utilisateur dans le form de l'admin
        $database->executeSql($sql,
        [
            $nameNewProduct,
            $descriptionNewProduct,
            $photoNewProduct,
            $initialStockNewProduct,
            $buyPriceNewProduct,
            $salePriceNewProduct
        ]);
    }

}

?>