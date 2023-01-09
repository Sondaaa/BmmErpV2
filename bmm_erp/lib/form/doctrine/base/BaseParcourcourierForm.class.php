<?php

/**
 * Parcourcourier form base class.
 *
 * @method Parcourcourier getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParcourcourierForm extends BaseFormDoctrine {

    public function setup() {
        if ($this->getObject()->isnew()) {
            $date = date('Y-m-d');
            $maxdate = date('Y-m-d');
        } else {
            $date = $this->getObject()->getDatecreation();
            $maxdate = $this->getObject()->getMdreponse();
        }
        $choices = array();
        $courriers = Doctrine_Core::getTable('courrier')->findByIdUser($_SESSION['user']->getId());
        $choices[0] = '';

        foreach ($courriers as $co) {
            $choices[$co->getId()] = ' Numéro:' . $co->getTitre() . '   Date de création:' . $co->getDatecreation() . '   Object:' . $co->getObject();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date', 'value' => $date)),
            'mdreponse' => new sfWidgetFormInputText(array(), array('type' => 'date', 'value' => $maxdate)),
            'id_exp' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'add_empty' => true)),
            'id_rec' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_4'), 'add_empty' => true)),
            'id_action' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actionparcour'), 'add_empty' => true)),
            'id_courier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'),  'add_empty' => true)),
            //  'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'description' => new sfWidgetFormTextarea(),
            'id_courrierdest' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier_6'), 'add_empty' => true)),
            'ordredetransfer' => new sfWidgetFormInputText(),
            'id_typecourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
			  'id_famexpdes'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'datecreation' => new sfValidatorDate(array('required' => false)),
            'mdreponse' => new sfValidatorDate(array('required' => false)),
            'id_exp' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest'), 'required' => false)),
            'id_rec' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Expdest_4'), 'required' => false)),
            'id_action' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Actionparcour'), 'required' => false)),
            'description' => new sfValidatorString(array('required' => false)),
            'id_courier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier'), 'required' => false)),
            'id_user' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
            'id_courrierdest' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Courrier_6'), 'required' => false)),
            'ordredetransfer' => new sfValidatorInteger(array('required' => false)),
            'id_typecourrier' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'required' => false)),
			  'id_famexpdes'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('parcourcourier[%s]');
        $this->widgetSchema['id_courier'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Parcourcourier';
    }

}
