<?php

/**
 * Lignecontrat form base class.
 *
 * @method Lignecontrat getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignecontratForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'cout'               => new sfWidgetFormInputText(),
      'id_articlestock'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_doc'             => new sfWidgetFormInputText(),
      'mntht'              => new sfWidgetFormInputText(),
      'mnttva'             => new sfWidgetFormInputText(),
      'mntthtva'           => new sfWidgetFormInputText(),
      'mntttc'             => new sfWidgetFormInputText(),
      'impudegt'           => new sfWidgetFormInputText(),
      'codearticle'        => new sfWidgetFormInputText(),
      'designationartcile' => new sfWidgetFormInputText(),
      'id_tva'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'observation'        => new sfWidgetFormTextarea(),
      'punitaire'          => new sfWidgetFormInputText(),
      'qte'                => new sfWidgetFormInputText(),
      'id_mag'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_projet'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_contrat'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'nordre'             => new sfWidgetFormInputText(),
      'unite'              => new sfWidgetFormInputText(),
      'tauxfodec'          => new sfWidgetFormInputText(),
      'fodec'              => new sfWidgetFormInputText(),
      'prixu'              => new sfWidgetFormInputText(),
      'id_unite'           => new sfWidgetFormInputText(),
      'id_tauxfodec'       => new sfWidgetFormInputText(),
      'id_unitemarche'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'id_typepiece'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiececontrat'), 'add_empty' => true)),
      'id_docparent'       => new sfWidgetFormInputText(),
      'tauxpourcentage'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cout'               => new sfValidatorNumber(array('required' => false)),
      'id_articlestock'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'required' => false)),
      'id_doc'             => new sfValidatorInteger(array('required' => false)),
      'mntht'              => new sfValidatorNumber(array('required' => false)),
      'mnttva'             => new sfValidatorNumber(array('required' => false)),
      'mntthtva'           => new sfValidatorNumber(array('required' => false)),
      'mntttc'             => new sfValidatorNumber(array('required' => false)),
      'impudegt'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'codearticle'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'designationartcile' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_tva'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'required' => false)),
      'observation'        => new sfValidatorString(array('required' => false)),
      'punitaire'          => new sfValidatorNumber(array('required' => false)),
      'qte'                => new sfValidatorNumber(array('required' => false)),
      'id_mag'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'required' => false)),
      'id_projet'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'required' => false)),
      'id_contrat'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'required' => false)),
      'nordre'             => new sfValidatorInteger(array('required' => false)),
      'unite'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tauxfodec'          => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'fodec'              => new sfValidatorNumber(array('required' => false)),
      'prixu'              => new sfValidatorNumber(array('required' => false)),
      'id_unite'           => new sfValidatorInteger(array('required' => false)),
      'id_tauxfodec'       => new sfValidatorInteger(array('required' => false)),
      'id_unitemarche'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'required' => false)),
      'id_typepiece'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiececontrat'), 'required' => false)),
      'id_docparent'       => new sfValidatorInteger(array('required' => false)),
      'tauxpourcentage'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignecontrat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecontrat';
  }

}
