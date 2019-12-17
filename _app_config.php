<?php
/**
 * @package REFECONTROL
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
	'GET:Aluno' => array('route' =>'Aluno.Main'),		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Administrador
	'GET:administradors' => array('route' => 'Administrador.ListView'),
	'GET:administrador/(:num)' => array('route' => 'Administrador.SingleView', 'params' => array('idroot' => 1)),
	'GET:api/administradors' => array('route' => 'Administrador.Query'),
	'POST:api/administrador' => array('route' => 'Administrador.Create'),
	'GET:api/administrador/(:num)' => array('route' => 'Administrador.Read', 'params' => array('idroot' => 2)),
	'PUT:api/administrador/(:num)' => array('route' => 'Administrador.Update', 'params' => array('idroot' => 2)),
	'DELETE:api/administrador/(:num)' => array('route' => 'Administrador.Delete', 'params' => array('idroot' => 2)),
		
	// Aluno
	'GET:alunos' => array('route' => 'Aluno.ListView'),
	'GET:aluno/(:num)' => array('route' => 'Aluno.SingleView', 'params' => array('idaluno' => 1)),
	'GET:api/alunos' => array('route' => 'Aluno.Query'),
	'POST:api/aluno' => array('route' => 'Aluno.Create'),
	'GET:api/aluno/(:num)' => array('route' => 'Aluno.Read', 'params' => array('idaluno' => 2)),
	'PUT:api/aluno/(:num)' => array('route' => 'Aluno.Update', 'params' => array('idaluno' => 2)),
	'DELETE:api/aluno/(:num)' => array('route' => 'Aluno.Delete', 'params' => array('idaluno' => 2)),
		
	// Cardapio
	'GET:cardapios' => array('route' => 'Cardapio.ListView'),
	'GET:cardapio/(:num)' => array('route' => 'Cardapio.SingleView', 'params' => array('idcardapio' => 1)),
	'GET:api/cardapios' => array('route' => 'Cardapio.Query'),
	'POST:api/cardapio' => array('route' => 'Cardapio.Create'),
	'GET:api/cardapio/(:num)' => array('route' => 'Cardapio.Read', 'params' => array('idcardapio' => 2)),
	'PUT:api/cardapio/(:num)' => array('route' => 'Cardapio.Update', 'params' => array('idcardapio' => 2)),
	'DELETE:api/cardapio/(:num)' => array('route' => 'Cardapio.Delete', 'params' => array('idcardapio' => 2)),
		
	// Ficha
	'GET:fichas' => array('route' => 'Ficha.ListView'),
	'GET:ficha/(:num)' => array('route' => 'Ficha.SingleView', 'params' => array('idficha' => 1)),
	'GET:api/fichas' => array('route' => 'Ficha.Query'),
	'POST:api/ficha' => array('route' => 'Ficha.Create'),
	'GET:api/ficha/(:num)' => array('route' => 'Ficha.Read', 'params' => array('idficha' => 2)),
	'PUT:api/ficha/(:num)' => array('route' => 'Ficha.Update', 'params' => array('idficha' => 2)),
	'DELETE:api/ficha/(:num)' => array('route' => 'Ficha.Delete', 'params' => array('idficha' => 2)),
		
	// Reserva
	'GET:reservas' => array('route' => 'Reserva.ListView'),
	'GET:reserva/(:num)' => array('route' => 'Reserva.SingleView', 'params' => array('idreserva' => 1)),
	'GET:api/reservas' => array('route' => 'Reserva.Query'),
	'POST:api/reserva' => array('route' => 'Reserva.Create'),
	'GET:api/reserva/(:num)' => array('route' => 'Reserva.Read', 'params' => array('idreserva' => 2)),
	'PUT:api/reserva/(:num)' => array('route' => 'Reserva.Update', 'params' => array('idreserva' => 2)),
	'DELETE:api/reserva/(:num)' => array('route' => 'Reserva.Delete', 'params' => array('idreserva' => 2)),
		
	// Semana
	'GET:semanas' => array('route' => 'Semana.ListView'),
	'GET:semana/(:num)' => array('route' => 'Semana.SingleView', 'params' => array('idsemana' => 1)),
	'GET:api/semanas' => array('route' => 'Semana.Query'),
	'POST:api/semana' => array('route' => 'Semana.Create'),
	'GET:api/semana/(:num)' => array('route' => 'Semana.Read', 'params' => array('idsemana' => 2)),
	'PUT:api/semana/(:num)' => array('route' => 'Semana.Update', 'params' => array('idsemana' => 2)),
	'DELETE:api/semana/(:num)' => array('route' => 'Semana.Delete', 'params' => array('idsemana' => 2)),
		
	// Turma
	'GET:turmas' => array('route' => 'Turma.ListView'),
	'GET:turma/(:num)' => array('route' => 'Turma.SingleView', 'params' => array('idturma' => 1)),
	'GET:api/turmas' => array('route' => 'Turma.Query'),
	'POST:api/turma' => array('route' => 'Turma.Create'),
	'GET:api/turma/(:num)' => array('route' => 'Turma.Read', 'params' => array('idturma' => 2)),
	'PUT:api/turma/(:num)' => array('route' => 'Turma.Update', 'params' => array('idturma' => 2)),
	'DELETE:api/turma/(:num)' => array('route' => 'Turma.Delete', 'params' => array('idturma' => 2)),
		
	// Turno
	'GET:turnos' => array('route' => 'Turno.ListView'),
	'GET:turno/(:num)' => array('route' => 'Turno.SingleView', 'params' => array('idturno' => 1)),
	'GET:api/turnos' => array('route' => 'Turno.Query'),
	'POST:api/turno' => array('route' => 'Turno.Create'),
	'GET:api/turno/(:num)' => array('route' => 'Turno.Read', 'params' => array('idturno' => 2)),
	'PUT:api/turno/(:num)' => array('route' => 'Turno.Update', 'params' => array('idturno' => 2)),
	'DELETE:api/turno/(:num)' => array('route' => 'Turno.Delete', 'params' => array('idturno' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Aluno","aluno_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Turma","turma_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Turno","turno_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>