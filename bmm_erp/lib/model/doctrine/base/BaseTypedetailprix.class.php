<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typedetailprix', 'doctrine');

/**
 * BaseTypedetailprix
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Detailprix
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getLibelle()    Returns the current record's "libelle" value
 * @method Doctrine_Collection getDetailprix() Returns the current record's "Detailprix" collection
 * @method Typedetailprix      setId()         Sets the current record's "id" value
 * @method Typedetailprix      setLibelle()    Sets the current record's "libelle" value
 * @method Typedetailprix      setDetailprix() Sets the current record's "Detailprix" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypedetailprix extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typedetailprix');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typedetailprix_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Detailprix', array(
             'local' => 'id',
             'foreign' => 'id_typedetailprix'));
    }
}