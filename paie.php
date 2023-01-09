<?php


require_once(dirname(__FILE__).'/bmm_erp/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('paie', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
