<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligneprimecontrat', 'doctrine');

/**
 * BaseLigneprimecontrat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_agents
 * @property integer $id_prime
 * @property string $libelle
 * @property integer $id_contrat
 * @property integer $nordre
 * @property date $datedebutvalidemodifprime
 * @property date $datefinvalidemodifiprime
 * @property Agents $Agents
 * @property Contrat $Contrat
 * @property Primes $Primes
 * 
 * @method integer           getId()                        Returns the current record's "id" value
 * @method integer           getIdAgents()                  Returns the current record's "id_agents" value
 * @method integer           getIdPrime()                   Returns the current record's "id_prime" value
 * @method string            getLibelle()                   Returns the current record's "libelle" value
 * @method integer           getIdContrat()                 Returns the current record's "id_contrat" value
 * @method integer           getNordre()                    Returns the current record's "nordre" value
 * @method date              getDatedebutvalidemodifprime() Returns the current record's "datedebutvalidemodifprime" value
 * @method date              getDatefinvalidemodifiprime()  Returns the current record's "datefinvalidemodifiprime" value
 * @method Agents            getAgents()                    Returns the current record's "Agents" value
 * @method Contrat           getContrat()                   Returns the current record's "Contrat" value
 * @method Primes            getPrimes()                    Returns the current record's "Primes" value
 * @method Ligneprimecontrat setId()                        Sets the current record's "id" value
 * @method Ligneprimecontrat setIdAgents()                  Sets the current record's "id_agents" value
 * @method Ligneprimecontrat setIdPrime()                   Sets the current record's "id_prime" value
 * @method Ligneprimecontrat setLibelle()                   Sets the current record's "libelle" value
 * @method Ligneprimecontrat setIdContrat()                 Sets the current record's "id_contrat" value
 * @method Ligneprimecontrat setNordre()                    Sets the current record's "nordre" value
 * @method Ligneprimecontrat setDatedebutvalidemodifprime() Sets the current record's "datedebutvalidemodifprime" value
 * @method Ligneprimecontrat setDatefinvalidemodifiprime()  Sets the current record's "datefinvalidemodifiprime" value
 * @method Ligneprimecontrat setAgents()                    Sets the current record's "Agents" value
 * @method Ligneprimecontrat setContrat()                   Sets the current record's "Contrat" value
 * @method Ligneprimecontrat setPrimes()                    Sets the current record's "Primes" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigneprimecontrat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ligneprimecontrat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
			  'sequence' => 'ligneprimecontrat_id',
             'length' => 4,
			 
             ));
        $this->hasColumn('id_agents', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_prime', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nordre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datedebutvalidemodifprime', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('datefinvalidemodifiprime', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Agents', array(
             'local' => 'id_agents',
             'foreign' => 'id'));

        $this->hasOne('Contrat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

        $this->hasOne('Primes', array(
             'local' => 'id_prime',
             'foreign' => 'id'));
    }
}