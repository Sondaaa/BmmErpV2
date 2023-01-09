<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typecompte', 'doctrine');

/**
 * BaseTypecompte
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $libelle
 * @property Doctrine_Collection $Typecomptebilan
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getCode()            Returns the current record's "code" value
 * @method string              getLibelle()         Returns the current record's "libelle" value
 * @method Doctrine_Collection getTypecomptebilan() Returns the current record's "Typecomptebilan" collection
 * @method Typecompte          setId()              Sets the current record's "id" value
 * @method Typecompte          setCode()            Sets the current record's "code" value
 * @method Typecompte          setLibelle()         Sets the current record's "libelle" value
 * @method Typecompte          setTypecomptebilan() Sets the current record's "Typecomptebilan" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypecompte extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typecompte');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typecompte_id',
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 20, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('libelle', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Typecomptebilan', array(
             'local' => 'id',
             'foreign' => 'id_typecompte'));
    }
}