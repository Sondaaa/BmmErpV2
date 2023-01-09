<?php

/**
 * Article form base class.
 *
 * @method Article getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseArticleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'datecreation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'numero'          => new sfWidgetFormInputText(),
      'id_user'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'codeart'         => new sfWidgetFormInputText(),
      'designation'     => new sfWidgetFormInputText(),
      'id_unite'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'id_typestock'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typearticle'), 'add_empty' => true)),
      'id_famille'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'add_empty' => true)),
      'codefamille'     => new sfWidgetFormInputText(),
      'stockmin'        => new sfWidgetFormInputText(),
      'stocksecurite'   => new sfWidgetFormInputText(),
      'stockalert'      => new sfWidgetFormInputText(),
      'stockmax'        => new sfWidgetFormInputText(),
      'codeabc'         => new sfWidgetFormInputText(),
      'id_modele'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modeleapro'), 'add_empty' => true)),
      'delai'           => new sfWidgetFormInputText(),
      'blocappro'       => new sfWidgetFormInputText(),
      'comptegenerale'  => new sfWidgetFormInputText(),
      'id_methode'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Methodevalorisation'), 'add_empty' => true)),
      'stockreel'       => new sfWidgetFormInputText(),
      'stockreelvaleur' => new sfWidgetFormInputText(),
      'enlinstance'     => new sfWidgetFormInputText(),
      'senqteenle'      => new sfWidgetFormInputText(),
      'id_fabriquant'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'add_empty' => true)),
      'aht'             => new sfWidgetFormInputText(),
      'id_tva'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'attc'            => new sfWidgetFormInputText(),
      'qtetheorique'    => new sfWidgetFormInputText(),
      'id_sousfamille'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamillearticle'), 'add_empty' => true)),
      'codesf'          => new sfWidgetFormInputText(),
      'id_nature'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturearticle'), 'add_empty' => true)),
      'codenature'      => new sfWidgetFormInputText(),
      'pamp'            => new sfWidgetFormInputText(),
      'stocable'        => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datecreation'    => new sfValidatorDate(array('required' => false)),
      'numero'          => new sfValidatorInteger(array('required' => false)),
      'id_user'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'codeart'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'designation'     => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_unite'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'column' => 'id', 'required' => false)),
      'id_typestock'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typearticle'), 'column' => 'id', 'required' => false)),
      'id_famille'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'column' => 'id', 'required' => false)),
      'codefamille'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'stockmin'        => new sfValidatorNumber(array('required' => false)),
      'stocksecurite'   => new sfValidatorNumber(array('required' => false)),
      'stockalert'      => new sfValidatorNumber(array('required' => false)),
      'stockmax'        => new sfValidatorNumber(array('required' => false)),
      'codeabc'         => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'id_modele'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modeleapro'), 'column' => 'id', 'required' => false)),
      'delai'           => new sfValidatorNumber(array('required' => false)),
      'blocappro'       => new sfValidatorPass(array('required' => false)),
      'comptegenerale'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'id_methode'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Methodevalorisation'), 'column' => 'id', 'required' => false)),
      'stockreel'       => new sfValidatorNumber(array('required' => false)),
      'stockreelvaleur' => new sfValidatorNumber(array('required' => false)),
      'enlinstance'     => new sfValidatorNumber(array('required' => false)),
      'senqteenle'      => new sfValidatorNumber(array('required' => false)),
      'id_fabriquant'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'column' => 'id', 'required' => false)),
      'aht'             => new sfValidatorNumber(array('required' => false)),
      'id_tva'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'column' => 'id', 'required' => false)),
      'attc'            => new sfValidatorNumber(array('required' => false)),
      'qtetheorique'    => new sfValidatorNumber(array('required' => false)),
      'id_sousfamille'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamillearticle'), 'column' => 'id', 'required' => false)),
      'codesf'          => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id_nature'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturearticle'), 'column' => 'id', 'required' => false)),
      'codenature'      => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'pamp'            => new sfValidatorNumber(array('required' => false)),
      'stocable'        => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('article[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Article';
  }

}
