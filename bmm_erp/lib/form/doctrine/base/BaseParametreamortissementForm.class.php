<?php

/**
 * Parametreamortissement form base class.
 *
 * @method Parametreamortissement getObject() Returns the current form's model object
 *
 * @package    Tes
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParametreamortissementForm extends BaseFormDoctrine {

    public function setup() {
        $fonts = array('calibri light' => 'calibri light',
            '"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
            'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
            'Georgia, serif' => 'Georgia, serif',
            '"Gill Sans", sans-serif' => '"Gill Sans", sans-serif',
            'sans-serif' => 'sans-serif',
            'serif' => 'serif',
            'cursive' => 'cursive',
            'system-ui' => 'system-ui');
        $align = array('left' => 'à gauche', 'right' => 'à droite', 'center' => 'au centre');
        $border = array('1' => 'Oui', '0' => 'Non');
        $taille = array(
            '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12',
            '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19',
            '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26',
            '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31', '32' => '32'
        );
        $designation = array( '0' => 'Numéro Immo.', '1' => 'Référence Immo.', '2' => 'Désignation Immo.', '3' => 'Code Bureau', '4' => 'Désignation Bureau');
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'date' => new sfWidgetFormInputText(array(), array('type' => 'date', 'readonly' => 'true', 'value' => date('Y-m-d'))),
            'heightcode' => new sfWidgetFormInputText(),
            'widthcode' => new sfWidgetFormInputText(),
            'taillecaractere' => new sfWidgetFormChoice(array('choices' => $taille)),
            'fontcaractere' => new sfWidgetFormChoice(array('choices' => $fonts)),
            'align' => new sfWidgetFormChoice(array('choices' => $align)),
            'border' => new sfWidgetFormChoice(array('choices' => $border)),
            'header' => new sfWidgetFormChoice(array('choices' => $designation, 'multiple' => true)),
            'footer' => new sfWidgetFormChoice(array('choices' => $designation, 'multiple' => true)),
            
            'heightticket' => new sfWidgetFormInputText(),
            'widthticket' => new sfWidgetFormInputText(),
            'dateamortissement' => new sfWidgetFormInputText(array(), array('type' => 'date')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'date' => new sfValidatorDate(array('required' => false)),
            'dateamortissement' => new sfValidatorDate(array('required' => false)),
            'fontcaractere' => new sfValidatorString(array('required' => false)),
            'taillecaractere' => new sfValidatorString(array('required' => false)),
            'header' => new sfValidatorChoice(array('choices' => $designation, 'required' => false, 'multiple' => true)),
            'footer' => new sfValidatorChoice(array('choices' => $designation, 'required' => false, 'multiple' => true)),
            'align' => new sfValidatorChoice(array('choices' => $align, 'required' => false)),
            'heightcode' => new sfValidatorInteger(array('required' => false)),
            'widthcode' => new sfValidatorInteger(array('required' => false)),
            'border' => new sfValidatorChoice(array('choices' => $border, 'required' => false)),
            'heightticket' => new sfValidatorInteger(array('required' => false)),
            'widthticket' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('parametreamortissement[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Parametreamortissement';
    }

}
