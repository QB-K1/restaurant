<?php

/*
 * Library configuration settings.
 */

/*
 * If true, the autoloader won't generate a fatal error if the class cannot
 * be loaded.
 *
 * Other libraries can then install their own autoloaders and try to find
 * the class file to load.
 */
$config['autoload-chain'] = false;

// List of all the intercepting filters classes.
	// donne les classes qui vont tourner dès le chargement de la page (voir UserSession.class.php)
$config['intercepting-filters'] = ['UserSession'];