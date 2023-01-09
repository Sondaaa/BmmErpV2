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
            <?php
            if (isset($immobilisations)) {
                include_partial('immobilisation/barCodeC128.class');
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
                                    ?>
                                    <tr>
                                        <td><?php echo $immobilisation->getDesignation(); ?></td>
                                        <td><?php echo $emplacment_codebarre->getReference(); ?></td>
                                        <td>
                                            <?php
                                            $code = new Code128();

                                            $code->setData($emplacment_codebarre->getReference());
                                            $code->setDimensions(190, 20);
                                            $code->draw();

                                            $cheminfile = sfconfig::get('sf_appdir') . "codebarre/";
                                            $code->save($cheminfile . $emplacment_codebarre->getReference() . ".png");

                                            echo '<img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacment_codebarre->getReference() . '.png">';
                                            ?>
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

<script  type="text/javascript">
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