<?php

/**
 * Carnetordrepostal filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCarnetordrepostalFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $caissesbanques = Doctrine_Core::getTable('caissesbanques')
                ->createQuery('a')
                ->where('id_typecb=2')
                ->andWhere('id_nature = 1')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($caissesbanques as $req) {
            $choices[$req->getId()] = $req->getLibelle();
        }
        $this->setWidgets(array(
            'refdepart' => new sfWidgetFormFilterInput(),
            'reffin' => new sfWidgetFormFilterInput(),
            'nbrepapier' => new sfWidgetFormFilterInput(),
            'daterecu' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'id_compte' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Caissesbanques'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'refdepart' => new sfValidatorPass(array('required' => false)),
            'reffin' => new sfValidatorPass(array('required' => false)),
            'nbrepapier' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'daterecu' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_compte' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Caissesbanques'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('carnetordrepostal_filters[%s]');
        $this->widgetSchema['id_compte'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Carnetordrepostal';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'refdepart' => 'Text',
            'reffin' => 'Text',
            'nbrepapier' => 'Number',
            'daterecu' => 'Date',
            'id_compte' => 'ForeignKey',
        );
    }

}
