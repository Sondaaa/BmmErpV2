<div id="sf_admin_container">
    <h1 id="replacediv"> Base Comptable 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Modifier Compte Comptable
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title smaller">Modifier compte comptable</h4>
            </div>

            <div class="widget-body" ng-controller="myCtrlCompteComptable">
                <div class="widget-main">
                    <table style="width: 100%;">
                        <tr id="ligne_dossier_classe">
                        <input type="hidden" id="id_class">

                        <td >
                            <fieldset>
                                <label style="width: 100%;">Dossier comptable : </label>
                            </fieldset>
                        </td>
                        <td >
                            <fieldset>
                                <label style="width: 100%;"> Numéro comptable * :</label>
                            </fieldset>
                        </td>
                        <td >
                            <fieldset>
                                <label style="width: 100%;">Intitulé * :</label>
                            </fieldset>
                        </td>
                        </tr>
                        <tr id="ligne_dossier_classe_champs">
                            <td>
                                <input value="<?php echo trim($dossier->getCode()) . ' - ' . trim($dossier->getRaisonsociale()); ?>" type="text" disabled="true">
                            </td>
                            <td >
                                <input type="hidden" id="id_compte_select">
                                <input class="form-control" id="code" 
                                       placeholder="numéro compte comptable" 
                                       value="<?php echo $compte->getNumeroCompte(); ?>" type="text"  onfocus="this.select();"                                     
                                       maxlength="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>"/>
                                <input value="<?php echo $compte->getId() ?>" id="compte_edit_id" type="hidden" >
                            </td>
                            <td >
                                <div class="mws-form-item" style="margin-left: 0%">

                                    <input  value="<?php echo $compte->getLibelle() ?>" id="libelle_edit" type="text">
                                </div>
                            </td>
                        </tr>
                        <tr>

<!--                            <td >
                                <fieldset>
                                    <label style="width: 100%;">Type * :</label>
                                </fieldset>
                            </td>-->
                            <td style="display: none">
                                <fieldset>
                                    <label style="width: 100%;">Compte Collectif * :</label>
                                </fieldset>
                            </td>
                            <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">Lettrage :</label>
                                </fieldset>
                            </td>
                            </td>
                            <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">En sommeil :</label>
                                </fieldset>
                            </td>
                             <td style="width: 20%;">
                                <fieldset>
                                    <label style="width: 100%;">Sens par défaut :</label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%; display: none">
                                <div class="mws-form-row">
                                    <input class="large" id="numero_compte" placeholder="numéro compte comptable"
                                           type="text" obligatoire=true 
                                           maxlength="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>" ><!--onfocus="setLibelle()"-->
                                    <input id="chiffre_numero_compte" value="<?php echo $dossier->getNombrechiffrenumerocompte(); ?>" type="hidden">
                                </div>
                            </td>
                            <td style="display: none">
                                <input type="hidden" id="id_compte_select">
                                <input ng-model="compte_select_for_plan.text" id="compte_select" placeholder="numéro compte comptable" value="" type="text" style="width: 100%;" onfocus="this.select();" ng-change="Choisircomptecomptable('#compte_select', '#id_compte_select')"/>
                            </td>


                            <td  id="compte_standard"  style="display: none">
                                <?php
                                $comptes = PlancomptableTable::getInstance()->getAllStandard();
