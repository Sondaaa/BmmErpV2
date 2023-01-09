<?php

/**
 * Famille filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFamilleFormFilter extends BaseFormFilterDoctrine {
    public function setup() {
        $this->setWidgets(array(
                'famille'      => new sfWidgetFormFilterInput(),
                'id_categorie' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'add_empty' => true)),
                'description'  => new sfWidgetFormFilterInput(),
                'id_typefamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typefamille'), 'add_empty' => true)),

        ));

        $this->setValidators(array(
                'famille'      => new sfValidatorPass(array('required' => false)),
                'id_categorie' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categoerie'), 'column' => 'id')),
                'description'  => new sfValidatorPass(array('required' => false)),
                'id_typefamille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typefamille'), 'column' => 'id')),
                
        ));

        $this->widgetSchema->setNameFormat('famille_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Famille';
    }

    public function getFields() {
        return array(
                'id'           => 'Number',
                'famille'      => 'Text',
                'id_categorie' => 'ForeignKey',
                'description'  => 'Text',
        );
    }
}
