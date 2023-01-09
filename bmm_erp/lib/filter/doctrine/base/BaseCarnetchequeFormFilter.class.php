<?php

/**
 * Carnetcheque filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCarnetchequeFormFilter extends BaseFormFilterDoctrine {

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
            'refdepart' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'reffin' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'id_banque' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
            'daterecu' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'nbrepapier' => new sfWidgetFormFilterInput(array('with_empty' => false)),
        ));

        $this->setValidators(array(
            'refdepart' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'reffin' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_banque' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
            'daterecu' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'nbrepapier' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('carnetcheque_filters[%s]');
        $this->widgetSchema['id_banque'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Carnetcheque';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'refdepart' => 'Number',
            'reffin' => 'Number',
            'id_banque' => 'ForeignKey',
            'daterecu' => 'Date',
            'nbrepapier' => 'Number',
        );
    }

}
