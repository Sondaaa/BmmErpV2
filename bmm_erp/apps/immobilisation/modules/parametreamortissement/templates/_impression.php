<?php $param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); ?>
<?php $immobilisation = ImmobilisationTable::getInstance()->find($id); ?>
<?php include_partial('immobilisation/barCodeC128.class'); ?>
<?php $emplacement = EmplacementTable::getInstance()->findOneByIdBureauAndIdImmo($immobilisation->getIdBureaux(), $immobilisation->getId()); ?>
<?php if ($emplacement): ?>
    <?php $bureau = BureauxTable::getInstance()->findOneById($emplacement->getIdBureau()); ?>
    <?php for ($k = 0; $k < $nombre; $k++): ?>
        <ul class="barcode" style="list-style:none; margin-left: -47px;">
            <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
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
            <li style="padding-left: <?php echo $padding_left ?>px;">
                <?php
                // set the barcode content and type
                $barcodeobj = new TCPDFBarcode($emplacement->getReference(), 'C128');
                echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                ?>
                <?php // echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacement->getReference() . '.png">'; ?>
            </li>
            <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
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
    <?php endfor; ?>
<?php endif; ?>

<style>

    .barcode{
        border: <?php echo $param->getBorder(); ?>px solid #000;
        background-color: #FFF;
        margin: 0px;
        padding-top: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-bottom: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-left: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;
        padding-right: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;
        width: <?php echo $param->getWidthticket() / 10 ?>cm;
        text-align: <?php echo $param->getAlign() ?>;
    }

</style>

<script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script  type="text/javascript">
    window.print();
</script>