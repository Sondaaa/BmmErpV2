<?php
$doc_achat = DocumentachatTable::getInstance()->find($iddoc);
$id_doc_achat_parent = $doc_achat->getIdDocparent();
$doc_achat_parent = DocumentachatTable::getInstance()->find($id_doc_achat_parent);
$taux_tva = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('tva')
                ->orderBy('libelle')->execute();
$liste_projet = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('projet')
                ->orderBy('libelle')->execute();
$liste_unite = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('unitemarche')
        ->orderBy('id')
        ->execute();
$liste_tauxfodec = Doctrine_Query::create()
        ->select("id,libelle")
        ->from('tauxfodec')
        ->orderBy('id')
        ->execute();
$liste_document_achats_parent = DocumentachatTable::getInstance()->getByFrss($iddoc);
?>
<?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
<div id="sf_admin_container"> 
    <div id="sf_admin_content">
        <div class="col-sm-12" >
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Avenant qui touche Le Détail du prix
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div   ng-controller="CtrlContrat">
                        <div style="position: absolute;float: right;margin-left: 50%;width: 50%;"
                             ng-init="AfficherlignebciAvenant('<?php echo $doc_achat_parent->getIdDocparent(); ?>', '<?php echo $contrat->getId(); ?>');AffichageModalitepaiment('<?php echo $doc_achat_parent->getIdDocparent(); ?>', '<?php echo $contrat->getId(); ?>')"
                             ><!-- ng-init="AfficheFournisseurContrat('<?php // echo $contrat->getId();                    ?>')"-->
                            <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                                <tr>
                                    <td>
                                        <table style="list-style: none; margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td>
                                                    <table ng-init="InialiserDemandePrix();
                                                                    AfficheLignedocBCIVersBCE('<?php echo $ids; ?>')" class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <td colspan="5">Raison sociale ou matricule fiscale du fournisseur consulté</td>
                                                        </tr>
                                                        <tr >
                                                            <td>Fournisseur</td>
                                                            <td style="width: 100px">
                                                                <input type="text" readonly="true" value="<?php echo $contrat->getFournisseur()->getReference() ?>" id="reffournisseur1" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input readonly="true" type="text" value="<?php echo $contrat->getFournisseur()->getRs() ?>" id="fournisseur1" class="form-control" 
                                                                       >
                                                                <input type="hidden" id="fournisseur_id" value="<?php echo $contrat->getIdFrs() ?>" />
                                                            </td>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table> 
                                    </td>
                                </tr>
                            </table> 
                        </div>
                        <div style="width: 100%;font-size: 16px">
                            <table style="list-style: none; margin-bottom: 10px;width: 50%">
                                <tr style="background-color: #F0F0F0;">
                                    <td style="width: 30%; vertical-align: middle; text-align: center;">
                                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                                            <strong><?php echo strtoupper($societe); ?></strong>
                                        </p>  
                                    </td>
                                    <td>
                                        <?php ?>
                                        <table style="margin-bottom: 0px;" class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <td colspan="2">
                                                    <a target="_blank" href="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $doc_achat->getId()) ?>">Formulaire de Contrat du BCI ( <?php echo $doc_achat->getNumerodocumentachat(); ?> )</a></td>
                                            </tr>
                                            <tr class="disabledbutton">
                                                <td>N° Contrat : </td> 
                                                <td><input type="text" id="contratachat_numero" value="<?php echo $contrat->getNumero(); ?>"
                                                    <?php // echo $form['numero']->renderError() ?>
                                                    <?php // echo $form['numero'] ?>
                                                </td>
                                            </tr>
                                            <tr class="disabledbutton">
                                                <td>Nom du Contrat: </td>
                                                <td>
                                                    <?php echo $form['reference']->renderError() ?>
                                                    <?php echo $form['reference'] ?>
                                                </td>
                                            </tr>
                                            <tr class="disabledbutton">
                                                <td>Date de création</td>
                                                <td> <?php echo date('d/m/Y') ?> 
                                                </td>
                                            </tr>
                                            <tr class="disabledbutton">
                                                <td>Date de Signature</td>
                                                <td><?php echo $form['datesigntaure']->renderError() ?>
                                                    <?php echo $form['datesigntaure'] ?></td>
                                            </tr>

                                            <tr class="disabledbutton">
                                                <td>Type Livraison</td>
                                                <td><?php echo $form['type']->renderError() ?>
                                                    <?php echo $form['type'] ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table> 
                        </div>
                        <div ng-click=" ListesTva();
                                    InialiserCombo();">
                            <div class="row" style="display: none">
                                <div class="col-lg-2" style="float: right;">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>
                                                <label>Montant Total</label>
                                                <input type="number" id="txt_mnttotal" class="align_right">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-2" style="float: right; display: none">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>
                                                <label style="font-weight: bold;">Total TTC</label>
                                                <input type="text" id="mnttotal" readonly="true" class="align_right">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row" ng-init="AfficheLignedocumentContrat('<?php echo $contrat->getId(); ?>')">
                                <fieldset>
                                    <legend>Liste des articles</legend>
                                    <table id="liste_ligne" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">N°Ordre</th>
                                                <th style="text-align:center;width: 18%">DESIGNATION</th>
                                                <th style="width:5%">Unité</th>
                                                <th style="width: 5%">Quantité</th>
                                                <th style="width: 6%">P.Unit.<br></th>
                                                <th style="width: 6%">T.H.T<br></th>
                                                <th style="width: 7%" >Taux<br>Fodec</th>
                                                <th style="width: 8%" class="disabledbutton">Fodec</th>
                                                <th style="width: 8%" class="disabledbutton">T.H.TVA</th>
                                                <th style="width: 7%" class="disabledbutton">Taux<br>T.V.A</th>
                                                <th style="width: 8%" class="disabledbutton">T.TTC</th>
                                                <th style="width: 8%">Projet</th>
                                                <th style="width: 8%">Observations</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr style="background-color: #EDEDED;">
                                                <td class="disabledbutton">  <input type="text" id="nordre"></td>
                                                <td >
                                                    <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">                   
                                                    <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                                    <?php include_partial('symbole', array()) ?>
                                                </td>

                                                <td >
                                                    <input type="hidden" id="idunite">

                                                    <select id="unite"  >
                                                        <option id="0"></option>
                                                        <?php foreach ($liste_unite as $type): ?>
                                                            <option value="<?php echo $type->getId() ?>"><?php echo $type->getLibelle() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </td>
                                                <td><input type="text" class="form-control" style="" id="qte"></td>
                                                <td><input type="text" class="form-control" style="" id="puht"></td>
                                                <td><input type="text" class="form-control" style="" id="totalhax"  readonly="true"></td>
                                                <td>

                                                    <input type="hidden" id="idtaufodec">

                                                    <select id="taufodec"  >
                                                        <option id="0"></option>
                                                        <?php foreach ($liste_tauxfodec as $tau): ?>
                                                            <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>

                                                <td><input type="text" class="form-control" style="" id="fodec"   readonly="true"></td>
                                                <td><input type="text" class="form-control" style="" id="totalhtva"  readonly="true" ></td>
                                                <td>                   
                                                    <input type="hidden" id="idtva">
                                                    <input type="hidden" value="" ng-model="tvacontrat.text" id="tvacontrat" class="form-control" autocomplete="off" ng-change="Tva()" ng-click="Tva()" ng-keyup="Tva()">
                                                    <select id="tva" onchange="selecttva()" >
                                                        <option id="0"></option>
                                                        <?php foreach ($taux_tva as $tva): ?>
                                                            <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" style="" id="totalttc" readonly="true" ></td><!--disabled="true"-->
                                                <td >
                                                    <input type="hidden" id="idprojet">

                                                    <select id="projet"  >
                                                        <option id="0"></option>
                                                        <?php foreach ($liste_projet as $projet): ?>
                                                            <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea id="observation" class="form-control" ></textarea>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a class="btn  btn-xs  btn-primary" ng-click="AddDetailContrat()"
                                                       title="Add Ligne">
                                                        <i class="fa fa-plus"></i>
                                                    </a> 
                                                    <button type="button" class="btn   btn-xs  btn-danger" 
                                                            ng-click="ViderChampsContrat()"
                                                            title="Vider les Chmaps"><i class="fa fa-minus"></i></button>
                                                    <br><br>
                                                    <a style="margin-top: 1px"
                                                       class="btn  btn-xs  btn-success"
                                                       onclick="AjouterLigne()" 
                                                       title="Modalité de Paiement">
                                                        <i class="fa fa-plus"></i>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <tr ng-repeat="lignedoc in lignedocsbcicontrat">
                                                <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                                <td style="text-align: center;">
                                                    <input type="hidden" id="id_lignedocachat" value="{{lignedoc.id}}">
                                                    <input type="hidden" id="nordre" value="{{lignedoc.norgdre}}">
                                                    <input type="text" class="form-control align_center" style=""
                                                           id="designation_p_{{lignedoc.norgdre}}" 
                                                           value="{{lignedoc.designation}}" 
                                                           ordre="{{lignedoc.norgdre}}" 
                                                           provisoire="p_" onchange="miseAjour(this)">
                                                </td>
                                                <td> {{lignedoc.unite}}  </td>
                                                <td style="text-align: center;"> <input type="text" class="form-control align_center" 
                                                                                        style="" id="qte_p_{{lignedoc.norgdre}}" 
                                                                                        value="{{lignedoc.qte|integer}}" 
                                                                                        ordre="{{lignedoc.norgdre}}" 
                                                                                        provisoire="p_">
                                                </td>
                                                <td> <input type="text" class="form-control align_center" style=""
                                                            id="puht_p_{{lignedoc.norgdre}}"
                                                            value="{{lignedoc.puht}}" ordre="{{lignedoc.norgdre}}"
                                                            provisoire="p_" onchange="miseAjour(this)">
                                                </td>
                                                <td>{{lignedoc.totalhax}}</td>
                                                <td><input type="hidden" id="idtaufodec">{{lignedoc.taufodec}}</td>
                                                <td>{{lignedoc.fodec}}</td>
                                                <td>{{lignedoc.totalhtva}}</td>
                                                <td>{{lignedoc.tva}} </td>
                                                <td style="display: none;">{{lignedoc.prixttc}}</td>
                                                <td>{{lignedoc.totalttc}}</td>
                                                <td>{{lignedoc.projet}}</td>
                                                <td>{{lignedoc.observation}}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-xs btn-primary" ng-click="UpdateDetailBci(lignedoc.norgdre, '')" > 
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-xs btn-danger" ng-click="DeleteLigneContrat(lignedoc.norgdre)" >
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <?php ?>

                                                </td>
                                            </tr>    
                                        <tr ng-repeat="lignedoc in lignelignecontratAvenant">
                                            <td></td>
                                                <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p></td>
                                                <td style="text-align: center;" colspan="8">
                                                    <input type="hidden" id="id_lignedocachat" value="{{lignedoc.id}}">
                                                    <input type="hidden" id="nordre" value="{{lignedoc.norgdre}}">
                                                    <input type="text" class="form-control align_center" style=""
                                                           id="designation_p_{{lignedoc.norgdre}}" 
                                                           value="{{lignedoc.designation}}" 
                                                           ordre="{{lignedoc.typepiece}}" 
                                                           provisoire="p_" onchange="miseAjour(this)">
                                                </td>
                                                <td style="text-align: right"> {{lignedoc.valeur_pourcetage}}%</td>
                                               
