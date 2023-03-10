<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Fonction', 'doctrine');

/**
 * BaseFonction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property Doctrine_Collection $Historiquefonctions
 * @property Doctrine_Collection $Primes
 * @property Doctrine_Collection $Contrat
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getDescription()         Returns the current record's "description" value
 * @method Doctrine_Collection getHistoriquefonctions() Returns the current record's "Historiquefonctions" collection
 * @method Doctrine_Collection getPrimes()              Returns the current record's "Primes" collection
 * @method Doctrine_Collection getContrat()             Returns the current record's "Contrat" collection
 * @method Fonction            setId()                  Sets the current record's "id" value
 * @method Fonction            setDescription()         Sets the current record's "description" value
 * @method Fonction            setHistoriquefonctions() Sets the current record's "Historiquefonctions" collection
 * @method Fonction            setPrimes()              Sets the current record's "Primes" collection
 * @method Fonction            setContrat()             Sets the current record's "Contrat" collection
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFonction extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('fonction');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'fonction_id',
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 100, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Historiquefonctions', array(
             'local' => 'id',
             'foreign' => 'id_fonction'));

        $this->hasMany('Primes', array(
             'local' => 'id',
             'foreign' => 'id_fonction'));

        $this->hasMany('Contrat', array(
             'local' => 'id',
             'foreign' => 'id_fonction'));
    }
}