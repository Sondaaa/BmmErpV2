<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat() ?><?php endforeach; ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach; ?>
                <!--<li><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>-->
                <li class="active"><a ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" href="#profile" data-toggle="tab" aria-expanded="false">Fiche Demande de Prix</a></li>
                <li class=""><a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false">Liste des Demandes de Prix</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <a href="<?php echo url_for('documentachat/etapefinal?etapedoc=9&iddoc=') . $ids ?>" style="float: right;" type="button" class="btn btn-primary">
                            Valider et passer à l'étape suivante
                        </a>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!--                <div class="tab-pane fade active in" id="home">
                                    <h3 style="width: 50%; float: left;">Bon de commande Interne N°:<?php // echo $documentachat->getNumerodocachat()                   ?></h3>
                                    <a href="<?php // echo url_for('documentachat/etapefinal?etapedoc=9&iddoc=') . $documentachat->getId()                   ?>" style="float: right;" type="button" class="btn btn-primary">
                                        Valider et passer à l'étape suivante
                                    </a>
                                    <div style="margin-top: 10px;">
                                        <object style="width: 100%;height: 900px;" data="<?php // echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId())                   ?>" type="application/pdf">
                                            <embed src="<?php // echo url_for('documentachat/Imprimerdocachat?iddoc=' . $documentachat->getId())                   ?>" type="application/pdf" />
                                        </object>
                                    </div>
                                </div>-->
                <div class="tab-pane fade active in" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCI('<?php echo $ids; ?>');">
                <!--                <div class="tab-pane fade active in" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCI(<?php // echo $documentachat->getId()                   ?>);">-->
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Demande de prix
                        </p>
                    </h4>
                    <div style="padding: 1%;width: 40%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">
                                                DEMANDE DE PRIX N° :
                                                <input type="text" id="numero_dossier" value="<?php echo date('y', strtotime($documentachat->getDatecreation())) . '/' . $numerodemande ?>" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lieu de livraison</td>
                                            <td>
                                                <select id="id_lieu">
                                                    <option value="0">--Sélectionnez--</option>
                                                    <?php foreach ($lieuxlivraisons as $lieu) { ?>
                                                        <option value="<?php echo $lieu->getId() ?>"><?php echo $lieu->getLibelle() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="disabledbutton">
                                                DPS N° :
                                                <input type="text" id="numero_dp" value="<?php echo $refernece ?>">
                                                <input type="hidden" id="hidden_numero_dp" value="<?php echo $refernece ?>">
                                            </td>
                                            <td>
                                                Opération :
                                                <select id="operation_dps" onchange="setDps()">
                                                    <option value=""></option>
                                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                                        <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>
<!--                                        <tr>
                                            <td>Bon de commande Interne N° :</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                   ?></td>
                                        </tr>-->
                                        <tr>
                                            <td colspan="2">
                                                <table style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr><td>Bon de commande Interne N° :</td></tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($liste_document_achats as $document_achat): ?>
                                                            <tr><td><?php echo $document_achat->getNumerodocachat() ?></td></tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Date de création</td>
                                            <td><?php echo date('d/m/Y') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Référence</td>
                                            <td><input type="text" id="ref" class="form-control" value=""></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Objet
                                                <input type="text" id="objet" class="form-control" value="">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="width: 150%; float: left; border-right: solid 2px black; padding: 2%;">
                            <p style="text-align: justify;">
                                J'ai l'honneur de vous prier vouloir me faire connaitre vos meilleurs conditions pour la fourniture éventuelle des marchandises (ou travaux) désignées ci-dessous,
                                A cet effet  vous voudrez bien compléter  la présente formule et me la renvoyer dans un délai de <input type="text" id="delai" style="width: 100px; text-align: center;" onchange="setDelai()"> jour(s).</br> 
                                <!-- à partir de la date de notification de la commande ferme.
                                  A cet effet, vous voudrez bien compléter la présente formule et me la renvoyer pour le -->
                                DATE  LIMITE DE REPONSE LE: <input min="<?php echo date('Y-m-d') ?>" type="date" id="datemax" style="width: 125px">
                                <!-- au plus tard.-->
                            </p>
                            <input min="<?php echo date('Y-m-d') ?>" type="hidden" id="datemax_hidden" style="width: 125px">
                            <p style="text-align: center;">
                                Sce.Appro
                            </p>
                        </div>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: left">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <td colspan="3">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">Fournisseur</td>
                                            <td style="width: 70%;">
                                                <select id="fournisseur_demande">
                                                    <option value=""></option>
                                                    <?php foreach ($fournisseurs as $fournisseur): ?>
                                                        <option value="<?php echo $fournisseur->getId(); ?>"><?php echo $fournisseur; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td style="text-align: center; width: 10%;">
                                                <button class="btn btn-xs btn-primary" onclick="ajouterFournisseur()">Ajouter</button>
                                            </td>
                                        </tr>
                                    </table>

                                    <table id="liste_fournisseur_demande" style="margin-bottom: 0px;">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">Id</th>
                                                <th>Liste des fournisseurs à consulter</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="width: 70%; float: right;">
                            <p>
                                Je m'engage à livrer aux conditions demandées les marchandises cotées 
                                par moi ci-dessous<br> Le .......................
                            </p>
                            <p style="text-align: center">
                                Signature et Cachet du Fournisseur
                            </p>
                        </div>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 80px">N°Ordre</th>
                                    <th style="text-align:center">DESIGNATION<br>
                                        (indiquer,s'il y a lieu, les référence au catalogue du fournisseur)
                                    </th>
                                    <th style="text-align:center">Quantité</th>
                                    <th>Unité</th>
                                    <th>P.Unit.<br>H.T</th>
                                    <th>Taux<br>T.V.A</th>
                                    <th>Observations</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                <tr>
                                    <td><input type="text" class="form-control disabledbutton" style="" id="nordre"  > </td>
                                    <td>
                                        <input type="hidden" id="qtemax" >
                                        <input type="text" class="form-control" ng-model="designation.text" id="designation" ng-click="ChoisArticle(<?php // echo $documentachat->getId()                  ?>)" ng-change="ChoisArticle(<?php // echo $documentachat->getId()                  ?>)"></td>
                                    <td style="width: 80px"><input type="text" ng-model="qte_txt" class="form-control" id="qte_txt" > </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="button" value="+"  class="btn btn-primary"  ng-click="AjouterLignedoc()" > 
                                        <input type="button" value="-"  class="btn btn-xs btn-danger" ng-click="ViderLignedoc()" >
                                    </td>
                                </tr>-->
                                <tr ng-repeat="lignedoc in lignedocs">
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p></td>
                                    <td style="text-align: center;"><p style="border-bottom: #000 dashed 1px !important;width: 100%; max-width: 100px; margin: 0px;"><input id="qte_{{lignedoc.norgdre}}" type="text" value="{{lignedoc.qte|integer}}" class="align_center" style="width: 100%;"></p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.unitedemander}}</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.observation}}</p></td>
                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCInterne(lignedoc.norgdre)"> 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCInterne(lignedoc.norgdre)">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary1" ng-click="ValiderDocumentdeprix('<?php echo $ids ?>')"> 
                    </div>
                </div>
                <div class="tab-pane" style="height: 1200px" id="listesdemandeprix" ng-controller="CtrlListesDemandeprix" ng-init="AfficheDoc('<?php echo $ids; ?>')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Demande de Prix
                        </p> 
                    </h4>
                    <div class="col-xs-12 col-lg-12">
                        <div class="col-xs-12 col-lg-6">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Numéro</th>
                                        <th>Fournisseur</th>
                                        <th style="text-align: center;" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="demandeprix in docDemandePrix">
                                        <td style="text-align: center;">{{demandeprix.numero}}</td>
                                        <td>{{demandeprix.rs}}</td> 
                                        <td style="text-align: center;">
                                            <input type="button" ng-model="btndetail" ng-click="DetailLignedoc(demandeprix.id)" value="+ Détail">
                                        </td>
                                        <td style="text-align: center;"><a href="<?php echo url_for('Documents/Imprimerdemandedachat?iddoc=') ?>{{demandeprix.id}}" ng-model="BtnExporter" target="_blanc">Exporter PDF</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="pull-right" style="width: 30%">
                                <tr>
                                    <td>
                                        <a href="<?php echo url_for('Documents/ImprimerlesdemandedeprixAvecCondition?iddoc=' . $ids) ?>" type="button" class="btn btn-success" 
                                           ng-model="BtnExporter" target="_blanc">Imprimer D.Prix Avec Condit° administ.</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo url_for('Documents/Imprimerlesdemandedeprix?iddoc=' . $ids) ?>" type="button" class="btn btn-primary" 
                                           ng-model="BtnExporter" target="_blanc">Imprimer Listes des Demande de Prix</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="divdetail" class="col-xs-12 col-lg-6">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center">Fournisseur sélectionné</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td style="width: 25%;">Raison sociale</td>
                                    <td style="width: 75%;">{{detailfrs.rs}}</td>
                                </tr>
                                <tr>
                                    <td>Adresse</td>
                                    <td>{{detailfrs.adrs}}</td>
                                </tr>
                                <tr>
                                    <td>Annuaire</td>
                                    <td>{{detailfrs.annuaire}}</td>
                                </tr>
                                <tr>
                                    <td>Activité</td>
                                    <td>{{detailfrs.description}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table style="margin-bottom: 0px;">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">N°ordre</th>
                                                    <th>Désignation d'article</th>
                                                    <th style="text-align: center;">Quantité</th>
                                                    <th style="text-align: center;">Unité</th>
                                                </tr>
                                            </thead>
                                            <tr ng-repeat="ligne in lignedocsDemandedeprix">
                                                <td style="text-align: center;">{{ligne.nordre}}</td>
                                                <td>{{ligne.designationarticle}}</td>
                                                <td style="text-align: center;">{{ligne.qteaachat|integer}}</td>
                                                <td style="text-align: center;">{{ligne.unitedemander}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div id="documentscan" class="col-md-12">
                            <div id="sf_admin_content" ng-controller="CtrlScan">
                                <div class="row ">
                                    <div  class="col-md-6">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading -->
                                            <div class="panel-body" id="imgmodel" style="height: 600px">

                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <fieldset style="padding: 10px">
                                                    <legend>Attacher fiche scannée</legend>
                                                    <div class="col-lg-12">
                                                        <div class="content">
                                                            <input type="button" value="SCAN NOUVEAUX DOCUMENT" ng-click="ScanDocDemandeachat();"  class="btn btn-info">
                                                            <input ng-click="ValiderAttachementDoucumentachat(detailfrs.demandedeprixid)" type="button" value="VALIDER ATTACHEMENT" ng-click=""  class="btn btn-info">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset style="padding: 10px;">
                                                    <div class="col-lg-12" >
                                                        <div class="content">
                                                            <input type="button" value="AFFICHE LES ATTACHEMENTS" ng-click="AfficheDemandedeprix(detailfrs.demandedeprixid);"  class="btn btn-info"><br>
                                                            <table>
                                                                <tr ng-repeat="att in attachements">
                                                                    <td>
                                                                        <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}">
                                                                            <img src="<?php echo sfconfig::get('sf_appdir') . "uploads/scanner/" ?>{{att.chemin}}" style="width: 50px">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setDelai() {
        if ($("#delai").val() != '') {
            var delai = $("#delai").val();
            if (isNaN(delai)) {
                $("#delai").val('');
                $("#datemax").val('');
            } else {
                delai = parseInt($("#delai").val())
                var data = '<?php echo date('Y-m-d') ?>';
                //Debut : incrementer délai en jour à une date définie
                var mydate = new Date(data);
                mydate.setDate(mydate.getDate() + delai);
                var y = mydate.getFullYear(),
                        m = mydate.getMonth() + 1, // january is month 0 in javascript
                        d = mydate.getDate();
                var pad = function (val) {
                    var str = val.toString();
                    return (str.length < 2) ? "0" + str : str
                };
                data = [y, pad(m), pad(d)].join("-");
                //Fin : incrementer délai en jour à une date définie
                $('#datemax').val(data);
            }
        } else {
            $("#datemax").val('');
        }
    }

    function ajouterFournisseur() {
        if ($("#fournisseur_demande").val() != '') {
            var id = parseInt($('#fournisseur_demande').val());
            var tr_html = '<tr id="fournisseur_tr_' + id + '">';
            tr_html = tr_html + '<td style="display: none;"><input type="hidden" name="id_fournisseur_tr" value="' + $("#fournisseur_demande").val() + '" /></td>';
            tr_html = tr_html + '<td style="text-align: justify;">' + $("#fournisseur_demande option:selected").text() + '</td>';
            tr_html = tr_html + '<td style="text-align: center;vertical-align:middle;"><button class="btn btn-xs btn-danger" onclick="deleteFournisseur(' + id + ')"><i class="ace-icon fa fa-trash"></i></button></td>';
            tr_html = tr_html + '</tr>';
            $("#liste_fournisseur_demande tbody").append(tr_html);

            $("#fournisseur_demande").val('').trigger("liszt:updated");
            $("#fournisseur_demande").trigger("chosen:updated");
        }
    }

    function deleteFournisseur(id) {
        $("#fournisseur_tr_" + id).remove();
    }

    function setDps() {
        var dps = '<?php echo $refernece ?>';
        var operation_dps = $("#operation_dps").val();
        if (operation_dps != '')
            dps = dps + '/' + operation_dps;
        $("#numero_dp").val(dps);
    }

</script>