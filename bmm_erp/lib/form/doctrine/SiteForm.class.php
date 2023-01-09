<?php

/**
 * Site form.
 *
 * @package    Commercial
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SiteForm extends BaseSiteForm {
    public function configure() {
        $adresse=new Adresse();
//        $adresseform=new AdresseForm($adresse);
//        $this->embedForm('adresse', $adresseform);
    
    }
}
