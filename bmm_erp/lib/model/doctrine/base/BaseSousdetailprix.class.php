<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Sousdetailprix', 'doctrine');

/**
 * BaseSousdetailprix
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $designation
 * @property integer $id_unite
 * @property decimal $quetiteant
 * @property decimal $qtemois
 * @property decimal $qtecumule
 * @property decimal $prixunitaire
 * @property decimal $prixthtva
 * @property integer $id_detail
 * @property integer $id_sousdetail
 * @property decimal $nordre
 * @property decimal $ancienqte
 * @property string $typeavenant
 * @property Unitemarche $Unitemarche
 * @property Detailprix $Detailprix
 * @property Doctrine_Collection $Sousdetailprix
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getDesignation()    Returns the current record's "designation" value
 * @method integer             getIdUnite()        Returns the current record's "id_unite" value
 * @method decimal             getQuetiteant()     Returns the current record's "quetiteant" value
 * @method decimal             getQtemois()        Returns the current record's "qtemois" value
 * @method decimal             getQtecumule()      Returns the current record's "qtecumule" value
 * @method decimal             getPrixunitaire()   Returns the current record's "prixunitaire" value
 * @method decimal             getPrixthtva()      Returns the current record's "prixthtva" value
 * @method integer             getIdDetail()       Returns the current record's "id_detail" value
 * @method integer             getIdSousdetail()   Returns the current record's "id_sousdetail" value
 * @method decimal             getNordre()         Returns the current record's "nordre" value
 * @method decimal             getAncienqte()      Returns the current record's "ancienqte" value
 * @method string              getTypeavenant()    Returns the current record's "typeavenant" value
 * @method Unitemarche         getUnitemarche()    Returns the current record's "Unitemarche" value
 * @method Detailprix          getDetailprix()     Returns the current record's "Detailprix" value
 * @method Doctrine_Collection getSousdetailprix() Returns the current record's "Sousdetailprix" collection
 * @method Sousdetailprix      setId()             Sets the current record's "id" value
 * @method Sousdetailprix      setDesignation()    Sets the current record's "designation" value
 * @method Sousdetailprix      setIdUnite()        Sets the current record's "id_unite" value
 * @method Sousdetailprix      setQuetiteant()     Sets the current record's "quetiteant" value
 * @method Sousdetailprix      setQtemois()        Sets the current record's "qtemois" value
 * @method Sousdetailprix      setQtecumule()      Sets the current record's "qtecumule" value
 * @method Sousdetailprix      setPrixunitaire()   Sets the current record's "prixunitaire" value
 * @method Sousdetailprix      setPrixthtva()      Sets the current record's "prixthtva" value
 * @method Sousdetailprix      setIdDetail()       Sets the current record's "id_detail" value
 * @method Sousdetailprix      setIdSousdetail()   Sets the current record's "id_sousdetail" value
 * @method Sousdetailprix      setNordre()         Sets the current record's "nordre" value
 * @method Sousdetailprix      setAncienqte()      Sets the current record's "ancienqte" value
 * @method Sousdetailprix      setTypeavenant()    Sets the current record's "typeavenant" value
 * @method Sousdetailprix      setUnitemarche()    Sets the current record's "Unitemarche" value
 * @method Sousdetailprix      setDetailprix()     Sets the current record's "Detailprix" value
 * @method Sousdetailprix      setSousdetailprix() Sets the current record's "Sousdetailprix" collection
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSousdetailprix extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sousdetailprix');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'sousdetailprix_id',
             'length' => 4,
             ));
        $this->hasColumn('designation', 'string', 250, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 250,
             ));
        $this->hasColumn('id_unite', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('quetiteant', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('qtemois', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('qtecumule', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('prixunitaire', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('prixthtva', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('id_detail', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_sousdetail', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('nordre', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('ancienqte', 'decimal', 18, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 18,
             ));
        $this->hasColumn('typeavenant', 'string', 10, array(
             'type' => 'string',
             'fixed' => 1,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Unitemarche', array(
             'local' => 'id_unite',
             'foreign' => 'id'));

        $this->hasOne('Detailprix', array(
             'local' => 'id_detail',
             'foreign' => 'id'));

        $this->hasMany('Sousdetailprix', array(
             'local' => 'id',
             'foreign' => 'id_sousdetail'));
    }
}