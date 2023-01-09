<div id="" class="panel panel-green">
    <div id="sf_admin_container"   >
        <h1>Ouvrir les fiches articles / magasin</h1>
    </div>
    <div id="sf_admin_content" class="col-lg-6">
        <fieldset>
            <legend>Nouvelle Fiche</legend>
            <form action="<?php echo url_for('inventairestock/ouvrir') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">

                <table>
                    <tr>
                        <td><?php
                            $mags = Doctrine_Core::getTable('magasin')->findAll();
                            ?>

                            <label>Magasin</label>
                            <select id="magtous" name="mag">
                                <option></option>
                                <?php foreach ($mags as $mag) { ?>
                                    <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                <?php } ?>
                            </select></td>
                            
                        <td><label>&emsp13;<br></label> <input  type="submit" value="Ouvrir Fiche" class="btn btn-outline btn-success"></td>
                    </tr>
                </table>


            </form>

        </fieldset>

    </div>
    <div class="col-lg-6">
        <?php if ($inventaire) { ?>
            <table>
                <tr>
                    <td colspan="2">Fiche Inventaire</td>
                </tr>
                <tr>
                    <td>Numéro</td><td> <?php echo $inventaire->getNumero(); ?></td>

                </tr>
                <tr>
                    <td>Date Création</td><td> <?php echo $inventaire->getDatedepart(); ?></td>

                </tr>
                <tr>
                    <td>Magasin</td><td><?php echo $inventaire->getMagasin(); ?></td>
                </tr>
            </table>
        <?php } ?>
    </div>
    <div class="col-lg-12" ng-controller="CtrlInventaire">
        <div>
            <fieldset>
                <legend>Listes des articles par magasin</legend>

                <table id="dynamic-table3" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th class="center">
                                Code
                            </th>
                            <th>Article</th>
                            <th>Magasin</th>
                            <th>Qte</th>
                            <th>Qte Existant</th>
                            <th></th>
                            <th>Ecart/Entrée/Sortie</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($stocks as $stock) {
                            $ligneinventaire = new Ligneinventaire();
                            $ligneInv = new Ligneinventaire();
                            $ligneInv = $ligneinventaire->MisajourLigne($inventaire->getId(), $stock['idart'], $stock['qtetheorique']);
                            ?>
                            <tr>

                                <td><?php echo $stock['codeart'] ?></td>  
                                <td><?php echo $stock['designation'] ?></td> 
                                <td><?php echo $stock['libelle'] ?></td> 
                                <td><?php echo $stock['qtetheorique'] ?></td> 
                                <td style="width: 10%">
                                    <input value="<?php if(isset($stock['ecartthorique'])) echo $stock['ecartthorique']; ?>"  type="text" id="txt<?php echo $stock['idart']; ?>" >

                                </td> 
                                <td> 
                                    <input type="button" value="OK" ng-model="btn<?php echo $stock['idart']; ?>" ng-click="MisajourLigneInventare('<?php echo $stock['qtetheorique'] ?>', '<?php echo $ligneInv->getId() ?>', '<?php echo $stock['idart']; ?>','<?php echo $stock['idstock']; ?>')"></td>
                                <td id="ecart<?php echo $stock['idart']; ?>">
                                     <?php if (isset($stock['ecartthorique'])) {echo "Ecart : "; echo $stock['qtetheorique'] - $stock['ecartthorique'];} ?>
                                    <br>                                   
                                    <?php
                                    if (isset($stock['ecartthorique'])) {
                                        $st = new Stock();
                                        $stk = Doctrine_Core::getTable('stock')->findOneById($stock['idstock']);
                                        $st = $stk;
                                        $qteentre = $st->getEntreeStock(date('Y-m-d'), $st->getIdMag());
                                        $qtesortie = $st->getSortieStock(date('Y-m-d'), $st->getIdMag());
                                        $qtetotal = $stock['ecartthorique'] + $qteentre - $qtesortie;
                                        echo "Entrée : " . $qteentre . '<br>';
                                        echo "Sortie : " . $qtesortie . '<br>';
                                        echo "Qte final: " . $qtetotal;
                                    }
                                    ?>

                                </td>

                            </tr>



                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </fieldset>
            <?php if ($inventaire) { ?>
                <fieldset style="margin-left:  50%">
                    <legend>Action</legend>
                    <form action="<?php echo url_for('inventairestock/fermer') ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo $inventaire->getId() ?>">
                        <input type="submit" value="Fermer & Valider l'inventaire pour c'ette date : <?php echo date('d-m-Y') ?>" >
                    </form>


                </fieldset>
            <?php } ?>

        </div>  
    </div>

</div>
