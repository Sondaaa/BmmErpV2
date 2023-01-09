<?php

/**
 * Documentod filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentodFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $doc_bcis = Doctrine_Core::getTable('documentod')
                        ->createQuery('a')
                        ->select('a.id ,a.numero')
                        ->where('id_typedoc=6')->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($doc_bcis as $doc) {
            $doc_bcdp = Doctrine_Core::getTable('documentod')->findByIdDocparentAndIdTypedocOrIdTypedoc($doc->getId(), 17, 18);
            if (count($doc_bcdp))
                $choices[$doc->getId()] = $doc->getNumerodocachat();
            //verif si a des bon de deponse au comptant provisoire
        }

        $this->setWidgets(array(
            'numero' => new sfWidgetFormFilterInput(),
            'reference' => new sfWidgetFormFilterInput(),
            'datecreation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormInputText(array('type' => 'date')), 'to_date' => new sfWidgetFormInputText(array('type' => 'date')))),
            'observation' => new sfWidgetFormFilterInput(),
            'chemindoc' => new sfWidgetFormFilterInput(),
            'id_demandeur' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demandeur'), 'add_empty' => true)),
            'id_typedoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typedoc'), 'add_empty' => true)),
            'id_adresse' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adresse'), 'add_empty' => true)),
            'id_lignedirectionsite' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Direction'), 'add_empty' => true)),
            'desiegniation' => new sfWidgetFormFilterInput(),
            'id_objet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Objectdocument'), 'add_empty' => true)),
            'id_projet' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projet'), 'add_empty' => true)),
            'id_docparent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Documentachat'), 'add_empty' => true)),
            'mht' => new sfWidgetFormFilterInput(),
            'mnttva' => new sfWidgetFormFilterInput(),
            'mntttc' => new sfWidgetFormFilterInput(),
            'etatdocachat' => new sfWidgetFormFilterInput(),
            'id_etatdoc' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etatdocument'), 'add_empty' => true)),
            'id_frs' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'delaifrs' => new sfWidgetFormFilterInput(),
            'maxreponsefrs' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'datesignature' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'mnthtax' => new sfWidgetFormFilterInput(),
           
        ));

        $this->setValidators(array(
            'numero' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'reference' => new sfValidatorPass(array('required' => false)),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'observation' => new sfValidatorPass(array('required' => false)),
            'chemindoc' => new sfValidatorPass(array('required' => false)),
            'id_demandeur' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demandeur'), 'column' => 'id')),
            'id_typedoc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typedoc'), 'column' => 'id')),
            'id_adresse' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adresse'), 'column' => 'id')),
            'id_lignedirectionsite' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Direction'), 'column' => 'id')),
            'desiegniation' => new sfValidatorPass(array('required' => false)),
            'id_docparent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Documentachat'), 'column' => 'id')),
            'id_objet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Objectdocument'), 'column' => 'id')),
            'id_projet' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Projet'), 'column' => 'id')),
            'mht' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mnttva' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'mntttc' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
            'etatdocachat' => new sfValidatorPass(array('required' => false)),
            'id_etatdoc' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etatdocument'), 'column' => 'id')),
            'id_frs' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'delaifrs' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'maxreponsefrs' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datesignature' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'mnthtax' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
           
        ));
        $this->widgetSchema->setNameFormat('documentachat_filters[%s]');
        $this->widgetSchema['id_docparent'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Documentachat';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'numero' => 'Number',
            'reference' => 'Text',
            'datecreation' => 'Date',
            'observation' => 'Text',
            'chemindoc' => 'Text',
            'id_demandeur' => 'ForeignKey',
            'id_typedoc' => 'ForeignKey',
            'id_adresse' => 'ForeignKey',
            'id_lignedirectionsite' => 'ForeignKey',
            'desiegniation' => 'Text',
            'id_objet' => 'ForeignKey',
            'id_projet' => 'ForeignKey',
            'mht' => 'Number',
            'mnttva' => 'Number',
            'mntttc' => 'Number',
            'etatdocachat' => 'Text',
            'id_etatdoc' => 'ForeignKey',
            'id_docparent' => 'Number',
            'id_frs' => 'ForeignKey',
            'id_user' => 'ForeignKey',
            'delaifrs' => 'Number',
            'maxreponsefrs' => 'Date',
            'id_note' => 'ForeignKey',
            'datesignature' => 'Date',
            'mnthtax' => 'Number',
           
        );
    }

}
