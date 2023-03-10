<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Typecommande', 'doctrine');

/**
 * BaseTypecommande
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $designation
 * @property Doctrine_Collection $Detailcommande
 * @property Doctrine_Collection $Fournisseur
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getCode()           Returns the current record's "code" value
 * @method string              getDesignation()    Returns the current record's "designation" value
 * @method Doctrine_Collection getDetailcommande() Returns the current record's "Detailcommande" collection
 * @method Doctrine_Collection getFournisseur()    Returns the current record's "Fournisseur" collection
 * @method Typecommande        setId()             Sets the current record's "id" value
 * @method Typecommande        setCode()           Sets the current record's "code" value
 * @method Typecommande        setDesignation()    Sets the current record's "designation" value
 * @method Typecommande        setDetailcommande() Sets the current record's "Detailcommande" collection
 * @method Typecommande        setFournisseur()    Sets the current record's "Fournisseur" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTypecommande extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('typecommande');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'typecommande_id',
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
        $this->hasColumn('designation', 'string', null, array(
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
        $this->hasMany('Detailcommande', array(
             'local' => 'id',
             'foreign' => 'id_typecommande'));

        $this->hasMany('Fournisseur', array(
             'local' => 'id',
             'foreign' => 'id_typecomande'));
    }
}