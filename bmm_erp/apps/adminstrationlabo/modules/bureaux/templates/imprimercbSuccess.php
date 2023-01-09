<div id="" class="panel panel-green">
    <div id="replacediv" class="panel-heading">Liste Code à barre</div>
    <div id="sf_admin_bar">
        <?php include_partial('immobilisation/barCodeC128.class');?>
        <div class="sf_admin_filter col-xs-6">
            <form action="<?php echo url_for('bureaux/imprimercb') ?>" method="post">
                <table class="table table-striped table-bordered table-hover ">                                    
                    <tr>
                        <td><label>Sous site</label></td>
                        <td>
                            <select name="eta" class="selectpicker">
                                <option></option>
                                <?php
foreach ($etages as $etage) {
    ?>
                                    <?php if ($eta != -1 && $eta == $etage->getId()) {?>

                                        <option selected="selected" value="<?php echo $etage->getId() ?>"><?php echo $etage; ?></option>
                                    <?php } else {?>
                                        <option  value="<?php echo $etage->getId() ?>"><?php echo $etage; ?></option>
                                        <?php
}
}
?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="btn" value="Recherche"> </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div id="sf_admin_content" >
        <div class="sf_admin_list">
            <?php
if (isset($bureauximprimer)) {

    ?>
                <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                    <thead>
                        <tr>
                            <th>Bureau.</th>
                            <th>Code </th>
                            <th>Code générer</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
foreach ($bureauximprimer as $bureau) {
        ?>
                            <tr>
                                <td><?php echo $bureau->getBureau(); ?></td>
                                <td><?php echo $bureau->getCode(); ?></td>
                                <td>
                                    <?php
$code = new Code128();

        $codebarre = $bureau->getCode();
        $code->setData($codebarre);
        $code->setDimensions(220, 20);
        $code->draw();

        $cheminfile = $_SERVER['DOCUMENT_ROOT'] . "/uploads/codebarre/";
        $code->save($cheminfile . $codebarre . ".png");

        echo '<img src="' . sfconfig::get('sf_appdir') . 'uploads/codebarre/' . $codebarre . '.png">';
        ?>
                                </td>
                            </tr>
                            <?php
}
    ?>
                    </tbody>
                </table>
            <?php }?>
            </div>
            <div class="col-xs-12">
          <br>  <a id="btn_impdirect" target="_blanc" href="<?php echo url_for('bureaux/imprimercode?bur=' . $bur . "&loc=" . $loc . "&eta=" . $eta) ?>" class="btn btn-primary" style="color: white"> Imprimer codes</a>
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