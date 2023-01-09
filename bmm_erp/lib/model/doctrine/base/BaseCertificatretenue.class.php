<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Certificatretenue', 'doctrine');

/**
 * BaseCertificatretenue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_fournisseur
 * @property integer $id_documentbudget
 * @property string $objetreglement
 * @property decimal $montantordonnance
 * @property decimal $montantordonnancenet
 * @property decimal $montantht
 * @property decimal $tvadue
 * @property decimal $tvacomprise
 * @property decimal $tvaretenue
 * @property decimal $montantretenue
 * @property date $datecreation
 * @property integer $id_retenuesource
 * @property Fournisseur $Fournisseur
 * @property Documentbudget $Documentbudget
 * @property Retenuesource $Retenuesource
 * 
 * @method integer           getId()                   Returns the current record's "id" value
 * @method integer           getIdFournisseur()        Returns the current record's "id_fournisseur" value
 * @method integer           getIdDocumentbudget()     Returns the current record's "id_documentbudget" value
 * @method string            getObjetreglement()       Returns the current record's "objetreglement" value
 * @method decimal           getMontantordonnance()    Returns the current record's "montantordonnance" value
 * @method decimal           getMontantordonnancenet() Returns the current record's "montantordonnancenet" value
 * @method decimal           getMontantht()            Returns the current record's "montantht" value
 * @method decimal           getTvadue()               Returns the current record's "tvadue" value
 * @method decimal           getTvacomprise()          Returns the current record's "tvacomprise" value
 * @method decimal           getTvaretenue()           Returns the current record's "tvaretenue" value
 * @method decimal           getMontantretenue()       Returns the current record's "montantretenue" value
 * @method date              getDatecreation()         Returns the current record's "datecreation" value
 * @method integer           getIdRetenuesource()      Returns the current record's "id_retenuesource" value
 * @method Fournisseur       getFournisseur()          Returns the current record's "Fournisseur" value
 * @method Documentbudget    getDocumentbudget()       Returns the current record's "Documentbudget" value
 * @method Retenuesource     getRetenuesource()        Returns the current record's "Retenuesource" value
 * @method Certificatretenue setId()                   Sets the current record's "id" value
 * @method Certificatretenue setIdFournisseur()        Sets the current record's "id_fournisseur" value
 * @method Certificatretenue setIdDocumentbudget()     Sets the current record's "id_documentbudget" value
 * @method Certificatretenue setObjetreglement()       Sets the current record's "objetreglement" value
 * @method Certificatretenue setMontantordonnance()    Sets the current record's "montantordonnance" value
 * @method Certificatretenue setMontantordonnancenet() Sets the current record's "montantordonnancenet" value
 * @method Certificatretenue setMontantht()            Sets the current record's "montantht" value
 * @method Certificatretenue setTvadue()               Sets the current record's "tvadue" value
 * @method Certificatretenue setTvacomprise()          Sets the current record's "tvacomprise" value
 * @method Certificatretenue setTvaretenue()           Sets the current record's "tvaretenue" value
 * @method Certificatretenue setMontantretenue()       Sets the current record's "montantretenue" value
 * @method Certificatretenue setDatecreation()         Sets the current record's "datecreation" value
 * @method Certificatretenue setIdRetenuesource()      Sets the current record's "id_retenuesource" value
 * @method Certificatretenue setFournisseur()          Sets the current record's "Fournisseur" value
 * @method Certificatretenue setDocumentbudget()       Sets the current record's "Documentbudget" value
 * @method Certificatretenue setRetenuesource()        Sets the current record's "Retenuesource" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCertificatretenue extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('certificatretenue');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'certificatretenue_id',
             'length' => 4,
             ));
        $this->hasColumn('id_fournisseur', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_documentbudget', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('objetreglement', 'string', 200, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 200,
             ));
        $this->hasColumn('montantordonnance', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantordonnancenet', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantht', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('tvadue', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('tvacomprise', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('tvaretenue', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('montantretenue', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('datecreation', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_retenuesource', 'integer', 4, array(
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
        $this->hasOne('Fournisseur', array(
             'local' => 'id_fournisseur',
             'foreign' => 'id'));

        $this->hasOne('Documentbudget', array(
             'local' => 'id_documentbudget',
             'foreign' => 'id'));

        $this->hasOne('Retenuesource', array(
             'local' => 'id_retenuesource',
             'foreign' => 'id'));
    }
}