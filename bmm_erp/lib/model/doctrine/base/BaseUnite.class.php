<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Unite', 'doctrine');

/**
 * BaseUnite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_service
 * @property Servicerh $Servicerh
 * @property Doctrine_Collection $Demandeur
 * @property Doctrine_Collection $Posterh
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getLibelle()    Returns the current record's "libelle" value
 * @method integer             getIdService()  Returns the current record's "id_service" value
 * @method Servicerh           getServicerh()  Returns the current record's "Servicerh" value
 * @method Doctrine_Collection getDemandeur()  Returns the current record's "Demandeur" collection
 * @method Doctrine_Collection getPosterh()    Returns the current record's "Posterh" collection
 * @method Unite               setId()         Sets the current record's "id" value
 * @method Unite               setLibelle()    Sets the current record's "libelle" value
 * @method Unite               setIdService()  Sets the current record's "id_service" value
 * @method Unite               setServicerh()  Sets the current record's "Servicerh" value
 * @method Unite               setDemandeur()  Sets the current record's "Demandeur" collection
 * @method Unite               setPosterh()    Sets the current record's "Posterh" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUnite extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('unite');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'unite_id',
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
        $this->hasColumn('id_service', 'integer', 4, array(
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
        $this->hasOne('Servicerh', array(
             'local' => 'id_service',
             'foreign' => 'id'));

        $this->hasMany('Demandeur', array(
             'local' => 'id',
             'foreign' => 'id_unite'));

        $this->hasMany('Posterh', array(
             'local' => 'id',
             'foreign' => 'id_unite'));
    }
}