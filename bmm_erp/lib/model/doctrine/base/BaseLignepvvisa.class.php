<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignepvvisa', 'doctrine');

/**
 * BaseLignepvvisa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_visa
 * @property integer $id_pv
 * @property Pvdoc $Pvdoc
 * @property Visaachat $Visaachat
 * 
 * @method integer     getId()        Returns the current record's "id" value
 * @method integer     getIdVisa()    Returns the current record's "id_visa" value
 * @method integer     getIdPv()      Returns the current record's "id_pv" value
 * @method Pvdoc       getPvdoc()     Returns the current record's "Pvdoc" value
 * @method Visaachat   getVisaachat() Returns the current record's "Visaachat" value
 * @method Lignepvvisa setId()        Sets the current record's "id" value
 * @method Lignepvvisa setIdVisa()    Sets the current record's "id_visa" value
 * @method Lignepvvisa setIdPv()      Sets the current record's "id_pv" value
 * @method Lignepvvisa setPvdoc()     Sets the current record's "Pvdoc" value
 * @method Lignepvvisa setVisaachat() Sets the current record's "Visaachat" value
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignepvvisa extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignepvvisa');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_visa', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Pvdoc', array(
             'local' => 'id_pv',
             'foreign' => 'id'));

        $this->hasOne('Visaachat', array(
             'local' => 'id_visa',
             'foreign' => 'id'));
    }
}