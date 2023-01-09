<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Retenue', 'doctrine');

/**
 * BaseRetenue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property string $typeretenue
 * @property integer $id_type
 * @property Typeavancepret $Typeavancepret
 * @property Doctrine_Collection $Demandeavancepret
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getLibelle()           Returns the current record's "libelle" value
 * @method string              getTyperetenue()       Returns the current record's "typeretenue" value
 * @method integer             getIdType()            Returns the current record's "id_type" value
 * @method Typeavancepret      getTypeavancepret()    Returns the current record's "Typeavancepret" value
 * @method Doctrine_Collection getDemandeavancepret() Returns the current record's "Demandeavancepret" collection
 * @method Retenue             setId()                Sets the current record's "id" value
 * @method Retenue             setLibelle()           Sets the current record's "libelle" value
 * @method Retenue             setTyperetenue()       Sets the current record's "typeretenue" value
 * @method Retenue             setIdType()            Sets the current record's "id_type" value
 * @method Retenue             setTypeavancepret()    Sets the current record's "Typeavancepret" value
 * @method Retenue             setDemandeavancepret() Sets the current record's "Demandeavancepret" collection
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRetenue extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('retenue');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'retenue_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('typeretenue', 'string', 25, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_type', 'integer', 4, array(
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
        $this->hasOne('Typeavancepret', array(
             'local' => 'id_type',
             'foreign' => 'id'));

        $this->hasMany('Demandeavancepret', array(
             'local' => 'id',
             'foreign' => 'id_retenue'));
    }
}