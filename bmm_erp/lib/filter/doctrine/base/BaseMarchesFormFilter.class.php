<?php

/**
 * Marches filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMarchesFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $documentachats = Doctrine_Core::getTable('documentachat')
                        ->createQuery('a')->select('*')->where('id_typedoc=9')->execute();
        $choices = array();
        $choices[''] = '';

        foreach ($documentachats as $req) {
            $choices[$req->getId()] = $req->getNumerodocachat();
        }
        $this->setWidgets(array(
            'numero' => new sfWidgetFormFilterInput(),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'delai' => new sfWidgetFormFilterInput(),
            'object' => new sfWidgetFormFilterInput(),
            'mrpme' => new sfWidgetFormFilterInput(),
            'nbrelot' => new sfWidgetFormFilterInput(),
            'titulaire' => new sfWidgetFormFilterInput(),
            'nbrebinificaire' => new sfWidgetFormFilterInput(),
            'mntttc' => new sfWidgetFormFilterInput(),
            'retenuegaraentie' => new sfWidgetFormFilterInput(),
            'cautionement' => new sfWidgetFormFilterInput(),
            'avance' => new sfWidgetFormFilterInput(),
            'penalite' => new sfWidgetFormFilterInput(),
            'id_passaction' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Procedurepassation'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'id_nature' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturemarche'), 'add_empty' => true)),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'id_documentachat' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'datecommencement' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'maxpinalite' => new sfWidgetFormFilterInput(),
        ));

        $this->setValidators(array(
            'numero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'delai' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'object' => new sfValidatorPass(array('required' => false)),
            'mrpme' => new sfValidatorPass(array('required' => false)),
            'nbrelot' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'titulaire' => new sfValidatorPass(array('required' => false)),
            'nbrebinificaire' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'mntttc' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'retenuegaraentie' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'cautionement' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'avance' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'penalite' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_passaction' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Procedurepassation'), 'column' => 'id')),
            'id_projet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
            'id_nature' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturemarche'), 'column' => 'id')),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'id_documentachat' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
            'id_frs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'datecommencement' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'maxpinalite' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
        ));

        $this->widgetSchema->setNameFormat('marches_filters[%s]');
        $this->widgetSchema['id_documentachat'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Marches';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'numero' => 'Number',
            'datecreation' => 'Date',
            'delai' => 'Number',
            'object' => 'Text',
            'mrpme' => 'Text',
            'nbrelot' => 'Number',
            'titulaire' => 'Text',
            'nbrebinificaire' => 'Number',
            'mntttc' => 'Number',
            'retenuegaraentie' => 'Number',
            'cautionement' => 'Number',
            'avance' => 'Number',
            'penalite' => 'Number',
            'id_passaction' => 'ForeignKey',
            'id_projet' => 'ForeignKey',
            'id_nature' => 'ForeignKey',
            'id_user' => 'ForeignKey',
            'id_documentachat' => 'ForeignKey',
            'id_frs' => 'ForeignKey',
        );
    }

}
