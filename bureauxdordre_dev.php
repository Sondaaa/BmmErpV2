<?php

require_once(dirname(__FILE__).'/bmm_erp/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('bureauxdordre', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
