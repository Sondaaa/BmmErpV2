<?php

/**
 * Demandedevoirfichieradmin form base class.
 *
 * @method Demandedevoirfichieradmin getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandedevoirfichieradminForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_agents'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'id_service'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'add_empty' => true)),
      'document'           => new sfWidgetFormTextarea(),
      'datedevue'          => new sfWidgetFormInputText(array(), array('type' => 'date')),
      'id_copie'           => new sfWidgetFormInputText(),
      'personne'           =>new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
      'signatureagents'    => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/personnel/' . $this->getObject()->getSignatureagents(),
                'edit_mode' => !$this->isNew(),
                  'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
      'signaturedirecteur' => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                'label' => "Document Attaché",
                // Lien de la photo à afficher
                'file_src' => sfconfig::get('sf_appdir') . 'uploads/personnel/' . $this->getObject()->getSignaturedirecteur(),
                'edit_mode' => !$this->isNew(),
                  'delete_label' => 'Supprimer',
                'is_image' => true), array('style' => 'max-width: 300px; max-height: 50px;')),
			
    	'cheminagents'   => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                        'label'        => "Photo",
                        // Lien de la photo à afficher
                        'file_src'     => sfconfig::get('sf_appdir').'uploads/images/'.$this->getObject()->getCheminagents(),
                        // à vrai
                        'is_image'     => true)),
	  'chemindirecteu'   => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                        'label'        => "Photo",
                        // Lien de la photo à afficher
                        'file_src'     => sfconfig::get('sf_appdir').'uploads/images/'.$this->getObject()->getChemindirecteu(),
                        // à vrai
                        'is_image'     => true)),
    'id_demandeur'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_agents'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
      'id_service'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Servicerh'), 'required' => false)),
      'document'           => new sfValidatorString(array('required' => false)),
      'datedevue'          => new sfValidatorDate(array('required' => false)),
      'id_copie'           => new sfValidatorInteger(array('required' => false)),
      'personne'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
      'signatureagents'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'signaturedirecteur' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
	  'cheminagents'   => new  sfValidatorFile(array('required' => false,'path' => 'uploads/images/', 'mime_types' => 'web_images')), 
	  'chemindirecteu'   => new  sfValidatorFile(array('required' => false,'path' => 'uploads/images/', 'mime_types' => 'web_images')),
    'id_demandeur'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents_3'), 'required' => false)),	  
    ));

    $this->widgetSchema->setNameFormat('demandedevoirfichieradmin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Demandedevoirfichieradmin';
  }

}
