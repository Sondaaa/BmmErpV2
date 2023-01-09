<?php

/**
 * Sousdetailprix form base class.
 *
 * @method Sousdetailprix getObject() Returns the current form's model object
 *
 * @package    BmmErpTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSousdetailprixForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'designation'   => new sfWidgetFormInputText(),
      'id_unite'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'quetiteant'    => new sfWidgetFormInputText(),
      'qtemois'       => new sfWidgetFormInputText(),
      'qtecumule'     => new sfWidgetFormInputText(),
      'prixunitaire'  => new sfWidgetFormInputText(),
      'prixthtva'     => new sfWidgetFormInputText(),
      'id_detail'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detailprix'), 'add_empty' => true)),
      'id_sousdetail' => new sfWidgetFormInputText(),
      'nordre'        => new sfWidgetFormInputText(),
      'ancienqte'     => new sfWidgetFormInputText(),
      'typeavenant'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'designation'   => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'id_unite'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'required' => false)),
      'quetiteant'    => new sfValidatorNumber(array('required' => false)),
      'qtemois'       => new sfValidatorNumber(array('required' => false)),
      'qtecumule'     => new sfValidatorNumber(array('required' => false)),
      'prixunitaire'  => new sfValidatorNumber(array('required' => false)),
      'prixthtva'     => new sfValidatorNumber(array('required' => false)),
      'id_detail'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Detailprix'), 'required' => false)),
      'id_sousdetail' => new sfValidatorInteger(array('required' => false)),
      'nordre'        => new sfValidatorNumber(array('required' => false)),
      'ancienqte'     => new sfValidatorNumber(array('required' => false)),
      'typeavenant'   => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousdetailprix[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousdetailprix';
  }

}
