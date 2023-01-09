<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lieuaffectationouvrier', 'doctrine');

/**
 * BaseLieuaffectationouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Contratouvrier
 * 
 * @method integer                getId()             Returns the current record's "id" value
 * @method string                 getLibelle()        Returns the current record's "libelle" value
 * @method Doctrine_Collection    getContratouvrier() Returns the current record's "Contratouvrier" collection
 * @method Lieuaffectationouvrier setId()             Sets the current record's "id" value
 * @method Lieuaffectationouvrier setLibelle()        Sets the current record's "libelle" value
 * @method Lieuaffectationouvrier setContratouvrier() Sets the current record's "Contratouvrier" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLieuaffectationouvrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lieuaffectationouvrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lieuaffectationouvrier_id',
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
        $this->hasMany('Contratouvrier', array(
             'local' => 'id',
             'foreign' => 'id_lieuaffetation'));
    }
}