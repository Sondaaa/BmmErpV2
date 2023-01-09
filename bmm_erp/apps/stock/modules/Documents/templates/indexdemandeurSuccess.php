<div id="sf_admin_container">
    <h1 id="replacediv"> Listes des bons de commandes internes par demandeur </h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8" >
        <form action="" method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/indexdemandeur') ?>">Effacer</a>
                            <input type="submit" value="Filtrer" />
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                <input type="hidden" name="idtype" value="<?php echo $idtype ?>">
                <tr>
                    <td><label>Date</label></td>
                    <td>
                        <input type="date" value="<?php echo $datedebut ?>" name="debut">TO<input type="date" name="fin" value="<?php echo $datefin ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Demandeur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $form['id_demandeur']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3 class="header smaller lighter blue"></h3>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            <div class="table-header">
                Résultat de recherche
            </div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Numéro</th>
                            <th>Date création</th>                         
                            <th>Demandeur</th>
                            <th>Mnt.total</th>
                            <th class="detail-col">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $boncomm = new Documentachat();

                        foreach ($boncommandeexterne as $bcex) {
                            $boncomm = $bcex;
                            ?>
                            <tr <?php if ($boncomm->getMntTTCDocument() != "") { ?> style="background-color: #DD9E93;" <?php } else { ?> style="background-color: #AADFA1 !important" <?php } ?>>
                                <td style="text-align: center;"><?php echo $boncomm->getNumerodocachat() ?></td>  
                                <td style="text-align: center;"><?php echo $boncomm->getDatecreation() ?></td> 
                                <td><?php echo $boncomm->getAgents() ?></td>
                                <td style="text-align: right;"><?php echo html_entity_decode($boncomm->getMntTTCDocument()) ?></td>
                                <td>
                                    <div class="action-buttons" style="text-align: center;">
                                        <p href="#my-modal<?php echo $boncomm->getId() ?>" role="button"  data-toggle="modal">
                                            <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                        </p> 
                                    </div>
                                    <div id="my-modal<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1" >
                                        <div class="modal-dialog" style="width: 60%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="smaller lighter blue no-margin">Détail</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo html_entity_decode($boncomm->getTransfertBonSortie()); ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                        <i class="ace-icon fa fa-times"></i>
                                                        fermer
                                                    </button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(".transform_a").addClass("btn btn-white btn-primary");
        $(".print_a").addClass("btn btn-white btn-success");
        $('.print_a').attr('style', 'margin-left:1%');
    });

</script>