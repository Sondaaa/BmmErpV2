<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Codesociale', 'doctrine');

/**
 * BaseCodesociale
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $libelle
 * @property decimal $taux
 * 
 * @method integer     getId()      Returns the current record's "id" value
 * @method string      getCode()    Returns the current record's "code" value
 * @method string      getLibelle() Returns the current record's "libelle" value
 * @method decimal     getTaux()    Returns the current record's "taux" value
 * @method Codesociale setId()      Sets the current record's "id" value
 * @method Codesociale setCode()    Sets the current record's "code" value
 * @method Codesociale setLibelle() Sets the current record's "libelle" value
 * @method Codesociale setTaux()    Sets the current record's "taux" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCodesociale extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('codesociale');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'codesociale_id',
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('taux', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}