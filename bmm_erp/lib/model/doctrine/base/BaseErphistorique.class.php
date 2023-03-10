<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Erphistorique', 'doctrine');

/**
 * BaseErphistorique
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $iduser
 * @property string $userlogin
 * @property date $datemaj
 * @property string $nametable
 * @property integer $idetranger
 * @property integer $idhistorique
 * @property Doctrine_Collection $Erphistorique
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method integer             getIduser()        Returns the current record's "iduser" value
 * @method string              getUserlogin()     Returns the current record's "userlogin" value
 * @method date                getDatemaj()       Returns the current record's "datemaj" value
 * @method string              getNametable()     Returns the current record's "nametable" value
 * @method integer             getIdetranger()    Returns the current record's "idetranger" value
 * @method integer             getIdhistorique()  Returns the current record's "idhistorique" value
 * @method Doctrine_Collection getErphistorique() Returns the current record's "Erphistorique" collection
 * @method Erphistorique       setId()            Sets the current record's "id" value
 * @method Erphistorique       setIduser()        Sets the current record's "iduser" value
 * @method Erphistorique       setUserlogin()     Sets the current record's "userlogin" value
 * @method Erphistorique       setDatemaj()       Sets the current record's "datemaj" value
 * @method Erphistorique       setNametable()     Sets the current record's "nametable" value
 * @method Erphistorique       setIdetranger()    Sets the current record's "idetranger" value
 * @method Erphistorique       setIdhistorique()  Sets the current record's "idhistorique" value
 * @method Erphistorique       setErphistorique() Sets the current record's "Erphistorique" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseErphistorique extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('erphistorique');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'erphistorique_id',
             'length' => 4,
             ));
        $this->hasColumn('iduser', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('userlogin', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('datemaj', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('nametable', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('idetranger', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('idhistorique', 'integer', 4, array(
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
        $this->hasMany('Erphistorique', array(
             'local' => 'id',
             'foreign' => 'idhistorique'));
    }
}