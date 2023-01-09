<div id="" class="panel panel-green">
    <div id="sf_admin_container"   >
        <h1>Détail Inventaire </h1>
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
    <div class="col-lg-12" >
        <div>
            <fieldset>
                <legend>Listes des articles par magasin</legend>

                <table id="dynamic-table4" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th class="center">
                                Code
                            </th>
                            <th>Article</th>

                            <th>Qte</th>
                            <th>Qte Existant</th>

                            <th>Ecart/Entrée/Sortie</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $ligneinv = new Ligneinventaire();
                        foreach ($lignes as $lg) {
                            $ligneinv = $lg;
                            ?>
                            <tr>

                                <td><?php echo $ligneinv->getArticle()->getCodeart() ?></td>  
                                <td><?php echo $ligneinv->getArticle() ?></td> 

                                <td><?php
                                    $qtearticle = $ligneinv->getQtetheorique();
                                    echo $ligneinv->getQtetheorique();
                                    ?></td> 
                                <td >
                                    <?php
                                    if ($ligneinv->getEcartthorique() && $ligneinv->getEcartthorique() != "")
                                        $qteexistant = $ligneinv->getEcartthorique();

                                    echo $ligneinv->getEcartthorique();
                                    ?>
                                </td> 

                                <td>
                                    Ecart: <?php if ($ligneinv->getEcartthorique() && $ligneinv->getEcartthorique() != "") echo $qtearticle - $qteexistant; ?><br>
                                     <?php
                                    $st = new Stock();
                                    $stk = Doctrine_Core::getTable('stock')->findOneByIdArticleAndIdMag($ligneinv->getIdArticle(),$inventaire->getIdMag());
                                    $st = $stk;
                                    $qteentre = $st->getEntreeStock($inventaire->getDatedepart(), $st->getIdMag());
                                    $qtesortie = $st->getSortieStock($inventaire->getDatedepart(), $st->getIdMag());
                                    $qtetotal = $ligneinv->getEcartthorique() + $qteentre - $qtesortie;
                                    echo "Entrée : " . $qteentre . '<br>';
                                    echo "Sortie : " . $qtesortie . '<br>';
                                    echo "Qte final: " . $qtetotal;
                                    ?>

                                </td>

                            </tr>



                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </fieldset>


        </div>  
    </div>

</div>
