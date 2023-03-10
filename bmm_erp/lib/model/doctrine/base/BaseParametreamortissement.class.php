<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Parametreamortissement', 'doctrine');

/**
 * BaseParametreamortissement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property int                     $id                               Type: integer(4), primary key
 * @property string                  $date                             Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @property string                  $dateamortissement                Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @property string                  $fontcaractere                    Type: string
 * @property string                  $header                           Type: string
 * @property string                  $footer                           Type: string
 * @property int                     $heightcode                       Type: integer(4)
 * @property int                     $widthcode                        Type: integer(4)
 * @property int                     $heightticket                     Type: integer(4)
 * @property int                     $widthticket                      Type: integer(4)
 * @property int                     $taillecaractere                  Type: integer(4)
 * @property string                  $align                            Type: string
 * @property int                     $border                           Type: integer(4)
 * @property string                  $logo                             Type: string
 * @property string                  $slogan                           Type: string
 *  
 * @method int                       getId()                           Type: integer(4), primary key
 * @method string                    getDate()                         Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @method string                    getDateamortissement()            Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @method string                    getFontcaractere()                Type: string
 * @method string                    getHeader()                       Type: string
 * @method string                    getFooter()                       Type: string
 * @method int                       getHeightcode()                   Type: integer(4)
 * @method int                       getWidthcode()                    Type: integer(4)
 * @method int                       getHeightticket()                 Type: integer(4)
 * @method int                       getWidthticket()                  Type: integer(4)
 * @method int                       getTaillecaractere()              Type: integer(4)
 * @method string                    getAlign()                        Type: string
 * @method int                       getBorder()                       Type: integer(4)
 * @method string                    getLogo()                         Type: string
 * @method string                    getSlogan()                       Type: string
 *  
 * @method Parametreamortissement    setId(int $val)                   Type: integer(4), primary key
 * @method Parametreamortissement    setDate(string $val)              Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @method Parametreamortissement    setDateamortissement(string $val) Type: date(25), Date in ISO-8601 format (YYYY-MM-DD)
 * @method Parametreamortissement    setFontcaractere(string $val)     Type: string
 * @method Parametreamortissement    setHeader(string $val)            Type: string
 * @method Parametreamortissement    setFooter(string $val)            Type: string
 * @method Parametreamortissement    setHeightcode(int $val)           Type: integer(4)
 * @method Parametreamortissement    setWidthcode(int $val)            Type: integer(4)
 * @method Parametreamortissement    setHeightticket(int $val)         Type: integer(4)
 * @method Parametreamortissement    setWidthticket(int $val)          Type: integer(4)
 * @method Parametreamortissement    setTaillecaractere(int $val)      Type: integer(4)
 * @method Parametreamortissement    setAlign(string $val)             Type: string
 * @method Parametreamortissement    setBorder(int $val)               Type: integer(4)
 * @method Parametreamortissement    setLogo(string $val)              Type: string
 * @method Parametreamortissement    setSlogan(string $val)            Type: string
 *  
 * @package    Bmm
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseParametreamortissement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('parametreamortissement');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('date', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('dateamortissement', 'date', 25, array(
             'type' => 'date',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('fontcaractere', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('header', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('footer', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('heightcode', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('widthcode', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('heightticket', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('widthticket', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('taillecaractere', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('align', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('border', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('logo', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
        $this->hasColumn('slogan', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'notnull' => false,
             'primary' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}