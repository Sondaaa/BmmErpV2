<?php

/**
 * Ordredeservice filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrdredeserviceFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'referece' => new sfWidgetFormFilterInput(),
            'object' => new sfWidgetFormFilterInput(),
            'description' => new sfWidgetFormFilterInput(),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeios'), 'add_empty' => true)),
            'dateios' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_benificaire' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lots'), 'add_empty' => true)),
            'delaios' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'referece' => new sfValidatorPass(array('required' => false)),
            'object' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeios'), 'column' => 'id')),
            'dateios' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_benificaire' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lots'), 'column' => 'id')),
            'delaios' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('ordredeservice_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Ordredeservice';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'referece' => 'Text',
            'object' => 'Text',
            'description' => 'Text',
            'id_type' => 'ForeignKey',
            'dateios' => 'Date',
            'id_benificaire' => 'ForeignKey',
        );
    }

}
