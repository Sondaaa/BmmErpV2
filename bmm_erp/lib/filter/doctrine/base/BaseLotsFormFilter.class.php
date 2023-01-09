<?php

/**
 * Lots filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLotsFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'nordre' => new sfWidgetFormFilterInput(),
            'objet' => new sfWidgetFormFilterInput(),
            'totalht' => new sfWidgetFormFilterInput(),
            'rrr' => new sfWidgetFormFilterInput(),
            'totalapresrrr' => new sfWidgetFormFilterInput(),
            'id_tva' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
            'tauxtva' => new sfWidgetFormFilterInput(),
            'ttcnet' => new sfWidgetFormFilterInput(),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_marche' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marches'), 'add_empty' => true)),
            'dateoservice' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datereceptionprevesoire' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'delaidexucution' => new sfWidgetFormFilterInput(),
            'periodejustifier' => new sfWidgetFormFilterInput(),
            'delaicontractuelle' => new sfWidgetFormFilterInput(),
            'pireodereelexecution' => new sfWidgetFormFilterInput(),
            'pirioderetard' => new sfWidgetFormFilterInput(),
            'anciendateios' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
          'delaigarantie'           => new sfWidgetFormFilterInput(),
		  
		   'datemaxreponse' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
          
		  ));

        $this->setValidators(array(
            'nordre' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'objet' => new sfValidatorPass(array('required' => false)),
            'totalht' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'rrr' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'totalapresrrr' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_tva' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
            'tauxtva' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'ttcnet' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_frs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'id_marche' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Marches'), 'column' => 'id')),
            'dateoservice' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datereceptionprevesoire' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'delaidexucution' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'periodejustifier' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'delaicontractuelle' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'pireodereelexecution' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'pirioderetard' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'anciendateios' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
         'delaigarantie'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
		 
		  'datemaxreponse' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
		 ));

        $this->widgetSchema->setNameFormat('lots_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Lots';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'nordre' => 'Number',
            'objet' => 'Text',
            'totalht' => 'Number',
            'rrr' => 'Number',
            'totalapresrrr' => 'Number',
            'id_tva' => 'ForeignKey',
            'tauxtva' => 'Number',
            'ttcnet' => 'Number',
            'id_frs' => 'ForeignKey',
            'id_marche' => 'ForeignKey',
            'dateoservice' => 'Date',
            'datereceptionprevesoire' => 'Date',
            'delaidexucution' => 'Number',
            'periodejustifier' => 'Number',
            'delaicontractuelle' => 'Number',
            'pireodereelexecution' => 'Number',
            'pirioderetard' => 'Number',
        );
    }

}
