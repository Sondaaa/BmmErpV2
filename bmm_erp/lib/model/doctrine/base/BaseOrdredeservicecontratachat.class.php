<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Ordredeservicecontratachat', 'doctrine');

/**
 * BaseOrdredeservicecontratachat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $reference
 * @property string $object
 * @property string $description
 * @property integer $id_type
 * @property date $dateios
 * @property integer $id_contrat
 * @property integer $delaios
 * @property integer $id_frs
 * @property integer $id_docachat
 * @property Contratachat $Contratachat
 * @property Typeios $Typeios
 * @property Fournisseur $Fournisseur
 * @property Documentachat $Documentachat
 * @property Doctrine_Collection $Piecejoint
 * 
 * @method integer                    getId()            Returns the current record's "id" value
 * @method string                     getReference()     Returns the current record's "reference" value
 * @method string                     getObject()        Returns the current record's "object" value
 * @method string                     getDescription()   Returns the current record's "description" value
 * @method integer                    getIdType()        Returns the current record's "id_type" value
 * @method date                       getDateios()       Returns the current record's "dateios" value
 * @method integer                    getIdContrat()     Returns the current record's "id_contrat" value
 * @method integer                    getDelaios()       Returns the current record's "delaios" value
 * @method integer                    getIdFrs()         Returns the current record's "id_frs" value
 * @method integer                    getIdDocachat()    Returns the current record's "id_docachat" value
 * @method Contratachat               getContratachat()  Returns the current record's "Contratachat" value
 * @method Typeios                    getTypeios()       Returns the current record's "Typeios" value
 * @method Fournisseur                getFournisseur()   Returns the current record's "Fournisseur" value
 * @method Documentachat              getDocumentachat() Returns the current record's "Documentachat" value
 * @method Doctrine_Collection        getPiecejoint()    Returns the current record's "Piecejoint" collection
 * @method Ordredeservicecontratachat setId()            Sets the current record's "id" value
 * @method Ordredeservicecontratachat setReference()     Sets the current record's "reference" value
 * @method Ordredeservicecontratachat setObject()        Sets the current record's "object" value
 * @method Ordredeservicecontratachat setDescription()   Sets the current record's "description" value
 * @method Ordredeservicecontratachat setIdType()        Sets the current record's "id_type" value
 * @method Ordredeservicecontratachat setDateios()       Sets the current record's "dateios" value
 * @method Ordredeservicecontratachat setIdContrat()     Sets the current record's "id_contrat" value
 * @method Ordredeservicecontratachat setDelaios()       Sets the current record's "delaios" value
 * @method Ordredeservicecontratachat setIdFrs()         Sets the current record's "id_frs" value
 * @method Ordredeservicecontratachat setIdDocachat()    Sets the current record's "id_docachat" value
 * @method Ordredeservicecontratachat setContratachat()  Sets the current record's "Contratachat" value
 * @method Ordredeservicecontratachat setTypeios()       Sets the current record's "Typeios" value
 * @method Ordredeservicecontratachat setFournisseur()   Sets the current record's "Fournisseur" value
 * @method Ordredeservicecontratachat setDocumentachat() Sets the current record's "Documentachat" value
 * @method Ordredeservicecontratachat setPiecejoint()    Sets the current record's "Piecejoint" collection
 * 
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOrdredeservicecontratachat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ordredeservicecontratachat');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'ordredeservicecontratachat_id',
             'length' => 4,
             ));
        $this->hasColumn('reference', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('object', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('id_type', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('dateios', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_contrat', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('delaios', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_frs', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_docachat', 'integer', 4, array(
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
        $this->hasOne('Contratachat', array(
             'local' => 'id_contrat',
             'foreign' => 'id'));

        $this->hasOne('Typeios', array(
             'local' => 'id_type',
             'foreign' => 'id'));

        $this->hasOne('Fournisseur', array(
             'local' => 'id_frs',
             'foreign' => 'id'));

        $this->hasOne('Documentachat', array(
             'local' => 'id_docachat',
             'foreign' => 'id'));

        $this->hasMany('Piecejoint', array(
             'local' => 'id',
             'foreign' => 'id_orderservicecontrat'));
    }
}