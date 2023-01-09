<?php

/**
 * Ligneplaning form base class.
 *
 * @method Ligneplaning getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseLigneplaningForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nordre'           => new sfWidgetFormInputText(),
      'numtheme'         => new sfWidgetFormInputText(),
      'id_regroupement'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Regroupementtheme'), 'add_empty' => true)),
      'id_sousrubrique'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'add_empty' => true)),
      'montant'          => new sfWidgetFormInputText(),
      'montanttotalht'   => new sfWidgetFormInputText(),
      'id_besoins'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'add_empty' => true)),
      'theme'            => new sfWidgetFormInputText(),
      'valide'           => new sfWidgetFormInputCheckbox(),
      'id_pluning'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'add_empty' => true)),
      'montantttc'       => new sfWidgetFormInputText(),
      'dateformation'    => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefin'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'montantht'        => new sfWidgetFormInputText(),
      'id_formateur'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'add_empty' => true)),
      'id_tva'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'mtva'             => new sfWidgetFormInputText(),
      'nbrjour'          => new sfWidgetFormInputText(),
      'nbrheure'         => new sfWidgetFormInputText(),
      'montantristourne' => new sfWidgetFormInputText(),
      'montantsociete'   => new sfWidgetFormInputText(),
      'mtvafinal'        => new sfWidgetFormInputText(),
      'modalitecalcul'   => new sfWidgetFormInputText(),
      'realise'          => new sfWidgetFormInputCheckbox(),
      'motif'            => new sfWidgetFormInputText(),
      'datedebutprevu'   => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datefinprevu'     => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_fournisseur'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_facture'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nordre'           => new sfValidatorInteger(array('required' => false)),
      'numtheme'         => new sfValidatorInteger(array('required' => false)),
      'id_regroupement'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Regroupementtheme'), 'column' => 'id', 'required' => false)),
      'id_sousrubrique'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousrubrique'), 'column' => 'id', 'required' => false)),
      'montant'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'montanttotalht'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_besoins'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'column' => 'id', 'required' => false)),
      'theme'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'valide'           => new sfValidatorBoolean(array('required' => false)),
      'id_pluning'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Planing'), 'column' => 'id', 'required' => false)),
      'montantttc'       => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'dateformation'    => new sfValidatorDate(array('required' => false)),
      'datefin'          => new sfValidatorDate(array('required' => false)),
      'montantht'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_formateur'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Formateur'), 'column' => 'id', 'required' => false)),
      'id_tva'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'column' => 'id', 'required' => false)),
      'mtva'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nbrjour'          => new sfValidatorInteger(array('required' => false)),
      'nbrheure'         => new sfValidatorInteger(array('required' => false)),
      'montantristourne' => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'montantsociete'   => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'mtvafinal'        => new sfValidatorString(array('max_length' => 55, 'required' => false)),
      'modalitecalcul'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'realise'          => new sfValidatorBoolean(array('required' => false)),
      'motif'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'datedebutprevu'   => new sfValidatorDate(array('required' => false)),
      'datefinprevu'     => new sfValidatorDate(array('required' => false)),
      'id_fournisseur'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'id_facture'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligneplaning[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligneplaning';
  }

}
