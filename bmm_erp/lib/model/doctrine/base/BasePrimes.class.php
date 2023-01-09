<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Primes', 'doctrine');

/**
 * BasePrimes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property decimal $montant
 * @property string $salairedebase
 * @property integer $id_categorie
 * @property integer $id_fonction
 * @property integer $id_grade
 * @property integer $id_corpsdet
 * @property integer $id_poste
 * @property integer $id_souscorps
 * @property integer $id_titreprime
 * @property boolean $cotisable
 * @property boolean $imposable
 * @property string $sensprime
 * @property string $typemontant
 * @property integer $id_typeformule
 * @property boolean $tenirjourfconge
 * @property string $formule
 * @property string $variableformule
 * @property boolean $tenirhjsuppavec
 * @property boolean $tenirhjsuppsans
 * @property boolean $primeactiveindemnite
 * @property Categorierh $Categorierh
 * @property Corpsdet $Corpsdet
 * @property Fonction $Fonction
 * @property Grade $Grade
 * @property Posterh $Posterh
 * @property Souscorps $Souscorps
 * @property Titreprimes $Titreprimes
 * @property Formuleprimes $Formuleprimes
 * @property Doctrine_Collection $Ligneprimecontrat
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method decimal             getMontant()              Returns the current record's "montant" value
 * @method string              getSalairedebase()        Returns the current record's "salairedebase" value
 * @method integer             getIdCategorie()          Returns the current record's "id_categorie" value
 * @method integer             getIdFonction()           Returns the current record's "id_fonction" value
 * @method integer             getIdGrade()              Returns the current record's "id_grade" value
 * @method integer             getIdCorpsdet()           Returns the current record's "id_corpsdet" value
 * @method integer             getIdPoste()              Returns the current record's "id_poste" value
 * @method integer             getIdSouscorps()          Returns the current record's "id_souscorps" value
 * @method integer             getIdTitreprime()         Returns the current record's "id_titreprime" value
 * @method boolean             getCotisable()            Returns the current record's "cotisable" value
 * @method boolean             getImposable()            Returns the current record's "imposable" value
 * @method string              getSensprime()            Returns the current record's "sensprime" value
 * @method string              getTypemontant()          Returns the current record's "typemontant" value
 * @method integer             getIdTypeformule()        Returns the current record's "id_typeformule" value
 * @method boolean             getTenirjourfconge()      Returns the current record's "tenirjourfconge" value
 * @method string              getFormule()              Returns the current record's "formule" value
 * @method string              getVariableformule()      Returns the current record's "variableformule" value
 * @method boolean             getTenirhjsuppavec()      Returns the current record's "tenirhjsuppavec" value
 * @method boolean             getTenirhjsuppsans()      Returns the current record's "tenirhjsuppsans" value
 * @method boolean             getPrimeactiveindemnite() Returns the current record's "primeactiveindemnite" value
 * @method Categorierh         getCategorierh()          Returns the current record's "Categorierh" value
 * @method Corpsdet            getCorpsdet()             Returns the current record's "Corpsdet" value
 * @method Fonction            getFonction()             Returns the current record's "Fonction" value
 * @method Grade               getGrade()                Returns the current record's "Grade" value
 * @method Posterh             getPosterh()              Returns the current record's "Posterh" value
 * @method Souscorps           getSouscorps()            Returns the current record's "Souscorps" value
 * @method Titreprimes         getTitreprimes()          Returns the current record's "Titreprimes" value
 * @method Formuleprimes       getFormuleprimes()        Returns the current record's "Formuleprimes" value
 * @method Doctrine_Collection getLigneprimecontrat()    Returns the current record's "Ligneprimecontrat" collection
 * @method Primes              setId()                   Sets the current record's "id" value
 * @method Primes              setDescription()          Sets the current record's "description" value
 * @method Primes              setMontant()              Sets the current record's "montant" value
 * @method Primes              setSalairedebase()        Sets the current record's "salairedebase" value
 * @method Primes              setIdCategorie()          Sets the current record's "id_categorie" value
 * @method Primes              setIdFonction()           Sets the current record's "id_fonction" value
 * @method Primes              setIdGrade()              Sets the current record's "id_grade" value
 * @method Primes              setIdCorpsdet()           Sets the current record's "id_corpsdet" value
 * @method Primes              setIdPoste()              Sets the current record's "id_poste" value
 * @method Primes              setIdSouscorps()          Sets the current record's "id_souscorps" value
 * @method Primes              setIdTitreprime()         Sets the current record's "id_titreprime" value
 * @method Primes              setCotisable()            Sets the current record's "cotisable" value
 * @method Primes              setImposable()            Sets the current record's "imposable" value
 * @method Primes              setSensprime()            Sets the current record's "sensprime" value
 * @method Primes              setTypemontant()          Sets the current record's "typemontant" value
 * @method Primes              setIdTypeformule()        Sets the current record's "id_typeformule" value
 * @method Primes              setTenirjourfconge()      Sets the current record's "tenirjourfconge" value
 * @method Primes              setFormule()              Sets the current record's "formule" value
 * @method Primes              setVariableformule()      Sets the current record's "variableformule" value
 * @method Primes              setTenirhjsuppavec()      Sets the current record's "tenirhjsuppavec" value
 * @method Primes              setTenirhjsuppsans()      Sets the current record's "tenirhjsuppsans" value
 * @method Primes              setPrimeactiveindemnite() Sets the current record's "primeactiveindemnite" value
 * @method Primes              setCategorierh()          Sets the current record's "Categorierh" value
 * @method Primes              setCorpsdet()             Sets the current record's "Corpsdet" value
 * @method Primes              setFonction()             Sets the current record's "Fonction" value
 * @method Primes              setGrade()                Sets the current record's "Grade" value
 * @method Primes              setPosterh()              Sets the current record's "Posterh" value
 * @method Primes              setSouscorps()            Sets the current record's "Souscorps" value
 * @method Primes              setTitreprimes()          Sets the current record's "Titreprimes" value
 * @method Primes              setFormuleprimes()        Sets the current record's "Formuleprimes" value
 * @method Primes              setLigneprimecontrat()    Sets the current record's "Ligneprimecontrat" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePrimes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('primes');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'primes_id',
             'length' => 4,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1000,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('salairedebase', 'string', 1000, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1000,
             ));
        $this->hasColumn('id_categorie', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_fonction', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_grade', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_corpsdet', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_poste', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_souscorps', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_titreprime', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('cotisable', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('imposable', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('sensprime', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('typemontant', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_typeformule', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('tenirjourfconge', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('formule', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('variableformule', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('tenirhjsuppavec', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('tenirhjsuppsans', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('primeactiveindemnite', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Categorierh', array(
             'local' => 'id_categorie',
             'foreign' => 'id'));

        $this->hasOne('Corpsdet', array(
             'local' => 'id_corpsdet',
             'foreign' => 'id'));

        $this->hasOne('Fonction', array(
             'local' => 'id_fonction',
             'foreign' => 'id'));

        $this->hasOne('Grade', array(
             'local' => 'id_grade',
             'foreign' => 'id'));

        $this->hasOne('Posterh', array(
             'local' => 'id_poste',
             'foreign' => 'id'));

        $this->hasOne('Souscorps', array(
             'local' => 'id_souscorps',
             'foreign' => 'id'));

        $this->hasOne('Titreprimes', array(
             'local' => 'id_titreprime',
             'foreign' => 'id'));

        $this->hasOne('Formuleprimes', array(
             'local' => 'id_typeformule',
             'foreign' => 'id'));

        $this->hasMany('Ligneprimecontrat', array(
             'local' => 'id',
             'foreign' => 'id_prime'));
    }
}