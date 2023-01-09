<?php

/**
 * Documentachat form base class.
 *
 * @method Documentachat getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id$
 */
abstract class BaseDocumentachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'numero'                       => new sfWidgetFormInputText(),
      'numerooperation'              => new sfWidgetFormInputText(),
      'valide'                       => new sfWidgetFormInputCheckbox(),
      'reference'                    => new sfWidgetFormInputText(),
      'montantestimatif'             => new sfWidgetFormInputText(),
      'datecreation'                 => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'observation'                  => new sfWidgetFormTextarea(),
      'chemindoc'                    => new sfWidgetFormTextarea(),
      'id_demandeur'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
      'id_typedoc'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
      'id_adresse'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
      'transfertcomptabilite'        => new sfWidgetFormInputCheckbox(),
      'id_lignedirectionsite'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
      'desiegniation'                => new sfWidgetFormInputText(),
      'id_objet'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objectdocument'), 'add_empty' => true)),
      'id_projet'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'mht'                          => new sfWidgetFormInputText(),
      'mnttva'                       => new sfWidgetFormInputText(),
      'id_lignemouvementfacturation' => new sfWidgetFormInputText(),
      'mntttc'                       => new sfWidgetFormInputText(),
      'montanttotlafacture'          => new sfWidgetFormInputText(),
      'etatdocachat'                 => new sfWidgetFormInputText(),
      'id_etatdoc'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'add_empty' => true)),
      'id_docparent'                 => new sfWidgetFormInputText(),
      'id_frs'                       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'id_user'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'delaifrs'                     => new sfWidgetFormInputText(),
      'maxreponsefrs'                => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_note'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Notesbce'), 'add_empty' => true)),
      'datesignature'                => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'mnthtax'                      => new sfWidgetFormInputText(),
      'mntremise'                    => new sfWidgetFormInputText(),
      'mntfodec'                     => new sfWidgetFormInputText(),
      'idmagdepart'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin_13'), 'add_empty' => true)),
      'idmagarrive'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_fils'                      => new sfWidgetFormInputText(),
      'numerodossier'                => new sfWidgetFormInputText(),
      'id_lieu'                      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lieulivraisson'), 'add_empty' => true)),
      'id_contrat'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'id_lignecontrat'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontrat'), 'add_empty' => true)),
      'datevalidebudget'             => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'fodec'                        => new sfWidgetFormInputCheckbox(),
      'droittimbre'                  => new sfWidgetFormTextarea(),
      
      'totalremisevaleur'            => new sfWidgetFormInputText(),
      'totalremisehpour'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numero'                       => new sfValidatorInteger(array('required' => false)),
      'numerooperation'              => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'valide'                       => new sfValidatorBoolean(array('required' => false)),
      'reference'                    => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'montantestimatif'             => new sfValidatorNumber(array('required' => false)),
      'datecreation'                 => new sfValidatorDate(array('required' => false)),
      'observation'                  => new sfValidatorString(array('required' => false)),
      'chemindoc'                    => new sfValidatorString(array('required' => false)),
      'id_demandeur'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'column' => 'id', 'required' => false)),
      'id_typedoc'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'column' => 'id', 'required' => false)),
      'id_adresse'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'column' => 'id', 'required' => false)),
      'transfertcomptabilite'        => new sfValidatorBoolean(array('required' => false)),
      'id_lignedirectionsite'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'column' => 'id', 'required' => false)),
      'desiegniation'                => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_objet'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Objectdocument'), 'column' => 'id', 'required' => false)),
      'id_projet'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'column' => 'id', 'required' => false)),
      'mht'                          => new sfValidatorNumber(array('required' => false)),
      'mnttva'                       => new sfValidatorNumber(array('required' => false)),
      'id_lignemouvementfacturation' => new sfValidatorInteger(array('required' => false)),
      'mntttc'                       => new sfValidatorNumber(array('required' => false)),
      'montanttotlafacture'          => new sfValidatorNumber(array('required' => false)),
      'etatdocachat'                 => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_etatdoc'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'column' => 'id', 'required' => false)),
      'id_docparent'                 => new sfValidatorInteger(array('required' => false)),
      'id_frs'                       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id', 'required' => false)),
      'id_user'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id', 'required' => false)),
      'delaifrs'                     => new sfValidatorInteger(array('required' => false)),
      'maxreponsefrs'                => new sfValidatorDate(array('required' => false)),
      'id_note'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Notesbce'), 'column' => 'id', 'required' => false)),
      'datesignature'                => new sfValidatorDate(array('required' => false)),
      'mnthtax'                      => new sfValidatorNumber(array('required' => false)),
      'mntremise'                    => new sfValidatorNumber(array('required' => false)),
      'mntfodec'                     => new sfValidatorNumber(array('required' => false)),
      'idmagdepart'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin_13'), 'column' => 'id', 'required' => false)),
      'idmagarrive'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'column' => 'id', 'required' => false)),
      'id_fils'                      => new sfValidatorInteger(array('required' => false)),
      'numerodossier'                => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'id_lieu'                      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lieulivraisson'), 'column' => 'id', 'required' => false)),
      'id_contrat'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'column' => 'id', 'required' => false)),
      'id_lignecontrat'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lignecontrat'), 'column' => 'id', 'required' => false)),
      'datevalidebudget'             => new sfValidatorDate(array('required' => false)),
      'fodec'                        => new sfValidatorBoolean(array('required' => false)),
      'droittimbre'                  => new sfValidatorString(array('required' => false)),
      
      'totalremisevaleur'            => new sfValidatorNumber(array('required' => false)),
      'totalremisehpour'             => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('documentachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Documentachat';
  }

}
