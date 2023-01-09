<div id="sf_admin_container" class="panel panel-green">
    <h1>Nouvel Inventaire</h1>
    <div class="sf_admin_filter">
        <table cellspacing="0" class="table table-striped table-bordered table-hover">
            <tbody>
                <tr>
                    <td><span>Inventaire N°: </span></td>
                    <td><?php echo $doc->getNumero(); ?></td>
                </tr>
                <tr>
                    <td><span>Date: </span></td>
                    <td><?php echo date("Y-m-d", strtotime($doc->getDateDoc())); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                <thead>
                    <tr>
                        <th>Immobilisation</th>
                        <th>Bureau</th>
                        <th>Code à barre</th>
                        <th>Qte Recp.</th>
                        <th>Qte Réel</th>
                        <th>Ecart</th>
                        <th>RQ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($immobilisations as $immobilisation):
                        $emplacements = Doctrine_Core::getTable('emplacement')->findByIdImmo($immobilisation->getId());

                        foreach ($emplacements as $empl) {
                            ?>
                            <tr id="inv_<?php echo $empl->getId(); ?>">
                                <td><?php echo $immobilisation->getDesignation() . "<br>" . $immobilisation->getReference(); ?></td>
                                <td>
                                    <?php
                                    if ($empl->getIdBureau()) {
                                        $bur = Doctrine_Core::getTable('bureaux')->findOneById($empl->getIdBureau());
                                        echo $bur;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $empl->getReference(); ?></td>
                                <?php
                                $inventaire = Doctrine_Core::getTable('inventairedoc')->findOneByIdDocAndIdEmpl($doc->getId(), $empl->getId());
                                if ($inventaire) {
                                    ?>
                                    <?php if ($inventaire->getEcart() == "-1") { ?>
                                <script  type="text/javascript">
                                    document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: rgba(255, 0, 0, 0.23);";
                                </script>
                            <?php } ?>
                            <?php if ($inventaire->getEcart() == "") { ?>
                                <script  type="text/javascript">
                                    document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: #ff9898";
                                </script>
                            <?php } ?>
                            <td style="text-align: center;"><p><?php echo $inventaire->getQtereel(); ?></p></td>

                            <td style="text-align: center;"><p><?php echo $inventaire->getQteexstant(); ?></p></td>
                            <td style="text-align: center;"><p><?php echo $inventaire->getEcart(); ?></p></td>
                            <td><p><?php echo $inventaire->getRq(); ?></p></td>
                        <?php } else { ?>
                            <td style="text-align: center;"><p>?</p></td>
                            <td style="text-align: center;"><p>?</p></td>
                            <td style="text-align: center;"><p>?</p></td>
                            <td style="text-align: center;"><p>Votre Bien est Perdue?</p></td>
                            <script  type="text/javascript">
                                document.getElementById('inv_<?php echo $empl->getId(); ?>').style = "background-color: #ff9898";
                            </script>
                        <?php } ?>
                        </tr>
                        <?php
                    }endforeach
                ;
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="idsite" value="">
</div>