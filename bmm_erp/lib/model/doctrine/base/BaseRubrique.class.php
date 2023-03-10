<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Rubrique', 'doctrine');

/**
 * BaseRubrique
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_rubrique
 * @property string $code
 * @property Doctrine_Collection $Rubrique
 * @property Doctrine_Collection $Ligprotitrub
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method string              getLibelle()      Returns the current record's "libelle" value
 * @method integer             getIdRubrique()   Returns the current record's "id_rubrique" value
 * @method string              getCode()         Returns the current record's "code" value
 * @method Doctrine_Collection getRubrique()     Returns the current record's "Rubrique" collection
 * @method Doctrine_Collection getLigprotitrub() Returns the current record's "Ligprotitrub" collection
 * @method Rubrique            setId()           Sets the current record's "id" value
 * @method Rubrique            setLibelle()      Sets the current record's "libelle" value
 * @method Rubrique            setIdRubrique()   Sets the current record's "id_rubrique" value
 * @method Rubrique        setCode()                 Sets the current record's "code" value
 * @method Rubrique            setRubrique()     Sets the current record's "Rubrique" collection
 * @method Rubrique            setLigprotitrub() Sets the current record's "Ligprotitrub" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRubrique extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('rubrique');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
            'length' => 4,
        ));
        $this->hasColumn('libelle', 'string', 254, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
            'length' => 254,
        ));
        $this->hasColumn('id_rubrique', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
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
    }

    public function setUp() {
        parent::setUp();
        $this->hasMany('Rubrique', array(
            'local' => 'id',
            'foreign' => 'id_rubrique'));

        $this->hasMany('Ligprotitrub', array(
            'local' => 'id',
            'foreign' => 'id_rubrique'));
    }

}
