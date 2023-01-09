<?php
$doc_achat = new Documentachat();
$doc_achat = $documentachat;
$caisses = CaissesbanquesTable::getInstance()->getAllCaisse();
?>

<div id="sf_admin_container" ng-controller="CtrlCaisse">
    <input type="hidden" id="id_user" value="<?php echo $sf_user->getAttribute('userB2m')->getId() ?>">

    <h1 id="replacediv"> 
        Engagement  du <?php echo $doc_achat->getTypedoc() ?>:<br><?php echo $documentachat->getNumerodocachat() ?>
    </h1>
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="<?php if ($active == "home") echo "active" ?>"><a href="#home" data-toggle="tab" aria-expanded="true">Détail </a>
            </li>


            <li class="active"  ><a href="#listeengagement" data-toggle="tab" aria-expanded="false">Liste des fiches quittances Provisoires & Définitifs</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php if ($active == "home") echo "fade active in" ?> " id="home">
                <h4><?php echo strtoupper($doc_achat->getTypedoc()) ?> N°:<?php echo $documentachat->getNumerodocachat() ?></h4> 
                <div style="margin-top: 10px;">
                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                        <embed src="<?php echo url_for('Documents/Imprimerbondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                    </object>
                </div>
                <div style="margin-top: 10px;">
                    <object style="width: 100%;height: 900px;" data="<?php echo url_for('Documents/ImprimerAnnexebondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf">
                        <embed src="<?php echo url_for('Documents/ImprimerAnnexebondeponse?iddoc=' . $documentachat->getId()) ?>" type="application/pdf" />
                    </object>
                </div>
            </div>


            <div class="tab-pane fade active in" id="listeengagement">
                <fieldset>
                    <legend>Liste des Quittances provisoires & Définitifs</legend>
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Numéro</th>
                                <th>Caise N°</th>
                                <th>BDCP N°</th>
                                <th>Mnt.</th>
                                <th>Démarcheur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $operation = new Ligneoperationcaisse();
                            foreach ($pieces_operations as $op) {
                                $operation = $op;
                                ?>
                                <tr>
                                    <td><?php echo $operation->getCategorieoperation(); ?></td>
                                    <td><?php echo $operation->getNumerodocachat(); ?></td>
                                    <td><?php echo $operation->getCaissesbanques() ?></td>
                                    <td><?php echo $operation->getDocumentachat() ?></td>
                                    <td><?php echo $operation->getMntoperation(); ?></td>
                                    <td><?php echo $operation->getDemarcheur(); ?></td>                                
                                    <td>
                                        <a href="<?php echo url_for('Documents/preengagementBDCG') . '?id=' . $operation->getIdDocachat() . '&idoperation=' . $operation->getId(); ?>">Détail</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <input type="hidden" id="liste_ligne" value="<?php echo $array_id_ligne; ?>">
                        </tbody>
                    </table>
                </fieldset>

                <fieldset >
                    <legend>Action</legend>
                   <input  type="button" value="Clôturer " ng-click="CloturerQuitanceEnvoyeachat(<?php echo $documentachat->getId() ?>, true)">                 
                </fieldset>
            </div>
        </div>
    </div>
</div>

<script>
            function printDiv()
            {

            var divToPrint = document.getElementById('engagement');
                    var newWin = window.open('', 'Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
                    newWin.document.close();
                    setTimeout(function(){newWin.close(); }, 10);
            }
//    function setCheckAll() {
//    var id = '';
//            if ($("#check_input").is(":checked")) {
//    $('.list_checbox_article[type=checkbox]').each(function () {
//    $(this).prop("checked", "checked");
//    });
//    } else {
//    $('.list_checbox_article[type=checkbox]').each(function () {
//    $(this).removeProp("checked");
//            $(this).removeAttr("checked");
//    }); }
//    if ($('#selecte_all_artcile').is(':checked')) {
//
//    $('.list_checbox_article[type=checkbox]').prop('checked', true);
//            $('.list_checbox_article[type=checkbox]:checked').each(function () {
//
//    id = $(this).attr('idientifiant');
////            AjouterArticleListeSelectionner(id);
//    });
//    }
//    }
</script>