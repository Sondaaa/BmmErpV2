<?php

/**
 * Article filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArticleFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'numero' => new sfWidgetFormFilterInput(),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'codeart' => new sfWidgetFormFilterInput(),
            'designation' => new sfWidgetFormFilterInput(),
            'id_unite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Unitemarche'), 'add_empty' => true)),
            'id_typestock' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typearticle'), 'add_empty' => true)),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillearticle'), 'add_empty' => true)),
            'codefamille' => new sfWidgetFormFilterInput(),
            'stockmin' => new sfWidgetFormFilterInput(),
            'stocksecurite' => new sfWidgetFormFilterInput(),
            'stockalert' => new sfWidgetFormFilterInput(),
            'stockmax' => new sfWidgetFormFilterInput(),
            'codeabc' => new sfWidgetFormFilterInput(),
            'id_modele' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modeleapro'), 'add_empty' => true)),
            'delai' => new sfWidgetFormFilterInput(),
            'blocappro' => new sfWidgetFormFilterInput(),
            'comptegenerale' => new sfWidgetFormFilterInput(),
            'id_methode' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Methodevalorisation'), 'add_empty' => true)),
            'stockreel' => new sfWidgetFormFilterInput(),
            'stockreelvaleur' => new sfWidgetFormFilterInput(),
            'enlinstance' => new sfWidgetFormFilterInput(),
            'senqteenle' => new sfWidgetFormFilterInput(),
            'id_fabriquant' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fabricant'), 'add_empty' => true)),
            'aht' => new sfWidgetFormFilterInput(),
            'id_tva' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tva'), 'add_empty' => true)),
            'attc' => new sfWidgetFormFilterInput(),
            'qtetheorique' => new sfWidgetFormFilterInput(),
            'id_sousfamille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sousfamillearticle'), 'add_empty' => true)),
            'codesf' => new sfWidgetFormFilterInput(),
            'id_nature' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturearticle'), 'add_empty' => true)),
            'codenature' => new sfWidgetFormFilterInput(),
            'pamp' => new sfWidgetFormFilterInput(),
			 'stocable'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
        ));

        $this->setValidators(array(
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'numero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'codeart' => new sfValidatorPass(array('required' => false)),
            'designation' => new sfValidatorPass(array('required' => false)),
            'id_unite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Unitemarche'), 'column' => 'id')),
            'id_typestock' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typearticle'), 'column' => 'id')),
            'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famillearticle'), 'column' => 'id')),
            'codefamille' => new sfValidatorPass(array('required' => false)),
            'stockmin' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'stocksecurite' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'stockalert' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'stockmax' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'codeabc' => new sfValidatorPass(array('required' => false)),
            'id_modele' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Modeleapro'), 'column' => 'id')),
            'delai' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'blocappro' => new sfValidatorPass(array('required' => false)),
            'comptegenerale' => new sfValidatorPass(array('required' => false)),
            'id_methode' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Methodevalorisation'), 'column' => 'id')),
            'stockreel' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'stockreelvaleur' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'enlinstance' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'senqteenle' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_fabriquant' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fabricant'), 'column' => 'id')),
            'aht' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_tva' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tva'), 'column' => 'id')),
            'attc' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'qtetheorique' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'id_sousfamille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sousfamillearticle'), 'column' => 'id')),
            'codesf' => new sfValidatorPass(array('required' => false)),
            'id_nature' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturearticle'), 'column' => 'id')),
            'codenature' => new sfValidatorPass(array('required' => false)),
            'pamp' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
			   'stocable'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('article_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Article';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'datecreation' => 'Date',
            'numero' => 'Number',
            'id_user' => 'ForeignKey',
            'codeart' => 'Text',
            'designation' => 'Text',
            'id_unite' => 'ForeignKey',
            'id_typestock' => 'ForeignKey',
            'id_famille' => 'ForeignKey',
            'codefamille' => 'Text',
            'stockmin' => 'Number',
            'stocksecurite' => 'Number',
            'stockalert' => 'Number',
            'stockmax' => 'Number',
            'codeabc' => 'Text',
            'id_modele' => 'ForeignKey',
            'delai' => 'Number',
            'blocappro' => 'Text',
            'comptegenerale' => 'Text',
            'id_methode' => 'ForeignKey',
            'stockreel' => 'Number',
            'stockreelvaleur' => 'Number',
            'enlinstance' => 'Number',
            'senqteenle' => 'Number',
            'id_fabriquant' => 'ForeignKey',
            'aht' => 'Number',
            'id_tva' => 'ForeignKey',
            'attc' => 'Number',
            'qtetheorique' => 'Number',
            'id_sousfamille' => 'ForeignKey',
            'codesf' => 'Text',
            'id_nature' => 'ForeignKey',
        );
    }

}
