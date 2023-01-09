<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Parametrenote', 'doctrine');

/**
 * BaseParametrenote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $contenue
 * @property integer $id_dossier
 * @property Dossiercomptable $Dossiercomptable
 * 
 * @method integer       getId()         Returns the current record's "id" value
 * @method string        getContenue()   Returns the current record's "contenue" value
 * @method integer       getIdDossier()  Returns the current record's "id_dossier" value
 * @method Dossiercomptable    getDossiercomptable()  Returns the current record's "Dossiercomptable" value
 * @method Parametrenote setId()         Sets the current record's "id" value
 * @method Parametrenote setContenue()   Sets the current record's "contenue" value
 * @method Parametrenote setIdDossier()  Sets the current record's "id_dossier" value
 * @method Parametrenote setDossiercomptable()  Sets the current record's "Dossiercomptable" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseParametrenote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('parametrenote');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'parametrenote_id',
             'length' => 4,
             ));
        $this->hasColumn('contenue', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_dossier', 'integer', 4, array(
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
        $this->hasOne('Dossiercomptable', array(
             'local' => 'id_dossier',
             'foreign' => 'id'));
        
    }
}