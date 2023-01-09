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
                            <a href="<?php echo url_for('Documents/indexfrs') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td><!--   min="<?php // echo date('Y') . "-01-01"                   ?>" 
                                  max="<?php // echo date('Y') . "-12-31"                   ?>" -->
                        De <input type="date" value="<?php if ($date_debut) echo $date_debut ?>" id="debut"  name="debut">
                        à <input type="date"  id="fin"   name="fin" value="<?php if ($date_fin) echo $date_fin ?>">
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
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 7): ?>

                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 17): ?>

                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 21): ?>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 22): ?>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 2): ?>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 8): ?>

                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="printListDocAchats(<?php echo $idtype ?>)"

                        class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter PDF
                </button>
                <br><br>
                <button style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" 
                        onclick="ExportListDocAchats(<?php echo $idtype ?>)"   class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>   Exporter vers Excel (.xlsx )
                </button>
            <?php elseif ($idtype == 19): ?>
    <!--                <a style="height: 55px !important; width: 250px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/imprimerlisteContrat?id_type=' . $idtype)         ?>" class=" btn btn-outline btn-danger">
                    <i class="ace-icon fa fa-print bigger-110"></i>   Exporter Contrat PDF
                </a>
                <br><br>
                <a style="height: 55px !important; width: 350px; font-size: 14px !important; font-weight: bold !important;" target="_blanc" href="<?php // echo url_for('Documents/exporterlisteContratExcel?id_type=' . $idtype)         ?>" class=" btn btn-outline btn-primary">
                    <i class="ace-icon fa fa-file-excel-o"></i>     Exporter Contrat vers Excel (.xlsx )
                </a>-->
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
                            <?php if ($idtype != 21 && $idtype != 22) { ?>
                                <th>Fournisseur</th>
                            <?php } ?>
                            <?php if ($idtype != 21 && $idtype != 22) { ?>

                                <th style="text-align: center; width: 15%">Mnt.TTC</th>
                            <?php } else { ?>
                                <th style="text-align: center;">Mnt Quitance</th>
                            <?php } ?>
                            <?php if ($idtype != 8) { ?>
                                <?php
                                if ($idtype != 19):
                                    if ($idtype != 21) {
                                        ?>
                                        <th style="width: 25%;">Imputation budgétaire</th>
                                    <?php } ?>
                                    <th>Caisse</th>
                                    <?php
                                endif;
                                ?>
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
                                    <td style="text-align: center;"><?php
                                        if ($boncomm->getIdTypedoc() != 19) {
                                            include_partial('tddetaildoc', array('boncomm' => $boncomm));
                                        } else {
                                            echo $boncomm->getNumerodocachat();
                                        }
                                        ?></td>  
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
                                    <?php if ($idtype != 21 && $idtype != 22) { ?>
                                        <td><?php echo $boncomm->getFournisseur()->getRs(); ?></td> 
                                    <?php } ?>
                                    <?php if ($idtype != 21 && $idtype != 22) { ?>
                                        <td style="text-align: right;"><?php
                                            $mnttc = $boncomm->getMntttc();
                                            echo number_format($mnttc, 3, '.', ' ')
                                            ?></td> 

                                        <?php
                                    } else {
                                        $quitance = LigneoperationcaisseTable::getInstance()->findByIdDocachatAndIdCategorie($boncomm->getId(), 2);
                                        if (sizeof($quitance) >= 1) {
                                            $mnt_quitance = 0;
                                            foreach ($quitance as $q):
                                                $mnt_quitance+= $q->getMntoperation();
                                            endforeach;
                                        }
                                        ?>
                                        <td style="text-align: right;"><?php echo number_format($mnt_quitance, 3, '.', ' ') ?></td> 
                                    <?php } ?>                                
                                    <?php if ($idtype != 8) { ?>
                                        <?php
                                        if ($idtype != 19):

                                            if ($idtype != 21) {
                                                ?>
                                                <td>
                                                    <?php if ($boncomm->ActionSignature() != "") { ?>
                                                        <span class="label label-sm label-warning" style="font-size: 12px !important; height: 100% !important; font-weight: bold; white-space: inherit;">
                                                            <?php echo html_entity_decode($boncomm->ActionSignature()); ?>
                                                        </span> 
                                                        <?php
                                                    }
                                                }
                                                ?> 
                                            </td>
                                            <?php if ($idtype != 21) { ?>
                                                <td><?php include_partial('tdcaisse', array('boncomm' => $boncomm)) ?></td>
                                            <?php } else { ?>                                            
                                                <td><?php include_partial('tdcaissebdcreg', array('boncomm' => $boncomm)) ?></td>
                                            <?php } ?>
                                            <td><?php include_partial('tdaction', array('boncomm' => $boncomm)) ?></td>
                                        <?php endif; ?>
                                    <?php }
                                    ?>
                                    <?php if ($idtype == 8) { ?>
                                        <td style="text-align: center;">

                                            <button onclick="javascript:document.location.href = '<?php echo url_for('Documents/remplirdemandedeprix') . '?iddoc=' . $boncomm->getId() ?>'" target="_blanc" class="btn btn-xs btn-success">
                                                <i class="ace-icon fa fa-edit icon-on-right bigger-110"></i>
                                                Modifier
                                                <!-- onclick="javascript:document.location.href = '<?php // echo url_for('documentachat/DeleteDemandedeprix?iddemandedeprix=' . $boncomm->getId())                                            ?>'" -->
                                            </button>
                                            <button 

                                                onclick="supprimer('<?php echo $boncomm->getId() ?>')"
                                                target="_blanc" class="btn btn-xs btn-danger">
                                                <i class="ace-icon fa fa-trash icon-on-right bigger-110"></i>
                                                Supprimer 
                                            </button>
                                            <!--                                        <button onclick="if (confirm('Etes-vous sûr?')) {
                                                                                                        var f = document.createElement('form');
                                                                                                        f.style.display = 'none';
                                                                                                        this.parentNode.appendChild(f);
                                                                                                        f.method = 'post';
                                                                                                        f.action = '/Documents/DeleteDemandedeprix?iddemandedeprix=<?php // echo $boncomm->getId()                                           ?>';
                                                                                                        var m = document.createElement('input');
                                                                                                        m.setAttribute('type', 'hidden');
                                                                                                        m.setAttribute('name', 'sf_method');
                                                                                                        m.setAttribute('value', 'delete');
                                                                                                        f.appendChild(m);
                                                                                                        f.submit();
                                                                                                    }
                                                                                                    ;
                                                                                                    return false;" type="button" class="btn btn-outline btn-danger"><i class="fa fa-trash"></i> Supprimer</button>-->
                                            <button onclick="javascript:document.location.href = '<?php echo url_for('documentachat/Imprimerconditionsdprix?iddemandedeprix=' . $boncomm->getId()) ?>'" 
                                                    target="_blanc" class="btn btn-xs btn-purple">
                                                <i class="ace-icon fa fa-print icon-on-right bigger-110"></i>
                                                Conditions Administratives
                                            </button>
                                            <a class="btn btn-xs btn-primary" href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') . $boncomm->getId() ?>"    target="_blanc">Imprimer Demande de prix</a>
                                        </td>
                                    <?php } ?>
                                    <?php if ($idtype == 19) { ?>
                                        <td style="width:10%">
                                            <div class="btn-toolbar">
                                                <div class="btn-group" id="btnaction">
                                                    <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                                                        Action
                                                        <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                        <li>
                                                            <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/edit') . '?id=' . $boncomm->getIdDocparent() ?>'" class="btn btn-outline btn-default"><i class="fa fa-edit"></i> Modifier
                                                                <?php echo $boncomm->getNumerodocachat() ?></button>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo url_for('documentachat/Imprimercontrat?id=' . $boncomm->getId()) ?>" target="_blanc" class="btn btn-white btn-success">
                                                                <i class="ace-icon fa fa-print bigger-110"></i>
                                                                Imprimer  <?php echo $boncomm->getNumerodocachat() ?>
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $total = 0;
                                                        $bci = Doctrine_Core::getTable('documentachat')->findOneById($boncomm->getIdDocparent());
                                                        $montant_final = $bci->getMontantestimatif();

                                                        $bces = Doctrine_Core::getTable('documentachat')->findByIdDocparentAndIdTypedocAndIdEtatdoc($boncomm->getIdDocparent(), 7, 27);
//                                                   die(sizeof($bces).'mp');
                                                        foreach ($bces as $bce):
                                                            $total = $total + $bce->getMntttc();
                                                        endforeach;

                                                        if ($total <= $montant_final):
                                                            ?>

                                                            <li>
                                                                <button type="button" onclick="document.location.href = '<?php echo url_for('documentachat/exportbce') . '?iddoc=' . $boncomm->getIdDocparent() ?>'" class="btn btn-outline btn-default"><i class="fa fa-long-arrow-right"></i> Exporter B.C.E</button>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <!--                                    <td style="text-align: center;">
                                                                                <a href="<?php // echo url_for('documentachat/Imprimercontrat?id=' . $boncomm->getId())                                                    ?>" target="_blanc" class="btn btn-white btn-success">
                                                                                    <i class="ace-icon fa fa-print bigger-110"></i>
                                                                                    Imprimer
                                                                                </a>
                                                                            </td>-->
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
            url: '<?php echo url_for('Documents/deleteDemandedeprix') ?>',
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
        if (id_type == 8) {
            url = '<?php echo url_for('Documents/imprimerlisteDeandeprix') ?>' + url;
        }
        else if (id_type == 7) {
            url = '<?php echo url_for('Documents/imprimerlisteBCE') ?>' + url;
        }
        else if (id_type == 18) {
            url = '<?php echo url_for('Documents/imprimerlisteBCEP') ?>' + url;
        }
        else if (id_type == 21) {
            url = '<?php echo url_for('Documents/imprimerlisteBDCRegroupeP') ?>' + url;
        }
        else if (id_type == 22) {
            url = '<?php echo url_for('Documents/imprimerlisteBDCRegroupeS') ?>' + url;
        }
        else if (id_type == 17) {
            url = '<?php echo url_for('Documents/imprimerlisteBDCP') ?>' + url;
        }
        else if (id_type == 2) {
            url = '<?php echo url_for('Documents/imprimerlisteBDCS') ?>' + url;
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

        if (id_type == 8) {
            url = '<?php echo url_for('Documents/exporterlisteDemandeprixExcel') ?>' + url;
        }
        else if (id_type == 7) {
            url = '<?php echo url_for('Documents/exporterlisteBCEExcel') ?>' + url;
        }
        else if (id_type == 18) {
            url = '<?php echo url_for('Documents/exporterlisteBCEPExcel') ?>' + url;
        }


        else if (id_type == 21) {
            url = '<?php echo url_for('Documents/exporterlisteBDCRegroupePExcel') ?>' + url;
        }
        else if (id_type == 22) {
            url = '<?php echo url_for('Documents/exporterlisteBDCRegroupeDefExcel') ?>' + url;
        }
        else if (id_type == 17) {
            url = '<?php echo url_for('Documents/exporterlisteBDCPExcel') ?>' + url;
        }
        else if (id_type == 2) {
            url = '<?php echo url_for('Documents/exporterlisteBDCSExcel') ?>' + url;
        }

        window.open(url, '_blank');
        win.focus();
    }
</script>