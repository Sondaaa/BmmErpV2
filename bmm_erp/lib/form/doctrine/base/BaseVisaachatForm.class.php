<?php

/**
 * Visaachat form base class.
 *
 * @method Visaachat getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVisaachatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'chemin'   => new sfWidgetFormInputFileEditable(array(
                // Label qui sera affiché
                        'label'        => "Photo",
                        // Lien de la photo à afficher
                        'file_src'     => sfconfig::get('sf_appdir').'uploads/images/'.$this->getObject()->getChemin(),
                        // à vrai
                        'is_image'     => true)),
      'libelle'  => new sfWidgetFormInputText(),
     'id_agent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
    
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'chemin'   => new  sfValidatorFile(array('required' => false,'path' => 'uploads/images/', 'mime_types' => 'web_images')),
      'libelle'  => new sfValidatorString(array('max_length' => 254, 'required' => false)),
      'id_agent' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('visaachat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Visaachat';
  }

}
