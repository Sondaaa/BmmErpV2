<?php

/**
 * Ligprotitrub filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigprotitrubFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_titre'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Titrebudjet'), 'add_empty' => true)),
      'id_rubrique'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rubrique'), 'add_empty' => true)),
      'mnt'            => new sfWidgetFormFilterInput(),
      'mntengage'      => new sfWidgetFormFilterInput(),
      'mntdeponser'    => new sfWidgetFormFilterInput(),
      'relicaengager'  => new sfWidgetFormFilterInput(),
      'relicadeponser' => new sfWidgetFormFilterInput(),
      'orderbudget'    => new sfWidgetFormFilterInput(),
      'nordre'         => new sfWidgetFormFilterInput(),
      'mntprovisoire'  => new sfWidgetFormFilterInput(),
      'mntencaisse'    => new sfWidgetFormFilterInput(),
      'mntredresement' => new sfWidgetFormFilterInput(),
      'modifseul'      => new sfWidgetFormFilterInput(),
      'mntexterne' => new sfWidgetFormFilterInput(),
	  'code'           => new sfWidgetFormFilterInput(),
	    'mntretire'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_titre'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Titrebudjet'), 'column' => 'id')),
      'id_rubrique'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rubrique'), 'column' => 'id')),
      'mnt'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntengage'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntdeponser'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'relicaengager'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'relicadeponser' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'orderbudget'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nordre'         => new sfValidatorPass(array('required' => false)),
      'mntprovisoire'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntencaisse'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntredresement' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'modifseul'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mntexterne' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	  'code'           => new sfValidatorPass(array('required' => false)),
	     'mntretire'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ligprotitrub_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ligprotitrub';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_titre'       => 'ForeignKey',
      'id_rubrique'    => 'ForeignKey',
      'mnt'            => 'Number',
      'mntengage'      => 'Number',
      'mntdeponser'    => 'Number',
      'relicaengager'  => 'Number',
      'relicadeponser' => 'Number',
      'orderbudget'    => 'Number',
      'nordre'         => 'Number',
      'mntprovisoire'  => 'Number',
      'mntencaisse'    => 'Number',
      'mntredresement' => 'Number',
      'modifseul'      => 'Number',
    );
  }
}
