<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ligneregimehoraire', 'doctrine');

/**
 * BaseLigneregimehoraire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_regime
 * @property integer $id_dossier
 * @property string $designation
 * @property integer $nordre
 * @property boolean $pardefaut
 * @property Regimehoraire $Regimehoraire
 * @property Dossiercomptable $Dossiercomptable
 * 
 * @method integer            getId()               Returns the current record's "id" value
 * @method integer            getIdRegime()         Returns the current record's "id_regime" value
 * @method integer            getIdDossier()        Returns the current record's "id_dossier" value
 * @method string             getDesignation()      Returns the current record's "designation" value
 * @method integer            getNordre()           Returns the current record's "nordre" value
 * @method boolean            getPardefaut()        Returns the current record's "pardefaut" value
 * @method Regimehoraire      getRegimehoraire()    Returns the current record's "Regimehoraire" value
 * @method Dossiercomptable   getDossiercomptable() Returns the current record's "Dossiercomptable" value
 * @method Ligneregimehoraire setId()               Sets the current record's "id" value
 * @method Ligneregimehoraire setIdRegime()         Sets the current record's "id_regime" value
 * @method Ligneregimehoraire setIdDossier()        Sets the current record's "id_dossier" value
 * @method Ligneregimehoraire setDesignation()      Sets the current record's "designation" value
 * @method Ligneregimehoraire setNordre()           Sets the current record's "nordre" value
 * @method Ligneregimehoraire setPardefaut()        Sets the current record's "pardefaut" value
 * @method Ligneregimehoraire setRegimehoraire()    Sets the current record's "Regimehoraire" value
 * @method Ligneregimehoraire setDossiercomptable() Sets the current record's "Dossiercomptable" value
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLigneregimehoraire extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ligneregimehoraire');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ligneregimehoraire_id',
             'length' => 4,
             ));
        $this->hasColumn('id_regime', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_dossier', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('designation', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('nordre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pardefaut', 'boolean', 1, array(
             'type' => 'boolean',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Regimehoraire', array(
             'local' => 'id_regime',
             'foreign' => 'id'));

        $this->hasOne('Dossiercomptable', array(
             'local' => 'id_dossier',
             'foreign' => 'id'));
    }
}