<?php

/**
 * Lignedocachat form base class.
 *
 * @method Lignedocachat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLignedocachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'pu'                 => new sfWidgetFormInputText(),
      'duree'              => new sfWidgetFormInputText(),
      'cout'               => new sfWidgetFormInputText(),
      'id_articlestock'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_doc'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'mntht'              => new sfWidgetFormInputText(),
      'mnttva'             => new sfWidgetFormInputText(),
      'mntttc'             => new sfWidgetFormInputText(),
      'impbudget'          => new sfWidgetFormInputText(),
      'codebudget'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_avis'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
      'nordre'             => new sfWidgetFormInputText(),
      'codearticle'        => new sfWidgetFormInputText(),
      'designationarticle' => new sfWidgetFormInputText(),
      'id_projet'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_tva'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'observation'        => new sfWidgetFormTextarea(),
      'pamp'               => new sfWidgetFormInputText(),
      'qte'                => new sfWidgetFormInputText(),
      'id_mag'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_ligneparent'     => new sfWidgetFormInputText(),
      'unitedemander'      => new sfWidgetFormInputText(),
      'id_unitemarche'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'mntfodec'           => new sfWidgetFormInputText(),
      'mntthtva'           => new sfWidgetFormInputText(),
      'id_tauxfodec'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tauxfodec'), 'add_empty' => true)),
      'mntremise'          => new sfWidgetFormInputText(),
      'mnhtaxnet'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'pu'                 => new sfValidatorInteger(array('required' => false)),
      'duree'              => new sfValidatorInteger(array('required' => false)),
      'cout'               => new sfValidatorNumber(array('required' => false)),
      'id_articlestock'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'column' => 'id', 'required' => false)),
      'id_doc'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
      'mntht'              => new sfValidatorNumber(array('required' => false)),
      'mnttva'             => new sfValidatorNumber(array('required' => false)),
      'mntttc'             => new sfValidatorNumber(array('required' => false)),
      'impbudget'          => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'codebudget'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id', 'required' => false)),
      'id_avis'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'column' => 'id', 'required' => false)),
      'nordre'             => new sfValidatorInteger(array('required' => false)),
      'codearticle'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'designationarticle' => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_projet'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'column' => 'id', 'required' => false)),
      'id_tva'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'column' => 'id', 'required' => false)),
      'observation'        => new sfValidatorString(array('required' => false)),
      'pamp'               => new sfValidatorNumber(array('required' => false)),
      'qte'                => new sfValidatorNumber(array('required' => false)),
      'id_mag'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'column' => 'id', 'required' => false)),
      'id_ligneparent'     => new sfValidatorInteger(array('required' => false)),
      'unitedemander'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_unitemarche'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'column' => 'id', 'required' => false)),
      'mntfodec'           => new sfValidatorNumber(array('required' => false)),
      'mntthtva'           => new sfValidatorNumber(array('required' => false)),
      'id_tauxfodec'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tauxfodec'), 'column' => 'id', 'required' => false)),
      'mntremise'          => new sfValidatorNumber(array('required' => false)),
      'mnhtaxnet'          => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignedocachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocachat';
  }

}