//                                die($comptes->getIdPlan() . 'fs');
                                ?>
                                <div class="mws-form-row">
                                    <select id="compte_standard">
                                        <option value=""></option>
                                        <?php foreach ($comptes as $cc):; ?>
                                            <option value="<?php echo $cc->getId(); ?>" 
                                            <?php if ($cc->getId() === $compte->getIdPlan()): ?>
                                                        selected="true"
                                                    <?php endif; ?>>
                                                <?php echo $cc->getNumerocompte() . ' - ' . $cc->getLibelle(); ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </td>
                            <td>
                                <select id="lettrage">
                                    <option value=""></option>
                                    <?php if ($compte->getLettrage() == '0'): ?>
                                        <option value="2" >Sans specification </option>
                                        <option value="0" selected="true" >Non Lettrable</option>
                                        <option value="1">Lettrable</option>
                                    <?php elseif ($compte->getLettrage() == '1'): ?>
                                        <option value="2" >Sans specification </option>
                                        <option value="0" >Non Lettrable</option>
                                        <option value="1"  selected="true">Lettrable</option>
                                    <?php elseif ($compte->getLettrage() == '2'): ?>
                                        <option value="2"  selected="true" >Sans specification </option>
                                        <option value="0" >Non Lettrable</option>
                                        <option value="1" >Lettrable</option>
                                    <?php endif; ?>
                                </select>

                            <td>
                                <select id="ensommeil">
                                    <?php if ($compte->getEnsommeil() == '0'): ?>
                                        <option value="" ></option>
                                        <option value="1" >Oui</option>
                                        <option value="0" selected="true">Non</option>
                                    <?php elseif ($compte->getEnsommeil() == '1'): ?>
                                        <option value="" ></option>
                                        <option value="1" selected="true" >Oui</option>
                                        <option value="0">Non</option>
                                    <?php else: ?>
                                        <option value=""  selected="true"></option>
                                        <option value="1" >Oui</option>
                                        <option value="0">Non</option>
                                    <?php endif; ?>
                                </select>
                                 <td>
                                <select id="senspardefaut">
                                   
                                    <?php if ($compte->getSenspardefaut() == '0'): ?>
                                        <option value="2" >Sans specification </option>
                                        <option value="0" selected="true">Crédit</option>
                                        <option value="1">Débit</option>
                                    <?php elseif ($compte->getSenspardefaut() == '1'): ?>
                                        <option value="2" >Sans specification </option>
                                        <option value="0" >Crédit</option>
                                        <option value="1" selected="true">Débit</option>
                                    <?php elseif ($compte->getSenspardefaut() == '2'): ?>
                                        <option value="2" selected="true">Sans specification </option>
                                        <option value="0" >Crédit</option>
                                        <option value="1">Débit</option>
                                        <?php else:?>
                                         <option value="" selected="true"></option>
                                         <option value="2" >Sans specification </option>
                                        <option value="0" >Crédit</option>
                                        <option value="1">Débit</option>
                                    <?php endif; ?>
                                </select>
                            </td>
                            </td>
                        </tr>
                        <tr>




                           
                            <td colspan="3"> 
                                <fieldset>
                                    <label style="width: 100%">Devise :</label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr>
                   

                            <td colspan="3">
                                <select id="devise">
                                    <option value=""></option>
                                    <?php foreach ($devises as $devise): ?>
                                        <option value="<?php echo $devise->getId(); ?>"
                                        <?php if ($devise->getId() == $compte->getIdDevise()): ?>
                                                    selected="true"
                                                <?php endif; ?>>
                                            <?php echo $devise->getLibelle(); ?> (<?php echo $devise->getSigle(); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                    </table>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" class="btn btn-sm btn-success pull-right" onclick="EditCompte('<?php echo  $id ?>')">
                                <i class="ace-icon fa fa-save bigger-110"></i> 
                                Valider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>

    #table_numerotatoin thead th{text-align: center;}
    #liste_generer tr td{vertical-align: middle; border: 1px solid #ddd;}
    .bootbox-close-button{display: none;}

</style>

<script  type="text/javascript">
    document.title = ('BMM - G. Compta. : Modifier journal comptable');
</script>
<script>
    function EditCompte(id) {
        if ($('#libelle_edit').val() != '') {
            $.ajax({
                url: '<?php echo url_for('plan_comptable/saveEdit') ?>',
                data: 'id=' + id +'&code='+ $('#code').val()+
                        '&libelle=' + $('#libelle_edit').val() + '&code=' + $('#code').val() +
                        '&ensommeil=' + $('#ensommeil').val() +
                        '&senspardefaut=' + $('#senspardefaut').val() +
                        '&comptestandar=' + $('#compte_standard').val() +
                        '&lettrage=' + $('#lettrage').val() +
                        '&standard=' + $('#standard').val() +
                        '&devise=' + $('#devise').val() +
                        '&dossier=' + "<?php echo $dossier->getId(); ?>",
                success: function (data) {
                    bootbox.dialog({
                        message: "Modification avec succée !!!!!!!",
                        buttons:
                                {
                                    "button":
                                            {
                                                "label": "Ok",
                                                "className": "btn-sm"
                                            }
                                }
                    });
                }
            });
        } else {
            return;
        }
    }

</script>