<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Objectdocument', 'doctrine');

/**
 * BaseObjectdocument
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property string $numeroobject
 * @property string $marqueobject
 * @property date $dateentreeobjet
 * @property Doctrine_Collection $Documentachat
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method string              getLibelle()         Returns the current record's "libelle" value
 * @method string              getNumeroobject()    Returns the current record's "numeroobject" value
 * @method string              getMarqueobject()    Returns the current record's "marqueobject" value
 * @method date                getDateentreeobjet() Returns the current record's "dateentreeobjet" value
 * @method Doctrine_Collection getDocumentachat()   Returns the current record's "Documentachat" collection
 * @method Objectdocument      setId()              Sets the current record's "id" value
 * @method Objectdocument      setLibelle()         Sets the current record's "libelle" value
 * @method Objectdocument      setNumeroobject()    Sets the current record's "numeroobject" value
 * @method Objectdocument      setMarqueobject()    Sets the current record's "marqueobject" value
 * @method Objectdocument      setDateentreeobjet() Sets the current record's "dateentreeobjet" value
 * @method Objectdocument      setDocumentachat()   Sets the current record's "Documentachat" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseObjectdocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('objectdocument');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
        $this->hasColumn('numeroobject', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
        $this->hasColumn('marqueobject', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 254,
             ));
        $this->hasColumn('dateentreeobjet', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Documentachat', array(
             'local' => 'id',
             'foreign' => 'id_objet'));
    }
}