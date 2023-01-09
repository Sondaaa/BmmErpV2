<div id="sf_admin_container">
    <h1>Courrier: <?php echo $courrier->getTypecourrier()->getPrefix(); ?> <?php echo $courrier->getNumero(); ?> </h1>
    <div id="sf_admin_header"> </div>
    <div id="sf_admin_content">
        <div>
            <fieldset>
                <legend>Données de base</legend>
                <div class="col-lg-9">
                    <table>
                        <tr>
                            <td colspan="4"><span>Note du Courrier: <?php if ($courrier->getIdFamille()) echo $courrier->getFamillecourrier(); ?></span></td>  
                        </tr>
                        <tr>
                            <td><span>Date de Création</span></td>
                            <td><?php echo $courrier->getDatecreation(); ?></td>
                            <td><span>Numéro</span></span></td>
                            <td><?php echo $courrier->getTypecourrier()->getPrefix(); ?> <?php echo $courrier->getNumero(); ?></td>
                        </tr>
                        <tr>
                            <td><span>Numéro Correspondance</span></td>
                            <td><?php echo $courrier->getNumeroseq(); ?></td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3" style="text-align: center;">
                    <ul class="sf_admin_bar">
                        <!--                        <li class="sf_admin_action_list" style="display: inline;">
                                                    <a style="height: 55px !important;width: 200px;        font-size: 14px !important;        font-weight: bold !important;" href="<?php //echo url_for('courrier/index') . '?idtype=' . $courrier->getIdType()      ?>" class=" btn btn-outline btn-success">
                                                        Retour à la liste<br> des courriers
                                                    </a>
                                                </li>-->
                        <li  class="sf_admin_action_list" style="display: inline;">
                            <a style="margin: 2%; width: 200px; font-size: 16px !important; font-weight: bold !important;" 
                               target="_blanc" href="<?php echo url_for('courrier/imprimercourrier') . '?idcourrier=' . $courrier->getId() ?>" class=" btn btn-outline btn-success">
                                Exporter Pdf <br> Imprimer
                            </a>
                        </li>
                    </ul>
                </div>
                <table class="col-lg-12">
                    <tr>
                        <td><span>Expéditeur</span></td>
                        <td><?php if ($mvc) echo $mvc->getExpdest(); ?></td>
                        <td style="color:#c36017;font-size: 18px"><?php if ($mvc && $mvc->getIdAction()) echo $mvc->getActionparcour(); ?> ===>> </td>
                        <td><span>Utilisateur && Bureau</span></td>
                        <td>
                            <?php if ($courrier->getIdUser() != null): ?>
                                <?php echo $courrier->getUtilisateur() ?>
                                <?php echo $courrier->getBureaux(); ?>
                            <?php else: ?>
                                <?php echo $courrier->getFamexpdes(); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Type</span></td>
                        <td><?php echo $courrier->getTypecourrier(); ?></td>
                        <td><span>Réference Courrier</span></td>
                        <td colspan="2"><?php echo $courrier->getReferencecourrier() ?></td>
                    </tr>
                    <tr>
                        <td><span>Mode ENV.||REC.</span></td>
                        <td><?php echo $courrier->getModescourrier() ?></td>
                        <td><span>Date Correspondance </span></td>
                        <td colspan="2"><?php echo $courrier->getDatecorespondanse() ?></td>
                    </tr>
                    <tr>
                        <td><span>Type d'envoi</span></td>
                        <td colspan="4"><?php echo $courrier->getTypeparamcourrier() ?></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Données de Contenue </legend>
                <table>
                    <tr>
                        <td style="width: 15%;"><span>Titre</span></td>
                        <td style="width: 40%;"><?php echo $courrier->getTitre() ?></td>
                        <td style="width: 10%;"><span>Objet</span></td>
                        <td style="width: 35%;"><?php echo $courrier->getObject() ?></td>
                    </tr>
                    <tr>
                        <td><span>Sujet</span></td>
                        <td colspan="2"><?php echo $courrier->getSujet() ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><span>Description du courrier</span></td>
                        <td colspan="3"><?php echo html_entity_decode($courrier->getDescription()) ?></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Données de Transfert </legend>
                <table>
                    <tr>
                        <td>Expédition</td>
                        <td>Destination</td>
                        <td>Action d'envoie</td>
                    </tr>
                    <?php
                    $parcourcourriers = new Parcourcourier();
                    foreach ($parcourcou as $par) {
                        $parcourcourriers = $par;
                        ?>
                        <tr>
                            <td><?php echo $parcourcourriers->getExpdest() ?></td>
                            <td><?php
                                if ($parcourcourriers->getIdRec() != null) {
                                    $rec = Doctrine_Core::getTable('expdest')->findOneById($parcourcourriers->getIdRec());
                                    if ($rec)
                                        echo $rec;
                                }
                                ?></td>
                            <td><?php echo $parcourcourriers->getActionparcour() ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </fieldset>
            <fieldset>
                <legend>Données de Scan et Impression </legend>
                <table>
                    <tr>
                        <td>Document</td>
                        <td>Courrier Origine ou Source</td>
                        <td>Action</td>
                    </tr>
                    <?php
                    $piecejoints_original = Doctrine_Core::getTable('piecejoint')->findByIdCourrier($courrier->getId());
                    foreach ($piecejoints_original as $piecejoint):
                        ?>
                        <tr>
                            <td><?php echo $piecejoint->getChemin(); ?></td>
                            <td>Courrier origine N°:<?php echo $courrier->getNumerocourrierstring(); ?> </td>
                            <td><a class="btn btn-white btn-xs btn-primary" target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">Voir et Imprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    if ($courrier->getIdCourrier()) {
                        $piecejoints_source = Doctrine_Core::getTable('piecejoint')->findByIdCourrier($courrier->getIdCourrier());
                        foreach ($piecejoints_source as $piecejoint):
                            ?>
                            <tr>
                                <td><?php echo $piecejoint->getChemin(); ?></td>
                                <td>Courrier source N°:<?php echo $courrier->getNumerocourrierstring(); ?></td>
                                <td><a class="btn btn-white btn-xs btn-primary" target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">Voir et Imprimer</a></td>
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>
                </table>
            </fieldset>
        </div>
    </div>
</div>
<style>

    .sf_admin_bar{
        margin: 0px !important;
    }
    td>span{
        color: #740808;
        font-size: small;
        font-style: italic;
    }

</style>