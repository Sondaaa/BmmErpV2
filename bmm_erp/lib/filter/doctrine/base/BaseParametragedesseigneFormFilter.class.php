<?php

/**
 * Parametragedesseigne filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametragedesseigneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_user'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'couleurfond' => new sfWidgetFormFilterInput(),
      'submenu'     => new sfWidgetFormFilterInput(),
      'sidebar'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_user'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'couleurfond' => new sfValidatorPass(array('required' => false)),
      'submenu'     => new sfValidatorPass(array('required' => false)),
      'sidebar'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('parametragedesseigne_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametragedesseigne';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_user'     => 'ForeignKey',
      'couleurfond' => 'Text',
      'submenu'     => 'Text',
      'sidebar'     => 'Text',
    );
  }
}
