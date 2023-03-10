<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Tauxammortisement', 'doctrine');

/**
 * BaseTauxammortisement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $tauxammortisement
 * 
 * @method integer           getId()                Returns the current record's "id" value
 * @method string            getTauxammortisement() Returns the current record's "tauxammortisement" value
 * @method Tauxammortisement setId()                Sets the current record's "id" value
 * @method Tauxammortisement setTauxammortisement() Sets the current record's "tauxammortisement" value
 * 
 * @package    Inventairetest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTauxammortisement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tauxammortisement');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('tauxammortisement', 'string', 254, array(
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