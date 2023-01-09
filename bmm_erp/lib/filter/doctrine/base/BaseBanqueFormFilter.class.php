<?php

/**
 * Banque filter form base class.
 *
 * @package    Caisse
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBanqueFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(array('empty_label' => 'vide')),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('banque_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Banque';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'libelle' => 'Text',
        );
    }

}
