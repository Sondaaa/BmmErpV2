<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php echo $documentachat->getNumerodocachat(); ?></h1>
    <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
    <div id="sf_admin_content">  
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">

                <!--<li><a href="#home" data-toggle="tab" aria-expanded="true">Détail</a></li>-->
                <li class="active"><a ng-controller="CtrlDemandeprix" ng-click="InialiserDemandePrix()" href="#profile" data-toggle="tab" aria-expanded="false">Fiche Demande de Prix</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">


                <div class="tab-pane fade active in" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCI('<?php echo $ids; ?>');">
                <!--                <div class="tab-pane fade active in" id="profile" ng-controller="CtrlDemandeprix" ng-init="AfficheLignedocBCI(<?php // echo $documentachat->getId()                 ?>);">-->
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
                                                        <option value="<?php echo $lieu->getId() ?>" <?php if ($id_lieu = $lieu->getId()): ?>selected="true" <?php endif; ?> ><?php echo $lieu->getLibelle() ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="disabledbutton">
                                                DPS N° :
                                                <input type="text" id="numero_dp" value="<?php echo $dps_numero; ?>" />
                                                <input type="hidden" id="hidden_numero_dp" value="<?php echo $dps_numero; ?>">
                                            </td>
                                            <td>
                                                Opération :
                                                <select id="operation_dps" onchange="setDps()">
                                                    <option value=""></option>
                                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                                        <option <?php if ($documentachat->getNumerooperation() == str_pad($i, 2, '0', STR_PAD_LEFT)): ?>selected="true"<?php endif; ?> value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </td>
                                        </tr>
<!--                                        <tr>
                                            <td>Bon de commande Interne N° :</td>
                                            <td><?php // echo $documentachat->getNumerodocachat()                 ?></td>
                                        </tr>-->
                                        <tr>
                                            <td colspan="2">
                                                <table style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr><td>Bon de commande Interne N° :</td></tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr><td><?php echo $documentachat->getNumerodocachat() ?></td></tr>

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
                                            <td><input type="text" id="ref" class="form-control" value="<?php echo $refernece; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                Objet
                                                <input type="text" id="objet" class="form-control" value="<?php echo $observation; ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="width: 150%; float: left; border-right: solid 2px black; padding: 2%;">
                            <p style="text-align: justify;">
                                J'ai l'honneur de vous prier vouloir me faire connaitre vos meilleurs conditions pour la fourniture éventuelle des marchandises désignées ci-dessous,
                                qui seraient à livrer à l'etablisement,<br> dans un délai de <input type="text" id="delai" style="width: 100px; text-align: center;" onchange="setDelai()" value="<?php echo $delai; ?>"> jour(s) 
                                à partir de la date de notification de la commande ferme.
                                A cet effet, vous voudrez bien compléter la présente formule et me la renvoyer pour le <input min="<?php echo date('Y-m-d') ?>" type="date" id="datemax" style="width: 125px" value="<?php echo $maxrepense ?>">
                                au plus tard.
                            </p>
                            <input min="<?php echo date('Y-m-d') ?>" type="hidden" id="datemax_hidden" style="width: 125px">
                            <p style="text-align: center;">
                                Sce.Appro
                            </p>
                        </div>
                    </div>
                    <div style="padding: 1%;width: 60%;font-size: 16px;float: left" ng-controller="CtrlDemandeprix">
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
                                                        <option <?php if ($fournisseur->getId() == $documentachat->getIdFrs()): ?> selected="true"  <?php endif; ?>value="<?php echo $fournisseur->getId(); ?>"> <?php echo $fournisseur; ?>
                                                        </option>
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
                                            <tr  ng-repeat="lignefrs in lignefrss">
                                                <td style="display: none">{{lignefrs.id}}</td>
                                                <td>{{lignefrs.rs}}</td>

                                               <td style="text-align: center;vertical-align:middle;">
                                                   <input type="button" class="btn btn-xs btn-danger" value="-"  ng-click="deleteFournisseur(lignefrs.id)">
                                                 
                                                </td>
                                            </tr>
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
                                        <input type="text" class="form-control" ng-model="designation.text" id="designation" ng-click="ChoisArticle(<?php // echo $documentachat->getId()                ?>)" ng-change="ChoisArticle(<?php // echo $documentachat->getId()                ?>)"></td>
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
                                    <td><p style="border-bottom: #000 dashed 1px !important">&emsp14;</p></td>
                                    <td>
                                        <input type="button" value="+" class="btn btn-primary" ng-click="MisAjourLigneDocBonCInterne(lignedoc.norgdre)"> 
                                        <input type="button" value="-" class="btn btn-xs btn-danger" ng-click="DeleteLigneDocBonCInterne(lignedoc.norgdre)">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a type="button" value="Retour à la liste" ng-model="btnretour" class="btn btn-xs btn-success" href="<?php echo url_for('Documents/indexfrs?idtype=8') ?>" >Retour à la liste</a> 
                        <input type="button" value="Enregistrer" ng-model="btnvalider" class="btn btn-primary1" ng-click="ValiderDocumentdeprixModifier('<?php echo $documentachat->getId(); ?>')"> 
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
    setDps();
    function setDps() {
        var dps = '<?php echo $dps_numero ?>';
        var operation_dps = $("#operation_dps").val();
        if (operation_dps != '')
            dps = dps + '/' + operation_dps;
        $("#numero_dp").val(dps);
    }

</script>