<div id="sf_admin_container">
    <h1 id="replacediv">Recherche par date, fournissuer ou document d'achat  </h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8" >
        <form action="" method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo url_for('Documents/bondefinitif') ?>">Effacer</a>

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
                    <td><label>Fournisseur</label></td>
                    <td><input type="hidden" value="<?php echo $idfrs ?>" id="idfrsselcet">
                        <?php echo $formfiletr['id_frs']->render(array('name' => 'idfrs')); ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Bon Commande Interne<br>(documents sources)</label></td>
                    <td>
                        <?php echo $formfiletr['id_docparent']->render(array('name' => 'id_bci')); ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Demandeur</label></td>
                    <td>
                        <?php echo $formfiletr['id_demandeur']->render(array('name' => 'id_dem')); ?>
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

            <div class="row">
                <div class="col-xs-12">

                    <table id="dynamic-table">
                        <thead>
                            <tr>


                                <th>Date création</th>
                                <th class="center">Numéro&Type</th>                           
                                <th>Numéro BCIS</th>
                                <th>Fournisseur</th>
                                <th>Mnt.HT</th>
                                <th>Mnt.TVA</th>
                                <th>Mnt.TTC</th>
                                <th>Facture||Quittance</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $boncomm = new Documentachat();
                            foreach ($boncommandeexterne as $bcex) {
                                $boncomm = $bcex;
                                ?>
                                <tr>
                                    <td><?php echo $boncomm->getDatecreation() ?></td> 
                                    <td>
                                        <a href="#my-modal<?php echo $boncomm->getId() ?>" role="button"  data-toggle="modal">
                                            <?php echo $boncomm->getNumerodocachat() ?>
                                        </a>
                                        <div id="my-modal<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin">Détail <?php echo $boncomm ?></h3>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->ReadHtmlBondeponse()); ?>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Close
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>

                                    </td>  

                                    <td>

                                        <a href="#bci_model<?php echo $boncomm->getId() ?>" role="button"  data-toggle="modal">


                                            <?php echo $boncomm->getDocumentparent() ?>

                                        </a>
                                        <div id="bci_model<?php echo $boncomm->getId() ?>" class="modal fade" tabindex="-1">
                                            <div class="modal-dialog" style="width: 84%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h3 class="smaller lighter blue no-margin">Détail <?php echo $boncomm ?></h3>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php echo html_entity_decode($boncomm->getDocumentparent()->getBonCommandeInterne()); ?>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                                                            <i class="ace-icon fa fa-times"></i>
                                                            Close
                                                        </button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>

                                    </td> 
                                    <td><?php echo $boncomm->getFournisseur() ?></td> 
                                    <td><?php echo $boncomm->getMht() ?></td> 
                                    <td><?php echo $boncomm->getMnttva() ?></td> 
                                    <td><?php echo $boncomm->getMntttc() ?></td> 
                                    <td>
                                        <?php
                                        echo html_entity_decode($boncomm->getFactureOuQuittanceParBceOuBdc());
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                      /*  && !$boncomm->getDocumentBudgetParBceOuBdc()*/
                                        if ($boncomm->getSignatureParDocumentBCE()  ) { ?>
                                            <a href="<?php echo url_for('Documents/preengagement') . '?id=' . $boncomm->getId(); ?>">Transformer Engagment Prov. en Définitif</a>
                                        <?php if($boncomm->getIdTypedoc()==7) 
                                            echo "-".$boncomm->getDatesignature();
                                        } ?>
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
</div>