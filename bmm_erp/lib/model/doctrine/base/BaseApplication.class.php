<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Application', 'doctrine');

/**
 * BaseApplication
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Applicationmodule
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method string              getLibelle()           Returns the current record's "libelle" value
 * @method Doctrine_Collection getApplicationmodule() Returns the current record's "Applicationmodule" collection
 * @method Application         setId()                Sets the current record's "id" value
 * @method Application         setLibelle()           Sets the current record's "libelle" value
 * @method Application         setApplicationmodule() Sets the current record's "Applicationmodule" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseApplication extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('application');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'application_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Applicationmodule', array(
             'local' => 'id',
             'foreign' => 'id_application'));
    }
}