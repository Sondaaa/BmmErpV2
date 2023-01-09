<?php

/**
 * Ligavisdoc filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigavisdocFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $docs = Doctrine_Core::getTable('documentachat')
                ->createQuery('a')
                ->where('id IN (select id_doc from ligavisdoc)')
                ->orderBy('id')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($docs as $doc) {
            $choices[$doc->getId()] = $doc->getTypedoc()->getPrefixetype() . '' . sprintf('%05d', $doc->getNumero());
        }
        $this->setWidgets(array(
            'id_avis' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avis'), 'add_empty' => true)),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_doc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_avis' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avis'), 'column' => 'id')),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_doc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('ligavisdoc_filters[%s]');
        $this->widgetSchema['id_doc'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Ligavisdoc';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'datecreation' => 'Date',
            'id_avis' => 'ForeignKey',
            'id_doc' => 'ForeignKey',
        );
    }

}
