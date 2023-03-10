<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Servicerh', 'doctrine');

/**
 * BaseServicerh
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_sousdirection
 * @property Sousdirection $Sousdirection
 * @property Doctrine_Collection $Demandeur
 * @property Doctrine_Collection $Unite
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getLibelle()          Returns the current record's "libelle" value
 * @method integer             getIdSousdirection()  Returns the current record's "id_sousdirection" value
 * @method Sousdirection       getSousdirection()    Returns the current record's "Sousdirection" value
 * @method Doctrine_Collection getDemandeur()        Returns the current record's "Demandeur" collection
 * @method Doctrine_Collection getUnite()            Returns the current record's "Unite" collection
 * @method Servicerh           setId()               Sets the current record's "id" value
 * @method Servicerh           setLibelle()          Sets the current record's "libelle" value
 * @method Servicerh           setIdSousdirection()  Sets the current record's "id_sousdirection" value
 * @method Servicerh           setSousdirection()    Sets the current record's "Sousdirection" value
 * @method Servicerh           setDemandeur()        Sets the current record's "Demandeur" collection
 * @method Servicerh           setUnite()            Sets the current record's "Unite" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseServicerh extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('servicerh');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'servicerh_id',
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
        $this->hasColumn('id_sousdirection', 'integer', 4, array(
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
        $this->hasOne('Sousdirection', array(
             'local' => 'id_sousdirection',
             'foreign' => 'id'));

        $this->hasMany('Demandeur', array(
             'local' => 'id',
             'foreign' => 'id_service'));

        $this->hasMany('Unite', array(
             'local' => 'id',
             'foreign' => 'id_service'));
    }
}