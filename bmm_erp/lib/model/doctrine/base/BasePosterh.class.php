<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Posterh', 'doctrine');

/**
 * BasePosterh
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property integer $id_unite
 * @property Unite $Unite
 * @property Doctrine_Collection $Taches
 * @property Doctrine_Collection $Contrat
 * @property Doctrine_Collection $Primes
 * 
 * @method integer             getId()       Returns the current record's "id" value
 * @method string              getLibelle()  Returns the current record's "libelle" value
 * @method integer             getIdUnite()  Returns the current record's "id_unite" value
 * @method Unite               getUnite()    Returns the current record's "Unite" value
 * @method Doctrine_Collection getTaches()   Returns the current record's "Taches" collection
 * @method Doctrine_Collection getContrat()  Returns the current record's "Contrat" collection
 * @method Doctrine_Collection getPrimes()   Returns the current record's "Primes" collection
 * @method Posterh             setId()       Sets the current record's "id" value
 * @method Posterh             setLibelle()  Sets the current record's "libelle" value
 * @method Posterh             setIdUnite()  Sets the current record's "id_unite" value
 * @method Posterh             setUnite()    Sets the current record's "Unite" value
 * @method Posterh             setTaches()   Sets the current record's "Taches" collection
 * @method Posterh             setContrat()  Sets the current record's "Contrat" collection
 * @method Posterh             setPrimes()   Sets the current record's "Primes" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePosterh extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('posterh');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'posterh_id',
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
        $this->hasColumn('id_unite', 'integer', 4, array(
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
        $this->hasOne('Unite', array(
             'local' => 'id_unite',
             'foreign' => 'id'));

        $this->hasMany('Taches', array(
             'local' => 'id',
             'foreign' => 'id_posterh'));

        $this->hasMany('Contrat', array(
             'local' => 'id',
             'foreign' => 'id_posterh'));

        $this->hasMany('Primes', array(
             'local' => 'id',
             'foreign' => 'id_poste'));
    }
}