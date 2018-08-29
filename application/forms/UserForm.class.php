<?php

//Class pour récup infos formulaires de création User
	// extends pour hériter des méthodes de la classe abstraite Form
class UserForm extends Form {

	// récup fonction build héritée de class Form
	public function build() {
		// récup values des champs du formulaire qui ont les "name" spécifiés en appelant fonction addFormField héritée des méthodes de la classe abstraite Form
    	$this->addFormField('lastName');
       	$this->addFormField('firstName');
        $this->addFormField('address');
        $this->addFormField('city');
        $this->addFormField('zipCode');
        $this->addFormField('phone');
        $this->addFormField('email'); 
	}

}

?>