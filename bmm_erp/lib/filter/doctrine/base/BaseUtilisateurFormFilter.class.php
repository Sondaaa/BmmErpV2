<?php

/**
 * Utilisateur filter form base class.
 *
 * @package    Bmm
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUtilisateurFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'login' => new sfWidgetFormFilterInput(),
            'pwd' => new sfWidgetFormFilterInput(),
            'id_parent' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Agents'), 'add_empty' => true)),
            'id_profil' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profil'), 'add_empty' => true)),
            'remember_token' => new sfWidgetFormFilterInput(),
            'password' => new sfWidgetFormFilterInput(),
            'is_admin' => new sfWidgetFormChoice(array('choices' => array('' => 'oui ou non', 1 => 'oui', 0 => 'non'))),
            'is_active' => new sfWidgetFormChoice(array('choices' => array('' => 'oui ou non', 1 => 'oui', 0 => 'non'))),
            'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
        ));

        $this->setValidators(array(
            'login' => new sfValidatorPass(array('required' => false)),
            'pwd' => new sfValidatorPass(array('required' => false)),
            'id_parent' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Agents'), 'column' => 'id')),
            'is_admin' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'is_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'id_profil' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profil'), 'column' => 'id')),
            'remember_token' => new sfValidatorPass(array('required' => false)),
            'password' => new sfValidatorPass(array('required' => false)),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
        ));

        $this->widgetSchema->setNameFormat('utilisateur_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Utilisateur';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'login' => 'Text',
            'pwd' => 'Text',
            'id_parent' => 'ForeignKey',
            'id_profil' => 'ForeignKey',
            'remember_token' => 'Text',
            'password' => 'Text',
            'is_admin' => 'Number',
            'is_active' => 'Number',
            'created_at' => 'Date',
            'updated_at' => 'Date',
        );
    }

}
