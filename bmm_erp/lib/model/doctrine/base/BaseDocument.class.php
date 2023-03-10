<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Document', 'doctrine');

/**
 * BaseDocument
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $numero
 * @property decimal $totalht
 * @property decimal $totalttc
 * @property integer $id_typedoc
 * @property date $datedoc
 * @property integer $id_user
 * @property integer $id_parent
 * @property integer $id_bureau
 * @property Doctrine_Collection $Document
 * @property Bureaux $Bureaux
 * @property Utilisateur $Utilisateur
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getNumero()           Returns the current record's "numero" value
 * @method decimal             getTotalht()          Returns the current record's "totalht" value
 * @method decimal             getTotalttc()         Returns the current record's "totalttc" value
 * @method integer             getIdTypedoc()        Returns the current record's "id_typedoc" value
 * @method date                getDatedoc()          Returns the current record's "datedoc" value
 * @method integer             getIdUser()           Returns the current record's "id_user" value
 * @method integer             getIdParent()         Returns the current record's "id_parent" value
 * @method integer             getIdBureau()  Returns the current record's "id_bureau" value
 * @method Doctrine_Collection getDocument()         Returns the current record's "Document" collection
 * @method Bureaux      getBureaux()   Returns the current record's "Bureaux" value
 * @method Utilisateur         getUtilisateur()      Returns the current record's "Utilisateur" value
 * @method Document            setId()               Sets the current record's "id" value
 * @method Document            setNumero()           Sets the current record's "numero" value
 * @method Document            setTotalht()          Sets the current record's "totalht" value
 * @method Document            setTotalttc()         Sets the current record's "totalttc" value
 * @method Document            setIdTypedoc()        Sets the current record's "id_typedoc" value
 * @method Document            setDatedoc()          Sets the current record's "datedoc" value
 * @method Document            setIdUser()           Sets the current record's "id_user" value
 * @method Document            setIdParent()         Sets the current record's "id_parent" value
 * @method Document            setIdBureau()  Sets the current record's "id_bureau" value
 * @method Document            setDocument()         Sets the current record's "Document" collection
 * @method Document            setBureaux()   Sets the current record's "Bureaux" value
 * @method Document            setUtilisateur()      Sets the current record's "Utilisateur" value
 * 
 * @package    Commercial
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'document_id',
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('totalht', 'decimal', 20, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('totalttc', 'decimal', 20, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('id_typedoc', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('datedoc', 'date', 20, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('id_user', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_parent', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_bureau', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Document', array(
             'local' => 'id',
             'foreign' => 'id_parent'));

        $this->hasOne('Bureaux', array(
             'local' => 'id_bureau',
             'foreign' => 'id'));

        $this->hasOne('Utilisateur', array(
             'local' => 'id_user',
             'foreign' => 'id'));
    }
}