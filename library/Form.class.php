<?php

// abstract est type de classe que l'on ne peut pas instancier directement en objet. On écris abstract devant. Ne sert qu'à l'héritage pour créer d'autres objets à partir d'autres class (auxquelles on rajoutera le contenu de la classe abstraite avec un "extends NomClassAbstract"). Comme ça si on modif qqch dans la classe abstraite ce sera modif pour toutes les class qui s'appuient dessus
abstract class Form
{
    private $errorMessage;

    private $formFields;


    abstract public function build();


    public function __construct()
    { 
        // messages d'erreur, initialisés à null
        $this->errorMessage = null;
        // là où seront stockés les infos rentrées par user
        $this->formFields   = array();
    }

    // pour récup infos rentrées par le user
    protected function addFormField($name, $value = null)
    {
        $this->formFields[$name] = $value;
    }

    public function bind(array $formFields)
    {
        $this->build();

        foreach($formFields as $name => $value)
        {
            if(array_key_exists($name, $this->formFields) == true)
            {
                $this->formFields[$name] = $value;
            }
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getFormFields()
    {
        return $this->formFields;
    }

    public function hasFormFields()
    {
        return empty($this->formFields) == false;
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
}