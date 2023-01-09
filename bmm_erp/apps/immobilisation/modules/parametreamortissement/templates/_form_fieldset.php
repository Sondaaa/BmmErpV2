<legend>Configuration Impression Code à Barre</legend>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php if ('NONE' != $fieldset): ?>
        <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
    <?php endif; ?>

    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php
        if ($name != 'dateamortissement')
            include_partial('parametreamortissement/form_field', array(
                'name' => $name,
                'attributes' => $field->getConfig('attributes', array()),
                'label' => $field->getConfig('label'),
                'help' => $field->getConfig('help'),
                'form' => $form,
                'field' => $field,
                'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_form_field_' . $name,
            ))
            ?>
    <?php endforeach; ?>
</fieldset>
<fieldset>
    <?php $immobilisation = ImmobilisationTable::getInstance()->getFirstImmobilisation(); ?>
    <?php $emplacement = EmplacementTable::getInstance()->findOneByIdBureauAndIdImmo($immobilisation->getIdBureaux(), $immobilisation->getId()); ?>
    <div class="col-lg-4">
        <div>
            <label for="parametreamortissement_widthcode">Tester Configuration Code à Barre Avec :</label>
            <div class="content">
                <table>
                    <tr>
                        <td colspan="3">
                            Immobilisation : <a href="<?php echo url_for('Immob/show?id=' . $immobilisation->getId()) ?>" target="_blank"><?php echo $immobilisation; ?></a>
                            <br>
                            <?php if ($emplacement): ?>
                                <?php $bureau = BureauxTable::getInstance()->findOneById($emplacement->getIdBureau()); ?>
                                Bureau : <?php echo $bureau; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Nombre</td>
                        <td>
                            <select id="nombre">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option <?php echo $i; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td style="text-align: center;">
                            <button onclick="printListAgents()" class="btn btn-white btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer Test</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div>
            <div id="zone_test">
                <div style="width: 100%; padding-top: 25px;">
                    <?php $param = $form->getObject(); ?>
                    <?php include_partial('immobilisation/barCodeC128.class'); ?>
                    <?php
                    if ($emplacement):
//                        $code = new Code128();
//
//                        $code->setData($emplacement->getReference());
//                        $code->setDimensions($param->getWidthcode(), $param->getheightcode());
//                        $code->draw();
//
//                        $cheminfile = sfconfig::get('sf_appdir') . "codebarre/";
//                        $code->save($cheminfile . $emplacement->getReference() . ".png");
                        ?>
                        <ul class="barcode">
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
                            <?php  $padding_left = $param->getWidthticket() - strlen($emplacement->getReference()) ?>
                            <li style="padding-left: <?php echo $padding_left ?>px;">
                                <?php
                                // include 1D barcode class (search for installation path)
                                include_partial('immobilisation/tcpdf_barcodes_1d_include');

                                // set the barcode content and type
                                $barcodeobj = new TCPDFBarcode($emplacement->getReference(), 'C128');
                                echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                                ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="col-lg-4">
        <legend>Date de Calcule Amortissement</legend>
        <div>
            <label for="parametreamortissement_dateamortissement">Date d'amortissement</label>
            <div class="content">
                <input type="date" name="parametreamortissement[dateamortissement]" value="<?php echo $param->getDateamortissement(); ?>" id="parametreamortissement_dateamortissement">
            </div>
        </div>
    </div>
</fieldset>

<script>

    var values = "<?php echo $param->getFooter(); ?>";
    $.each(values.split(","), function (i, e) {
        $("#parametreamortissement_footer option[value='" + e + "']").prop("selected", true);
    });

    var values = "<?php echo $param->getHeader(); ?>";
    $.each(values.split(","), function (i, e) {
        $("#parametreamortissement_header option[value='" + e + "']").prop("selected", true);
    });

    function saveParam(id) {
        $.ajax({
            url: '<?php echo url_for('parametreamortissement/save') ?>',
            data: 'id=' + id +
                    '&heightcode=' + $("#parametreamortissement_heightcode").val() +
                    '&widthcode=' + $("#parametreamortissement_widthcode").val() +
                    '&taillecaractere=' + $("#parametreamortissement_taillecaractere").val() +
                    '&fontcaractere=' + $("#parametreamortissement_fontcaractere").val() +
                    '&align=' + $("#parametreamortissement_align").val() +
                    '&header=' + $("#parametreamortissement_header").val() +
                    '&footer=' + $("#parametreamortissement_footer").val() +
                    '&border=' + $("#parametreamortissement_border").val() +
                    '&heightticket=' + $("#parametreamortissement_heightticket").val() +
                    '&widthticket=' + $("#parametreamortissement_widthticket").val() +
                    '&dateamortissement=' + $("#parametreamortissement_dateamortissement").val(),
            success: function (data) {
                document.location.reload();
            }
        });
    }

    function printListAgents() {
        var url = '?id=<?php echo $immobilisation->getId(); ?>' + '&nombre=' + $('#nombre').val();
        url = '<?php echo url_for('parametreamortissement/imprimerTest') ?>' + url;
        window.open(url, '_blank');
        win.focus();
    }

</script>

<style>

    .barcode{
        border: <?php echo $param->getBorder(); ?>px solid #000;
        background-color: #F0F0F0;
        margin: 0px;
        padding-top: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-bottom: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-left: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;
        padding-right: <?php echo ($param->getWidthticket() - $param->getWidthcode()) / 2 ?>px;
        width: <?php echo $param->getWidthticket() / 10 ?>cm;
        text-align: <?php echo $param->getAlign() ?>;
    }

</style>