<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Lignepiececomptable', 'doctrine');

/**
 * BaseLignepiececomptable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $libelle
 * @property string $reference
 * @property string $numeroexterne
 * @property date $date
 * @property decimal $montantdebit
 * @property decimal $montantcredit
 * @property string $lettrelettrage
 * @property integer $id_piececomptable
 * @property integer $id_comptecomptable
 
  * @property integer $id_regelment
 * @property integer $id_contrepartie
 * @property integer $id_naturepiece
 * @property integer $id_factureachat
 * @property integer $id_factureod
 * @property integer $id_factureodclient
 * @property integer $id_factureavente
 * @property integer $id_mouvement
 * @property Piececomptable $Piececomptable
 * @property Plandossiercomptable $Plandossiercomptable
 * @property Plandossiercomptable $Plandossiercomptablecontre
 * @property Naturepiece $Naturepiece
 * @property Facturecomptableachat $Facturecomptableachat
 * @property Facturecomptablevente $Facturecomptablevente
 * 
 * @method integer               getId()                     Returns the current record's "id" value
 * @method string                getLibelle()                Returns the current record's "libelle" value
 * @method string                getReference()              Returns the current record's "reference" value
 * @method string                getNumeroexterne()          Returns the current record's "numeroexterne" value
 * @method date                  getDate()                   Returns the current record's "date" value
 * @method decimal               getMontantdebit()           Returns the current record's "montantdebit" value
 * @method decimal               getMontantcredit()          Returns the current record's "montantcredit" value
 * @method string                getLettrelettrage()         Returns the current record's "lettrelettrage" value
 * @method integer               getIdPiececomptable()       Returns the current record's "id_piececomptable" value
 * @method integer               getIdComptecomptable()      Returns the current record's "id_comptecomptable" value
 * @method integer               getIdContrepartie()         Returns the current record's "id_contrepartie" value
 * @method integer               getIdNaturepiece()          Returns the current record's "id_naturepiece" value
 * @method integer               getIdFactureod()         Returns the current record's "id_factureod" value
 
 * @method integer               getIdMouvement()         Returns the current record's "id_mouvement" value
 * @method integer               getIdFactureodclient()         Returns the current record's "id_factureodclient" value

 * @method integer               getIdFactureachat()         Returns the current record's "id_factureachat" value
 
 * @method integer               getIdRegelment()         Returns the current record's "id_regelment" value
 * @method integer               getIdFacturevente()         Returns the current record's "id_facturevente" value
 * @method Piececomptable        getPiececomptable()         Returns the current record's "Piececomptable" value
 * @method Plandossiercomptable  getPlandossiercomptable()   Returns the current record's "Plandossiercomptable" value
 * @method Plandossiercomptable  getPlandossiercomptablecontre()   Returns the current record's "Plandossiercomptablecontre" value
 * @method Naturepiece           getNaturepiece()            Returns the current record's "Naturepiece" value
 * @method Facturecomptableachat getFacturecomptableachat()  Returns the current record's "Facturecomptableachat" value
 * @method Facturecomptablevente getFacturecomptablevente()  Returns the current record's "Facturecomptablevente" value
 * @method Lignepiececomptable   setId()                     Sets the current record's "id" value
 * @method Lignepiececomptable   setLibelle()                Sets the current record's "libelle" value
 * @method Lignepiececomptable   setReference()              Sets the current record's "reference" value
 * @method Lignepiececomptable   setNumeroexterne()          Sets the current record's "numeroexterne" value
 * @method Lignepiececomptable   setDate()                   Sets the current record's "date" value
 * @method Lignepiececomptable   setMontantdebit()           Sets the current record's "montantdebit" value
 * @method Lignepiececomptable   setMontantcredit()          Sets the current record's "montantcredit" value
 * @method Lignepiececomptable   setLettrelettrage()         Sets the current record's "lettrelettrage" value
 * @method Lignepiececomptable   setIdPiececomptable()       Sets the current record's "id_piececomptable" value
 * @method Lignepiececomptable   setIdComptecomptable()      Sets the current record's "id_comptecomptable" value
 * @method Lignepiececomptable   setIdContrepartie()         Sets the current record's "id_contrepartie" value
 * @method Lignepiececomptable   setIdNaturepiece()          Sets the current record's "id_naturepiece" value
 * @method Lignepiececomptable   setIdFactureachat()         Sets the current record's "id_factureachat" value
 
 * @method Lignepiececomptable   setIdMouvement()         Sets the current record's "id_mouvement" value
 * @method Lignepiececomptable   setIdRegelment()         Sets the current record's "id_regelment" value
 * @method Lignepiececomptable   setIdFactureod()            Sets the current record's "id_factureod" value
 
  * @method Lignepiececomptable   setIdFactureodclient()            Sets the current record's "id_factureodclient" value
 * @method Lignepiececomptable   setIdFacturevente()         Sets the current record's "id_facturevente" value
 * @method Lignepiececomptable   setPiececomptable()         Sets the current record's "Piececomptable" value
 * @method Lignepiececomptable   setPlandossiercomptable()   Sets the current record's "Plandossiercomptable" value
 * @method Lignepiececomptable   setPlandossiercomptablecontre()  Sets the current record's "Plandossiercomptablecontre" value
 * @method Lignepiececomptable   setNaturepiece()            Sets the current record's "Naturepiece" value
 * @method Lignepiececomptable   setFacturecomptableachat()  Sets the current record's "Facturecomptableachat" value
 * @method Lignepiececomptable   setFacturecomptablevente()  Sets the current record's "Facturecomptablevente" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLignepiececomptable extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lignepiececomptable');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'lignepiececomptable_id',
             'length' => 4,
             ));
        $this->hasColumn('libelle', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('reference', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('numeroexterne', 'string', 50, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('montantdebit', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '0',
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantcredit', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'default' => '0',
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('lettrelettrage', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('id_piececomptable', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => true,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_comptecomptable', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_contrepartie', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_naturepiece', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_factureachat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			 
			  $this->hasColumn('id_mouvement', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			 $this->hasColumn('id_regelment', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			 $this->hasColumn('id_factureod', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
			 
			 $this->hasColumn('id_factureodclient', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_facturevente', 'integer', 4, array(
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
        $this->hasOne('Piececomptable', array(
             'local' => 'id_piececomptable',
             'foreign' => 'id'));

        $this->hasOne('Plandossiercomptable', array(
             'local' => 'id_comptecomptable',
             'foreign' => 'id'));

        $this->hasOne('Plandossiercomptable  as  Plandossiercomptablecontre', array(
             'local' => 'id_contrepartie',
             'foreign' => 'id'));

        $this->hasOne('Naturepiece', array(
             'local' => 'id_naturepiece',
             'foreign' => 'id'));

        $this->hasOne('Facturecomptableachat', array(
             'local' => 'id_factureachat',
             'foreign' => 'id'));
			 
		 $this->hasOne('Movementpiece', array(
		 'local' => 'id_mouvement',
		 'foreign' => 'id'));
          $this->hasOne('Facturecomptableod', array(
             'local' => 'id_factureod',
             'foreign' => 'id'));
			 
			 $this->hasOne('Facturecomptableodclient', array(
             'local' => 'id_factureodclient',
             'foreign' => 'id'));
        $this->hasOne('Facturecomptablevente', array(
             'local' => 'id_facturevente',
             'foreign' => 'id'));
			 
		  $this->hasOne('Reglementcomptable', array(
		 'local' => 'id_regelment',
		 'foreign' => 'id'));
    }
}