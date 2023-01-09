<?php

/**
 * Immobilisation form base class.
 *
 * @method Immobilisation getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseImmobilisationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'numero'                 => new sfWidgetFormInputText(),
      'reference'              => new sfWidgetFormTextarea(),
      'refcodeabarre'          => new sfWidgetFormInputText(array(), array('readOnly' => 'readOnly')),          
      'datecreation'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datemisajour'           => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_user'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_nature'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Nature'), 'add_empty' => true)),
      'id_fabricant'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'add_empty' => true)),
      'designation'            => new sfWidgetFormTextarea(),
      'id_marque'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marqueimmobilisation'), 'add_empty' => true)),
      'id_type'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeimmobilsation'), 'add_empty' => true)),
      'id_fournisseur'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'numerofacture'          => new sfWidgetFormTextarea(),
      'dateacquisition'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'prixhtva'               => new sfWidgetFormInputText(),
      'description'            => new sfWidgetFormTextarea(),
      'tva'                    => new sfWidgetFormInputText(),
      'mntttc'                 => new sfWidgetFormInputText(),
      'duree'                  => new sfWidgetFormInputText(),
      'numeropiece'            => new sfWidgetFormInputText(),
      'typepiece'              => new sfWidgetFormInputText(),
      'id_categorie'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'add_empty' => true)),
      'id_famille'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'add_empty' => true)),
      'id_sousfamille'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamille'), 'add_empty' => true)),
      'id_pays'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'add_empty' => true)),
      'id_gouvernera'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'add_empty' => true)),
      'id_site'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'add_empty' => true)),
      'id_etage'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'add_empty' => true)),
      'id_bureaux'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
      'id_agent'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'adresse'                => new sfWidgetFormInputText(),
      'comptecomptabel'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'add_empty' => true)),
      'tauxammortisement'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tauxammortisement'), 'add_empty' => true)),
      'modeamortisement'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modeammortisement'), 'add_empty' => true)),
      'sourcefinancement'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesfinancemment'), 'add_empty' => true)),
      'etat'                   => new sfWidgetFormInputText(),
      'datemiseenservice'      => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'datemiseenrebut'        => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'tauxammor2'             => new sfWidgetFormInputText(),
      'id_typeaffectationimmo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'                 => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'reference'              => new sfValidatorString(array('required' => false)),
      'refcodeabarre' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            
      'datecreation'           => new sfValidatorDate(array('required' => false)),
      'datemisajour'           => new sfValidatorDate(array('required' => false)),
      'id_user'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'id_nature'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Nature'), 'column' => 'id', 'required' => false)),
      'id_fabricant'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'column' => 'id', 'required' => false)),
      'designation'            => new sfValidatorString(array('required' => false)),
      'id_marque'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Marqueimmobilisation'), 'column' => 'id', 'required' => false)),
      'id_type'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeimmobilsation'), 'column' => 'id', 'required' => false)),
      'id_fournisseur'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'numerofacture'          => new sfValidatorString(array('required' => false)),
      'dateacquisition'        => new sfValidatorDate(array('required' => false)),
      'prixhtva'               => new sfValidatorNumber(array('required' => false)),
      'description'            => new sfValidatorString(array('required' => false)),
      'tva'                    => new sfValidatorInteger(array('required' => false)),
      'mntttc'                 => new sfValidatorNumber(array('required' => false)),
      'duree'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'numeropiece'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'typepiece'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_categorie'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categoerie'), 'column' => 'id', 'required' => false)),
      'id_famille'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Famille'), 'column' => 'id', 'required' => false)),
      'id_sousfamille'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamille'), 'column' => 'id', 'required' => false)),
      'id_pays'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pays'), 'column' => 'id', 'required' => false)),
      'id_gouvernera'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gouvernera'), 'column' => 'id', 'required' => false)),
      'id_site'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Site'), 'column' => 'id', 'required' => false)),
      'id_etage'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etage'), 'column' => 'id', 'required' => false)),
      'id_bureaux'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id', 'required' => false)),
      'id_agent'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'column' => 'id', 'required' => false)),
      'adresse'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'comptecomptabel'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plancomptable'), 'column' => 'id', 'required' => false)),
      'tauxammortisement'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tauxammortisement'), 'column' => 'id', 'required' => false)),
      'modeamortisement'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Modeammortisement'), 'column' => 'id', 'required' => false)),
      'sourcefinancement'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sourcesfinancemment'), 'column' => 'id', 'required' => false)),
      'etat'                   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'datemiseenservice'      => new sfValidatorDate(array('required' => false)),
      'datemiseenrebut'        => new sfValidatorDate(array('required' => false)),
      'tauxammor2'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'id_typeaffectationimmo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeaffectationimmo'), 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('immobilisation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Immobilisation';
  }

}
