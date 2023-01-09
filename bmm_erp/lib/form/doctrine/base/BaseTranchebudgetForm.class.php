<?php

/**
 * Tranchebudget form base class.
 *
 * @method Tranchebudget getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTranchebudgetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'nordre'                => new sfWidgetFormInputText(),
      'datetranche'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'mntpourcentage'        => new sfWidgetFormInputText(),
      'mntvaleur'             => new sfWidgetFormInputText(),
      'id_titrebudget'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_parametragetranche' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parametragetranche'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nordre'                => new sfValidatorInteger(array('required' => false)),
      'datetranche'           => new sfValidatorDate(array('required' => false)),
      'mntpourcentage'        => new sfValidatorInteger(array('required' => false)),
      'mntvaleur'             => new sfValidatorNumber(array('required' => false)),
      'id_titrebudget'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'required' => false)),
      'id_parametragetranche' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Parametragetranche'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tranchebudget[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tranchebudget';
  }

}
