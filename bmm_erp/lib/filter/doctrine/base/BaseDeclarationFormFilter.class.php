<?php

/**
 * Declaration filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeclarationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $caissesbanques = Doctrine_Core::getTable('caissesbanques')
                ->createQuery('a')
                ->where('id_typecb=2')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($caissesbanques as $req) {
            $choices[$req->getId()] = $req->getLibelle();
        }
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'datedebut' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'datefin' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'montant' => new sfWidgetFormFilterInput(),
            'etat' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'id_caissebanque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'datedebut' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datefin' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'montant' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'etat' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'id_caissebanque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
        ));

        $this->widgetSchema->setNameFormat('declaration_filters[%s]');
        $this->widgetSchema['id_caissebanque'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Declaration';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'libelle' => 'Text',
            'datedebut' => 'Date',
            'datefin' => 'Date',
            'montant' => 'Number',
            'etat' => 'Boolean',
        );
    }

}
