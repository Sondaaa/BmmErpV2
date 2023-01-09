<?php

/**
 * Document filter form base class.
 *
 * @package    Commercial
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'           => new sfWidgetFormFilterInput(),
      'totalht'          => new sfWidgetFormFilterInput(),
      'totalttc'         => new sfWidgetFormFilterInput(),
      'id_typedoc'       => new sfWidgetFormFilterInput(),
      'datedoc'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type'=>'date')), 'to_date' => new sfWidgetFormInputText(array('type'=>'date')))),
      'id_user'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
      'id_parent'        => new sfWidgetFormFilterInput(),
      'id_bureau' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'           => new sfValidatorPass(array('required' => false)),
      'totalht'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalttc'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_typedoc'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedoc'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_user'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
      'id_parent'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_bureau' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('document_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'numero'           => 'Text',
      'totalht'          => 'Number',
      'totalttc'         => 'Number',
      'id_typedoc'       => 'Number',
      'datedoc'          => 'Date',
      'id_user'          => 'ForeignKey',
      'id_parent'        => 'Number',
      'id_bureau' => 'ForeignKey',
    );
  }
}
