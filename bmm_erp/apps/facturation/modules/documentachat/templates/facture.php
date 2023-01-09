<?php if ($lienBCEJ != 0 && $lienFacture != 0) {
   
    ?>
    <div class="tab-pane" id="jeton">
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo html_entity_decode($jeton->ReadBonCommandeExterne_ENTETE());
                $lignedoc = new Lignedocachat();
                $liste_demande_de_prix = Doctrine_Core::getTable('lignedocachat')
                                ->createQuery('a')
                                ->where('id_doc=' . $jeton->getId())->orderBy('nordre asc')->execute();
                ?>
                <table border="1" style="padding:1%" id="liste_article">
                    <thead>
                        <tr>
                            <th style="width: 50px">N°</th>
                            <th style="text-align:center">DESIGNATION<br>

                            </th>
                            <th style="width: 80px">Quantité</th>
                            <th style="width: 70px">P.Unit.<br>H.T</th>
                            <th style="width: 6%">T.H.T<br></th>
                            <th style="width: 70px">Remise en %</th>                            
                            <th style="width: 7%">Taux<br>Fodec</th>
                            <th style="width: 8%" class="disabledbutton">Fodec</th>
                            <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                            <th style="width: 8%">Taux<br>T.V.A</th>
                            <th style="width: 10%" class="disabledbutton">T.TTC</th>
                            <th>Observations</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tva = Doctrine_Core::getTable('tva')->findAll();
                        foreach ($liste_demande_de_prix as $lgnedoc) {
                            $lignedoc = $lgnedoc;
                            $qte = 0;
                            $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lgnedoc->getId());
                            if ($qteligne) {
                                $qte = $qteligne->getQtelivrefrs();
                            }
                            ?>
                            <tr>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
        <?php echo $lignedoc->getNordre() ?>
                                    </p>
                                </td>
                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
        <?php echo $lignedoc->getDesignationarticle() ?>
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="qte<?php echo $lignedoc->getId() ?>" value="<?php echo $qte ?>" class="align_center">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php echo ( $lignedoc->getQte() * $lignedoc->getMntht()); ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php echo $lignedoc->getMntremise(); ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php if ($lignedoc->getIdTauxfodec()) echo $lignedoc->getTauxfodec()->getLibelle(); ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php echo $lignedoc->getMntfodec(); ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php echo $lignedoc->getMntthtva(); ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <input type="text" id="mntht<?php echo $lignedoc->getId() ?>" value="<?php if ($lignedoc->getIdTva()) echo $lignedoc->getTva() ?>" class="align_right">
                                    </p>
                                </td>
                                <td style="text-align:center;">
                                    <p style="border-bottom: #000 dashed 1px !important">
                                        <select id="tva<?php echo $lignedoc->getId() ?>" style="width: 100%">
                                            <?php foreach ($tva as $tv) {
                                                ?>
                                                <option value="<?php $tv->getId() ?>"
                                                <?php
                                                if ($lignedoc->getIdTva() == $tv->getId()) {
                                                    echo ' selected="selected"';
                                                }
                                                ?>>
                                                <?php echo $tv; ?></option>
        <?php } ?>
                                        </select>
                                    </p>
                                </td>
                                <td style="text-align:justify;">
                                    <p style="border-bottom: #000 dashed 1px !important">
        <?php echo $lignedoc->getObservation() ?>
                                    </p>
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn btn-primary btn-xs" ng-click="MisAjour(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-edit bigger-110 icon-only"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs" ng-click="Supprimer(<?php echo $lignedoc->getId() ?>,<?php echo $jeton->getId() ?>)">
                                        <i class="ace-icon fa fa-remove bigger-110 icon-only"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <?php $ligne_mouvement = LignemouvementfacturationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                            <?php if ($ligne_mouvement): ?>
        <?php $montant_facture_mouvement = $ligne_mouvement->getMontant(); ?>
                                <td colspan="3">
                                    <p style="text-align: center;font-size: 18px; color: #9f191f;">
                                        Montant facture TTC saisie dans le mouvement :
                                        <input type="text" id="ttcnet_facture_mouvement" value="<?php echo number_format($montant_facture_mouvement, 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
                                <td colspan="4">
                                    <p style="text-align: center;font-size: 18px">
                                        Total TTC:
                                        <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
    <?php else: ?>
                                <td colspan="7">
                                    <p style="text-align: center;font-size: 18px">
                                        Total TTC:
                                        <input type="text" id="ttcnet_jeton" value="<?php echo number_format($jeton->getMntttc(), 3, ',', '.') ?>" class="disabledbutton align_center">
                                    </p>
                                </td>
    <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
    <?php echo html_entity_decode($jeton->ReadBonCommandeExterne_Footer()); ?>
            </div>
<!--            <ul>
                <li id="export_to_facture_tab" style="margin-top: 1%; margin-right: 2%; float: right;" class="<?php // echo $classBtn . ' ' . $classBtnF . ' ' . $disabled ?>">
                    <a href="<?php // echo url_for('Documents/detail') . '?exporterfacture=' . $documentachat->getId() . '&id=' . $documentachat->getId() ?>" style="font-size: 18px;" class="btn btn-primary">Exporter en Facture</a>
                </li>
            </ul>-->
        </div>
    </div>
    <div class="tab-pane active" id="facture">
        <div class="row">
            <div class="col-lg-12">
    <?php echo html_entity_decode($facture->ReadHtmlFactureImression($documentachat->getId())); ?>
            </div>
        </div>
    </div>
<?php } ?>