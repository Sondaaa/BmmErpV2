<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Famexpdes', 'doctrine');

/**
 * BaseFamexpdes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $famille
 * @property Doctrine_Collection $Expdest
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getFamille() Returns the current record's "famille" value
 * @method Doctrine_Collection getExpdest() Returns the current record's "Expdest" collection
 * @method Famexpdes           setId()      Sets the current record's "id" value
 * @method Famexpdes           setFamille() Sets the current record's "famille" value
 * @method Famexpdes           setExpdest() Sets the current record's "Expdest" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFamexpdes extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('famexpdes');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
            'length' => 4,
        ));
        $this->hasColumn('famille', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasMany('Expdest', array(
            'local' => 'id',
            'foreign' => 'id_famille'));
    }

}
