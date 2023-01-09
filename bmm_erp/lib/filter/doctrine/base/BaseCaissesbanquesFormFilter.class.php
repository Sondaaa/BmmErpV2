<?php

/**
 * Caissesbanques filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCaissesbanquesFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
      
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'codecb' => new sfWidgetFormFilterInput(),
            'referencecb' => new sfWidgetFormFilterInput(),
            'mntouverture' => new sfWidgetFormFilterInput(),
            'mntprov' => new sfWidgetFormFilterInput(),
            'mntdefini' => new sfWidgetFormFilterInput(),
            'dateouvert' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'rib' => new sfWidgetFormFilterInput(),
            'description' => new sfWidgetFormFilterInput(),
            'adresse' => new sfWidgetFormFilterInput(),
            'id_typecb' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecaisse'), 'add_empty' => true)),
            'libellebanque' => new sfWidgetFormFilterInput(),
            'id_nature' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
            'iban' => new sfWidgetFormFilterInput(),
            'codebic' => new sfWidgetFormFilterInput(),
            'id_devise' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'codecb' => new sfValidatorPass(array('required' => false)),
            'referencecb' => new sfValidatorPass(array('required' => false)),
            'mntouverture' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mntprov' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mntdefini' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'dateouvert' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'rib' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'adresse' => new sfValidatorPass(array('required' => false)),
            'id_typecb' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecaisse'), 'column' => 'id')),
            'libellebanque' => new sfValidatorPass(array('required' => false)),
            'id_nature' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id')),
            'iban' => new sfValidatorPass(array('required' => false)),
            'codebic' => new sfValidatorPass(array('required' => false)),
            'id_devise' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Devise'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('caissesbanques_filters[%s]');
       
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Caissesbanques';
    }

    public function getFields() {
        return array(
            'libelle' => 'Text',
            'codecb' => 'Text',
            'referencecb' => 'Text',
            'mntouverture' => 'Number',
            'mntprov' => 'Number',
            'mntdefini' => 'Number',
            'dateouvert' => 'Date',
            'rib' => 'Text',
            'description' => 'Text',
            'adresse' => 'Text',
            'id_typecb' => 'ForeignKey',
            'libellebanque' => 'Text',
            'id' => 'Number',
            'id_nature' => 'ForeignKey',
            'iban' => 'Text',
            'codebic' => 'Text',
            'id_devise' => 'ForeignKey',
        );
    }

}
