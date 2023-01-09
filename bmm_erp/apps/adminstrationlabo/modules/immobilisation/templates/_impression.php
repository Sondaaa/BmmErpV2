<?php if (isset($immobilisations)) { ?>
    <?php $bureau = Doctrine_Core::getTable('bureaux')->findOneById($bur); ?>
    <?php $param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); ?>

    <?php
    $immobilisation_new = new Immobilisation();
    $emplacment_codebarre = new Emplacement();
    foreach ($immobilisations as $immobilisation) {
        $immobilisation_new = $immobilisation;
        if ($immobilisation_new->getDatemiseenrebut() == "" || $immobilisation_new->getDatemiseenrebut() == "0000-00-00") {
            $emplacement = Doctrine_Core::getTable('emplacement')->findOneByIdBureauAndIdImmo($immobilisation_new->getIdBureaux(), $immobilisation_new->getId());
            if ($emplacement) {
                $emplacment_codebarre = $emplacement;
                $bureau = Doctrine_Core::getTable('bureaux')->findOneById($emplacment_codebarre->getIdBureau());
    ?>


                <ul class="barcode" style="list-style:none; margin-left: -47px;">
                    <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                    <?php $entete = ''; ?> 
                    <?php if($param->getLogo()):?> 
                    <img class="logo" src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $param->getLogo() ?>">
                        <?php endif;?>
                        <?php if($param->getSlogan()):?> 
                        <b> <?php echo $param->getSlogan(); ?> </b>
                        <?php endif;?>
                        </li>
                        <li class="intop" style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                    <?php if($param->getHeader() && $param->getHeader()!='null' && !empty($param->getHeader())):?>
                    <?php $header = explode(',', $param->getHeader()); ?>
                           
                    <?php for ($i = 0; $i < sizeof($header); $i++) :?>
                        <?php
                        switch ($header[$i]):
                            case 0:
                                $entete = $entete . $immobilisation->getRefcodeabarre() . ' ';
                                break;
                            case 1:
                                $entete = $entete . $immobilisation->getReference() . ' ';
                                break;
                            case 2:
                                $entete = $entete . $immobilisation->getDesignation() . ' ';
                                break;
                            case 3:
                                $entete = $entete . $bureau->getCode() . ' ';
                                break;
                            case 4:
                                $entete = $entete . $bureau->getBureau() . ' ';
                                break;
                        endswitch;
                        ?>
                    <?php endfor; ?>
                    <?php endif; ?>
                    <?php echo trim($entete); ?>
                    </li>
                    <?php $padding_left = $param->getWidthticket() - strlen($immobilisation->getRefcodeabarre()); ?>
                    <li class="intop" style="padding-left: 0px;">

                        <?php echo '<img src="' . sfconfig::get('sf_appdir') . 'uploads/codebarre/' . $immobilisation->getRefcodeabarre() . '.png">'; ?>
                    </li>
                    <li class="intop" style=" font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                        <?php $footer = explode(',', $param->getFooter()); ?>
                        <?php $pied = ''; ?>
                        <?php for ($i = 0; $i < sizeof($footer); $i++) : ?>
                            <?php
                            switch ($footer[$i]):
                                case 1:
                                    $pied ='<span style="text-align:left;text-overflow: ellipsis;overflow: hidden;">'. $pied . $immobilisation->getDesignation() . '</span> ';
                                    break;
                                case 0:
                                    $pied = $pied . $immobilisation->getRefcodeabarre() . ' ';
                                    break;
                                case 3:
                                    $pied = $pied . $bureau->getCode() . ' ';
                                    break;
                                
                                case 4:
                                    $pied = $pied . $bureau->getBureau() . ' ';
                                    break;
                            endswitch;
                            ?>
                        <?php endfor; ?>
                        <?php echo trim($pied); ?>
                    </li>
                </ul>

    <?php
            }
        }
    }
    ?>
<?php } ?>



<style>
      .barcode {
         border: <?php echo $param->getBorder(); ?>px solid #000; 
        margin: 0px;
     
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
    .intop{
        top:-15px;
        position: relative;
    }
</style>

<script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    window.print();

    var myVar = setInterval(function() {
        chargement();
    }, 1);

    var x = 1;

    function chargement() {
        if (document.readyState == "complete") {
            if (x == 1) {

                // document.location="<?php // echo url_for(array('module' => 'immobilisation', 'action' => 'imprimercb'))       
                                        ?>";
            }
            x++;
        }
    }
</script>