<?php

/**
 * Parametreamortissement filter form base class.
 *
 * @package    Tes
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParametreamortissementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dateamortissement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fontcaractere'     => new sfWidgetFormFilterInput(),
      'taillecaractere'   => new sfWidgetFormFilterInput(),
      'header'            => new sfWidgetFormFilterInput(),
      'footer'            => new sfWidgetFormFilterInput(),
      'heightcode'        => new sfWidgetFormFilterInput(),
      'widthcode'         => new sfWidgetFormFilterInput(),
      'heightticket'      => new sfWidgetFormFilterInput(),
      'widthticket'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dateamortissement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fontcaractere'     => new sfValidatorPass(array('required' => false)),
      'taillecaractere'   => new sfValidatorPass(array('required' => false)),
      'header'            => new sfValidatorPass(array('required' => false)),
      'footer'            => new sfValidatorPass(array('required' => false)),
      'heightcode'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'widthcode'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'heightticket'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'widthticket'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('parametreamortissement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parametreamortissement';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'date'              => 'Date',
      'dateamortissement' => 'Date',
      'fontcaractere'     => 'Text',
      'taillecaractere'   => 'Text',
      'header'            => 'Text',
      'footer'            => 'Text',
      'heightcode'        => 'Number',
      'widthcode'         => 'Number',
      'heightticket'      => 'Number',
      'widthticket'       => 'Number',
    );
  }
}
