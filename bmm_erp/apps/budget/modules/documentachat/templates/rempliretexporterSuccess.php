<div id="sf_admin_container">
    <?php if ($documentachat->getIdTypedoc() == 6): ?>
        <h1>Fiche B.C.I N°: <?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php elseif ($documentachat->getIdTypedoc() == 9): ?>
        <h1>Fiche B.C.I.M.P N°: <?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php endif; ?>

    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    $visas = Doctrine_Core::getTable('visaachat')->findAll();
    ?>
    <div id="sf_admin_content" ng-controller="myCtrldocvisa">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;">
            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: center; font-size: 16px;">Avis de l'unité budget</th>
                    </tr>
                </thead>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    ?>
                    <tr>
                        <td><?php
                            if (strpos($avis->getLibelle(), ":") == 0)
                                echo $avis->getLibelle();
                            else
                                echo "<p style='color: red; margin: 0px;'>" . $avis->getLibelle() . "</p>";
                            ?></td>
                        <td>
                            <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                <input class="disabledbutton" <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox">
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div style="padding: 1%;width: 80%;font-size: 16px; <?php if ($documentachat->getIdTypedoc() == 9): ?>margin-bottom: 15px;<?php endif; ?>">
            <table style="list-style: none; margin-bottom: 0px;">
                <tr>
                    <td style="width: 200px; vertical-align: middle; text-align: center;">
                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>
                    </td>
                    <td>
                        <?php
                        $numero = strtoupper($documentachat->getTypedoc());
                        $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                        ?>
                        <table style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <tr>
                                <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                    <td>Nature</td>
                                    <td><?php echo $documentachat->getObjectdocument(); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td><?php if ($documentachat->getMontantestimatif() != null): ?><?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND<?php endif; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>
        <fieldset style="width: 80%; margin-bottom: 15px;">
            <legend>Données de base</legend>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 25%">Nom et Prénom du demandeur</td>
                        <td style="width: 50%"><?php echo $documentachat->getAgents(); ?></td>
                        <td style="width: 10%">Référence</td>
                        <td style="width: 15%"><?php echo $documentachat->getReference(); ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset id="zone_avis_budgetaire">
            <legend>Avis Budgétaire</legend>
            <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
            <table>
                <tbody>
                    <?php foreach ($liste_avis as $lgavis): ?>
                        <tr>
                            <td style="width: 13%; background: repeat-x #F2F2F2;">Avis Bugétaire</td>
                            <td style="width: 60%;"><?php echo $lgavis->getAvis(); ?></td>
                            <td style="width: 12%; background: repeat-x #F2F2F2;">Date Création</td>
                            <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                        </tr>
                        <?php if ($lgavis->getIdLigprotitrub() != null): ?>
                            <tr>
                                <td style="background: repeat-x #F2F2F2;">Budget</td>
                                <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getRubrique(); ?></td>
                            </tr>
                            <tr>
                                <td style="background: repeat-x #F2F2F2;">Rubrique</td>
                                <td colspan="3"><?php echo $lgavis->getLigprotitrub(); ?></td>
                            </tr>
                            <tr>
                                <td style="background: repeat-x #F2F2F2;">Reliquat</td>
                                <td colspan="3"><?php if($lgavis->getMntdisponible()) echo number_format ($lgavis->getMntdisponible(), 3 , '.', ' ') . ' TND'; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </fieldset>

        <?php $ligavissig = LigavissigTable::getInstance()->findByIdDoc($documentachat->getId()); ?>
        <?php if ($ligavissig->count() == 0): ?>
            <fieldset id="zone_visa">
                <legend>Données de Visa</legend>
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 14%">Liste des Visas B.C.I</td>
                            <td style="width: 31%">
                                <select id="visaid">
                                    <option value="0">Sélectionnez...</option>
                                    <?php foreach ($visas as $visa) { ?>                        
                                        <option value="<?php echo $visa->getId(); ?>"><?php echo $visa; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td style="width: 5%">Etat:</td>
                            <td style="width: 15%">
                                <select id="etat_visa">
                                    <option value=""></option>
                                    <option value="1">Valide</option>
                                    <option value="0">Non Valide</option>
                                </select>
                            </td>
                            <td>Date: <input type="date" id="datevisa" value="<?php echo date('Y-m-d'); ?>" readonly="true"></td>
                            <td rowspan="2" style="text-align: center;">
                                <a ng-click="AjouterVisa(<?php echo $documentachat->getId(); ?>)" class="btn btn-sm btn-outline btn-danger" >Ajouter Visa</a>
                            </td>
                        </tr>
                        <tr id="zone_motif" style="display: none;">
                            <td>Motif d'annulation</td>
                            <td colspan="4"><input type="text" id="motif" /></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        <?php endif; ?>
        <fieldset ng-init="ChargerVisa(<?php echo $documentachat->getId() ?>)">
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th style="text-align: center;">N°ordre</th>
                        <?php if ($documentachat->getIdTypedoc() != 9): ?>
                            <th style="text-align: center;">Code Article</th>
                        <?php endif; ?>
                        <th>Désignation</th>
                        <th style="text-align: center;">Qte. Demander</th>
                        <th style="text-align: center;">Qte. Stock</th>
                        <th>Projet</th>
                        <th>Observation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lg = new Lignedocachat();
                    foreach ($listesdocuments as $lignedoc) {
                        $lg = $lignedoc;
                        $qtedemander = 0;
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                        }
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <?php if ($documentachat->getIdTypedoc() != 9): ?>
                                <td style="text-align: center;"><?php echo $lg->getCodearticle() ?></td>
                            <?php endif; ?>
                            <td><?php echo html_entity_decode($lg->getDesignationarticle()) ?></td>
                            <td style="text-align: center;"><?php echo $qtedemander ?></td>
                            <td style="text-align: center;">
                                <?php $total_qte = 0; ?>
                                <?php if ($lg->getIdArticlestock()): ?>
                                    <?php $article_stocks = StockTable::getInstance()->findByIdArticle($lg->getIdArticlestock()); ?>
                                    <?php if ($article_stocks->count() != 0): ?>
                                        <?php foreach ($article_stocks as $article_stock): ?>
                                            <?php $total_qte = $total_qte + $article_stock->getQtereel(); ?>
                                        <?php endforeach; ?>
                                        <a style="padding: 0px 8px;" href="#" id="id-btn-dialog1_<?php echo $lg->getNordre() ?>" class="btn btn-primary btn-sm"><?php echo $total_qte; ?></a>
                                        <div id="dialog-message_<?php echo $lg->getNordre() ?>" class="hide">
                                            <legend style="margin-bottom: 10px; font-size: 18px;">Article : <?php echo $lg->getArticle(); ?></legend>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;">#</th>
                                                        <th>Magasin</th>
                                                        <th style="text-align: center;">Quantité</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $k = 1; ?>
                                                    <?php foreach ($article_stocks as $article_stock): ?>
                                                        <?php if ($article_stock->getQtereel() && $article_stock->getQtereel() != 0): ?>
                                                            <tr>
                                                                <td style="text-align: center;"><?php echo $k; ?></td>
                                                                <td><?php echo $article_stock->getMagasin(); ?></td>
                                                                <td style="text-align: center;"><?php echo $article_stock->getQtereel(); ?></td>
                                                            </tr>
                                                            <?php $k++; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr style="background-color: #F0F0F0;">
                                                        <td colspan="2" style="text-align: right;">Total : </td>
                                                        <td style="text-align: center;"><?php echo $total_qte; ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="hr hr-12 hr-double"></div>
                                            <p style="color: #aa4242;">
                                                Remarque : Les stocks épuisés ( avec quantité 0 ) ne sont pas affichés dans le tableau si-dessus.
                                            </p>
                                        </div>
                                        <script  type="text/javascript">

                                                    $("#id-btn-dialog1_<?php echo $lg->getNordre() ?>").on('click', function (e) {
                                            e.preventDefault();
                                                    var dialog = $("#dialog-message_<?php echo $lg->getNordre() ?>").removeClass('hide').dialog({
                                            modal: true,
                                                    title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-archive'></i> Répartition du Stock / Magasin</h4></div>",
                                                    title_html: true,
                                                    buttons: [
                                                    {
                                                    text: "Imprimer",
                                                            "class": "btn btn-success btn-minier",
                                                            click: function () {
                                                            var url = '?id=' + '<?php echo $lg->getId(); ?>';
                                                                    url = '<?php echo url_for('documentachat/imprimerStockDocument') ?>' + url;
                                                                    window.open(url, '_blank');
                                                                    win.focus();
                                                            }
                                                    },
                                                    {
                                                    text: "Fermer",
                                                            "class": "btn btn-primary btn-minier",
                                                            click: function () {
                                                            $(this).dialog("close");
                                                            }
                                                    }
                                                    ]
                                            });
                                            });</script>
                                    <?php else: ?>
                                        <?php echo $total_qte; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo $total_qte; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getObservation() ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table style="border: none !important;background: none !important">
                <tr style="border: none !important;background: none !important">
                    <td ng-repeat="visa in visadonnees" style="width: 123px;border: none !important;background: none !important">
                        <table style="width: 123px !important">
                            <tr>
                                <td>
                                    <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/images/" ?>{{visa.chemin}}" style="width: 100px;">
                                </td>
                            </tr>
                            <tr><td style="text-align: center;">{{visa.ag}}</td></tr>
                            <tr>
                                <td style="text-align: center;" ng-class="{etat_valide: {{visa.etatvalide}} == true, etat_non_valide: {{visa.etatvalide}} == false}">{{visa.datevisa | date:'dd/MM/yyyy'}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<style>

    .etat_valide {background-color: #9f9;}
    .etat_non_valide {background-color: #ffa6a6;}
    .ui-dialog{width: 600px !important;}

</style>