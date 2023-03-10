<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Secteuractivite', 'doctrine');

/**
 * BaseSecteuractivite
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property Doctrine_Collection $Dossiercomptable
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method string              getLibelle()          Returns the current record's "libelle" value
 * @method Doctrine_Collection getDossiercomptable() Returns the current record's "Dossiercomptable" collection
 * @method Secteuractivite     setId()               Sets the current record's "id" value
 * @method Secteuractivite     setLibelle()          Sets the current record's "libelle" value
 * @method Secteuractivite     setDossiercomptable() Sets the current record's "Dossiercomptable" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSecteuractivite extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('secteuractivite');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'secteuractivite_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Dossiercomptable', array(
             'local' => 'id',
             'foreign' => 'id_secteuractivite'));
    }
}