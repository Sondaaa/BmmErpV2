<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Tableauxammortisement', 'doctrine');

/**
 * BaseTableauxammortisement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_immobilisation
 * @property date $date_aquisition
 * @property string $vorigine
 * @property string $taux
 * @property string $dotation
 * @property string $amrtinterieur
 * @property string $amrtcumile
 * @property string $vcn
 * @property date $datetableux
 * @property Immobilisation $Immobilisation
 * 
 * @method integer               getId()                Returns the current record's "id" value
 * @method integer               getIdImmobilisation()  Returns the current record's "id_immobilisation" value
 * @method date                  getDateAquisition()    Returns the current record's "date_aquisition" value
 * @method string                getVorigine()          Returns the current record's "vorigine" value
 * @method string                getTaux()              Returns the current record's "taux" value
 * @method string                getDotation()          Returns the current record's "dotation" value
 * @method string                getAmrtinterieur()     Returns the current record's "amrtinterieur" value
 * @method string                getAmrtcumile()        Returns the current record's "amrtcumile" value
 * @method string                getVcn()               Returns the current record's "vcn" value
 * @method date                  getDatetableux()       Returns the current record's "datetableux" value
 * @method Immobilisation        getImmobilisation()    Returns the current record's "Immobilisation" value
 * @method Tableauxammortisement setId()                Sets the current record's "id" value
 * @method Tableauxammortisement setIdImmobilisation()  Sets the current record's "id_immobilisation" value
 * @method Tableauxammortisement setDateAquisition()    Sets the current record's "date_aquisition" value
 * @method Tableauxammortisement setVorigine()          Sets the current record's "vorigine" value
 * @method Tableauxammortisement setTaux()              Sets the current record's "taux" value
 * @method Tableauxammortisement setDotation()          Sets the current record's "dotation" value
 * @method Tableauxammortisement setAmrtinterieur()     Sets the current record's "amrtinterieur" value
 * @method Tableauxammortisement setAmrtcumile()        Sets the current record's "amrtcumile" value
 * @method Tableauxammortisement setVcn()               Sets the current record's "vcn" value
 * @method Tableauxammortisement setDatetableux()       Sets the current record's "datetableux" value
 * @method Tableauxammortisement setImmobilisation()    Sets the current record's "Immobilisation" value
 * 
 * @package    InventaireTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTableauxammortisement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tableauxammortisement');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_immobilisation', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('date_aquisition', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('vorigine', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('taux', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('dotation', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('amrtinterieur', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('amrtcumile', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('vcn', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('datetableux', 'date', 25, array(
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
        $this->hasOne('Immobilisation', array(
             'local' => 'id_immobilisation',
             'foreign' => 'id'));
    }
}