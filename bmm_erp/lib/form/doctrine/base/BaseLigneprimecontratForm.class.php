<?php

/**
 * Ligneprimecontrat form base class.
 *
 * @method Ligneprimecontrat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneprimecontratForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'id_agents'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_prime'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Primes'), 'add_empty' => true)),
      'libelle'                   => new sfWidgetFormInputText(),
      'id_contrat'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'add_empty' => true)),
      'nordre'                    => new sfWidgetFormInputText(),
      'datedebutvalidemodifprime' => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefinvalidemodifiprime'  => new sfWidgetFormInputText(array(), array('type' => 'date')),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'id_prime'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Primes'), 'column' => 'id', 'required' => false)),
      'libelle'                   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'id_contrat'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contrat'), 'column' => 'id', 'required' => false)),
      'nordre'                    => new sfValidatorInteger(array('required' => false)),
      'datedebutvalidemodifprime' => new sfValidatorDate(array('required' => false)),
      'datefinvalidemodifiprime'  => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneprimecontrat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneprimecontrat';
  }

}
