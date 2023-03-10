<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Pays', 'doctrine');

/**
 * BasePays
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $pays
 * @property Doctrine_Collection $Gouvernera
 * @property Doctrine_Collection $Adressefrs
 * @property Doctrine_Collection $Magasin
 * @property Doctrine_Collection $Immobilisation
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getPays()           Returns the current record's "pays" value
 * @method Doctrine_Collection getGouvernera()     Returns the current record's "Gouvernera" collection
 * @method Doctrine_Collection getAdressefrs()     Returns the current record's "Adressefrs" collection
 * @method Doctrine_Collection getMagasin()        Returns the current record's "Magasin" collection
 * @method Doctrine_Collection getImmobilisation() Returns the current record's "Immobilisation" collection
 * @method Pays                setId()             Sets the current record's "id" value
 * @method Pays                setPays()           Sets the current record's "pays" value
 * @method Pays                setGouvernera()     Sets the current record's "Gouvernera" collection
 * @method Pays                setAdressefrs()     Sets the current record's "Adressefrs" collection
 * @method Pays                setMagasin()        Sets the current record's "Magasin" collection
 * @method Pays                setImmobilisation() Sets the current record's "Immobilisation" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePays extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pays');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'pays_id',
             'length' => 4,
             ));
        $this->hasColumn('pays', 'string', null, array(
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
        $this->hasMany('Gouvernera', array(
             'local' => 'id',
             'foreign' => 'id_pays'));

        $this->hasMany('Adressefrs', array(
             'local' => 'id',
             'foreign' => 'id_pays'));

        $this->hasMany('Magasin', array(
             'local' => 'id',
             'foreign' => 'id_pay'));

        $this->hasMany('Immobilisation', array(
             'local' => 'id',
             'foreign' => 'id_pays'));
    }
}