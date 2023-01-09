<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Organisme', 'doctrine');

/**
 * BaseOrganisme
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $nenregusrement
 * @property string $libelle
 * @property Doctrine_Collection $Planing
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method integer             getNenregusrement() Returns the current record's "nenregusrement" value
 * @method string              getLibelle()        Returns the current record's "libelle" value
 * @method Doctrine_Collection getPlaning()        Returns the current record's "Planing" collection
 * @method Organisme           setId()             Sets the current record's "id" value
 * @method Organisme           setNenregusrement() Sets the current record's "nenregusrement" value
 * @method Organisme           setLibelle()        Sets the current record's "libelle" value
 * @method Organisme           setPlaning()        Sets the current record's "Planing" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrganisme extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('organisme');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'organisme_id',
             'length' => 4,
             ));
        $this->hasColumn('nenregusrement', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Planing', array(
             'local' => 'id',
             'foreign' => 'id_organisme'));
    }
}