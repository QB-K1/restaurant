<?php

// Constructeur/classe OrderModel
class OrderModel 
{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // framework bloque affichage du numéro de commande dans page payment

	// fonction pour récupérer id le plus grand de la table des commandes pour savoir numéro de commande (correspond à l'id dans la BDD)
	public function addNewOrderId() {
		// instanciation de constructeur Database (contenu dans Database.class.php) pour création d'objet contenu dans la variable database
    	$database = new Database();
    	
    	// stocke dans variable sql la requête SQL
        $sql = 'SELECT 
        			MAX(Id) 
        		AS 
        			MaxID 
        		FROM 
        			`orders`
        		';

        //renvoie la variable database sur laquelle on applique la fonction query (contenu dans constructeur Database) à qui on passe en paramètre notre requête SQL (voir HomeController.class.php pour la suite) 
       	return $database->query($sql);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // fonction pour rentrer dans BDD la commande
    public function validateOrder($userId, $items) {
        // instanciation de constructeur Database (contenu dans Database.class.php) pour création d'objet contenu dans la variable database
        $database = new Database();

        // stocke dans variable sql la requête SQL pour rentrer infos générales de la commande
        $sql = 'INSERT INTO
                     orders
                     (
                        User_Id, 
                        TaxRate, 
                        CreationTimeStamp
                     )
                VALUES
                    (?, ?, NOW())
                ';

        // valeurs pour remplacer les ? pour éviter injections SQL
        $values = [
            $userId,
            20
        ];

        //enregistre résultat de l'exécution de la requête comme numéro de commande - variable database sur laquelle on applique la fonction executeSql (contenu dans constructeur Database) à qui on passe en paramètre notre requête SQL (voir HomeController.class.php pour la suite) et lezs values à remplacer pour éviter injections 
        $orderId = $database->executeSql($sql, $values);


        // stocke dans variable sql la requête SQL pour rentrer infos spécifiques de la commande
        $sql2 = 'INSERT INTO
                    orderline
                    (
                        Order_Id,
                        Meal_Id, 
                        QuantityOrdered, 
                        PriceEach
                    )
                VALUES
                    (?, ?, ?, ?)
                ';

        // Initialisation du montant total HT à 0
        $totalAmount = 0;

        //foreach pour insérer les détails de la commande
        foreach($items as $item)
        {
            // Ajout du montant HT du produit sur lequel boucle au montant total HT du panier
                // flèche car fait classe d'objet par le JSON et non un tableau associatif
            $totalAmount += $item->quantity * $item->salePrice;

            // valeurs pour remplacer les ? pour éviter injections SQL
            $values2 = [
                $orderId,
                $item->mealId,
                $item->quantity,
                $item->salePrice
            ];
            // exécution de requête SQL 2 à chaque boucle for
            $database->executeSql($sql2, $values2);
        }

        // stocke dans variable sql la requête SQL pour rentrer update infos générales de la commande
        $sql3 = 'UPDATE 
                    orders
                SET 
                    TotalAmount       = ?,
                    TaxAmount         = ? * TaxRate / 100,
                    CompleteTimestamp = NOW()
                WHERE 
                    Id = ?';

        // valeurs pour remplacer les ? pour éviter injections SQL
        $values3 = [
            $totalAmount,
            $totalAmount,
            $orderId
        ];

        // / exécution de requête SQL 3
        $database->executeSql($sql3, $values3);


        // renvoie le numéro de commande
        return $orderId;
    }
}

?>