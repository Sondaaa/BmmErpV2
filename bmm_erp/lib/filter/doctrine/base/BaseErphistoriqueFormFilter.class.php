<?php

/**
 * Erphistorique filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseErphistoriqueFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iduser'       => new sfWidgetFormFilterInput(),
      'userlogin'    => new sfWidgetFormFilterInput(),
      'datemaj'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nametable'    => new sfWidgetFormFilterInput(),
      'idetranger'   => new sfWidgetFormFilterInput(),
      'idhistorique' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'iduser'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'userlogin'    => new sfValidatorPass(array('required' => false)),
      'datemaj'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'nametable'    => new sfValidatorPass(array('required' => false)),
      'idetranger'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idhistorique' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('erphistorique_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Erphistorique';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'iduser'       => 'Number',
      'userlogin'    => 'Text',
      'datemaj'      => 'Date',
      'nametable'    => 'Text',
      'idetranger'   => 'Number',
      'idhistorique' => 'Number',
    );
  }
}
