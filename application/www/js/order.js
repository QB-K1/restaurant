// fonction pour récupérer info d'un meal précis quand change produit dans le formulaire de commande
function onChangeLoadMealDetails(e){
	// évite que page se charge quand on clique, évite comportement par défaut dans la page
	e.preventDefault();
	// stocke dans id la valeur de la balise ayant id productOrder (le select des noms de produits dans le formulaire de commande)
	var id = $('#productOrder').val();

	// récupère sous format JSON l'id du produit sélectionné
	$.getJSON(
		// pour compléter l'URL (fonction getRequestUrl et rajoute id du produit sélectionné)
        getRequestUrl() + '/meal?id='+id,
        	// JQuery pour que balance les instructions suivantes si trouve la réponse (infos du produit corrrespondant à l'id) sous forme utilisable, response étant le résultat sous forme de tableau (JSON)
            function(response) {
            	// affiche les infos du produit en console log
                console.log(response);

                // va chercher contenu de balise ayant pour id descriptionOrderArticle (les détails du produit sélectionné) et le vide à chaque fois que change sélection dans le menu déroulant et l'affiche (caché en CSS de base)
                $('#descriptionOrderArticle').empty().show();

                // va écrire HTML à la main pour affichage des détails du produit sélectionné à partir de response
                	// met id à balise image pour la récup dans le recap de la page payment
                $('#descriptionOrderArticle').append($('<img id="photoOrder">').attr('src', getWwwUrl() + '/images/meals/' + response.Photo));

                $('#descriptionOrderArticle').append($('<div>')

                .append($('<p>').append(response.Description))

				.append($('<p>').append('Prix : ').append($('<span id="priceOrder" class="bold">').append(response.SalePrice + ' €'))));
            }
    );
}


//variable nulle pour vider tableau ou l'initialiser
var items = null;


//On éxécute la fonction loadOrder pour charger ce qu'il y a dans le tableau
loadOrder();


// fonction pour charger l'état du panier en cours en passant par le DOM
function loadOrder(){
	// Chargement du panier depuis le DOM storage, où est stocké dans index de "panier" (voir fonction saveOrder)
	items = loadDataFromDomStorage('panier');

	// si l'index order est null, donc panier vide
	if(items == null)
    {	
    	// créé tableau vide
        items =[];

    // si la longueur du tableau contenant les produits est de 0
    } else if (items.length == 0) {

    	// écris le message suivant en caption du tableau
        $('#tableRecapOrder').empty().append($('<caption class="bold emptyBasket">').append('Votre panier est vide !'));

    } else { 

    	// va écrire à la main la suite par fonction display
    	display();

    	// passe en valeur de la balise ayant id items (input hidden sur page payment) toutes les infos de la commande (la valeur de items) en le passant en string via JSON pour être récup ensuite en PHP
    	$('#items').val(JSON.stringify(items));

    	}
}


// fonction pour afficher le contenu du recap avant paiement
function display(){

	// variables pour les montants, initialisés à 0 pour éviter accumulation avec précédente commande
	var totalHT = 0;
    var totalTTC = 0; 

    // vide le contenu du tableau récapitulatif
    $('#tableRecapOrder').empty();

    // envoie tableau avec le contenu (ici thead)
	$('#tableRecapOrder').append($('<thead>').append($('<tr>').append($('<th>').append('Quantité')).append($('<th>').append('Produit')).append($('<th>').append('Prix Unitaire')).append($('<th>').append('Prix Total')).append($('<th>'))));

	// variable pour pas avoir à tout réécrire
	var body = $('#tableRecapOrder').append($('<tbody>'))

	// boucle pour afficher le contenu des produits sélectionnés
	for (var i = 0; i < items.length; i++) {

		// complète tableau (ici tbody) avec le contenu trouvé (détail des produits sélectionnés)
		body.append($('<tr>').attr('id', items[i].mealId).
			append($('<td>').append(items[i].quantity)).
			append($('<td>').append(items[i].name)).
			append($('<td>').append(items[i].salePrice)).
			// calcul pour prix final, en coupant à 2 décimales
			append($('<td>').append((items[i].quantity * items[i].salePrice).toFixed(2) + ' €')).
			// mets en attribut un data-index avec le mealId pour le recup dans les fonctions remove
			append($('<td>').append($('<button id="buttonDeleteProduct" name="buttonDeleteProduct">').attr('data-index', items[i].mealId).append($('<i class="fas fa-trash-alt">')))));

		// passe dans même boucle pour afficher les détails du produit sur la page de paiement récap
		$('#paymentRecap').append($('<tr>').attr('id', items[i].mealId).
			append($('<td>').append($('<img>').attr('src', items[i].url)).append($('<em>').append(items[i].name))).
			append($('<td>').append(items[i].quantity)).
			append($('<td>').append(items[i].salePrice + ' €')).
			// calcul pour prix final, en coupant à 2 décimales
			append($('<td>').append((items[i].quantity * items[i].salePrice).toFixed(2) + ' €')));

		// définit totalHT comme quantity = salePrice et le fait en += car doit refaire le calcul à chaque tour de boucle en prenant en compte le montant précédent
		totalHT += items[i].quantity * items[i].salePrice;
	};

	// calcul pour montant part de TVA, afficher le montant
	partTVA = totalHT * 0.2;

	// définit totalTTC par totalHT = 1.2 car 20% TVA
	totalTTC = totalHT * 1.2;

	// insère dans balise ac id spécifié le texte passé en param
		// en coupant à 2 décimales
	$('#priceHT').text((totalHT).toFixed(2) + ' €');

	$('#partTVA').text((partTVA).toFixed(2) + '€')

    $('#priceTTC').text((totalTTC).toFixed(2) + ' €');

    // stocke dans variable l'id de la balise où on va insérer date de la commandende/aujourd'hui
    $dateOrderRecap = $('#dateOrderRecap');

    // envoie fonction dateNow en lui passant id de la balise
    dateNow($dateOrderRecap);
}


