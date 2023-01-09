<?php

/**
 * Historiquemouvement form base class.
 *
 * @method Historiquemouvement getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoriquemouvementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'etatfrs'     => new sfWidgetFormTextarea(),
      'id_frs'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_lignemvt' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'add_empty' => true)),
	   'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'etatfrs'     => new sfValidatorString(array('required' => false)),
      'id_frs'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
      'id_lignemvt' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignemouvementfacturation'), 'required' => false)),
	    'datecreation' => new sfValidatorDate(array('required' => false)),
   
    ));

    $this->widgetSchema->setNameFormat('historiquemouvement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historiquemouvement';
  }

}
