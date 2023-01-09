<div class="page-header">
<h1>Liste Code à barre</h1>
</div>
<div class="row" class="panel panel-green">
    
    <div class="col-xs-12">
        <div class="col-xs-12">
     
         
            <form action="<?php echo url_for('@Imprimercb') ?>" method="post">
                <table class="table table-striped table-bordered table-hover ">
                    <tr>
                        <td><label>Bureau</label></td>
                        <td>
                            <select name="bur" id='id_bureau' class="selectpicker">
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
                        <td>
                            <input type="submit" value="Recherche"></td>
                            <td>
                        <input id="" 
                  onclick="printlistecodeImmobilisation()"  class="btn btn-xs btn-primary" 
                   style="color: white" value="Imprimer codes "/></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-xs-12">
        <div class="sf_admin_list">
            <?php $param = ParametreamortissementTable::getInstance()->findAll()->getFirst(); ?>
            <?php
            if (isset($immobilisations)) {

                include_partial('immobilisation/tcpdf_barcodes_1d_include');
            ?>
                <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                    <thead>
                        <tr>
                            <th>Immo.</th>
                            <th>Code Immo.</th>
                            <th>Code Emplacement</th>
                            <th>Code générer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $immobilisation_new = new Immobilisation();
                        $emplacment_codebarre = new Emplacement();
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
                                        <td><?php echo $immobilisation->getRefcodeabarre(); ?></td>
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
                                            if ($emplacement) :
                                                $code = new Code128();

                                                $code->setData($immobilisation->getRefcodeabarre());
                                                $code->setDimensions(220, 20);
                                                $code->draw();

                                                $cheminfile =  sfConfig::get('codebarre');
                                                $code->save($cheminfile . $immobilisation->getRefcodeabarre() . ".png");
                                            ?>
                                                <ul class="barcode">
                                                    <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                                                        <?php $entete = ''; ?>
                                                        <?php if ($param->getLogo()) : ?>
                                                            <img class="logo" src="<?php echo sfconfig::get('sf_appdir') . 'uploads/images/' . $param->getLogo() ?>">
                                                        <?php endif; ?>
                                                        <?php if ($param->getSlogan()) : ?>
                                                            <b> <?php echo $param->getSlogan(); ?> </b>
                                                        <?php endif; ?>
                                                        <?php if ($param->getHeader() && $param->getHeader() != 'null' && !empty($param->getHeader())) : ?>
                                                            <?php $header = explode(',', $param->getHeader()); ?>
                                                            <br>
                                                            <?php for ($i = 0; $i < sizeof($header); $i++) : ?>
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
                                                    <li style="padding-left: 0px;">
                                                        <?php
                                                        // set the barcode content and type
                                                        //$barcodeobj = new TCPDFBarcode($emplacement->getReference(), 'C128');
                                                        //echo $barcodeobj->getBarcodeHTML(1, $param->getheightcode(), 'black');
                                                        ?>
                                                        <?php echo '<img src="' . sfconfig::get('sf_appdir') . 'uploads/codebarre/' . $immobilisation->getRefcodeabarre() . '.png">'; ?>
                                                    </li>
                                                    <li style="font-size: <?php echo $param->getTaillecaractere() ?>px; font-weight: bold; font-family: <?php echo $param->getFontcaractere() ?>;">
                                                        <?php $footer = explode(',', $param->getFooter());?>
                                                        <?php $pied = ''; ?>
                                                        <?php for ($i = 0; $i < sizeof($footer); $i++) : ?>
                                                            <?php
                                                            switch ($footer[$i]):
                                                                case 2:
                                                                    $pied ='<span style="text-align:left">'. $pied . $immobilisation->getDesignation() . '</span> ';
                                                                    break;
                                                                case 1:
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
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td>
                                <a id="btn_impdirect" target="_blanc" 
                                href="<?php echo url_for('immobilisation/imprimercodebarrebureaux').'?id_immo=' . $immobilisation->getId()?>" 
                                class="btn btn-primary" style="color: white"> Imprimer code</a>                                  
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
            <?php if ($bur != -1) : ?>
                <a id="btn_impdirect" target="_blanc" href="<?php echo url_for('immobilisation/imprimercode?bur=' . $bur) ?>" class="btn btn-primary" style="color: white"> Imprimer codes</a>
                <a id="btn_impdirect" target="_blanc" href="<?php echo url_for('immobilisation/ImprimerListeBarcode?bur=' . $bur) ?>" class="btn btn-primary" style="color: white"> Imprimer listes</a>
            <?php endif; ?>
        </div>
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
        xhr.onreadystatechange = function() {
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
<script>
    
    function printlistecodeImmobilisation() {             
             var valide = false;
             var url = '';
             if ($('#id_bureau').val()) {
                 if (url == '')
                     url = '?id_bureau=' + $('#id_bureau').val();
                 valide = true;
             }     
                     
             if (valide) {                 
                 url = '<?php echo url_for('immobilisation/Imprimercodesimmobilisation') ?>' + url;
                 window.open(url, '_blank');
                
             } else {
                 bootbox.dialog({
                     message: "<span class='bigger-110' style='margin:20px;'>Il faut choisir au moins un champ !</span>",
                     buttons: {
                         "button": {
                             "label": "Ok",
                             "className": "btn-sm"
                         }
                     }
                 });
             }
         }
    

   
</script>
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

    li b {
        z-index: 1;
        position: relative;
        top: -20px;
        left: 30px;
    }
</style>