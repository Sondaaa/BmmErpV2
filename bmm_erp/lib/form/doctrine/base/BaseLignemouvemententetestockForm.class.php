<?php

/**
 * Lignemouvemententetestock form base class.
 *
 * @method Lignemouvemententetestock getObject() Returns the current form's model object
 *
 * @package    Bmm
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseLignemouvemententetestockForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_mouvement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvemententetestock'), 'add_empty' => true)),
      'libelle'      => new sfWidgetFormTextarea(),
      'id_article'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'qte_entere'   => new sfWidgetFormInputText(),
      'qte_sortie'   => new sfWidgetFormInputText(),
      'stock_final'  => new sfWidgetFormInputText(),
      'puachat'      => new sfWidgetFormInputText(),
      'cump'         => new sfWidgetFormInputText(),
      'stock_valeur' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormInputText(array(),array('type'=>'date')),
    
     ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_mouvement' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvemententetestock'), 'column' => 'id', 'required' => false)),
      'libelle'      => new sfValidatorString(array('required' => false)),
      'id_article'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'column' => 'id', 'required' => false)),
      'qte_entere'   => new sfValidatorNumber(array('required' => false)),
      'qte_sortie'   => new sfValidatorNumber(array('required' => false)),
      'stock_final'  => new sfValidatorNumber(array('required' => false)),
      'puachat'      => new sfValidatorNumber(array('required' => false)),
      'cump'         => new sfValidatorNumber(array('required' => false)),
      'stock_valeur' => new sfValidatorNumber(array('required' => false)),
      'created_at'          => new sfValidatorDate(array('required' => false)),
    
     ));

    $this->widgetSchema->setNameFormat('lignemouvemententetestock[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemouvemententetestock';
  }

}
