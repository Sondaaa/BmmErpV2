<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Modeammortisement', 'doctrine');

/**
 * BaseModeammortisement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $modeammortisement
 * @property string $valeurmode
 * 
 * @method integer           getId()                Returns the current record's "id" value
 * @method string            getModeammortisement() Returns the current record's "modeammortisement" value
 * @method string            getValuermode() Returns the current record's "valeurmode" value
 * @method Modeammortisement setId()                Sets the current record's "id" value
 * @method Modeammortisement setModeammortisement() Sets the current record's "modeammortisement" value
 * @method Modeammortisement setValeurmode() Sets the current record's "valeurmode" value
 * 
 * @package    Inventairetest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseModeammortisement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('modeammortisement');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('modeammortisement', 'string', 254, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
         $this->hasColumn('valeurmode', 'string', 254, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}