<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Specialite', 'doctrine');

/**
 * BaseSpecialite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $LigneSpecialteAgents
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getLibelle()              Returns the current record's "libelle" value
 * @method Doctrine_Collection getLigneSpecialteAgents() Returns the current record's "LigneSpecialteAgents" collection
 * @method Specialite          setId()                   Sets the current record's "id" value
 * @method Specialite          setLibelle()              Sets the current record's "libelle" value
 * @method Specialite          setLigneSpecialteAgents() Sets the current record's "LigneSpecialteAgents" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSpecialite extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('specialite');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'specialite_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('LigneSpecialteAgents', array(
             'local' => 'id',
             'foreign' => 'id_specialite'));
    }
}