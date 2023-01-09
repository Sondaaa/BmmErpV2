<div class="page-header">
    <h1>Liste des codes à barre</h1>
</div>
<div id="" class="row">

    <div id="col-xs-12">

        <div class="col-xs-6">
            <form action="<?php echo url_for('bureaux/imprimercb') ?>" method="post">
                <table class="table table-striped table-bordered table-hover ">
                    <tr>
                        <td><label>Local</label></td>
                        <td>
                            <select name="bur" id="id_bureau" class="selectpicker">
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
                        <td><label>Site</label></td>
                        <td>
                            <select name="loc" id="id_site" class="selectpicker">
                                <option></option>
                                <?php
                                foreach ($locals as $local) {
                                ?>
                                    <?php if ($loc != -1 && $loc == $local->getId()) { ?>
                                        <option selected="selected" value="<?php echo $local->getId() ?>"><?php echo $local; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $local->getId() ?>"><?php echo $local; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Sous site</label></td>
                        <td>
                            <select name="eta" id="id_etage" class="selectpicker">
                                <option></option>
                                <?php
                                foreach ($etages as $etage) {
                                ?>
                                    <?php if ($eta != -1 && $eta == $etage->getId()) { ?>

                                        <option selected="selected" value="<?php echo $etage->getId() ?>"><?php echo $etage; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $etage->getId() ?>"><?php echo $etage; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td ><input type="submit" name="btn" value="Recherche"> </td>
                  <td>
                  <!-- <input id="btn_impdirect" 
                  onclick="printlistecode()"  class="btn btn-xs btn-primary"  style="color: white" value="Imprimer codes"/>
                 <br><br> -->
                  <input id="btn_impdirect" 
                  onclick="printlistecodeSQL()"  class="btn btn-xs btn-primary"  style="color: white" value="Imprimer codes "/>
                
                
               
           </td>
                    </tr>
                </table>
                <table>
                
                </table>
            </form>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="col-xs-12">
            <?php
            if (isset($bureauximprimer)) {
            ?>
                <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                    <thead>
                        <tr>
                            <th>Bureau.</th>
                            <th>Code </th>
                            <th>Code générer</th>
                            <th>Action</th>
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
                                <td>
                                <a id="btn_impdirect" target="_blanc" 
                                href="<?php echo url_for('bureaux/imprimercodebarrebureaux').'?id_bur=' . $bureau->getId().'&codebarre='.$codebarre ?>" 
                                class="btn btn-primary" style="color: white"> Imprimer code</a>    
                                  
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        <!-- <div class="col-xs-12">
            <br>
             <a id="btn_impdirect" target="_blanc" href="<?php //echo url_for('bureaux/imprimercode?bur=' . $bur . "&loc=" . $loc . "&eta=" . $eta) ?>" class="btn btn-primary" style="color: white"> Imprimer codes</a>

                              
           </div> -->
    </div>
</div>
<script type="text/javascript">
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
        function printlistecodeSQL() {             
             var valide = false;
             var url = '';
             if ($('#id_bureau').val()) {
                 if (url == '')
                     url = '?id_bureau=' + $('#id_bureau').val();
                 valide = true;
             }     
     
             if ($('#id_site').val()) {
                 if (url == '')
                     url = '?id_site=' + $('#id_site').val();
                 else
                     url = url + '&id_site=' + $('#id_site').val();
                 valide = true;
             }
     
             if ($('#id_etage').val()) {
                 if (url == '')
                     url = '?id_etage=' + $('#id_etage').val();
                 else
                     url = url + '&id_etage=' + $('#id_etage').val();
                 valide = true;
             }
     
            
             if (valide) {                 
                 url = '<?php echo url_for('bureaux/ImprimercodesRequette') ?>' + url;
                 window.open(url, '_blank');
                // win.focus();
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
    

    function printlistecode() {             
             var valide = false;
             var url = '';
             if ($('#id_bureau').val()) {
                 if (url == '')
                     url = '?id_bureau=' + $('#id_bureau').val();
                 valide = true;
             }     
     
             if ($('#id_site').val()) {
                 if (url == '')
                     url = '?id_site=' + $('#id_site').val();
                 else
                     url = url + '&id_site=' + $('#id_site').val();
                 valide = true;
             }
     
             if ($('#id_etage').val()) {
                 if (url == '')
                     url = '?id_etage=' + $('#id_etage').val();
                 else
                     url = url + '&id_etage=' + $('#id_etage').val();
                 valide = true;
             }
     
            
             if (valide) {                 
                 url = '<?php echo url_for('bureaux/imprimercodes') ?>' + url;
                 window.open(url, '_blank');
                 win.focus();
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