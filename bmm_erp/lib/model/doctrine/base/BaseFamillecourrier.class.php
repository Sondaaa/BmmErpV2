<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Famillecourrier', 'doctrine');

/**
 * BaseFamillecourrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Courrier
 * 
 * @method integer             getId()       Returns the current record's "id" value
 * @method string              getLibelle()  Returns the current record's "libelle" value
 * @method Doctrine_Collection getCourrier() Returns the current record's "Courrier" collection
 * @method Famillecourrier     setId()       Sets the current record's "id" value
 * @method Famillecourrier     setLibelle()  Sets the current record's "libelle" value
 * @method Famillecourrier     setCourrier() Sets the current record's "Courrier" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFamillecourrier extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('famillecourrier');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'famillecourrier_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Courrier', array(
             'local' => 'id',
             'foreign' => 'id_famille'));
    }
}