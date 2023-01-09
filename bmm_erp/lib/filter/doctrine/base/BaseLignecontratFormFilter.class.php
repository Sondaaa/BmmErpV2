<?php

/**
 * Lignecontrat filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLignecontratFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cout'               => new sfWidgetFormFilterInput(),
      'id_articlestock'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'id_doc'             => new sfWidgetFormFilterInput(),
      'mntht'              => new sfWidgetFormFilterInput(),
      'mnttva'             => new sfWidgetFormFilterInput(),
      'mntthtva'           => new sfWidgetFormFilterInput(),
      'mntttc'             => new sfWidgetFormFilterInput(),
      'impudegt'           => new sfWidgetFormFilterInput(),
      'codearticle'        => new sfWidgetFormFilterInput(),
      'designationartcile' => new sfWidgetFormFilterInput(),
      'id_tva'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
      'observation'        => new sfWidgetFormFilterInput(),
      'punitaire'          => new sfWidgetFormFilterInput(),
      'qte'                => new sfWidgetFormFilterInput(),
      'id_mag'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Magasin'), 'add_empty' => true)),
      'id_projet'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
      'id_contrat'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contratachat'), 'add_empty' => true)),
      'nordre'             => new sfWidgetFormFilterInput(),
      'unite'              => new sfWidgetFormFilterInput(),
      'tauxfodec'          => new sfWidgetFormFilterInput(),
      'fodec'              => new sfWidgetFormFilterInput(),
      'prixu'              => new sfWidgetFormFilterInput(),
      'id_unite'           => new sfWidgetFormFilterInput(),
      'id_tauxfodec'       => new sfWidgetFormFilterInput(),
      'id_unitemarche'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
      'id_typepiece'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typepiececontrat'), 'add_empty' => true)),
      'id_docparent'       => new sfWidgetFormFilterInput(),
      'tauxpourcentage'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'cout'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_articlestock'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'id_doc'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mntht'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mnttva'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntthtva'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'mntttc'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'impudegt'           => new sfValidatorPass(array('required' => false)),
      'codearticle'        => new sfValidatorPass(array('required' => false)),
      'designationartcile' => new sfValidatorPass(array('required' => false)),
      'id_tva'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
      'observation'        => new sfValidatorPass(array('required' => false)),
      'punitaire'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qte'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_mag'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Magasin'), 'column' => 'id')),
      'id_projet'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
      'id_contrat'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contratachat'), 'column' => 'id')),
      'nordre'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'unite'              => new sfValidatorPass(array('required' => false)),
      'tauxfodec'          => new sfValidatorPass(array('required' => false)),
      'fodec'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prixu'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_unite'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tauxfodec'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_unitemarche'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unitemarche'), 'column' => 'id')),
      'id_typepiece'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typepiececontrat'), 'column' => 'id')),
      'id_docparent'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tauxpourcentage'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignecontrat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignecontrat';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'cout'               => 'Number',
      'id_articlestock'    => 'ForeignKey',
      'id_doc'             => 'Number',
      'mntht'              => 'Number',
      'mnttva'             => 'Number',
      'mntthtva'           => 'Number',
      'mntttc'             => 'Number',
      'impudegt'           => 'Text',
      'codearticle'        => 'Text',
      'designationartcile' => 'Text',
      'id_tva'             => 'ForeignKey',
      'observation'        => 'Text',
      'punitaire'          => 'Number',
      'qte'                => 'Number',
      'id_mag'             => 'ForeignKey',
      'id_projet'          => 'ForeignKey',
      'id_contrat'         => 'ForeignKey',
      'nordre'             => 'Number',
      'unite'              => 'Text',
      'tauxfodec'          => 'Text',
      'fodec'              => 'Number',
      'prixu'              => 'Number',
      'id_unite'           => 'Number',
      'id_tauxfodec'       => 'Number',
      'id_unitemarche'     => 'ForeignKey',
      'id_typepiece'       => 'ForeignKey',
      'id_docparent'       => 'Number',
      'tauxpourcentage'    => 'Number',
    );
  }
}
