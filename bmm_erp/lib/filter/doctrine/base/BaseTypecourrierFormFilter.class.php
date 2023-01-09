<?php

/**
 * Typecourrier filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypecourrierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'type' => new sfWidgetFormFilterInput(),
            'prefix' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'type' => new sfValidatorPass(array('required' => false)),
            'prefix' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('typecourrier_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Typecourrier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'type' => 'Text',
        );
    }

}
