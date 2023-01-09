<?php

/**
 * Parcourcourier filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParcourcourierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
//        $array = array();
//        $array[0] = '';
//        $i = 1;
//        $typecourrier = Doctrine_Core::getTable('typecourrier')->findAll();
//        foreach ($typecourrier as $type) {
//            $array[$type->getId()] = $type;
//        }
//
//        $choices = array();
//        $courriers = Doctrine_Core::getTable('courrier')->findByIdUser($_SESSION['user']->getId());
//        $courriers = Doctrine_Core::getTable('courrier')->findAll();
//        $choices[0] = '';
//
//        foreach ($courriers as $co) {
//            $choices[$co->getId()] = 'Numéro:' . $co->getNumero() . ' Date de création:' . $co->getDatecreation() . ' Object:' . $co->getObject();
//        }

        $this->setWidgets(array(
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'mdreponse' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_exp' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'add_empty' => true)),
            'id_rec' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_4'), 'add_empty' => true)),
            'id_action' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actionparcour'), 'add_empty' => true)),
            'description' => new sfWidgetFormFilterInput(),
            'id_courier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'), 'add_empty' => true)),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'id_typecourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
            'id_famexpdes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'mdreponse' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_exp' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Expdest'), 'column' => 'id')),
            'id_rec' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Expdest_4'), 'column' => 'id')),
            'id_action' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Actionparcour'), 'column' => 'id')),
            'description' => new sfValidatorPass(array('required' => false)),
            'id_courier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Courrier'), 'column' => 'id')),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'id_typecourrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecourrier'), 'column' => 'id')),
            'id_famexpdes' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id')),
        ));
        //$this->widgetSchema['type_courrier'] = new sfWidgetFormChoice(array('choices' => $array));
        $this->widgetSchema->setNameFormat('parcourcourier_filters[%s]');
//        $this->widgetSchema['id_courier'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Parcourcourier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'datecreation' => 'Date',
            'mdreponse' => 'Date',
            'id_exp' => 'ForeignKey',
            'id_rec' => 'ForeignKey',
            'id_action' => 'ForeignKey',
            'description' => 'Text',
            'id_courier' => 'ForeignKey',
            'id_user' => 'ForeignKey',
            'id_courrierdest' => 'ForeignKey',
            'ordredetransfer' => 'Number',
            'id_typecourrier' => 'ForeignKey',
            'id_famexpdes' => 'ForeignKey',
        );
    }

}
