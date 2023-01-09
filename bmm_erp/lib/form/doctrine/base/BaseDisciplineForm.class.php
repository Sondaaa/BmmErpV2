<?php

/**
 * Discipline form base class.
 *
 * @method Discipline getObject() Returns the current form's model object
 *
 * @package    PhpProjectTest
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDisciplineForm extends BaseFormDoctrine {

    public function setup() {
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
            'id_typediscipline' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscipline'), 'add_empty' => true)),
            'source' => new sfWidgetFormInputText(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date')),
            'explication' => new sfWidgetFormInputText(),
            'id_naturediscipline' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturediscipline'), 'add_empty' => true)),
            'nbrejour' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'id_agents' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'required' => false)),
            'id_typediscipline' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typediscipline'), 'required' => false)),
            'source' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'explication' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'id_naturediscipline' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturediscipline'), 'required' => false)),
            'nbrejour' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('discipline[%s]');
        $this->widgetSchema['id_agents'] = new sfWidgetFormChoice(array('choices' => $choices));
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Discipline';
    }

}
