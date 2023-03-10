<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Formuleprimes', 'doctrine');

/**
 * BaseFormuleprimes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Primes
 * 
 * @method integer             getId()      Returns the current record's "id" value
 * @method string              getLibelle() Returns the current record's "libelle" value
 * @method Doctrine_Collection getPrimes()  Returns the current record's "Primes" collection
 * @method Formuleprimes       setId()      Sets the current record's "id" value
 * @method Formuleprimes       setLibelle() Sets the current record's "libelle" value
 * @method Formuleprimes       setPrimes()  Sets the current record's "Primes" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFormuleprimes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('formuleprimes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'formuleprimes_id',
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
        $this->hasMany('Primes', array(
             'local' => 'id',
             'foreign' => 'id_typeformule'));
    }
}