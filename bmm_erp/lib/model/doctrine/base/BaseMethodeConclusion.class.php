<?php

/**
 * BaseMethodeConclusion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string                                     $name                                            Type: string
 * @property integer                                     $id                                              Type: integer, primary key
 * @property Doctrine_Collection|MarchePrevesionelle[]  $MarchePrevesionelle                             
 *  
 * @method string                                       getName()                                        Type: string
 * @method integer                                       getId()                                          Type: integer, primary key
 * @method Doctrine_Collection|MarchePrevesionelle[]    getMarchePrevesionelle()                         
 *  
 * @method MethodeConclusion                            setName(string $val)                             Type: string
 * @method MethodeConclusion                            setId(integer $val)                               Type: integer, primary key
 * @method MethodeConclusion                            setMarchePrevesionelle(Doctrine_Collection $val) 
 *  
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMethodeConclusion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('methode_conclusion');
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'fixed' => 4,
             'unsigned' => false,
             'primary' => true,
             ));
             
         
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('MarchePrevesionelle', array(
             'local' => 'id',
             'foreign' => 'id_methode'));
    }
}