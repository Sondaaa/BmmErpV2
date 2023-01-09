<?php

/**
 * Lignedocachat filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignedocachatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pu'                 => new sfWidgetFormFilterInput(),
      'duree'              => new sfWidgetFormFilterInput(),
      'cout'               => new sfWidgetFormFilterInput(),
      'id_articlestock'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_doc'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
      'mntht'              => new sfWidgetFormFilterInput(),
      'mnttva'             => new sfWidgetFormFilterInput(),
      'mntttc'             => new sfWidgetFormFilterInput(),
      'impbudget'          => new sfWidgetFormFilterInput(),
      'codebudget'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ligprotitrub'), 'add_empty' => true)),
      'id_avis'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
      'nordre'             => new sfWidgetFormFilterInput(),
      'codearticle'        => new sfWidgetFormFilterInput(),
      'designationarticle' => new sfWidgetFormFilterInput(),
      'id_projet'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_tva'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'observation'        => new sfWidgetFormFilterInput(),
      'pamp'               => new sfWidgetFormFilterInput(),
      'qte'                => new sfWidgetFormFilterInput(),
      'id_mag'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_ligneparent'     => new sfWidgetFormFilterInput(),
        'unitedemander'      => new sfWidgetFormFilterInput(),
		      'mntfodec'           => new sfWidgetFormFilterInput(),
      'mntthtva'           => new sfWidgetFormFilterInput(),
      'id_tauxfodec'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tauxfodec'), 'add_empty' => true)),
	    'mntremise'          => new sfWidgetFormFilterInput(),
		
		  'mnhtaxnet'          => new sfWidgetFormFilterInput(),

    ));

    $this->setValidators(array(
      'pu'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'duree'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cout'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_articlestock'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'id_doc'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
      'mntht'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttva'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntttc'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'impbudget'          => new sfValidatorPass(array('required' => false)),
      'codebudget'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ligprotitrub'), 'column' => 'id')),
      'id_avis'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avis'), 'column' => 'id')),
      'nordre'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codearticle'        => new sfValidatorPass(array('required' => false)),
      'designationarticle' => new sfValidatorPass(array('required' => false)),
      'id_projet'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
      'id_tva'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
      'observation'        => new sfValidatorPass(array('required' => false)),
      'pamp'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qte'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_mag'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
      'id_ligneparent'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
   'unitedemander'      => new sfValidatorPass(array('required' => false)),
        'mntfodec'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntthtva'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_tauxfodec'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tauxfodec'), 'column' => 'id')),
	  'mntremise'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
	   'mnhtaxnet'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
 
        ));

    $this->widgetSchema->setNameFormat('lignedocachat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignedocachat';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'pu'                 => 'Number',
      'duree'              => 'Number',
      'cout'               => 'Number',
      'id_articlestock'    => 'ForeignKey',
      'id_doc'             => 'ForeignKey',
      'mntht'              => 'Number',
      'mnttva'             => 'Number',
      'mntttc'             => 'Number',
      'impbudget'          => 'Text',
      'codebudget'         => 'ForeignKey',
      'id_avis'            => 'ForeignKey',
      'nordre'             => 'Number',
      'codearticle'        => 'Text',
      'designationarticle' => 'Text',
      'id_projet'          => 'ForeignKey',
      'id_tva'             => 'ForeignKey',
      'observation'        => 'Text',
      'pamp'               => 'Number',
      'qte'                => 'Number',
      'id_mag'             => 'ForeignKey',
      'id_ligneparent'     => 'Number',
    );
  }
}
