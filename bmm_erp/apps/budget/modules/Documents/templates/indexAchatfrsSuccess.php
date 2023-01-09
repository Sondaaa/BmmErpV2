<div id="sf_admin_container">
    <h1 id="replacediv"><?php echo $typedocument; ?> par fournisseur</h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post" >
            <table cellspacing="0" style="margin-bottom: 0px;" onmouseup="setMinMaxDate()">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        De <input type="date" id="date_debut" value="<?php echo $datedebut ?>" name="debut"> à <input type="date" id="date_fin" name="fin" value="<?php echo $datefin ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Fournisseur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $form['id_frs']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue"></h3>
            <div class="clearfix"></div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div>
                <table id="list_forme" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">Numéro</th>
                            <th style="text-align: center;">Date Création</th>
                            <th style="text-align: center;">Numéro BCIS</th>
                            <th>Fournisseur</th>
                            <th style="text-align: center;">Mnt.TTC</th>
                            <?php if ($idtype != 8) { ?>
                                <?php if ($idtype != 19): ?>
                                    <th style="width: 30%;">Imputation budgétaire</th>
                                    <th>Caisse</th>
                                <?php endif; ?>
                                <th>Action</th>
                            <?php } ?>
                            <?php if ($idtype == 8) { ?>
                                <th style="text-align: center;"><i class="ace-icon fa fa-print bigger-120"></i> Imprimer</th>
                            <?php } ?> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $boncomm = new Documentachat();
                        foreach ($boncommandeexterne as $bcex) {
                            $boncomm = $bcex;
                            ?>
                            <tr>
                                <td style="text-align: center;"><?php include_partial('tddetaildoc', array('boncomm' => $boncomm)) ?></td>  
                                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($boncomm->getDatecreation())) ?></td> 
                                <td style="text-align: center;">
                                    <?php
                                    $documents_parent = DocumentparentTable::getInstance()->findByIdDocumentachat($boncomm->getId());
                                    if ($documents_parent->count() != 0) {
                                        foreach ($documents_parent as $doc) {
                                            $doc_achat = DocumentachatTable::getInstance()->find($doc->getIdDocumentparent());
                                            include_partial('tddetaildoc', array('boncomm' => $doc_achat));
                                        }
                                    } else
                                        include_partial('tddetaildoc', array('boncomm' => $boncomm->getDocumentparent()));
                                    ?>
                                </td> 
                                <td><?php echo $boncomm->getFournisseur()->getRs(); ?></td> 
                                <td style="text-align: right;"><?php echo number_format($boncomm->getMntttc(), 3, ',', '.') ?></td> 
                                <?php if ($idtype != 8) { ?>
                                    <?php if ($idtype != 19): ?>
                                        <td>
                                            <?php if ($boncomm->ActionSignature() != "") { ?>
                                                <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: inherit;">
                                                    <?php echo html_entity_decode($boncomm->ActionSignature()); ?>
                                                </span> 
                                            <?php } ?> 
                                        </td>
                                        <td><?php include_partial('tdcaisse', array('boncomm' => $boncomm)) ?></td>
                                        <td style="vertical-align: top"><?php include_partial('tdaction', array('boncomm' => $boncomm)) ?></td>
                                    <?php endif; ?>
                                <?php } ?>
                                <?php if ($idtype == 8) { ?>
                                    <td style="text-align: center;">
                                        <button onclick="javascript:document.location.href = '<?php echo url_for('documentachat/Imprimerconditionsdprix?iddemandedeprix=' . $boncomm->getId()) ?>'" target="_blanc" class="btn btn-xs btn-purple">
                                            <i class="ace-icon fa fa-print bigger-110"></i>
                                            Conditions Administratives
                                        </button>
                                    </td>
                                <?php } ?>
                                <?php if ($idtype == 19) { ?>
                                    <td style="text-align: center;">
                                        <a href="<?php echo url_for('documentachat/Imprimercontrat?id=' . $boncomm->getId()) ?>" target="_blanc" class="btn btn-white btn-success">
                                            <i class="ace-icon fa fa-print bigger-110"></i>
                                            Imprimer
                                        </a>
                                    </td>
                                <?php } ?> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $pager = $boncommandeexterne;
                        $chaine = '&idtype=' . $idtype . '&idfrs=' . $idfrs . '&debut=' . $date_debut . '&fin=' . $date_fin;
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="sf_admin_pagination">
                                    <?php if ($pager->haveToPaginate()): ?>
                                        <a href="<?php echo url_for('Documents/indexfrs') ?>?page=1<?php echo $chaine ?>">
                                            <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/first.png' ?>">
                                        </a>

                                        <a href="<?php echo url_for('Documents/indexfrs') ?>?page=<?php echo $pager->getPreviousPage() ?><?php echo $chaine ?>">
                                            <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/previous.png' ?>">
                                        </a>

                                        <?php foreach ($pager->getLinks() as $page): ?>
                                            <?php if ($page == $pager->getPage()): ?>
                                                <?php echo $page ?>
                                            <?php else: ?>
                                                <a href="<?php echo url_for('Documents/indexfrs') ?>?page=<?php echo $page ?><?php echo $chaine ?>"><?php echo $page ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <a href="<?php echo url_for('Documents/indexfrs') ?>?page=<?php echo $pager->getNextPage() ?><?php echo $chaine ?>">
                                            <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/next.png' ?>">
                                        </a>

                                        <a href="<?php echo url_for('Documents/indexfrs') ?>?page=<?php echo $pager->getLastPage() ?><?php echo $chaine ?>">
                                            <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/last.png' ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setMinMaxDate() {
        var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#date_debut').attr('min', min_date);
        $('#date_debut').attr('max', max_date);
        $('#date_fin').attr('min', min_date);
        $('#date_fin').attr('max', max_date);
    }

</script>

<style>

    #list_forme tbody td{vertical-align: middle;}

</style>