// fonction pour afficher la date de la commandende/aujourd'hui dans une balise
function dateNow(balise) {
	// série de variables pour récup date actuelle sous forme de format exploitable en passant par objet codé en natif Date
    var now = new Date();
    var annee   = now.getFullYear();
	var mois    = now.getMonth() + 1; // +1 car dans tableau part de 0
	var jour    = now.getDate();
	var heure   = now.getHours();
	var minute  = now.getMinutes();
	var seconde = now.getSeconds();
 
	$dateNow = ("Commandé le "+annee+"-"+mois+"-"+jour+" à "+heure+"h "+minute+"mn "+seconde+"s");

	balise.append($dateNow);
}


// fonction pour sauvegarder état du panier
function saveOrder() {
	// Enregistrement du panier dans le DOM storage sous l'index "panier" et avec valeur le recap et spécifié plus haut (avec détails du produit)
	saveDataToDomStorage('panier', items);
}


// fonction qui s'enclenche quand clicke sur l'ajout d'un produit (voir le fichier main)
function onClickAddOrder(e)
{	
	// empêche page de se recharger entièrement quand Ajax interagit
	e.preventDefault();

	// stocke dans variable les pointeurs pour récup valeur des champs du produit
	$productOrder = $('#productOrder').val();
	$productQuantityOrder = $('#productQuantityOrder').val();
	$nameOrder = $('#'+$('#productOrder').val()).text();
	$priceOrder = $('#priceOrder').text();
	$photoOrder = $('#photoOrder').attr('src');

	// si id pas trouvé, donc produit pas sélectionné dans menu déroulant, ou si quantité pas remplie ou si quantité n'est pas un nombre
	if ($productOrder == null) {

		$('#messOrder').empty().append('Veuillez sélectionner un produit !');

	} else if ($productQuantityOrder == 0) {

		$('#mess2Order').show();

	} else if (isNaN($productQuantityOrder)) {

		$('#mess2Order').show();

	} else {
	// fonction addOrder à qui on passe en paramètre les valeurs prises dans les champs du formulaire correspondant aux name spécifiés
		addOrder(
			$productOrder,
	        $productQuantityOrder ,
	        $nameOrder,
	        $priceOrder,
	        $photoOrder  
	    );
	}
}


//fonction pour regrouper infos du produit commandé
function addOrder(mealId, quantity, name, price, photo) {
	// Conversion des valeurs en nombres pour être exploit&es par la suite dans les calculs
	mealId = parseInt(mealId);
	quantity = parseInt(quantity);
	price = parseFloat(price);
	// récupère la photo passée en paramètre paramètre et la stocke en local 
	photoOrder = photo;

	// Sélection du product en les parcourant
	for (var i = 0; i < items.length; i++) {
		// si le mealId du product sélectionné existe déjà dans le panier
		if(items[i].mealId == mealId) {
			// Alors rajoute la quantité sélectionnée par le user
			items[i].quantity += quantity;
			// sauvegarde état du panier
			saveOrder();
			// load panier pour MAJ dans le recap
			loadOrder();
			return;
		}
	}

	// Si produit pas trouvé dans le panier alors est nouveau dans le recap et doit être spécifié
	items.push({
		mealId: mealId,
		quantity: quantity,
		name: name,
		salePrice: price,
		url: photo
	});
	// sauvegarde état du panier
	saveOrder();
	// load panier pour MAJ dans le recap
	loadOrder();
}


// fonction qui s'enclenche quand clicke sur le bouton supprimer un produit (voir le fichier main)
function onClickDeleteOrder(e)
{
	// va chercher valeur d'attribut "data-index" de l'élément sur lequel l'event pointe (donc le bouton sur lequel on clique) qui correspond au meal-Id pour savoir lequel supprimer
	var mealId = $(this).data('index'); 

	// appelle fonction pour supprimer article
	deleteOrder(mealId);

	// empêche page de se recharger entièrement quand Ajax interagit
	e.preventDefault();
}


// fonction pour supprimer article
function deleteOrder(mealId)
{
	console.log('items', items);
	// boucle pour parcourir les éléments du panier 
	for (var i = 0; i < items.length; i++)
	{
		// condition : si le mealId du produit à supprimer correspond au mealId du produit examiné par la boucle
		if (items[i].mealId == mealId)
		{
			console.log(mealId);
			console.log(items[i]);

			// supprime le premier élément de l'index correspondant dans items
			items.splice(i, 1);

			// sauvegarde état du panier
			saveOrder();

			// load panier pour MAJ dans le recap
			loadOrder();

			return;
		}
	}
	return;
}


// fonction qui supprime le contenu du panier et qui renvoie sur page order quand clique sur bouton annuler
function onClickCancelOrder(e) {

	// empêche page de se recharger entièrement quand Ajax interagit
	e.preventDefault();

	// remplace contenu du panier par un tableau vide
	items = [];

	// sauvegarde état du panier
	saveOrder();

	// load panier pour MAJ dans le recap
	loadOrder();

	// reviens sur la page order
	window.location.replace(getRequestUrl() + '/order');
}


//fonction qui efface panier (localstorage) quand clique sur le bouton déconnexion
function onClickEmptyUserBasket(e) {

	// remplace contenu du panier par un tableau vide
	items = [];

	// sauvegarde état du panier
	saveOrder();

	// reviens sur la page home
	window.location.replace(getRequestUrl() + '/');
}