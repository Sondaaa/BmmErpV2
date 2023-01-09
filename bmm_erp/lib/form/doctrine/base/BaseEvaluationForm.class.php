<?php

/**
 * Evaluation form base class.
 *
 * @method Evaluation getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluationForm extends BaseFormDoctrine {

    public function setup() {
        $array = array("حلقة التكوين" => "حلقة التكوين", "دورة تكوينية " => "دورة تكوينية ", "تكو مستمر " => "تكو مستمر ", "تربص فني " => "تربص فني ");
//        $notegenerale = array("Mauvais " => "Mauvais", "Moyen  " => "Moyen  ", "Bon  " => "Bon  ", "Excellent  " => "Excellent  ");
//        $condition = array("Mauvais " => "Mauvais", "Moyen  " => "Moyen  ", "Bon  " => "Bon  ");
//        $note= array("Incompétent " => "Incompétent", "Compétent  " => "Compétent  ", "Bonne efficacité  " => "Bonne efficacité ","Excellente efficacité   " => " Excellente efficacité ");
        $note = array("" => "", "0" => "0", "1" => "1", "2" => "2", "3" => "3");
        $condition = array("" => "", "0" => "0", "1" => "1", "2" => "2", "3" => "3");
        $notegenerale = array("" => "", "0" => "0", "1" => "1", "2" => "2", "3" => "3");
        $degre = array("" => "", "0" => "0", "1" => "1", "2" => "2", "3" => "3");
        $structure = array("" => "", "0" => "0", "1" => "1", "2" => "2", "3" => "3");
        $agents = Doctrine_Core::getTable('agents')
                ->createQuery('a')
                ->where('a.id_motifabsence IS NULL ')
                ->execute();
        $choices = array();
        $choices[0] = '';
        foreach ($agents as $req) {
            $choices[$req->getId()] = $req->getIdrh() . " " . $req->getNomcomplet() . " " . $req->getPrenom();
        }
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'id_agents' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'competance' => new sfWidgetFormTextarea(),
            'connaissanceaquise' => new sfWidgetFormTextarea(),
            'conditionslogement' => new sfWidgetFormChoice(array('choices' => $condition)),
            'notecomposant' => new sfWidgetFormChoice(array('choices' => $notegenerale)),
            'noteformateur' => new sfWidgetFormChoice(array('choices' => $note)),
            'observation' => new sfWidgetFormTextarea(),
            'signatureagents' => new sfWidgetFormInputText(),
            'cahcetresponsable' => new sfWidgetFormInputText(),
            'id_formation' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'add_empty' => true)),
            'degreobjectif' => new sfWidgetFormChoice(array('choices' => $degre)),
            'structureprog' => new sfWidgetFormChoice(array('choices' => $structure)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'typeformation' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'bureau' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'competance' => new sfValidatorString(array('required' => false)),
            'connaissanceaquise' => new sfValidatorString(array('required' => false)),
            'conditionslogement' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'notecomposant' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'noteformateur' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'observation' => new sfValidatorString(array('required' => false)),
            'signatureagents' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'cahcetresponsable' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'id_formation' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Besoinsdeformation'), 'required' => false)),
            'degreobjectif' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'structureprog' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('evaluation[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Evaluation';
    }

}
