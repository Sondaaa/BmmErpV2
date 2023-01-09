<?php if (isset($immobilisations)) { ?>
    <?php $bureau = Doctrine_Core::getTable('bureaux')->findOneById($bur); ?>
    <?php $param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); ?>
    <?php include_partial('immobilisation/barCodeC128.class'); ?>
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
                <!--                <ul>
                                    <li style="font-size: 7px;font-weight: bold;font-family: calibri light;">
                <?php // echo $immobilisation->getDesignation(); ?>
                                    </li>
                                    <li>
                <?php // echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacment_codebarre->getReference() . '.png">'; ?>
                                    </li>
                                    <li style="font-size: 7px;font-weight: bold;font-family: calibri light;"><?php // echo $bureau;     ?></li>
                                </ul>-->

                <ul class="barcode" style="list-style:none; margin-left: -47px;">
                    <li style="height:32px; font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                        <?php $header = split(',', $param->getHeader()); ?>
                        <?php $entete = ''; ?>
                        <?php for ($i = 0; $i < sizeof($header); $i++): ?>
                            <?php
                            switch ($header[$i]):
                                case 0:
                                    $entete = $entete . $immobilisation->getNumero() . ' ';
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
                        <?php echo trim($entete); ?>
                    </li>
                    <?php $padding_left = $param->getWidthticket() - strlen($emplacement->getReference()); ?>
                    <li style="padding-left: 0px;">
                        <?php
                        // set the barcode content and type
                        //$barcodeobj = new TCPDFBarcode($emplacement->getReference(), 'C128');
                        //echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                        ?>
                        <?php echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacement->getReference() . '.png" width="150" height="150">'; ?>
                    </li>
                    <li style="height:14px;font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                        <?php $footer = split(',', $param->getFooter()); ?>
                        <?php $pied = ''; ?>
                        <?php for ($i = 0; $i < sizeof($footer); $i++): ?>
                            <?php
                            switch ($footer[$i]):
                                case 0:
                                    $pied = $pied . $immobilisation->getNumero() . ' ';
                                    break;
                                case 1:
                                    $pied = $pied . $immobilisation->getReference() . ' ';
                                    break;
                                case 2:
                                    $pied = $pied . $immobilisation->getDesignation() . ' ';
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

<!--<style>
    ul {
        list-style-type: none;
        margin-left:-30px;
    }

    ul li a {
        color: green;
        text-decoration: none;
        padding: 3px;
        display: block;
    }

    @media screen and (max-width: 699px) and (min-width: 520px) {
        ul li a {
        }
    }

    @media screen and (max-width: 1000px) and (min-width: 700px) {
        ul li a:before {
            color: #666666;
        }
    }
</style>-->
<style>

    img {
        /*  margin-top: 5px;*/
        /*width: 90%;*/
        /*height: <?php // echo $param->getHeightcode() ?>px;*/
    }

</style>

<style>

    .barcode{
        border: <?php echo $param->getBorder(); ?>px solid #000;
        background-color: #FFF;
        margin: 0px;
        padding-top: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 4 ?>px;
        padding-bottom: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 4 ?>px;
        padding-left: 14mm;
        padding-right: 0px;
        /*width: <?php // echo $param->getWidthticket() / 10 ?>cm;*/
        text-align: <?php echo $param->getAlign() ?>;
    }

</style>

<script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script  type="text/javascript">

    window.print();

    var myVar = setInterval(function () {
        chargement();
    }, 1);

    var x = 1;
    function chargement() {
        if (document.readyState == "complete") {
            if (x == 1) {

                // document.location="<?php // echo url_for(array('module' => 'immobilisation', 'action' => 'imprimercb'))       ?>";
            }
            x++;
        }
    }

</script>
