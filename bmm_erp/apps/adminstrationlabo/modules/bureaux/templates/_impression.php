<?php 
if(isset($bureauximprimer)) :
$param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); 


$brnew=new Bureaux();

        foreach($bureauximprimer as $bureau):
         $brnew=$bureau;
         $codebarre=$brnew->getCode();
?>
        <ul class="barcode" style="list-style:none;margin-left: -47px; ">
            <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
            <img class="logo" src="<?php echo sfconfig::get('sf_appdir').'uploads/images/'.$param->getLogo() ?>">

                       <b>          <?php echo $param->getSlogan(); ?> </b>
            </li>
            <?php $padding_left = 5; ?>
            <li style="padding-left: <?php echo $padding_left ?>px;">
                <?php
                // set the barcode content and type
               // $barcodeobj = new TCPDFBarcode($codebarre, 'C128');
               // echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                ?>
                <?php  echo '<img src="' . sfconfig::get('sf_appdir') . '/uploads/codebarre/' . $codebarre . '.png">'; ?>
            </li>
            <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                
              
                <?php echo $codebarre; ?>
            </li>
        </ul>
    <?php 
    
        endforeach;
    ?>


<style>
    .barcode {
         border: <?php echo $param->getBorder(); ?>px solid #000; 
        /* background-color: #F0F0F0; */
        margin: 0px;
       /* padding-top: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-bottom: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-left: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;
        padding-right: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;*/
        width: <?php echo $param->getWidthticket() / 10 ?>cm;
        height: <?php echo $param->getHeightticket() / 10 ?>cm;
        text-align: <?php echo $param->getAlign() ?>;
    }
    .logo {
        margin-left: -70px;
        z-index: 999;
        width: 50px;
        position: relative;
    }
    li b{
        z-index: 1;
        position: relative;
        top: -20px;
        left: 30px;
    }
</style>

<script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script  type="text/javascript">
    window.print();
</script>


<?php
endif;
?>



