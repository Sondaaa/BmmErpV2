<?php

/**
 * Bordereauvirement filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBordereauvirementFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_compte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'id_typeoperation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeoperation'), 'add_empty' => true)),
            'id_naturecompte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
            'total' => new sfWidgetFormFilterInput(),
            'id_papierordrepostal' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Papierordrepostal'), 'add_empty' => true)),
            'valide' => new sfWidgetFormChoice(array('choices' => array('' => 'Tout', 1 => 'Validé', 0 => 'Non Validé'))),
        ));

        $this->setValidators(array(
            'date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_compte' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'id_typeoperation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeoperation'), 'column' => 'id')),
            'id_naturecompte' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id')),
            'total' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_papierordrepostal' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Papierordrepostal'), 'column' => 'id')),
            'valide' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('bordereauvirement_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Bordereauvirement';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'date' => 'Date',
            'id_compte' => 'ForeignKey',
            'id_typeoperation' => 'ForeignKey',
            'id_naturecompte' => 'ForeignKey',
            'total' => 'Number',
            'id_papierordrepostal' => 'ForeignKey',
        );
    }

}
