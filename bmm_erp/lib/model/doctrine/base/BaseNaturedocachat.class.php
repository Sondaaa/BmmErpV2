<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Naturedocachat', 'doctrine');

/**
 * BaseNaturedocachat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $libelle
 
 * @property string $id_user
 * @property string             
 * @property Doctrine_Collection $Documentachat
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getCode()          Returns the current record's "code" value
 * @method string              getLibelle()       Returns the current record's "libelle" value
 * @method string              getIduser()     Returns the current record's "id_user" value
 * @method Doctrine_Collection getDocumentachat() Returns the current record's "Documentachat" collection
 * @method Naturedocachat      setId()            Sets the current record's "id" value
 * @method Naturedocachat      setCode()          Sets the current record's "code" value
 * @method Naturedocachat      setLibelle()       Sets the current record's "libelle" value
 * @method Naturedocachat      setIdUser    	  Sets the current record's "id_user" value
 * @method Naturedocachat      setDocumentachat() Sets the current record's "Documentachat" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseNaturedocachat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('naturedocachat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'naturedocachat_id',
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
			 $this->hasColumn('id_user', 'string', null, array(
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
        $this->hasMany('Documentachat', array(
             'local' => 'id',
             'foreign' => 'id_naturedoc'));
    }
}