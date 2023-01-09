<?php


require_once(dirname(__FILE__).'/bmm_erp/config/ProjectConfiguration.class.php');
//test
$configuration = ProjectConfiguration::getApplicationConfiguration('Ressourcehumaine', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
