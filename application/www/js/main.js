'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

// event listeners
$(function() {
    // event listener qui envoie fonction onChangeLoadMealDetails quand change produit dans le formulaire de commande
	$('#productOrder').on('change', onChangeLoadMealDetails);
    // event listener qui envoie fonction onClickAddOrder quand ajoute produit à son panier
    $(document).on('click','#buttonAddProductOrder', onClickAddOrder);
    // event listener qui envoie fonction onClickDeleteOrder quand supprime produit du panier
    $(document).on('click','#buttonDeleteProduct', onClickDeleteOrder);
    // event listener qui lance fonction onClickCancelOrder quand annulle commande sur le recap paiement
    $(document).on('click','#buttonCancelOrder', onClickCancelOrder);
    // fonction qui efface panier (localstorage) quand clique sur le bouton déconnexion 
    $(document).on('click','#buttonSignOut', onClickEmptyUserBasket);
})

