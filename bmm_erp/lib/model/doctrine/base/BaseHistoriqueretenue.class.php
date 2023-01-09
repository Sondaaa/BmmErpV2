<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Historiqueretenue', 'doctrine');

/**
 * BaseHistoriqueretenue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_retenue
 * @property integer $id_demandeavance
 * @property integer $id_demandepret
 * @property integer $mois
 * @property integer $annee
 * @property decimal $montant
 * @property decimal $montantrestant
 * @property string $typeextraction
 * @property date $datedemandeextraction
 * @property integer $nbrmoissoustre
 * @property decimal $montantsoustre
 * @property decimal $montantmensuel
 * @property integer $nbrmoispaye
 * @property string $reference
 * @property date $daterecue
 * @property Demandeavance $Demandeavance
 * @property Demandepret $Demandepret
 * @property Retenuesursalaire $Retenuesursalaire
 * @property Doctrine_Collection $Paie
 * 
 * @method integer             getId()                    Returns the current record's "id" value
 * @method integer             getIdRetenue()             Returns the current record's "id_retenue" value
 * @method integer             getIdDemandeavance()       Returns the current record's "id_demandeavance" value
 * @method integer             getIdDemandepret()         Returns the current record's "id_demandepret" value
 * @method integer             getMois()                  Returns the current record's "mois" value
 * @method integer             getAnnee()                 Returns the current record's "annee" value
 * @method decimal             getMontant()               Returns the current record's "montant" value
 * @method decimal             getMontantrestant()        Returns the current record's "montantrestant" value
 * @method string              getTypeextraction()        Returns the current record's "typeextraction" value
 * @method date                getDatedemandeextraction() Returns the current record's "datedemandeextraction" value
 * @method integer             getNbrmoissoustre()        Returns the current record's "nbrmoissoustre" value
 * @method decimal             getMontantsoustre()        Returns the current record's "montantsoustre" value
 * @method decimal             getMontantmensuel()        Returns the current record's "montantmensuel" value
 * @method integer             getNbrmoispaye()           Returns the current record's "nbrmoispaye" value
 * @method string              getReference()             Returns the current record's "reference" value
 * @method date                getDaterecue()             Returns the current record's "daterecue" value
 * @method Demandeavance       getDemandeavance()         Returns the current record's "Demandeavance" value
 * @method Demandepret         getDemandepret()           Returns the current record's "Demandepret" value
 * @method Retenuesursalaire   getRetenuesursalaire()     Returns the current record's "Retenuesursalaire" value
 * @method Doctrine_Collection getPaie()                  Returns the current record's "Paie" collection
 * @method Historiqueretenue   setId()                    Sets the current record's "id" value
 * @method Historiqueretenue   setIdRetenue()             Sets the current record's "id_retenue" value
 * @method Historiqueretenue   setIdDemandeavance()       Sets the current record's "id_demandeavance" value
 * @method Historiqueretenue   setIdDemandepret()         Sets the current record's "id_demandepret" value
 * @method Historiqueretenue   setMois()                  Sets the current record's "mois" value
 * @method Historiqueretenue   setAnnee()                 Sets the current record's "annee" value
 * @method Historiqueretenue   setMontant()               Sets the current record's "montant" value
 * @method Historiqueretenue   setMontantrestant()        Sets the current record's "montantrestant" value
 * @method Historiqueretenue   setTypeextraction()        Sets the current record's "typeextraction" value
 * @method Historiqueretenue   setDatedemandeextraction() Sets the current record's "datedemandeextraction" value
 * @method Historiqueretenue   setNbrmoissoustre()        Sets the current record's "nbrmoissoustre" value
 * @method Historiqueretenue   setMontantsoustre()        Sets the current record's "montantsoustre" value
 * @method Historiqueretenue   setMontantmensuel()        Sets the current record's "montantmensuel" value
 * @method Historiqueretenue   setNbrmoispaye()           Sets the current record's "nbrmoispaye" value
 * @method Historiqueretenue   setReference()             Sets the current record's "reference" value
 * @method Historiqueretenue   setDaterecue()             Sets the current record's "daterecue" value
 * @method Historiqueretenue   setDemandeavance()         Sets the current record's "Demandeavance" value
 * @method Historiqueretenue   setDemandepret()           Sets the current record's "Demandepret" value
 * @method Historiqueretenue   setRetenuesursalaire()     Sets the current record's "Retenuesursalaire" value
 * @method Historiqueretenue   setPaie()                  Sets the current record's "Paie" collection
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHistoriqueretenue extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('historiqueretenue');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'historiqueretenue_id',
             'length' => 4,
             ));
        $this->hasColumn('id_retenue', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_demandeavance', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_demandepret', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('mois', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('annee', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantrestant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('typeextraction', 'string', 55, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 55,
             ));
        $this->hasColumn('datedemandeextraction', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('nbrmoissoustre', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('montantsoustre', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantmensuel', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('nbrmoispaye', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('reference', 'string', 255, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 255,
             ));
        $this->hasColumn('daterecue', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Demandeavance', array(
             'local' => 'id_demandeavance',
             'foreign' => 'id'));

        $this->hasOne('Demandepret', array(
             'local' => 'id_demandepret',
             'foreign' => 'id'));

        $this->hasOne('Retenuesursalaire', array(
             'local' => 'id_retenue',
             'foreign' => 'id'));

        $this->hasMany('Paie', array(
             'local' => 'id',
             'foreign' => 'id_historiqueretenue'));
    }
}