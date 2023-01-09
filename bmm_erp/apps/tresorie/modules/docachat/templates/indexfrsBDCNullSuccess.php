<div id="sf_admin_container">
    <h1 id="replacediv"><?php echo $typedocument; ?> par fournisseur</h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post" >
            <table cellspacing="0" style="margin-bottom: 0px;">
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('docachat/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        De <input type="date" value="<?php echo $date_debut ?>"id="debut" name="debut">
                        à <input type="date" id="fin" name="fin" value="<?php echo $date_fin ?>">
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

    <div class="widget-body col-xs-4 pull-right">
        <div class="widget-main" style="padding: 5%; text-align: center;">
            <?php if ($idtype == 18): ?>      
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/imprimerlisteBCEP?id_type=' . $idtype) ?>" class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter BCEP PDF
                </a>
                <br><br>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/exporterlisteBCEPExcel?id_type=' . $idtype) ?>" class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>     Exporter BCEP vers Excel (.xlsx )
                </a>
            <?php elseif ($idtype == 7): ?>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/imprimerlisteBCE?id_type=' . $idtype) ?>" class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter BCES PDF
                </a>
                <br><br>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/exporterlisteBCEExcel?id_type=' . $idtype) ?>" class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>     Exporter BCES vers Excel (.xlsx )
                </a>
            <?php elseif ($idtype == 17): ?>
   
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter BDC <br>Provisoire PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter BDC  <br>Provisoire vers Excel (.xlsx )
                </button>

            <?php elseif ($idtype == 2): ?>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/imprimerlisteBDCS?id_type=' . $idtype) ?>" class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter BDCS PDF
                </a>
                <br><br>
                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php echo url_for('docachat/exporterlisteBDCSExcel?id_type=' . $idtype) ?>" class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>     Exporter BDCS vers Excel (.xlsx )
                </a>

            <?php endif; ?>
        </div>
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

  <!--<th style="text-align: center;">Mnt.TTC </th>-->
                            <?php if ($idtype != 8) { ?>
                                <?php if ($idtype != 19): ?>
                                    <th style="width: 30%;">Imputation budgétaire</th>
                                    <th colspan="2">Caisse</th>
                                <?php endif; ?>
                                <th>Action</th>
                            <?php } ?>
                            <?php if ($idtype == 8) { ?>
                                <th style="text-align: center;"><i class="ace-icon fa fa-print bigger-120"></i> Action</th>
                            <?php } ?> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $boncomm = new Documentachat();
                        foreach ($boncommandeexterne as $bcex) {
                            $boncomm = $bcex;
//                         die($boncomm->getIdTypedoc().'mp');
                            if ($boncomm->getIdTypedoc() != null):
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
                                    <?php if ($idtype != 21) { ?>
                                                                <!--<td><?php // echo $boncomm->getFournisseur()->getRs();       ?></td>--> 
                                    <?php } ?>
                                    <!--<td style="text-align: right;"><?php // echo number_format($boncomm->getMntttc(), 3, '.', ' ')       ?></td>--> 
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
                                            <td><?php include_partial('tdcaissedef', array('boncomm' => $boncomm)) ?></td>
                                            <td><?php include_partial('tdactionBDC', array('boncomm' => $boncomm)) ?></td>
                                        <?php endif; ?>
                                    <?php } ?>
                                  
                                </tr>
                                <?php
                            endif;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $pager = $boncommandeexterne;
                        $chaine = '&idtype=' . $idtype . '&idfrs=' . $idfrs . '&debut=' . $date_debut . '&fin=' . $date_fin;
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="sf_admin_pagination">
                                    <?php
                                 
                                    if ($idtype == "17"):
                                        ?>
                                        <?php if ($pager->haveToPaginate()): ?>
                                            <a href="<?php echo url_for('docachat/indexfrsBDCNull') ?>?page=1<?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/first.png' ?>">
                                            </a>
                                            <a href="<?php echo url_for('docachat/indexfrsBDCNull') ?>?page=<?php echo $pager->getPreviousPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/previous.png' ?>">
                                            </a>
                                            <?php foreach ($pager->getLinks() as $page): ?>
                                                <?php if ($page == $pager->getPage()): ?>
                                                    <?php echo $page ?>
                                                <?php else: ?>
                                                    <a href="<?php echo url_for('docachat/indexfrsBDCNull') ?>?page=<?php echo $page ?><?php echo $chaine ?>"><?php echo $page ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                            <a href="<?php echo url_for('docachat/indexfrsBDCNull') ?>?page=<?php echo $pager->getNextPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/next.png' ?>">
                                            </a>

                                            <a href="<?php echo url_for('docachat/indexfrs') ?>?page=<?php echo $pager->getLastPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/last.png' ?>">
                                            </a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if ($pager->haveToPaginate()): ?>
                                            <a href="<?php echo url_for('docachat/indexfrs') ?>?page=1<?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/first.png' ?>">
                                            </a>

                                            <a href="<?php echo url_for('docachat/indexfrs') ?>?page=<?php echo $pager->getPreviousPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/previous.png' ?>">
                                            </a>

                                            <?php foreach ($pager->getLinks() as $page): ?>
                                                <?php if ($page == $pager->getPage()): ?>
                                                    <?php echo $page ?>
                                                <?php else: ?>
                                                    <a href="<?php echo url_for('docachat/indexfrs') ?>?page=<?php echo $page ?><?php echo $chaine ?>"><?php echo $page ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>

                                            <a href="<?php echo url_for('docachat/indexfrs') ?>?page=<?php echo $pager->getNextPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/next.png' ?>">
                                            </a>

                                            <a href="<?php echo url_for('docachat/indexfrs') ?>?page=<?php echo $pager->getLastPage() ?><?php echo $chaine ?>">
                                                <img src="<?php echo sfConfig::get('sf_appdir') . 'sfDoctrinePlugin/images/last.png' ?>">
                                            </a>
                                        <?php endif; ?>
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

<style>

    #list_forme tbody td{vertical-align: middle;}

</style>
<script>
    function supprimer(id) {
        var message_text = "Voulez-vous supprimer ce demande de prix ? ";
        bootbox.confirm({
            message: message_text,
            buttons: {
                cancel: {
                    label: "Non",
                    className: "btn-sm",
                },
                confirm: {
                    label: "Oui",
                    className: "btn-primary btn-sm",
                }
            },
            callback: function (result) {
                if (result) {
                    validerSupression(id);
                }
            }
        });
    }
    function validerSupression(id) {

        $.ajax({
            url: '<?php echo url_for('docachat/deleteDemandedeprix') ?>',
            data: 'iddemandedeprix=' + id,
            success: function (data) {
                document.location.reload();
//              
            }
        });
    }

    function printListDocAchats(id_type) {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        if (id_type != '') {
            {
                if (url == '')
                    url = '?id_type=' + id_type;
                else
                    url = url + '&id_type=' + id_type;
            }
        }
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }

        if ($('#idfrs').val() != '')
        {
            if (url == '')
                url = '?idfrs=' + $('#idfrs').val();
            else
                url = url + '&idfrs=' + $('#idfrs').val();
        }
        if (id_type == 17) {
            url = '<?php echo url_for('docachat/imprimerlisteBDCPNull') ?>' + url;
        }


        window.open(url, '_blank');
        win.focus();
    }

    function ExportListDocAchats(id_type) {
        var url = '';

        if ($('#debut').val() != '')
        {
            url = '?datedebut=' + $('#debut').val();
        }
        if (id_type != '') {
            {
                if (url == '')
                    url = '?id_type=' + id_type;
                else
                    url = url + '&id_type=' + id_type;
            }
        }
        if ($('#fin').val() != '')
        {
            if (url == '')
                url = '?datefin=' + $('#fin').val();
            else
                url = url + '&datefin=' + $('#fin').val();
        }

        if ($('#idfrs').val() != '')
        {
            if (url == '')
                url = '?idfrs=' + $('#idfrs').val();
            else
                url = url + '&idfrs=' + $('#idfrs').val();
        }

        if (id_type == 17) {
            url = '<?php echo url_for('docachat/exporterlisteBDCPNULLExcel') ?>' + url;
        }
        window.open(url, '_blank');
        win.focus();
    }
</script>