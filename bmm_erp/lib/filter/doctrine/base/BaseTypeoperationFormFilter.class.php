<?php

/**
 * Typeoperation filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeoperationFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $caissesbanques = Doctrine_Core::getTable('caissesbanques')
                ->createQuery('a')
                ->where('id_typecb=2')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($caissesbanques as $req) {
            $choices[$req->getId()] = $req->getLibelle();
        }
        $this->setWidgets(array(
            'libelle' => new sfWidgetFormFilterInput(),
            'valeurop' => new sfWidgetFormFilterInput(),
            'id_banque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'codeop' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'libelle' => new sfValidatorPass(array('required' => false)),
            'valeurop' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_banque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'codeop' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('typeoperation_filters[%s]');
        $this->widgetSchema['id_banque'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Typeoperation';
    }

    public function getFields() {
        return array(
            'libelle' => 'Text',
            'id' => 'Number',
            'valeurop' => 'Number',
            'id_banque' => 'ForeignKey',
        );
    }

}
