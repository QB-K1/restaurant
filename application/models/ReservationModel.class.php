<?php

// Constructeur/classe ReservationModel
class ReservationModel 
{
	// fonction pour envoyer infos du formulaire de reservation d'une table
	public function addReservation($user_Id, $user_LastName, $bookingDate, $bookingTime, $numberOfSeats) {
		
		// stocke dans variable l'instanciation de la classe Database dans laquelle il y a tout le processus pour requête SQL, et notamment la fonction query que l'on utilise dessous
			// récupère toutes les méthodes de Database
		$databaseReservation = new Database();

		$sql = 'INSERT INTO 
					booking (User_Id, User_LastName, BookingDate, BookingTime, NumberOfSeats, CreationTimeStamp)
				VALUES 
					(?, ?, ?, ?, ?, NOW())
				';

		// stocke dans variable les éléments que l'on va passer à notre fonction query pour remplacer les ?
			// créé tableau avec les valeurs à passer en paramètres à la fonction suivante
		$values = [
			$user_Id,
			$user_LastName,
			$bookingDate,
			$bookingTime,
			$numberOfSeats, 
			];
		// renvoie résultat de fonction query contenu dans Database.class.php qui sert à lancer une query en auto en lui passant la requête et les remplacements de ? sous forme de tableau pour être exploités par les controllers
		$databaseReservation->executeSql($sql, $values);
	}
}

?>