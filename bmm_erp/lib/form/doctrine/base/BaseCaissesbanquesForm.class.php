<?php

/**
 * Caissesbanques form base class.
 *
 * @method Caissesbanques getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseCaissesbanquesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle'          => new sfWidgetFormInputText(),
      'codecb'           => new sfWidgetFormInputText(),
      'referencecb'      => new sfWidgetFormInputText(),
      'mntouverture'     => new sfWidgetFormInputText(),
      'mntprov'          => new sfWidgetFormInputText(),
      'mntdefini'        => new sfWidgetFormInputText(),
      'dateouvert'       => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'rib'              => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'adresse'          => new sfWidgetFormInputText(),
      'id_typecb'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecaisse'), 'add_empty' => true)),
      'libellebanque'    => new sfWidgetFormInputText(),
      'id'               => new sfWidgetFormInputHidden(),
      'id_nature'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'add_empty' => true)),
      'iban'             => new sfWidgetFormInputText(),
      'codebic'          => new sfWidgetFormInputText(),
      'id_devise'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'add_empty' => true)),
      'id_plancomptable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'id_dossier'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'libelle'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'codecb'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'referencecb'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'mntouverture'     => new sfValidatorNumber(array('required' => false)),
      'mntprov'          => new sfValidatorNumber(array('required' => false)),
      'mntdefini'        => new sfValidatorNumber(array('required' => false)),
      'dateouvert'       => new sfValidatorDate(array('required' => false)),
      'rib'              => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'adresse'          => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_typecb'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typecaisse'), 'column' => 'id', 'required' => false)),
      'libellebanque'    => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_nature'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebanque'), 'column' => 'id', 'required' => false)),
      'iban'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'codebic'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'id_devise'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Devise'), 'column' => 'id', 'required' => false)),
      'id_plancomptable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'id_dossier'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossiercomptable'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('caissesbanques[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caissesbanques';
  }

}
