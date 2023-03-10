<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignefacturecomptableachat', 'doctrine');

/**
 * BaseLignefacturecomptableachat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property decimal $totalht
 * @property decimal $totaltva
 * @property integer $id_tva
 * @property integer $id_facturecomptableachat
 * @property Tva $Tva
 * @property Facturecomptableachat $Facturecomptableachat
 * 
 * @method integer                    getId()                       Returns the current record's "id" value
 * @method decimal                    getTotalht()                  Returns the current record's "totalht" value
 * @method decimal                    getTotaltva()                 Returns the current record's "totaltva" value
 * @method integer                    getIdTva()                    Returns the current record's "id_tva" value
 * @method integer                    getIdFacturecomptableachat()  Returns the current record's "id_facturecomptableachat" value
 * @method Tva                        getTva()                      Returns the current record's "Tva" value
 * @method Facturecomptableachat      getFacturecomptableachat()    Returns the current record's "Facturecomptableachat" value
 * @method Lignefacturecomptableachat setId()                       Sets the current record's "id" value
 * @method Lignefacturecomptableachat setTotalht()                  Sets the current record's "totalht" value
 * @method Lignefacturecomptableachat setTotaltva()                 Sets the current record's "totaltva" value
 * @method Lignefacturecomptableachat setIdTva()                    Sets the current record's "id_tva" value
 * @method Lignefacturecomptableachat setIdFacturecomptableachat()  Sets the current record's "id_facturecomptableachat" value
 * @method Lignefacturecomptableachat setTva()                      Sets the current record's "Tva" value
 * @method Lignefacturecomptableachat setFacturecomptableachat()    Sets the current record's "Facturecomptableachat" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignefacturecomptableachat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignefacturecomptableachat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignefacturecomptableachat_id',
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
        $this->hasColumn('id_facturecomptableachat', 'integer', 4, array(
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
        $this->hasOne('Tva', array(
             'local' => 'id_tva',
             'foreign' => 'id'));

        $this->hasOne('Facturecomptableachat', array(
             'local' => 'id_facturecomptableachat',
             'foreign' => 'id'));
    }
}