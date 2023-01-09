<div id="sf_admin_container">

    <?php
    $ids = explode(',', $idss);
    $documentachat = new Documentachat();

    $numero = $documentachat->NumeroSeqDocumentAchat(6);
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
        ->createQuery('a')->where('id_poste=5')
        ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    $visas = Doctrine_Core::getTable('visaachat')->findAll();
    $date_sys = date('Y-m-d');
    $mnt_estimatif = 0;
    for ($i = 0; $i < count($ids); $i++) {
        if ($ids[$i] != 'undefined' && $ids[$i] != null) {
            $docachat = DocumentachatTable::getInstance()->findOneById($ids[$i]);
            //  die('hhh'.$ids[$i]);
            $mnt_estimatif = $mnt_estimatif + $docachat->getMontantestimatif();
        }
    }
    // die($ids."fe") ;
    ?>
    <input type="hidden" id="ids_bci" value="<?php echo $idss; ?>">
    <input type="hidden" id="numero"  value="<?php echo $numero; ?>">
    <h1>Fiche D.I. N° :<?php echo $numero ; ?> </h1>
</div>
<div ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCIVersDemandeAchat('<?php echo $idss ?>')">
<div style="padding: 1%; width: 100%; font-size: 16px">
    <table style="list-style: none; margin-bottom: 0px;">
        <tr style="background-color: #F0F0F0;">
            <td style="width: 200px; vertical-align: middle; text-align: center;">
                <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                    <strong><?php echo strtoupper($societe); ?></strong>
                </p>
            </td>
            <td>
                <table style="margin-bottom: 0px;">
                    <tr>
                        <td colspan="2"><?php echo 'BON DE COMMANDE INTERNE (SYSTÈME) '; ?></td>
                    </tr>
                    <tr>
                        <td>N° : <?php echo $numero; ?></td>
                        <td>Date création : <?php echo  date('d/m/Y', strtotime($date_sys));  ?></td>
                    </tr>
                    <tr>
                        <td>Nature</td>
                        <td>
                            <?php $naturedoc = NaturedocachatTable::getInstance()->find(2);
                            echo $naturedoc->getLibelle(); ?></td>
                    </tr>
                    <tr>
                        <td>Montant Estimatif</td>
                        <td>
                            <?php echo number_format($mnt_estimatif, 3, '.', ' '); ?> TND

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div>
    <table id="liste_ligne">
        <thead>
            <tr>
                <th style="width: 80px">N°Ordre</th>
                <th>Code Article</th>
                <th style="text-align:center">DESIGNATION<br> </th>
                <th style="width: 80px">Quantité</th>
                <th>Projet</th>
                

            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="lignedoc in lignedocsdesbci">
                <td>
                    <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                </td>
                <td>
                    <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.codearticle}}</p>
                </td>
                <td>
                    <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                </td>
                <td style="text-align: center;">
                    <p style="border-bottom: #000 dashed 1px !important">
                        <input type="text" class="form-control align_center" style=""
                         id="qte_p_{{lignedoc.norgdre}}" 
                         value="{{lignedoc.qte|integer}}" 
                         ordre="{{lignedoc.norgdre}}" provisoire="p_"
                          onchange="miseAjour(this)">{{lignedoc.unitedemander}}
                    </p>
                </td>
                <input type="hidden" id="id_lignebce" value="{{lignedoc.id}}">
                <td>
                    <p style="border-bottom: #000 dashed 1px !important">
                        <textarea id="desc_p_{{lignedoc.norgdre}}" class="form-control" ordre="{{lignedoc.norgdre}}" provisoire="p_"> {{lignedoc.projet}}</textarea>
                    </p>
                </td>
                


            </tr>
        </tbody>
    </table>
    <input type="button" value="Enregistrer" ng-model="btnvalider"  class="btn btn-primary" ng-click="ValiderDAchatRegroupper('<?php echo $idss; ?>', '_p')">
</div>
</div>