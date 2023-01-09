<?php

/**
 * Courrier filter form base class.
 *
 * @package    BmmErpTest
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCourrierFormFilter extends BaseFormFilterDoctrine {

    public function setup() {

        $reqtypecourrier = Doctrine_Core::getTable('typecourrier')
                ->createQuery('a');

        if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
            $user = $_SESSION['user'];
            if (!$user->getAcceesDroit("Secretariat bureaux d'ordre")) {
                $reqtypecourrier = $reqtypecourrier->where("type like '%Ext%'");
            } else {
                $reqtypecourrier = $reqtypecourrier->where("type like '%Int%'");
            }
        }

        if (isset($_REQUEST['idtype'])) {
            $reqtypecourrier = $reqtypecourrier->AndWhere('id=' . $_REQUEST['idtype']);
        }
        $reqtypecourrier = $reqtypecourrier->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($reqtypecourrier as $req) {
            $choices[$req->getId()] = $req->getType();
        }
        //referencecourrier
        $this->setWidgets(array(
            'titre' => new sfWidgetFormFilterInput(),
            'referencecourrier' => new sfWidgetFormFilterInput(array()),
            'object' => new sfWidgetFormFilterInput(),
            'sujet' => new sfWidgetFormFilterInput(),
            'description' => new sfWidgetFormFilterInput(),
            'id_user' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Utilisateur'), 'add_empty' => true)),
            'id_mode' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Modescourrier'), 'add_empty' => true)),
            'datecreation' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'datereponse' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_bureaux' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bureaux'), 'add_empty' => true)),
            'id_type' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typecourrier'), 'add_empty' => true)),
            'id_famille' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famillecourrier'), 'add_empty' => true)),
            'id_affectation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Affectaioncourrier'), 'add_empty' => true)),
            'id_typeparamcourrier' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeparamcourrier'), 'add_empty' => true)),
            'datecorespondanse' => new sfWidgetFormFilterInput(),
            'numeroseq' => new sfWidgetFormFilterInput(),
            'dateredige' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'id_famexpdes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Famexpdes'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'titre' => new sfValidatorPass(array('required' => false)),
            'referencecourrier' => new sfValidatorPass(array('required' => false)),
            'object' => new sfValidatorPass(array('required' => false)),
            'sujet' => new sfValidatorPass(array('required' => false)),
            'description' => new sfValidatorPass(array('required' => false)),
            'id_user' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Utilisateur'), 'column' => 'id')),
            'id_mode' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Modescourrier'), 'column' => 'id')),
            'datecreation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'datereponse' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_bureaux' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bureaux'), 'column' => 'id')),
            'id_type' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typecourrier'), 'column' => 'id')),
            'id_famille' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famillecourrier'), 'column' => 'id')),
            'id_affectation' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Affectaioncourrier'), 'column' => 'id')),
            'id_typeparamcourrier' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeparamcourrier'), 'column' => 'id')),
            'datecorespondanse' => new sfValidatorPass(array('required' => false)),
            'numeroseq' => new sfValidatorPass(array('required' => false)),
            'dateredige' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
            'id_famexpdes' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Famexpdes'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('courrier_filters[%s]');
        // $this->widgetSchema['id_type'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Courrier';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'titre' => 'Text',
            'object' => 'Text',
            'sujet' => 'Text',
            'description' => 'Text',
            'id_user' => 'ForeignKey',
            'id_mode' => 'ForeignKey',
            'datecreation' => 'Date',
            'id_bureaux' => 'ForeignKey',
            'id_type' => 'ForeignKey',
            'dateredige' => 'Date',
            'id_famexpdes' => 'ForeignKey',
        );
    }

}