<!--                                                <td style="text-align: center;" >
                                                    
                                                    <a class="btn btn-xs btn-danger" ng-click="DeleteLigneLigneContratAvenant(lignedoc.norgdre)" >
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                  
                                                </td>-->
                                                 <td ></td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </fieldset>
                                <fieldset>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr style="background-color: #F2F2F2;"> 
                                            <!--<td colspan="8"></td>-->
                                            <td style="text-align: center; font-size: 16px; vertical-align: middle;" colspan="2">Total TTC </td>
                                            <td class="disabledbutton">
                                                <input type="hidden" id="montantcontrat" class="align_center" style="max-width: 100px;" placeholder="M.T.TTC">
                                                <?php echo $form['montantcontrat']->renderError() ?>
                                                <?php echo $form['montantcontrat'] ?>
                                            </td>
                                             <td style="text-align: center; font-size: 16px; vertical-align: middle;" colspan="2">Montant contrat</td>
                                            <td class="disabledbutton">
                                                <input type="text" id="montant_contrat"
                                                       class="align_center" style="max-width: 100px;" value="<?php echo $contrat->getMontantcontrat(); ?>">

                                            </td>
                                             <td style="text-align: center; font-size: 16px; vertical-align: middle;" colspan="2">Montant Avenat</td>
                                            <td class="disabledbutton">
                                                <input type="text" id="montantavenant"
                                                       class="align_center" style="max-width: 100px;" value="<?php echo $contrat->getMontantavenant(); ?>">

                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset style="margin-left: 50%">
                            <legend>Action Fiche Contrat</legend>
                            <div>
                                <a id="btn_retour" type="button" style="width: 17%;"  
                                   class="btn btn-white btn-default pull-left" href="<?php echo url_for('@contratachat') ?>">
                                    Retour à la liste</a>

                                <input id="btnvalider" style="margin-left: 2px" ng-click="ValiderContratAchatAvenat('<?php echo $contrat->getId(); ?>','<?php echo $doc_achat->getId(); ?>')"
                                     class="btn btn-white btn-success "  type="button" value="Enregistrer Contrat ... " class="btn  btn-success" />
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .align_right{text-align: right;}

