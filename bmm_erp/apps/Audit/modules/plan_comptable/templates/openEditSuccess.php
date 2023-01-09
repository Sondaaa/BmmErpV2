<div class="mws-panel-body no-padding">
    <form>
        <div class="mws-form-inline" >
            <div class="mws-panel-header">
                <span>Modifier un Compte</span>
            </div>
            <div style="margin-left: 1%;">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Date de Création * :</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Numéro du Compte * :</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Intitulé * :</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Classe :</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row" style="width: 100%">
                                    <input value="<?php echo date('d/m/Y', strtotime($compte->getDate())); ?>" id="date_edit" type="text" obligatoire=true  style="width: 85%">
                                    
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <input value="<?php echo $compte->getNumeroCompte(); ?>" class="large" id="numero_compte_edit" obligatoire=true type="text" style="width: 85%">
                                <input value="<?php echo $compte->getNumeroCompte() ?>" id="numero_compte_initial" type="hidden" >
                                <input value="<?php echo $compte->getId() ?>" id="compte_edit_id" type="hidden" >
                            </div>
                            <div id="s_num_compte_edit" style="  display: none; color: #d11010; margin-left: 10%;  ">
                                    <p><b>numéro de compte existe déja  !!</b></p>
                                </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-item" style="margin-left: 0%">
                                <input class="large" value="<?php echo $compte->getLibelle() ?>" id="libelle_edit" type="text" style="width: 85%">
                                <input value="<?php echo $compte->getLibelle() ?>" id="libelle_initial" type="hidden" >
                                <input  id="libelle_edit_confirm" type="hidden"  value="1">
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <select id="classe_compte_edit" class="mws-select2 large" style="width: 85%">
                                    <option value="-1"></option>
                                    <?php foreach ($classes as $classe): ?>
                                        <option <?php if ($compte->getClasseId() == $classe->getId()): ?> selected="selected" <?php endif; ?> value="<?php echo $classe->getId() ?>"><?php echo $classe->getLibelle() ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Nature du Solde * :</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Devise :</label>
                                </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%">Lettrage * :</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label" style="width: 100%"></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <select id="nature_edit" class="mws-select2 large" style="width: 85%" obligatoire=true>
                                    <option value="-1"></option>
                                    <option <?php if ($compte->getTypeSolde() == '0'): ?> selected="selected" <?php endif; ?> value="0">Débiteur</option>
                                    <option <?php if ($compte->getTypeSolde() == '1'): ?> selected="selected" <?php endif; ?> value="1">Créditeur</option>
                                    <option <?php if ($compte->getTypeSolde() == '2'): ?> selected="selected" <?php endif; ?> value="2">Soldé</option>
                                    <option <?php if ($compte->getTypeSolde() == '3'): ?> selected="selected" <?php endif; ?> value="3">Libre</option>
                                </select>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <select id="devise_edit" class="mws-select2 large" style="width: 85%">
                                    <option value="-1"></option>
                                    <?php foreach ($devises as $devise): ?>
                                        <option <?php if ($compte->getDeviseId() == $devise->getId()): ?> selected="selected" <?php endif; ?> value="<?php echo $devise->getId(); ?>"><?php echo $devise->getLibelle(); ?> (<?php echo $devise->getSigle(); ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </td>
                        <td style="width: 25%">
                            <div class="mws-form-row">
                                <select id="lettrage_edit" class="mws-select2 large" style="width: 85%" obligatoire=true>
                                    <option value="-1"></option>
                                    <option <?php if ($compte->getLettrage() == '0'): ?> selected="selected" <?php endif; ?> value="0">Libre</option>
                                    <option <?php if ($compte->getLettrage() == '1'): ?> selected="selected" <?php endif; ?> value="1">Lettrable</option>
                                    <option <?php if ($compte->getLettrage() == '2'): ?> selected="selected" <?php endif; ?> value="2">Rapprochable</option>
                                </select>
                            </div>
                        </td>
                        <td style="width: 25%">
<!--                            <input <?php //if ($compte->getExtrait() == '1'): ?> checked="checked" <?php //endif; ?> id="extrait_edit" type="checkbox">
                            <label>Extrait du Compte</label>-->
                        </td>
                    </tr>
                </table>
            </div>

            <div class="mws-panel-toolbar">
                <div class="btn-toolbar">
                    <div class="btn-group" style="width: 100%;">
                        <a class="btn" style="float: right; margin-right: 3%; cursor:pointer;" onclick="closeEditCompte()"><i class="icol-cross"></i> Annuler</a>
                        <a class="btn" style="float: right; cursor:pointer;" onclick="confirmerLibelleEdit(<?php echo $compte->getId() ?>)"><i class="icol-add"></i> Modifier</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>


<script  type="text/javascript">

    $('#date_edit').datepicker();
    $("#date_edit").mask("99/99/9999");
    $('#classe_compte_edit').select2({placeholder: 'Classe'});
    $('#nature_edit').select2({placeholder: 'Naure'});
    $('#devise_edit').select2({placeholder: 'Devise'});
    $('#lettrage_edit').select2({placeholder: 'Lettrage'});

</script>