<?php

/**
 * Ligprotitrub form base class.
 *
 * @method Ligprotitrub getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLigprotitrubForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'mnt'            => new sfWidgetFormInputText(),
      'mntengage'      => new sfWidgetFormInputText(),
      'mntdeponser'    => new sfWidgetFormInputText(),
      'relicaengager'  => new sfWidgetFormInputText(),
      'relicadeponser' => new sfWidgetFormInputText(),
      'orderbudget'    => new sfWidgetFormInputText(),
      'nordre'         => new sfWidgetFormInputText(),
      'mntprovisoire'  => new sfWidgetFormInputText(),
      'mntencaisse'    => new sfWidgetFormInputText(),
      'mntredresement' => new sfWidgetFormInputText(),
      'modifseul'      => new sfWidgetFormInputText(),
      'mntexterne' => new sfWidgetFormInputText(),
	    'code'           => new sfWidgetFormInputText(),
		 'mntretire'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_titre'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'required' => false)),
      'mnt'            => new sfValidatorNumber(array('required' => false)),
      'mntengage'      => new sfValidatorNumber(array('required' => false)),
      'mntdeponser'    => new sfValidatorNumber(array('required' => false)),
      'relicaengager'  => new sfValidatorNumber(array('required' => false)),
      'relicadeponser' => new sfValidatorNumber(array('required' => false)),
      'orderbudget'    => new sfValidatorInteger(array('required' => false)),
      'nordre'         => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'mntprovisoire'  => new sfValidatorNumber(array('required' => false)),
      'mntencaisse'    => new sfValidatorNumber(array('required' => false)),
      'mntredresement' => new sfValidatorNumber(array('required' => false)),
      'modifseul'      => new sfValidatorInteger(array('required' => false)),
      'mntexterne' => new sfValidatorNumber(array('required' => false)),
	  'code'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
	   'mntretire'      => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligprotitrub[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligprotitrub';
  }

}
