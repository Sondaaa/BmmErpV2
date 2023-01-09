<?php

/*if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')))
{
  die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}*/

require_once(dirname(__FILE__).'/bmm_erp/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('Ressourcehumaine', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

