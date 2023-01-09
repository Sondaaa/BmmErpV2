<div id="sf_admin_container">
    <h1 id="replacediv"> Liste des bons de commandes externes par fournisseur </h1>
</div>
<div id="sf_admin_bar" ng-controller="myCtrldoc" ng-init="AfficheBCE()">
    <div class="sf_admin_filter col-xs-8">
        <form action="" method="post">
            <table cellspacing="0">
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
                        <input type="date" value="<?php echo $datedebut ?>" name="debut">TO<input type="date" name="fin" value="<?php echo $datefin ?>">
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
                            <th class="center">Numéro</th>
                            <th>Date création</th>
                            <th>Numéro BCIS</th>
                            <th>Fournisseur</th>
                            <th>Mnt.HT</th>
                            <th>Mnt.TVA</th>
                            <th>Mnt.TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $boncomm = new Documentachat();
                        foreach ($boncommandeexterne as $bcex) {
                            $boncomm = $bcex;
                            ?>
                            <tr>
                                <td><a href="<?php echo url_for('Documents/detail?id=') . $boncomm->getId() ?>"><?php echo $boncomm->getNumerodocachat() ?></a></td>  
                                <td><?php echo $boncomm->getDatecreation() ?></td> 
                                <td><?php echo $boncomm->getDocumentparent() ?></td> 
                                <td><?php echo $boncomm->getFournisseur() ?></td> 
                                <td><?php echo $boncomm->getMht() ?></td> 
                                <td><?php echo $boncomm->getMnttva() ?></td> 
                                <td><?php echo $boncomm->getMntttc() ?></td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>