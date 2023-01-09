<?php
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
?>

<?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$aviss = Doctrine_Core::getTable('avis')
                ->createQuery('a')->where('id_poste=5')
                ->orderBy('id asc')->execute(); //Liste des avis par unité budget
?>
<div style="position: absolute;float: right;margin-left: 80%;" class="disabledbutton">
    <table>
        <thead>
            <tr>
                <th colspan="2" style="font-size: 16px;">Avis de l'unité budget</th>
            </tr>
        </thead>
        <?php foreach ($aviss as $avis) { ?>
            <tr>
                <td>
                    <?php
                    if (strpos($avis->getLibelle(), ":") == 0)
                        echo $avis->getLibelle();
                    else
                        echo "<p style='color: red; margin-bottom:0px;'>" . $avis->getLibelle() . "</p>";
                    ?>
                </td>
                <td>
                    <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                        <?php
                        if ($documentachat->getId())
                            $lgdoc = LigavisdocTable::getInstance()->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                        else
                            $lgdoc = NULL;
                        ?>
                        <input type="checkbox" <?php if ($lgdoc): ?> checked="true"<?php endif; ?>>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div style="width: 80%;font-size: 16px" ng-init="Initisaliercontrat()">
    <table style="list-style: none; margin-bottom: 10px;">
        <tr style="background-color: #F0F0F0;">
            <td style="width: 200px; vertical-align: middle; text-align: center;">
                <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                    <strong><?php echo strtoupper($societe); ?></strong>
                </p>  
            </td>
            <td>
                <?php
                $liste_contra_definitif = ContratachatTable::getInstance()->findBytypePartielEtdefifitif();
                $numero = strtoupper($documentachat->getTypedoc());
                $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                ?>
                <table style="margin-bottom: 0px;">
                    <tr>
                        <td colspan="5"><?php echo $numero; ?></td>
                    </tr>
                    <tr>
                        <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                        <td colspan="3">Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                    </tr>
                    <tr>
                        <td>Nature : </td> 
                        <td style="width: 40%" >
                            <?php echo $form['id_objet']->renderError() ?>
                            <?php echo $form['id_objet'] ?>
                        </td>
                        <td>Contrat : </td>

                        <td id="list_contrat" style="width: 20%">
                            <?php // echo $form['id_contrat']->renderError()  ?>
                            <?php // echo $form['id_contrat'] ?>
                            <select id="documentachat_id_contrat" ng-model="documentachat_id_contrat" ><!-- onchange="AffichageLigneContrat()"-->
                                <option value=""></option>
                                <?php foreach ($liste_contra_definitif as $contrat): ?>
                                    <option value="<?php echo $contrat->getId() ?>"><?php echo $contrat->getReference() . '  ' . $contrat->getNumero(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>


                    </tr>
                    <tr>
                        <td>Montant Estimatif (TND): </td>
                        <td colspan="3">
                            <?php echo $form['montantestimatif']->renderError() ?>
                            <?php echo $form['montantestimatif'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> 
</div>

<fieldset style="width: 80%">
    <legend>Données de base</legend>
    <table>
        <tbody>
            <tr>
                <td style="width: 10%; vertical-align: middle;">Référence</td>
                <td style="width: 10%">
                    <?php echo $form['reference']->renderError() ?>
                    <?php echo $form['reference']->render(array('class' => 'form-control')) ?>
                </td>
                <td style="width: 20%; vertical-align: middle;">Nom et Prénom du demandeur</td>
                <td style="width: 40%">
                    <?php echo $form['id_demandeur']->renderError() ?>
                    <?php echo $form['id_demandeur'] ?>
                </td>

            </tr>
        </tbody>
    </table>
</fieldset>
<?php
$liste_unite = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('unitemarche')
                ->orderBy('libelle')->execute();

$liste_projet = Doctrine_Query::create()
                ->select("id,libelle")
                ->from('projet')
                ->orderBy('libelle')->execute();
?>
<div id="general" class="row" ng-init="AfficheLignedocumentBCI('<?php echo $documentachat->getId(); ?>')">
    <div >
        <fieldset>
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Code & Désignation</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th>Projet</th>
                        <th>Observation</th>               
                        <th>Action</th>
                    </tr>             
                </thead>
                <tbody>
                    <tr id="formligne">
                        <td style="width: 6%"><input type="text" value="" ng-model="nordre.text" id="nordreid" class="form-control align_center disabledbutton"></td>
                        <td style="width: 32%;">
                            <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">                   
                            <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignation()" ng-keydown="goToList($event)">
                            <?php include_partial('symbole', array()) ?>
                        </td>
                        <td style="width: 6%"><input type="text" value="" ng-model="quantite.text" id="quantite" class="align_center"></td>
                        <td style="width: 12%">
                            <input type="hidden" id="idunitemarche">
                            <input type="hidden" value="" ng-model="unitedemander.text" id="unitedemander" class="form-control" autocomplete="off" ng-change="UniteMarche()" ng-click="UniteMarche()" ng-keyup="UniteMarche()">
                            <select id="id_unite" onchange="selectUnite()">
                                <option id="0"></option>
                                <?php foreach ($liste_unite as $unite): ?>
                                    <option value="<?php echo $unite->getId() ?>"><?php echo $unite->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 18%">
                            <input type="hidden" id="idprojet">
                            <input type="hidden" value="" ng-model="projetss.text" id="projetsid" autocomplete="off" ng-change="ProjetParMotif()" ng-click="ProjetParMotif()" ng-keyup="ProjetParMotif()" ng-keydown="goToList($event)">
                            <select id="id_projet" onchange="selectProject()">
                                <option id="0"></option>
                                <?php foreach ($liste_projet as $projet): ?>
                                    <option value="<?php echo $projet->getId() ?>"><?php echo $projet->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="width: 17%">
                            <textarea ng-model="observation.text" id="observation" class="form-control"></textarea>
                        </td>
                        <td style="width: 9%; text-align: center;">
                            <button type="button" class="btn btn-primary" ng-click="AjouterLigne()"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-danger" ng-click="ViderChamps()"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>

                    <tr ng-repeat="lignedoc in listedocs">
                        <td style="text-align: center;">{{lignedoc.norgdre}}</td>
                        <td>{{lignedoc.codearticle}} {{lignedoc.designation}}</td>
                        <td style="text-align: center;">{{lignedoc.quantite}}</td>
                        <td>{{lignedoc.unitedemander}}</td>
                        <td>{{lignedoc.projet}}</td>
                        <td>{{lignedoc.observation}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-circle" ng-click="MisAJour(lignedoc)"><i class="fa fa-hospital-o"></i></button>
                            <button type="button" class="btn btn-warning btn-circle" ng-click="Delete(lignedoc)"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

    </div>
    <fieldset style="margin-left: 50%">
        <legend>Action Fiche BCI</legend>
        <div>
            <?php if (!$documentachat->getValide()): ?> 
                <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', false)" type="button" value="Enregistrer B.C.I ... " class="btn btn-white btn-success"  />
                <?php
            endif;
            if (!$documentachat->getValide() ):
                ?> 
                <input id="btnvalider" ng-click="AjouterBCIAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer B.C.I & Envoyer a l'unité budget " class="btn btn-white btn-success" />
            <?php endif; ?>
            <?php if ($documentachat->getIdEtatdoc() == 33):
                ?> 
                <input id="btnvalider" ng-click="ModifierBCIEnvoyerUniteControlegestion('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer B.C.I & Envoyer a l'unité Contrôle gestion " class="btn btn-white btn-success" />
            <?php endif; ?>
        </div>
    </fieldset>
</div>
<div id="contratpartiel" class="row "  style="display: none"  >
    <div class="row " >
        <fieldset  style="width: 78%;margin-left: 25px">
            <table style="width: 100%">
                <td>Fournisseur</td>
                <input type="hidden" id="id_frs" value="" >
                <input type="hidden" id="mnt_totlacontrat" value="" >
                <td><input type="text" id="rs" value="" readonly="true"></td>
                <input type="hidden" id="contrat_mntttc" value="">
            </table>
        </fieldset>
        <fieldset>
            <legend>Liste des Articles du Contrat</legend>
            <table>
                <thead>
                    <tr>
                        <th style="width: 1%">N°Ordre</th>
                        <th style="text-align:center;width: 18%">DESIGNATION</th>
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
                        <td>
                            <input type="text"  id="codearticle_contrat" class="form-control"  readonly="true">                   
                            <input type="text" id="designation_contrat" class="form-control" readonly="true">
                        </td>
                        <td><input type="text" class="form-control" style="" id="qte"></td>
                        <td><input type="text" class="form-control" style="" id="puht" readonly="true"></td>
                        <td><input type="text" class="form-control" style="" id="totalhax"  readonly="true"></td>
                        <td readonly="true">
                            <input type="hidden" id="idtaufodec">
                            <select id="taufodec" readonly="true" class="disabledbutton">
                                <option id="0"></option>
                                <?php foreach ($liste_tauxfodec as $tau): ?>
                                    <option value="<?php echo $tau->getId() ?>"><?php echo $tau->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" style="" id="fodec"   readonly="true"></td>
                        <td><input type="text" class="form-control" style="" id="totalhtva"  readonly="true" ></td>
                        <td readonly="true">                   
                            <input type="hidden" id="idtva">
                            <input type="hidden" value="" ng-model="tvacontrat.text" id="tvacontrat" class="form-control" autocomplete="off" readonly="true">
                            <select id="tva" onchange="selecttva()" readonly="true" class="disabledbutton">
                                <option id="0"></option>
                                <?php foreach ($taux_tva as $tva): ?>
                                    <option value="<?php echo $tva->getId() ?>"><?php echo $tva->getLibelle() ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" style="" id="totalttc" readonly="true" ></td><!--disabled="true"-->
                        <td readonly="true">
                            <input type="hidden" id="idprojet">

                            <select id="projet" class="disabledbutton" >
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
                            <a class="btn  btn-xs  btn-primary" ng-click="AddDetailContratBCI()">
                                <i class="fa fa-plus"></i>
                            </a> 
                            <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsContratBCI()"><i class="fa fa-minus"></i></button>
                        </td>
                    </tr>
                    <tr ng-repeat="lignecontrat in lignedocscontrat">
                        <td><p style="border-bottom: #000 dashed 1px !important">{{lignecontrat.norgdre}}</p></td>

                        <td style="text-align: center;">
                            <input type="hidden" id="id_lignedocachat" value="{{lignecontrat.id}}">
                            <input type="hidden" id="nordre" value="{{lignecontrat.norgdre}}">
                            <input type="text" class="form-control align_center" style=""
                                   id="code_p_{{lignecontrat.norgdre}}" 
                                   value="{{lignecontrat.codearticle}}"  readonly="true">
                            <input type="text" class="form-control align_center" style=""
                                   id="designation" 
                                   value="{{lignecontrat.designation}}" readonly="true" >
                        </td>

                        <td style="text-align: center;"> <input type="text" class="form-control align_center" style=""
                                                                id="qte_p_{{lignecontrat.norgdre}}" 
                                                                value="{{lignecontrat.qte|integer}}" 
                                                                ordre="{{lignecontrat.norgdre}}" 
                                                                provisoire="p_" readonly="true"></td>
                        <td> <input type="text" class="form-control align_center" style=""
                                    id="puht_p_{{lignecontrat.norgdre}}" value="{{lignecontrat.puht}}" ordre="{{lignedoc.norgdre}}"
                                    provisoire="p_" onchange="miseAjour(this)">
                        </td>
                        <td>{{lignecontrat.totalhax}}</td>
                        <td><input type="hidden" id="idtaufodec">{{lignecontrat.taufodec}}
    <!--                                <select id="taufodec"  >
                                <option id="0"></option>
                            <?php // foreach ($liste_tauxfodec as $tau):  ?>
                                    <option value="<?php // echo $tau->getId()                            ?>"><?php // echo $tau->getLibelle()                            ?></option>
                            <?php // endforeach;  ?>
                            </select>-->
                        </td>

                        <td>
                            {{lignecontrat.fodec}}</td>
                        <td>{{lignecontrat.totalhtva}}</td>
                        <td>{{lignecontrat.tva}}
    <!--                                <p style="border-bottom: #000 dashed 1px !important">
                                <select id="tva_p_{{lignedoc.norgdre}}" ordre="{{lignedoc.norgdre}}" provisoire="p_" 
                                      >
                                    <option ng-repeat="tva in tvalistes" value="{{tva.id}}">{{tva.libelle}}</option>
                                </select>
                            </p>-->
                        </td>
                        <td style="display: none;">{{lignecontrat.prixttc}}</td>
                        <td>{{lignecontrat.totalttc}}</td>
                        <td>{{lignecontrat.projet}}</td>
                        <td>{{lignecontrat.observation}}</td>
                        <!--<td><input type="text" class="form-control" style="" id="totalttc" readonly="true" ></td>disabled="true"-->
    <!--                            <td >
                            <input type="hidden" id="idprojet">
    
                            <select id="projet"  >
                                <option id="0"></option>
                        <?php // foreach ($liste_projet as $projet):  ?>
                                    <option value="<?php // echo $projet->getId()                            ?>"><?php // echo $projet->getLibelle()                            ?></option>
                        <?php // endforeach;  ?>
                            </select>
                        </td>-->
    <!--                             <td><p style="border-bottom: #000 dashed 1px !important">{{lignedoc.observation}} </p></td>-->
                        <td style="text-align: center;">
                            <a class="btn btn-xs btn-primary" ng-click="UpdateDetailContratBci(lignecontrat.norgdre, '')" > 
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" ng-click="DeleteLigneContratBCi(lignecontrat.norgdre)" >
                                <i class="fa fa-remove"></i>
                            </a>


                        </td>
                    </tr>  
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <table>
                <tr style="background-color: #F2F2F2;"> 
                    <!--<td colspan="8"></td>-->
                    <td style="text-align: center; font-size: 16px; vertical-align: middle;" colspan="2">Total TTC (Montant contrat)</td>
                    <td class="disabledbutton">
                        <input type="text" id="montantcontratTotal" class="align_center" style="max-width: 100px;" placeholder="M.T.TTC">
                        <?php // echo $form['montantcontrat']->renderError() ?>
                        <?php // echo $form['montantcontrat'] ?>
                    </td>
                    <!--<td style="text-align: center; font-size: 16px; vertical-align: middle;">Montant Plafonné</td>-->
                    <!--<td  colspan="2">-->
                    <?php // echo $form['montantplanfonne']->renderError() ?>
                    <?php // echo $form['montantplanfonne'] ?>
                    <!--</td>-->

                    <td colspan="3"></td>
                </tr>
            </table>
        </fieldset>
    </div>
    <fieldset style="margin-left: 50%">
        <legend>Action Fiche BCI</legend>
        <div>
            <?php if (!$documentachat->getValide()): ?> 
                <input id="btnvalider" ng-click="AjouterBCIContratAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', false)" type="button" value="Enregistrer B.C.I Du Contrat ... " class="btn btn-white btn-success"  />
                <?php
            endif;
            if (!$documentachat->getValide()):
                ?> 
                <input id="btnvalider" ng-click="AjouterBCIContratAchatEtEnvoyerUniteAchat('<?php echo $documentachat->getId(); ?>', true)" type="button" value="Enregistrer B.C.I  Du Contrat & Envoyer a l'unité Facturation " class="btn btn-white btn-success" />
            <?php endif; ?>

        </div>
    </fieldset>
</div>


<script  type="text/javascript">

    function selectUnite() {
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

//    function AffichageLigneContrat() {
//        if ($('#documentachat_id_contrat').val() != '0') {
//            $('#contratpartiel').attr('style', 'width:100%');
//            $('#contratpartiel').attr('style', 'display: block');
//            $('#general').attr('style', 'display: none');
//        } else {
//            $('#general').attr('style', 'display: block');
//            $('#general').attr('style', 'width:100%');
//            $('#contratpartiel').attr('style', 'display: none');
//
//        }
//
//    }
</script>

<style>

    #ul_compte{min-width: 130px;}

</style>