<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Poste', 'doctrine');

/**
 * BasePoste
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $poste
 * @property Doctrine_Collection $Taches
 * @property Doctrine_Collection $Avis
 * @property Doctrine_Collection $Contrat
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getPoste()   Returns the current record's "poste" value
 * @method Doctrine_Collection getTaches()  Returns the current record's "Taches" collection
 * @method Doctrine_Collection getAvis()    Returns the current record's "Avis" collection
 * @method Doctrine_Collection getContrat() Returns the current record's "Contrat" collection
 * @method Poste               setId()      Sets the current record's "id" value
 * @method Poste               setPoste()   Sets the current record's "poste" value
 * @method Poste               setTaches()  Sets the current record's "Taches" collection
 * @method Poste               setAvis()    Sets the current record's "Avis" collection
 * @method Poste               setContrat() Sets the current record's "Contrat" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePoste extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('poste');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'poste_id',
             'length' => 4,
             ));
        $this->hasColumn('poste', 'string', null, array(
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
        $this->hasMany('Taches', array(
             'local' => 'id',
             'foreign' => 'id_taches'));

        $this->hasMany('Avis', array(
             'local' => 'id',
             'foreign' => 'id_poste'));

        $this->hasMany('Contrat', array(
             'local' => 'id',
             'foreign' => 'id_poste'));
    }
}