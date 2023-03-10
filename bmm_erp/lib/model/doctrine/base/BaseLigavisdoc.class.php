<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligavisdoc', 'doctrine');

/**
 * BaseLigavisdoc
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_avis
 * @property integer $id_doc
 * @property date $datecreation
 * @property integer $id_ligprotitrub
 * @property decimal $mntdisponible
 * @property Documentachat $Documentachat
 * @property Avis $Avis
 * @property Ligprotitrub $Ligprotitrub
 * 
 * @method integer       getId()              Returns the current record's "id" value
 * @method integer       getIdAvis()          Returns the current record's "id_avis" value
 * @method integer       getIdDoc()           Returns the current record's "id_doc" value
 * @method date          getDatecreation()    Returns the current record's "datecreation" value
 * @method integer       getIdLigprotitrub()  Returns the current record's "id_ligprotitrub" value
 * @method decimal       getMntdisponible()   Returns the current record's "mntdisponible" value
 * @method Documentachat getDocumentachat()   Returns the current record's "Documentachat" value
 * @method Avis          getAvis()            Returns the current record's "Avis" value
 * @method Ligprotitrub  getLigprotitrub()    Returns the current record's "Ligprotitrub" value
 * @method Ligavisdoc    setId()              Sets the current record's "id" value
 * @method Ligavisdoc    setIdAvis()          Sets the current record's "id_avis" value
 * @method Ligavisdoc    setIdDoc()           Sets the current record's "id_doc" value
 * @method Ligavisdoc    setDatecreation()    Sets the current record's "datecreation" value
 * @method Ligavisdoc    setIdLigprotitrub()  Sets the current record's "id_ligprotitrub" value
 * @method Ligavisdoc    setMntdisponible()   Sets the current record's "mntdisponible" value
 * @method Ligavisdoc    setDocumentachat()   Sets the current record's "Documentachat" value
 * @method Ligavisdoc    setAvis()            Sets the current record's "Avis" value
 * @method Ligavisdoc    setLigprotitrub()    Sets the current record's "Ligprotitrub" value
 * 
 * @package    PhpProjecttest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigavisdoc extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ligavisdoc');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ligavisdoc_id',
             'length' => 4,
             ));
        $this->hasColumn('id_avis', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_doc', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('datecreation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_ligprotitrub', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mntdisponible', 'decimal', 18, array(
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
        $this->hasOne('Documentachat', array(
             'local' => 'id_doc',
             'foreign' => 'id'));

        $this->hasOne('Avis', array(
             'local' => 'id_avis',
             'foreign' => 'id'));

        $this->hasOne('Ligprotitrub', array(
             'local' => 'id_ligprotitrub',
             'foreign' => 'id'));
    }
}