<?php

// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Retenuesource', 'doctrine');

/**
 * BaseRetenuesource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property decimal $valeurretenue
 * @property Doctrine_Collection $Certificatretenue
 * 
 * @method integer       getId()            Returns the current record's "id" value
 * @method string        getLibelle()       Returns the current record's "libelle" value
 * @method decimal       getValeurretenue() Returns the current record's "valeurretenue" value
 * @method Doctrine_Collection getCertificatretenue() Returns the current record's "Certificatretenue" collection
 * @method Retenuesource setId()            Sets the current record's "id" value
 * @method Retenuesource setLibelle()       Sets the current record's "libelle" value
 * @method Retenuesource setValeurretenue() Sets the current record's "valeurretenue" value
 * @method Retenuesource       setCertificatretenue() Sets the current record's "Certificatretenue" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRetenuesource extends sfDoctrineRecord {

    public function setTableDefinition() {
        $this->setTableName('retenuesource');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'fixed' => 0,
            'unsigned' => false,
            'primary' => true,
            'sequence' => 'retenuesource_id',
            'length' => 4,
        ));
        $this->hasColumn('libelle', 'string', 20, array(
            'type' => 'string',
            'fixed' => 1,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 20,
        ));
        $this->hasColumn('valeurretenue', 'decimal', 18, array(
            'type' => 'decimal',
            'fixed' => 0,
            'unsigned' => false,
            'notnull' => false,
            'primary' => false,
            'length' => 18,
        ));
    }

    public function setUp() {
        parent::setUp();
        $this->hasMany('Certificatretenue', array(
            'local' => 'id',
            'foreign' => 'id_retenuesource'));
    }

}
