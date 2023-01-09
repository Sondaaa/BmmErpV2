<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typedoc', 'doctrine');

/**
 * BaseTypedoc
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property string $conditiontype
 * @property integer $valeurcondition
 * @property string $prefixetype
 * @property integer $prefixevaleur
 * @property Doctrine_Collection $Documentachat
 * @property Doctrine_Collection $Parametragetypedoc
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method string              getLibelle()            Returns the current record's "libelle" value
 * @method string              getConditiontype()      Returns the current record's "conditiontype" value
 * @method integer             getValeurcondition()    Returns the current record's "valeurcondition" value
 * @method string              getPrefixetype()        Returns the current record's "prefixetype" value
 * @method integer             getPrefixevaleur()      Returns the current record's "prefixevaleur" value
 * @method Doctrine_Collection getDocumentachat()      Returns the current record's "Documentachat" collection
 * @method Doctrine_Collection getParametragetypedoc() Returns the current record's "Parametragetypedoc" collection
 * @method Typedoc             setId()                 Sets the current record's "id" value
 * @method Typedoc             setLibelle()            Sets the current record's "libelle" value
 * @method Typedoc             setConditiontype()      Sets the current record's "conditiontype" value
 * @method Typedoc             setValeurcondition()    Sets the current record's "valeurcondition" value
 * @method Typedoc             setPrefixetype()        Sets the current record's "prefixetype" value
 * @method Typedoc             setPrefixevaleur()      Sets the current record's "prefixevaleur" value
 * @method Typedoc             setDocumentachat()      Sets the current record's "Documentachat" collection
 * @method Typedoc             setParametragetypedoc() Sets the current record's "Parametragetypedoc" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypedoc extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typedoc');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typedoc_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('conditiontype', 'string', 254, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 254,
             ));
        $this->hasColumn('valeurcondition', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('prefixetype', 'string', 6, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 6,
             ));
        $this->hasColumn('prefixevaleur', 'integer', 4, array(
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
        $this->hasMany('Documentachat', array(
             'local' => 'id',
             'foreign' => 'id_typedoc'));

        $this->hasMany('Parametragetypedoc', array(
             'local' => 'id',
             'foreign' => 'id_typedoc'));
    }
}