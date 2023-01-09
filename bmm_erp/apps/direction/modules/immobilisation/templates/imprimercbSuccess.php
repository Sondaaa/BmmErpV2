<div id="sf_admin_container" class="panel panel-green">
    <h1>Liste Code à barre</h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter">
            <form action="<?php echo url_for('@Imprimercb') ?>" method="post">
                <table>
                    <tr>
                        <td><label>Bureau</label></td>
                        <td>
                            <select name="bur" class="selectpicker">
                                <option></option>
                                <?php
                                foreach ($bureaux as $bure) {
                                    ?>
                                    <?php if ($bur != -1 && $bur == $bure->getId()) { ?>
                                        <option selected="selected" value="<?php echo $bure->getId() ?>"><?php echo $bure; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $bure->getId() ?>"><?php echo $bure; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Recherche"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <?php $param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); ?>
            <?php
            if (isset($immobilisations)) {
                include_partial('immobilisation/barCodeC128.class');
                // include 1D barcode class (search for installation path)
                include_partial('immobilisation/tcpdf_barcodes_1d_include');
                ?>
                <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                    <thead>
                        <tr>
                            <th>Immob.</th>
                            <th>Code barre </th>
                            <th>Code générer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $immobilisation_new = new Immobilisation();
                        $emplacment_codebarre = new Emplacement();
                        //  die("hh".count($immobilisations));
                        foreach ($immobilisations as $immobilisation) {
                            $immobilisation_new = $immobilisation;
                            if ($immobilisation_new->getDatemiseenrebut() == "" || $immobilisation_new->getDatemiseenrebut() == "0000-00-00") {
                                $emplacement = Doctrine_Core::getTable('emplacement')->findOneByIdBureauAndIdImmo($immobilisation_new->getIdBureaux(), $immobilisation_new->getId());
                                if ($emplacement) {
                                    $emplacment_codebarre = $emplacement;
                                    $bureau = BureauxTable::getInstance()->findOneById($emplacement->getIdBureau());
                                    ?>
                                    <tr>
                                        <td><?php echo $immobilisation->getDesignation(); ?></td>
                                        <td><?php echo $emplacment_codebarre->getReference(); ?></td>
                                        <td>
                                            <?php
//                                            $code = new Code128();
//
//                                            $code->setData($emplacment_codebarre->getReference());
//                                            $code->setDimensions(190, 20);
//                                            $code->draw();
//
//                                            $cheminfile = $_SERVER['DOCUMENT_ROOT'] . "/codebarre/";
//                                            $code->save($cheminfile . $emplacment_codebarre->getReference() . ".png");
//
//                                            echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacment_codebarre->getReference() . '.png">';
                                            ?>

                                            <?php
                                            if ($emplacement):
                                                $code = new Code128();

                                                $code->setData($emplacement->getReference());
                                                $code->setDimensions($param->getWidthcode(), $param->getheightcode());
                                                $code->draw();
                                                    
                                                $cheminfile =  sfConfig::get('codebarre') ;
                                                $code->save($cheminfile . $emplacement->getReference() . ".png");
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
                                                    <?php  $padding_left = $param->getWidthticket() - strlen($emplacement->getReference()); ?>
                                                    <li style="padding-left: 0px;">
                                                        <?php
                                                        // set the barcode content and type
                                                        //$barcodeobj = new TCPDFBarcode($emplacement->getReference(), 'C128');
                                                        //echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                                                        ?>
                                                        <?php echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacement->getReference() . '.png">'; ?>
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
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
            <?php if ($bur != -1): ?>
                <a id="btn_impdirect" target="_blanc" href="<?php echo url_for('immobilisation/imprimercode?bur=' . $bur) ?>" class="btn btn-primary" style="color: white"> Imprimer codes</a>
                <a id="btn_impdirect" target="_blanc" href="<?php echo url_for('immobilisation/ImprimerListeBarcode?bur=' . $bur) ?>" class="btn btn-primary" style="color: white"> Imprimer listes</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script language="javascript">
    function getXMLHttpRequest() {

        var xhr = null;

        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }

        return xhr;
    }
    function ModifierQte(id) {
        id_articlesite = "qtecb_" + id;
        qte = document.getElementById(id_articlesite).value;
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                result = xhr.responseText;
                //alert(result);
            }
        };

        xhr.open("POST", "<?php echo url_for(array('module' => 'articlesite', 'action' => 'Modifiercb')) ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("id=" + id + "&qte=" + qte);
    }

</script>

<style>

    .barcode{
        border: <?php echo $param->getBorder(); ?>px solid #000;
        background-color: #F0F0F0;
        margin: 0px;
        padding-top: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-bottom: <?php echo ($param->getHeightticket() - $param->getHeightcode()) / 2 ?>px;
        padding-left: 0px;
        padding-right: 0px;
        width: <?php echo $param->getWidthticket() / 10 ?>cm;
        text-align: <?php echo $param->getAlign() ?>;
    }

</style>