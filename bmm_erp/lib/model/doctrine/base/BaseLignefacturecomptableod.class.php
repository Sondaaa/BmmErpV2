<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignefacturecomptableod', 'doctrine');

/**
 * BaseLignefacturecomptableod
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property decimal $totalht
 * @property decimal $totaltva
 * @property integer $id_tva
 * @property integer $id_facturecomptableod
 * @property Facturecomptableod $Facturecomptableod
 * @property Tva $Tva
 * 
 * @method integer                 getId()                    Returns the current record's "id" value
 * @method decimal                 getTotalht()               Returns the current record's "totalht" value
 * @method decimal                 getTotaltva()              Returns the current record's "totaltva" value
 * @method integer                 getIdTva()                 Returns the current record's "id_tva" value
 * @method integer                 getIdFacturecomptableod()  Returns the current record's "id_facturecomptableod" value
 * @method Facturecomptableod      getFacturecomptableod()    Returns the current record's "Facturecomptableod" value
 * @method Tva                     getTva()                   Returns the current record's "Tva" value
 * @method Lignefacturecomptableod setId()                    Sets the current record's "id" value
 * @method Lignefacturecomptableod setTotalht()               Sets the current record's "totalht" value
 * @method Lignefacturecomptableod setTotaltva()              Sets the current record's "totaltva" value
 * @method Lignefacturecomptableod setIdTva()                 Sets the current record's "id_tva" value
 * @method Lignefacturecomptableod setIdFacturecomptableod()  Sets the current record's "id_facturecomptableod" value
 * @method Lignefacturecomptableod setFacturecomptableod()    Sets the current record's "Facturecomptableod" value
 * @method Lignefacturecomptableod setTva()                   Sets the current record's "Tva" value
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignefacturecomptableod extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignefacturecomptableod');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignefacturecomptableod_id',
             'length' => 4,
             ));
        $this->hasColumn('totalht', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('totaltva', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_tva', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_facturecomptableod', 'integer', 4, array(
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
        $this->hasOne('Facturecomptableod', array(
             'local' => 'id_facturecomptableod',
             'foreign' => 'id'));

        $this->hasOne('Tva', array(
             'local' => 'id_tva',
             'foreign' => 'id'));
    }
}