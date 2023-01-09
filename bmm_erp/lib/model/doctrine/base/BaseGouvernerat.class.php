<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Gouvernerat', 'doctrine');

/**
 * BaseGouvernerat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_pays
 * @property Pays $Pays
 * 
 * @method integer     getId()      Returns the current record's "id" value
 * @method string      getLibelle() Returns the current record's "libelle" value
 * @method integer     getIdPays()  Returns the current record's "id_pays" value
 * @method Pays        getPays()    Returns the current record's "Pays" value
 * @method Gouvernerat setId()      Sets the current record's "id" value
 * @method Gouvernerat setLibelle() Sets the current record's "libelle" value
 * @method Gouvernerat setIdPays()  Sets the current record's "id_pays" value
 * @method Gouvernerat setPays()    Sets the current record's "Pays" value
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGouvernerat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('gouvernerat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'gouvernerat_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_pays', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pays', array(
             'local' => 'id_pays',
             'foreign' => 'id'));
    }
}