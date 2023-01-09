<?php

/**
 * Documentcontratresiliation form base class.
 *
 * @method Documentcontratresiliation getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentcontratresiliationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'dateresiliation'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'motifresiliattion' => new sfWidgetFormTextarea(),
      'valide_budget'     => new sfWidgetFormInputCheckbox(),
      'id_docachat'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'id_doccontrat'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'montantconsomme'   => new sfWidgetFormInputText(),
      'montantrestant'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dateresiliation'   => new sfValidatorDate(array('required' => false)),
      'id_user'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'required' => false)),
      'motifresiliattion' => new sfValidatorString(array('required' => false)),
      'valide_budget'     => new sfValidatorBoolean(array('required' => false)),
      'id_docachat'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'required' => false)),
      'id_doccontrat'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'required' => false)),
      'montantconsomme'   => new sfValidatorNumber(array('required' => false)),
      'montantrestant'    => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentcontratresiliation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentcontratresiliation';
  }

}
