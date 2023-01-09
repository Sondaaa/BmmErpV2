<?php

/**
 * Lignemouvemententetestock filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id$
 */
abstract class BaseLignemouvemententetestockFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_mouvement' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mouvemententetestock'), 'add_empty' => true)),
      'libelle'      => new sfWidgetFormFilterInput(),
      'id_article'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Article'), 'add_empty' => true)),
      'qte_entere'   => new sfWidgetFormFilterInput(),
      'qte_sortie'   => new sfWidgetFormFilterInput(),
      'stock_final'  => new sfWidgetFormFilterInput(),
      'puachat'      => new sfWidgetFormFilterInput(),
      'cump'         => new sfWidgetFormFilterInput(),
      'stock_valeur' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_mouvement' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mouvemententetestock'), 'column' => 'id')),
      'libelle'      => new sfValidatorPass(array('required' => false)),
      'id_article'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Article'), 'column' => 'id')),
      'qte_entere'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'qte_sortie'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stock_final'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'puachat'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cump'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'stock_valeur' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('lignemouvemententetestock_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lignemouvemententetestock';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_mouvement' => 'ForeignKey',
      'libelle'      => 'Text',
      'id_article'   => 'ForeignKey',
      'qte_entere'   => 'Number',
      'qte_sortie'   => 'Number',
      'stock_final'  => 'Number',
      'puachat'      => 'Number',
      'cump'         => 'Number',
      'stock_valeur' => 'Number',
    );
  }
}
