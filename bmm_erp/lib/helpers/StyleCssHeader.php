<?php

class StyleCssHeader {

    public static function header1() {
        $html = '<style>
    h3 {
        font-family: times;
        font-size: 12pt;
        text-align: center;
    }
    
    span {
        font-family: times;
        font-size: 10pt;
        color: #000000 !important;
    }
    
    h6 {
        font-family: times;
        font-size: 9pt;
    }
   
    .tableclass{
        width: 750px;
        padding-left: 59%;
        margin-top: -6%;
    }
    
    .tableclass td {
        border: 2px solid #000;
    }
   
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
     .tableligne{
        padding: 1px;
        border: 1px solid #000;
    }
    
    .tableclass{
        border: 1px dashed #000000 ;
        padding: 5px;
    }
    
    .tableligne{
        padding: 5px;
    }
    
    .tableligne td{
        border: 1px solid #000;
        padding: 5px;
        text-align: center;
    } 
    
    .tableclass  th{
        border: 1px solid #000;
        font-weight: bold;
        font-size: 9pt;
        text-align: center;
    } 
    
    .tableligne th{
        border: 1px solid #000;
        font-weight: bold;
        font-size: 9pt;
        text-align: center;
    }
    
    .tableclass td{
        text-align: justify;
        border: 1px solid #000;
    }

    body{
        border: 1px solid #000;
    }
    
    .secondtd{
        background-color: #fff;
    }
    
    .fersttd{
        background-color: #f6f8f4;
    }
    
    td{
        padding: 1%;
    }
</style>';
        return $html;
    }

    public static function header2() {
        $html = '<style>
                    h3 {
                        font-family: times;
                        font-size: 16pt;
                        text-align: center;
                    }
                </style>';
        return $html;
    }

    public static function header3() {
        $html = '<style>
                    h3 {
                        font-size: 16pt;
                        text-align: center;
                    }
                </style>';
        return $html;
    }

    public static function header4() {
        $html = '<style>
    h3 {
        font-size: 12pt;
        text-align: center;
    }
    
    span {
        font-family: times;
        font-size: 10pt;
        color: #000000 !important;
    }
    
    h6 {
        font-family: times;
        font-size: 9pt;
    }
   
    .tableclass{
        width: 750px;
        padding-left: 59%;
        margin-top: -6%;
    }
    
    .tableclass td {border: 2px solid #000;}
    .lowercase {text-transform: lowercase;}
    .uppercase {text-transform: uppercase;}
    .capitalize {text-transform: capitalize;}
    
     .tableligne{
        padding: 1px;
        border: 1px solid #000;
    }
    
    .tableclass{
        border: 1px dashed #000000 ;
        padding: 5px;
    }
    
    .tableligne{padding: 5px;}
    
    .tableligne td{
        border: 1px solid #000;
        padding: 5px;
        text-align: center;
    } 
    
    .tableclass  th{
        border: 1px solid #000;
        font-weight: bold;
        font-size: 9pt;
        text-align: center;
    } 
    
    .tableligne th{
        border: 1px solid #000;
        font-weight: bold;
        font-size: 9pt;
        text-align: center;
    }
    
    .tableclass td{
        text-align: justify;
        border: 1px solid #000;
    }

    body{border: 1px solid #000;}
    .secondtd{background-color: #fff;}
    .fersttd{background-color: #f6f8f4;}
    td{padding: 1%;}
</style>';
        return $html;
    }

}

?>
