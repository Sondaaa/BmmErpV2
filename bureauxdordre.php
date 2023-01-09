<?php


require_once(dirname(__FILE__).'/bmm_erp/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('bureauxdordre', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
