<?php

/**
 * Avis filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAvisFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'id_poste' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Poste'), 'add_empty' => true)),
            'nordre' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'id_poste' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Poste'), 'column' => 'id')),
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('avis_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Avis';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'libelle' => 'Text',
            'id_poste' => 'ForeignKey',
        );
    }

}
