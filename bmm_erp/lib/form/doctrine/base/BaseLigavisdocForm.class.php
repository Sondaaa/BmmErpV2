<?php

/**
 * Ligavisdoc form base class.
 *
 * @method Ligavisdoc getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigavisdocForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_avis'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
      'id_doc'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'datecreation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_ligprotitrub' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'mntdisponible'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_avis'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'column' => 'id', 'required' => false)),
      'id_doc'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'datecreation'    => new sfValidatorDate(array('required' => false)),
      'id_ligprotitrub' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'mntdisponible'   => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligavisdoc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligavisdoc';
  }

}
