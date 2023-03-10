<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Courrier', 'doctrine');

/**
 * BaseCourrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $titre
 * @property string $object
 * @property string $sujet
 * @property string $description
 * @property integer $id_user
 * @property integer $id_mode
 * @property date $datecreation
 * @property integer $id_bureaux
 * @property integer $id_type
 * @property integer $id_courrier
 * @property float $numero
 * @property integer $id_famille
 * @property integer $id_affectation
 * @property string $referencecourrier
 * @property date $datereponse
 * @property integer $id_typeparamcourrier
 * @property string $datecorespondanse
 * @property string $numeroseq
 * @property date $dateredige
 * @property integer $id_famexpdes
 * @property boolean $lire
 * @property Affectaioncourrier $Affectaioncourrier
 * @property Famillecourrier $Famillecourrier
 * @property Typeparamcourrier $Typeparamcourrier
 * @property Bureaux $Bureaux
 * @property Modescourrier $Modescourrier
 * @property Typecourrier $Typecourrier
 * @property Utilisateur $Utilisateur
 * @property Doctrine_Collection $Courrier
 * @property Famexpdes $Famexpdes
 * @property Doctrine_Collection $Parcourcourier
 * @property Doctrine_Collection $Parcourcourier_3
 * @property Doctrine_Collection $Piecejoint
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getTitre()                Returns the current record's "titre" value
 * @method string              getObject()               Returns the current record's "object" value
 * @method string              getSujet()                Returns the current record's "sujet" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method integer             getIdUser()               Returns the current record's "id_user" value
 * @method integer             getIdMode()               Returns the current record's "id_mode" value
 * @method date                getDatecreation()         Returns the current record's "datecreation" value
 * @method integer             getIdBureaux()            Returns the current record's "id_bureaux" value
 * @method integer             getIdType()               Returns the current record's "id_type" value
 * @method integer             getIdCourrier()           Returns the current record's "id_courrier" value
 * @method float               getNumero()               Returns the current record's "numero" value
 * @method integer             getIdFamille()            Returns the current record's "id_famille" value
 * @method integer             getIdAffectation()        Returns the current record's "id_affectation" value
 * @method string              getReferencecourrier()    Returns the current record's "referencecourrier" value
 * @method date                getDatereponse()          Returns the current record's "datereponse" value
 * @method integer             getIdTypeparamcourrier()  Returns the current record's "id_typeparamcourrier" value
 * @method string              getDatecorespondanse()    Returns the current record's "datecorespondanse" value
 * @method string              getNumeroseq()            Returns the current record's "numeroseq" value
 * @method date                getDateredige()           Returns the current record's "dateredige" value
 * @method integer             getIdFamexpdes()          Returns the current record's "id_famexpdes" value
 * @method boolean             getLire()                 Returns the current record's "lire" value
 * @method Affectaioncourrier  getAffectaioncourrier()   Returns the current record's "Affectaioncourrier" value
 * @method Famillecourrier     getFamillecourrier()      Returns the current record's "Famillecourrier" value
 * @method Typeparamcourrier   getTypeparamcourrier()    Returns the current record's "Typeparamcourrier" value
 * @method Bureaux             getBureaux()              Returns the current record's "Bureaux" value
 * @method Modescourrier       getModescourrier()        Returns the current record's "Modescourrier" value
 * @method Typecourrier        getTypecourrier()         Returns the current record's "Typecourrier" value
 * @method Utilisateur         getUtilisateur()          Returns the current record's "Utilisateur" value
 * @method Doctrine_Collection getCourrier()             Returns the current record's "Courrier" collection
 * @method Famexpdes           getFamexpdes()            Returns the current record's "Famexpdes" value
 * @method Doctrine_Collection getParcourcourier()       Returns the current record's "Parcourcourier" collection
 * @method Doctrine_Collection getParcourcourier3()      Returns the current record's "Parcourcourier_3" collection
 * @method Doctrine_Collection getPiecejoint()           Returns the current record's "Piecejoint" collection
 * @method Courrier            setId()                   Sets the current record's "id" value
 * @method Courrier            setTitre()                Sets the current record's "titre" value
 * @method Courrier            setObject()               Sets the current record's "object" value
 * @method Courrier            setSujet()                Sets the current record's "sujet" value
 * @method Courrier            setDescription()          Sets the current record's "description" value
 * @method Courrier            setIdUser()               Sets the current record's "id_user" value
 * @method Courrier            setIdMode()               Sets the current record's "id_mode" value
 * @method Courrier            setDatecreation()         Sets the current record's "datecreation" value
 * @method Courrier            setIdBureaux()            Sets the current record's "id_bureaux" value
 * @method Courrier            setIdType()               Sets the current record's "id_type" value
 * @method Courrier            setIdCourrier()           Sets the current record's "id_courrier" value
 * @method Courrier            setNumero()               Sets the current record's "numero" value
 * @method Courrier            setIdFamille()            Sets the current record's "id_famille" value
 * @method Courrier            setIdAffectation()        Sets the current record's "id_affectation" value
 * @method Courrier            setReferencecourrier()    Sets the current record's "referencecourrier" value
 * @method Courrier            setDatereponse()          Sets the current record's "datereponse" value
 * @method Courrier            setIdTypeparamcourrier()  Sets the current record's "id_typeparamcourrier" value
 * @method Courrier            setDatecorespondanse()    Sets the current record's "datecorespondanse" value
 * @method Courrier            setNumeroseq()            Sets the current record's "numeroseq" value
 * @method Courrier            setDateredige()           Sets the current record's "dateredige" value
 * @method Courrier            setIdFamexpdes()          Sets the current record's "id_famexpdes" value
 * @method Courrier            setLire()                 Sets the current record's "lire" value
 * @method Courrier            setAffectaioncourrier()   Sets the current record's "Affectaioncourrier" value
 * @method Courrier            setFamillecourrier()      Sets the current record's "Famillecourrier" value
 * @method Courrier            setTypeparamcourrier()    Sets the current record's "Typeparamcourrier" value
 * @method Courrier            setBureaux()              Sets the current record's "Bureaux" value
 * @method Courrier            setModescourrier()        Sets the current record's "Modescourrier" value
 * @method Courrier            setTypecourrier()         Sets the current record's "Typecourrier" value
 * @method Courrier            setUtilisateur()          Sets the current record's "Utilisateur" value
 * @method Courrier            setCourrier()             Sets the current record's "Courrier" collection
 * @method Courrier            setFamexpdes()            Sets the current record's "Famexpdes" value
 * @method Courrier            setParcourcourier()       Sets the current record's "Parcourcourier" collection
 * @method Courrier            setParcourcourier3()      Sets the current record's "Parcourcourier_3" collection
 * @method Courrier            setPiecejoint()           Sets the current record's "Piecejoint" collection
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCourrier extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('courrier');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'sequence' => 'courrier_id',
            'length' => 4,
        ));
        $this->hasColumn('titre', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('object', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('sujet', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('description', 'string', null, array(
            'type' => 'string',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('id_user', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_mode', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('datecreation', 'date', 25, array(
            'type' => 'date',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 25,
        ));
        $this->hasColumn('id_bureaux', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_type', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_courrier', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('numero', 'float', null, array(
            'type' => 'float',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => '',
        ));
        $this->hasColumn('id_famille', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('id_affectation', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('referencecourrier', 'string', 254, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 254,
        ));
        $this->hasColumn('datereponse', 'date', 25, array(
            'type' => 'date',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 25,
        ));
        $this->hasColumn('id_typeparamcourrier', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('datecorespondanse', 'string', 254, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 254,
        ));
        $this->hasColumn('numeroseq', 'string', 254, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 254,
        ));
        $this->hasColumn('dateredige', 'date', 25, array(
            'type' => 'date',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 25,
        ));
        $this->hasColumn('id_famexpdes', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 4,
        ));
        $this->hasColumn('lire', 'boolean', 1, array(
            'type' => 'boolean',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'default' => 'false',
            'primary' => false,
            'length' => 1,
        ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasOne('Affectaioncourrier', array(
            'local' => 'id_affectation',
            'foreign' => 'id'));

        $this->hasOne('Famillecourrier', array(
            'local' => 'id_famille',
            'foreign' => 'id'));

        $this->hasOne('Typeparamcourrier', array(
            'local' => 'id_typeparamcourrier',
            'foreign' => 'id'));

        $this->hasOne('Bureaux', array(
            'local' => 'id_bureaux',
            'foreign' => 'id'));

        $this->hasOne('Modescourrier', array(
            'local' => 'id_mode',
            'foreign' => 'id'));

        $this->hasOne('Typecourrier', array(
            'local' => 'id_type',
            'foreign' => 'id'));

        $this->hasOne('Utilisateur', array(
            'local' => 'id_user',
            'foreign' => 'id'));

        $this->hasMany('Courrier', array(
            'local' => 'id',
            'foreign' => 'id_courrier'));

        $this->hasOne('Famexpdes', array(
            'local' => 'id_famexpdes',
            'foreign' => 'id'));

        $this->hasMany('Parcourcourier', array(
            'local' => 'id',
            'foreign' => 'id_courier'));

        $this->hasMany('Parcourcourier as Parcourcourier_3', array(
            'local' => 'id',
            'foreign' => 'id_courrierdest'));

        $this->hasMany('Piecejoint', array(
            'local' => 'id',
            'foreign' => 'id_courrier'));
    }

}
