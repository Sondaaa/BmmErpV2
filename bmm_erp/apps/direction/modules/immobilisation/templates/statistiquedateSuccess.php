<div id="sf_admin_container" class="panel panel-green">
    <h1>Stat/Date...</h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter">
            <form action="<?php echo url_for('immobilisation/statistiquedate') ?>" method="get" role="form">
                <table cellspacing="0" class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr class="sf_admin_form_row">
                            <td><label>Date début</label></td>
                            <td colspan="3">
                                <input type="date" name="date_debut" value="<?php echo $date_debut ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Date fin</label></td>
                            <td colspan="3">
                                <input type="date" name="date_fin" value="<?php echo $date_fin ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Catégorie d'immobilisation</td>
                            <td colspan="3">
                                <?php echo $FilterImmobilisation['id_categorie'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Type Famille</td>
                            <td colspan="3">
                                <?php echo $FilterFamille['id_typefamille'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Famille</td>
                            <td>
                                <?php echo $FilterImmobilisation['id_famille'] ?>
                            </td>
                            <td>Sous Famille</td>
                            <td>
                                <?php echo $FilterImmobilisation['id_sousfamille'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <a onclick="var f = document.createElement('form');
                                        f.style.display = 'none';
                                        this.parentNode.appendChild(f);
                                        f.method = 'post';
                                        f.action = this.href;
                                        f.submit();
                                        return false;" href="<?php echo url_for('immobilisation/statistiquedate') ?>" class="btn btn-outline btn-success">Effacer</a>
                                <input type="submit" value="Filtrer" name="filter" class="btn btn-outline btn-success">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                <thead>
                    <tr>
                        <th colspan="5" style="padding-left: 60%">Mnt TTC: <?php echo number_format($ttctotal, 3) . " DT"; ?></th>
                        <th>
                            <?php
                            $lien = "";
                            if ($FilterImmobilisation['id_categorie']->getValue())
                                $lien.="&immobilisation_filters[id_categorie]=" . $FilterImmobilisation['id_categorie']->getValue();
                            if ($FilterFamille['id_typefamille']->getValue())
                                $lien.="&famille_filters[id_typefamille]=" . $FilterFamille['id_typefamille']->getValue();
                            if ($FilterImmobilisation['id_famille']->getValue())
                                $lien.="&immobilisation_filters[id_famille]=" . $FilterImmobilisation['id_famille']->getValue();
                            if ($FilterImmobilisation['id_sousfamille']->getValue())
                                $lien.="&immobilisation_filters[id_sousfamille]=" . $FilterImmobilisation['id_sousfamille']->getValue();
                            ?>
                            <a class="btn btn-primary" href="<?php echo url_for('immobilisation/exporter?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer' . $lien) ?>">Exporter CSV</a>
                            <?php if (isset($_REQUEST['fichier'])) { ?>
                                <a href="<?php echo $_REQUEST['fichier'] ?>" target="_blanc">Télécharger Fichier</a>
                            <?php } ?>
                        </th>
                    </tr>
                    <tr>
                        <th>Numéro</th>
                        <th>Désignation</th>
                        <th>Famille</th>
                        <th>SousFamille</th>
                        <th>Bureaux</th>
                        <th>Mnt TTC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $immobilisation = new Immobilisation();
                    foreach ($immobilisations as $immo) {
                        $immobilisation = $immo;
                        ?>
                        <tr>
                            <td><?php echo $immobilisation->getNumero(); ?></td>
                            <td><?php echo $immobilisation->getDesignation(); ?></td>
                            <td><?php echo $immobilisation->getFamille(); ?></td>
                            <td><?php echo $immobilisation->getSousfamille(); ?></td>
                            <td><?php echo $immobilisation->getBureaux(); ?></td>
                            <td><?php
                                if ($immobilisation->getMntttc())
                                    echo $immobilisation->getMntttc() . " DT";
                                else
                                    echo "0.000 DT"
                                    ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">
                            <?php if ($pagerimmob->haveToPaginate()): ?>
                    <div class="sf_admin_pagination">
                        <strong><?php echo count($pagerimmob) ?></strong> Bon de réception
                        <?php if ($pagerimmob->haveToPaginate()): ?>
                            - page <strong><?php echo $pagerimmob->getPage() ?>/<?php echo $pagerimmob->getLastPage() ?></strong>
                        <?php endif; ?>
                        <a href="<?php echo url_for('immobilisation/statistiquedate?page=1&date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer&' . $lien) ?>">
                            <img src="<?php echo sfconfig::get('sf_appdir') ?>sfDoctrinePlugin/images/first.png" alt="First page" title="First page" />
                        </a>
                        <a href="<?php echo url_for('immobilisation/statistiquedate') ?>?page=<?php echo $pagerimmob->getPreviousPage() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer&' . $lien ?>">
                            <img src="<?php echo sfconfig::get('sf_appdir') ?>sfDoctrinePlugin/images/previous.png" alt="Previous page" title="Previous page" />
                        </a>
                        <?php foreach ($pagerimmob->getLinks() as $page): ?>
                            <?php if ($page == $pagerimmob->getPage()): ?>
                                <?php echo $page ?>
                            <?php else: ?>
                                <a href="<?php echo url_for('immobilisation/statistiquedate') ?>?page=<?php echo $page . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer' . $lien ?>"><?php echo $page ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <a href="<?php echo url_for('immobilisation/statistiquedate') ?>?page=<?php echo $pagerimmob->getNextPage() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer' . $lien ?>">
                            <img src="<?php echo sfconfig::get('sf_appdir') ?>sfDoctrinePlugin/images/next.png" alt="Next page" title="Next page" />
                        </a>
                        <a href="<?php echo url_for('immobilisation/statistiquedate') ?>?page=<?php echo $pagerimmob->getLastPage() . '&date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer' . $lien ?>">
                            <img src="<?php echo sfconfig::get('sf_appdir') ?>sfDoctrinePlugin/images/last.png" alt="Last page" title="Last page" />
                        </a>
                    <?php endif; ?>
                </div>
                </th>
                </tr>
                <tr>
                    <th colspan="5" style="padding-left: 60%">Mnt TTC: <?php echo number_format($ttctotal, 3) . " DT"; ?></th>
                    <th>
                        <a class="btn btn-primary" href="<?php echo url_for('immobilisation/exporter?date_debut=' . $date_debut . '&date_fin=' . $date_fin . '&filter=Filtrer' . $lien) ?>">Exporter CSV</a>
                        <?php if (isset($_REQUEST['fichier'])) { ?>
                            <a href="<?php echo $_REQUEST['fichier'] ?>" target="_blanc">Télécharger Fichier</a>
                        <?php } ?>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>