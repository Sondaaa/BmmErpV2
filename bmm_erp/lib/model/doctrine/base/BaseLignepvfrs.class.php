<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignepvfrs', 'doctrine');

/**
 * BaseLignepvfrs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_pv
 * @property integer $id_frs
 * @property Pvdoc $Pvdoc
 * 
 * @method integer    getId()     Returns the current record's "id" value
 * @method integer    getIdPv()   Returns the current record's "id_pv" value
 * @method integer    getIdFrs()  Returns the current record's "id_frs" value
 * @method Pvdoc      getPvdoc()  Returns the current record's "Pvdoc" value
 * @method Lignepvfrs setId()     Sets the current record's "id" value
 * @method Lignepvfrs setIdPv()   Sets the current record's "id_pv" value
 * @method Lignepvfrs setIdFrs()  Sets the current record's "id_frs" value
 * @method Lignepvfrs setPvdoc()  Sets the current record's "Pvdoc" value
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignepvfrs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignepvfrs');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_pv', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_frs', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pvdoc', array(
             'local' => 'id_pv',
             'foreign' => 'id'));
    }
}