</style>
<script>
    var index_ligne = 0;
    function selecttva() {
        if ($('#id_unite').val() != '0') {
            $('#idunitemarche').val($('#id_unite').val());
            $('#unitedemander').val($('#id_unite option:selected').text());
        } else {
            $('#idunitemarche').val('');
            $('#unitedemander').val('');
        }
    }

    function selectProject() {
        if ($('#id_projet').val() != '0') {
            $('#idprojet').val($('#id_projet').val());
            $('#projetsid').val($('#id_projet option:selected').text());
        } else {
            $('#idprojet').val('');
            $('#projetsid').val('');
        }
    }

    function formatLigne(index) {
        console.log('index=' + index);
        $('#liste_ligne tbody tr').each(function () {
            $(this).css('background', '');
            $(this).css('border-bottom', '');
            $(this).css('border-top', '');
        });

        $('#ligne_' + index).css('background', '#E7E7E7');
        $('#ligne_' + index).css('border-bottom', '1px solid #000000');
        $('#ligne_' + index).css('border-top', '1px solid #000000');
        index_ligne = $('#ligne_' + index).attr('index_ligne');



    }
    function AjouterLigne() {

        var count_ligne = -1;
        var id_ligne_achat = $('#id_lignedocachat').val();
        var nordre = $('#nordre').val();

        $('#liste_ligne tbody tr').each(function () {
            count_ligne++;
        });
        index_ligne = count_ligne;
        $.ajax({
            url: '<?php echo url_for('contratachat/addLigne') ?>',
            async: true,
            data: 'id_ligne_achat=' + $('#id_lignedocachat').val() + 'id_ligne'
                    + id_ligne_achat + 'nordre' + nordre,
            success: function (data) {
                console.log(data + 'data=');
//                index_ligne = 1;
//                if (count_ligne > 0) {
//                $('#liste_ligne > tbody > tr').eq(index_ligne).after(data);
//                index_ligne++;
//                }
//                else {
                $('#liste_ligne tbody').append(data);
                index_ligne = 0;
//                }

//                var nordre = 1;
//            var comArr = eval($scope.lignedocsbcicontrat);
//            var max = 0;
//            if (comArr.length > 0)
//                max = comArr[0].norgdre;
////            console.log(max + 'max=' + comArr.length);
////            console.log(max + 'max=');
//            for (var i = 0; i < comArr.length - 1; i++) {
//                for (var j = i + 1; j < comArr.length; j++) {
//                    alert(parseFloat(comArr[j].nordre) + '>' + max);
//                    if (parseFloat(comArr[j].nordre) > max)
//                        max = comArr[j].nordre;
//                }
//            }
//            if (max === 0)
//                max = 1;
//            else
//                max = parseFloat(max) + 0.1;
//            $scope.maxumum = max;
//            $('#norodre').val(max.toFixed(2));
            }
        });

    }
    function ligneNumber() {
        //id_ligne, nordre
        var i = 1;
        $('#liste_ligne tbody tr').each(function () {
            var id = 'ligne_' + i;
            $(this).attr('id', id);
            $(this).attr('index_ligne', i);
            var format = 'formatLigne("' + i + '")';
            $(this).attr('onclick', format);
            i++;
        });
        var i = 1;
        $('[name="col_number"]').each(function () {
            $(this).text(i);
            i++;
        });

        var i = 1;
        $('[name="designation"]').each(function () {
            var id = 'designation_' + i;
            $(this).attr('id', id);
//            var format = 'formatLigne("' + i + '")';
//            $(this).attr('onclick', format);
//            format = 'moveToNext(event, "ligne_compte", ' + i + ')';
//            $(this).attr('onkeydown', format);
            i++;
        });
        var i = 1;
        $('[name="id_typepiece"]').each(function () {
            var id = 'id_typepiece_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="typepiece"]').each(function () {
            var id = 'typepiece_' + i;
            $(this).attr('id', id);
            i++;
        });
        var i = 1;
        $('[name="valeur_pourcetage"]').each(function () {
            var id = 'valeur_pourcetage' + i;
            $(this).attr('id', id);
            i++;
        });


    }

</script>
