<?php

/**
 * Lignedossierfournisseur form base class.
 *
 * @method Lignedossierfournisseur getObject() Returns the current form's model object
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLignedossierfournisseurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'nordre'        => new sfWidgetFormInputText(),
      'name'          =>  new sfWidgetFormInputText(),
      'url'           =>  new sfWidgetFormInputFileEditable(array(
        // Label qui sera affiché
        'label' => "Document Attaché",
        // Lien de la photo à afficher
        'file_src' => sfconfig::get('sf_appdir') . 'uploads/scanner/' . $this->getObject()->getUrl(),
        'edit_mode' => !$this->isNew(),
        'delete_label' => 'Supprimer',
        'is_image' => true
    ), array('style' => 'max-width: 500px; max-height: 500px;')),
      'objet'         => new sfWidgetFormTextarea(),
      'sujet'         => new sfWidgetFormTextarea(),
      'id_dossierfrs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierfourniseur'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nordre'        => new sfValidatorInteger(array('required' => false)),
      'name'          => new sfValidatorString(array('required' => false)),
      'url'           => new sfValidatorString(array('required' => false)),
      'objet'         => new sfValidatorString(array('required' => false)),
      'sujet'         => new sfValidatorString(array('required' => false)),
      'id_dossierfrs' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Dossierfourniseur'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lignedossierfournisseur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedossierfournisseur';
  }

}
