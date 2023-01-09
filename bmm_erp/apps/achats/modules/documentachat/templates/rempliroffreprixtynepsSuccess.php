<div id="sf_admin_container">
    <h1>Fiche D.I. N°:<?php foreach ($liste_document_achats as $document_achat): ?> - <?php echo $document_achat->getNumerodocachat()
?><?php endforeach;?>
        <?php
$docofreprix = DocumentachatTable::getInstance()->findByIdDocparentAndIdTypedoc($document_achat->getId(), 25);
$docparentbcebdc = DocumentachatTable::getInstance()->getByOffresdeprix($document_achat->getId(),25);

?>
    </h1>
    <input type="hidden" id="iddoc" value="<?php echo $documentachat->getId(); ?>">
    <input type="hidden" id="idbdcp" value="<?php echo $idbdcp; ?>">
    <?php
$societe = Doctrine_Core::getTable('societe')->findOneById(1);
$documentachatBCE = DocumentachatTable::getInstance()->find($ids);
$documentachatBCEP = DocumentachatTable::getInstance()->findOneByIdDocparentAndIdTypedoc($ids, 18);
$documentachatBCE_Sys = DocumentachatTable::getInstance()->findOneByIdDocparent($ids);
?>
    <div id="sf_admin_content">
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <li><a href="#home_<?php echo $document_achat->getId(); ?>" data-toggle="tab" aria-expanded="true">
                    Détail <?php echo $document_achat->getNumerodocachat(); ?></a></li>
                <?php endforeach;?>
                <li class="<?php if ($tab != "3" && $tab != "4") {echo 'active';}?>"><a href="#profilep" data-toggle="tab"  aria-expanded="false">Remplir Offre de Prix Tyneps</a></li>
               
            <?php //die($offre_prix_tyneps->getId().'r'); 
            if($offre_prix_tyneps){?>
            <input type="hidden" value="<?php echo $offre_prix_tyneps->getId();?>" id="id_offreprix">
                <li class="tab-pane <?php if ($tab == "4") echo 'fade active in' ?>">
                <a href="#listesdemandeprix" data-toggle="tab" aria-expanded="false"> Export Offres de Prix Tyneps</a></li>
                <?php }?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ($liste_document_achats as $document_achat): ?>
                    <div class="tab-pane" id="home_<?php echo $document_achat->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Demande Interne N°:<?php echo $document_achat->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/Imprimerdocachat?iddoc=' . $document_achat->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
                <?php endforeach;?>

                <div class="tab-pane <?php if ($tab != "3" && $tab != "4") { echo 'fade active in';}?>" id="profilep" ng-controller="CtrlDemandeprix"  ng-init="AfficheLignedocBCIVersoffreprixTyneps('<?php echo $ids ?>', 'p')">
                    <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Formulaire de Offre de Prix Tyneps
                        </p>
                    </h4>
                    <div style="padding: 1%; width: 100%; font-size: 16px; float: left;">
                        <table style="list-style: none" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td colspan="2">Offre Prix S. N°: <?php echo $numerobcep ?></td>
                                        </tr>

                                        <td colspan="2">
                                            <table style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <td>Demande Interne N° :</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($liste_document_achats as $document_achat): ?>
                                                        <tr>
                                                            <td><?php echo $document_achat->getNumerodocachat() ?></td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <tr rowspan="2">
                                            <td>Date de création</td>
                                            <td><input type="text" value="<?php echo date('d/m/Y') ?>" readonly="true" id="datecreation"></td>
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
                                    <th style="text-align:center">DESIGNATION<br> </th>
                                    <th>Déscription</th>
                                    <th>Cautionnement</th>
                                    <th>Devise</th>
                                    <th>Estimation</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="disabledbutton"> <input type="text" id="nordre"></td>
                                    <td>
                                        <input type="text" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" placeholder="CODE" readonly="true">
                                        <input type="text" value="" ng-model="designation.text" id="designation" class="form-control" placeholder="DESIGNATION" ng-change="RechercheArticleByCodeAndDesignationContrat()" ng-keydown="goToListContrat($event)">
                                        <?php include_partial('symbole', array())?>
                                    </td>
                                    <td >
                                    <textarea id="observation" class="form-control"></textarea>
                                    </td>

                                    <td><input type="text" class="form-control" style="" id="caussionnement" ></td>
                                    <td><input type="text" class="form-control" style="" id="devise" ></td>                            
                                    <td><input type="text" class="form-control" style="" id="estimation" ></td>
                                    <td style="text-align: center;">
                                        <a class="btn  btn-xs  btn-primary" ng-click="AddDetailOffreTyneps()" title="Add Ligne">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <button type="button" class="btn   btn-xs  btn-danger" ng-click="ViderChampsoffresTyneps()" title="Vider les Chmaps"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                                <tr ng-repeat="lignedoc in lignedocsoffretyneps">
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.norgdre}}</p>
                                    </td>
                                    <td>
                                        <p style="border-bottom: #000 dashed 1px !important">{{lignedoc.designation}}</p>
                                    </td>
                                    <td style="text-align: left">                               
                                    <textarea>  {{lignedoc.observation}}</textarea></td>
                                    <td>{{lignedoc.caussionnement}}</td>
                                    <td>{{lignedoc.devise}}</td>
                                    <td>{{lignedoc.estimation}}</td>


                            <td style="text-align: center;">
                                <a class="btn btn-xs btn-primary" ng-click="UpdateDetailOffreprixTyneps(lignedoc.norgdre)">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" ng-click="DeleteLigneoffreTyneps(lignedoc.norgdre)">
                                    <i class="fa fa-remove"></i>
                                </a>
                                <?php ?>

                            </td>
                           
                            </tr>
                            </tbody>
                        </table>
                        <input type="button" value="Enregistrer" ng-model="btnvalider" ng-disabled="disableBtn" class="btn btn-primary" ng-click="ValiderOffreprixTyneps('<?php echo $ids; ?>')">
                    </div>
                </div>

                <div class="tab-pane <?php if ($tab == "4" && $offre_prix_tyneps) echo 'fade active in' ?>" style="height: 1200px" id="listesdemandeprix" >                 
             <button style="float: right; padding: 5px 12px;margin-left: 4px"
                    target="_blanc"
                    onclick="setExportExcelmodaltyneps()"
                    class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-file-excel-o"></i>   Exporter Excel Par Article
            </button>  
                <h4>
                        <p>
                            <strong><?php echo strtoupper($societe); ?></strong>
                            <br>Exporter Offres de Prix Tyneps
                        </p>
                </h4>
                    <?php if($offre_prix_tyneps){?>
                    <div class="tab-pane" id="home_<?php echo $offre_prix_tyneps->getId(); ?>">
                        <h3 style="width: 50%; float: left;">Model Tyneps N°:<?php echo $offre_prix_tyneps->getNumerodocachat() ?></h3>
                        <div style="margin-top: 10px;">
                            <object style="width: 100%;height: 900px;" data="<?php echo url_for('documentachat/ImprimerdocachatTyneps?iddoc=' . $offre_prix_tyneps->getId()) ?>" type="application/pdf">
                                <embed src="<?php echo url_for('documentachat/ImprimerdocachatTyneps?iddoc=' . $offre_prix_tyneps->getId()) ?>" type="application/pdf" />
                            </object>
                        </div>
                    </div>
<?php }?>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">



    function miseAjour(element_input) {
        var norgdre = $('#' + element_input.id).attr('ordre');
        var p = $('#' + element_input.id).attr('provisoire');
        angular.element($('#' + element_input.id)).scope().MisAjourLigneDocBonCommandeExterne(norgdre, p);
    }
    function setExportExcelmodaltyneps() {
        var url = '';
        if ($('#iddoc').val() != '') {
            if (url == '')
                url = '?iddoc=' + $('#iddoc').val();
            else
                url = url + '&iddoc=' + $('#iddoc').val();
        }

        url = '<?php echo url_for('documentachat/exporterexceloffrepri') ?>' + url;

        window.open(url, '_blank');
        win.focus();
    }
    function setExportExcelmodaltyneps() {
        var url = '';
        if ($('#id_offreprix').val() != '') {
            if (url == '')
                url = '?iddoc=' + $('#id_offreprix').val();
            else
                url = url + '&iddoc=' + $('#id_offreprix').val();
        }        
      url = '<?php echo url_for('documentachat/exporterexceloffreprityneps') ?>' + url;
        window.open(url, '_blank');
       // win.focus();
    }
</script>