<?php

/**
 * Sousdetailprix filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSousdetailprixFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'designation'   => new sfWidgetFormFilterInput(),
      'id_unite'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'quetiteant'    => new sfWidgetFormFilterInput(),
      'qtemois'       => new sfWidgetFormFilterInput(),
      'qtecumule'     => new sfWidgetFormFilterInput(),
      'prixunitaire'  => new sfWidgetFormFilterInput(),
      'prixthtva'     => new sfWidgetFormFilterInput(),
      'id_detail'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Detailprix'), 'add_empty' => true)),
      'id_sousdetail' => new sfWidgetFormFilterInput(),
      'nordre'        => new sfWidgetFormFilterInput(),
      'ancienqte'     => new sfWidgetFormFilterInput(),
      'typeavenant'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'designation'   => new sfValidatorPass(array('required' => false)),
      'id_unite'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unitemarche'), 'column' => 'id')),
      'quetiteant'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qtemois'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qtecumule'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prixunitaire'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prixthtva'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_detail'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Detailprix'), 'column' => 'id')),
      'id_sousdetail' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nordre'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ancienqte'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'typeavenant'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sousdetailprix_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sousdetailprix';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'designation'   => 'Text',
      'id_unite'      => 'ForeignKey',
      'quetiteant'    => 'Number',
      'qtemois'       => 'Number',
      'qtecumule'     => 'Number',
      'prixunitaire'  => 'Number',
      'prixthtva'     => 'Number',
      'id_detail'     => 'ForeignKey',
      'id_sousdetail' => 'Number',
      'nordre'        => 'Number',
      'ancienqte'     => 'Number',
      'typeavenant'   => 'Text',
    );
  }
}
