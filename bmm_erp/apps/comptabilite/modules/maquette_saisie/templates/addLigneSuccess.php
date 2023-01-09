
<tr id="ligne_0" onclick="formatLigne(0)" index_ligne="0">
    <td name="col_number" style="text-align:center">0</td>
    <td>
        <div class="mws-form-row" style="text-align: center; margin-bottom: 5px;">
<!--            <span style="margin-top: 5px; margin-left: 2%; float: left; font-weight: bold;">
                <input type="checkbox" name="ck_compte" id="ck_compte_0"/> Obligatoire
            </span>-->
            <span style="margin-top: 5px; margin-right: 2%; float: left; font-weight: bold;">
                <input type="checkbox" name="ck_compte_retenue" id="ck_compte_retenue_0" onchange="showSpecificationCompte(0)"/> Compte Comptable Contre Partie
            </span>
            <span style="margin-top: 5px; margin-right: 2%; float: right; font-weight: bold;">
                <input type="checkbox" name="ck_compte_tiers" id="ck_compte_tiers_0" onchange="showSpecificationCompte(0)"/> Compte Comptable du Tiers
            </span>
             <div class="mws-form-row" name="div_specification_compte_retenue" id="div_specification_compte_retenue_0" style="display: none">
                <select name="specification_compte_retenue" onchange="showCompte(0)" id="specification_compte_retenue_0" class="mws-select2 large" style="width: 50%;">
                    <!--<option value="-1"></option>-->
                     <option value="sans" selected="true">Sans Spécification</option>
                    <option value="fixe">Fixe</option>
                    <option value="modifiable">Modifiable</option>
                   
                </select>
            </div>
            
            <div class="mws-form-row" name="div_specification_compte" id="div_specification_compte_0" style="">
                <select name="specification_compte" onchange="showCompte(0)" id="specification_compte_0" class="mws-select2 large" style="width: 50%;">
                    <option value="-1"></option>
                    <option value="fixe">Fixe</option>
                    <option value="modifiable">Modifiable</option>
                    <option value="sans">Sans Spécification</option>
                </select>
            </div>
        </div>
        <div class="mws-form-row" name="div_ligne_compte" id="div_ligne_compte_0" style="text-align: center; display: none;">
            <select name="ligne_compte" id="ligne_compte_0" class="mws-select2 large" style="width: 96%;">
                <option value="-1"></option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </td>
    <td style="width: 15%;">
        <div class="mws-form-row" style="text-align: center;">
            <label style="font-weight: bold;">
                Type
            </label>
            <select  name="type_montant" id="type_montant_0" class="mws-select2 large" style="width: 50%; margin-bottom: 5px" onchange="calculeTotal()">
                <option value="-1"></option>
                <option value="credit" <?php if(isset($typeop) && isset($total) && $total==0 && $typeop=='debit' ): ?> selected <?php elseif(isset($total) && $total>0 ): ?> selected   <?php endif;?>>Crédit</option>
                <option value="debit" <?php if(isset($typeop) && $typeop=='credit' && isset($total) && $total==0): ?> selected <?php elseif(isset($total) && $total<0 ): ?> selected   <?php endif;?>>Débit</option>
            </select>
        </div>
    </td>
    <td style="width: 16%;">
        <div class="mws-form-row" style="text-align: center;">
            <label style="font-weight: bold;">
                <input type="checkbox" name="ck_montant" id="ck_montant_0"/> Obligatoire
            </label>
            <select onchange="showMontant(0)" name="specification_montant" id="specification_montant_0" class="mws-select2 large" style="width: 50%;">
                <option value="-1"></option>
                <option value="saisimanuel" <?php if(isset($typespec) && $typespec=='saisimanuel'): ?> selected <?php endif?>>Saisi Manuelle</option>
                <option value="fixe" <?php if(isset($typespec) && $typespec=='fixe'): ?> selected <?php endif?>>Fixe</option>
                <option value="copie" <?php if(isset($typespec) && $typespec=='copie'): ?> selected <?php endif?>>Copie du Montant</option>
                <option value="taux" <?php if(isset($typespec) && $typespec=='taux'): ?> selected <?php endif?>>Montant * Taux</option>
            </select>
        </div>
        <div name="div_montant_saisi" id="div_montant_saisi_0" class="mws-form-row"  <?php if(isset($montant_ligne_saisi)): ?> style="text-align: center;" <?php else: ?> style="text-align: center;display: none;"  <?php endif ?>>
<!--            <label>Montant Saisi :</label>
            <input class="large" value="<?php // if(isset($montant_ligne_saisi)): echo $montant_ligne_saisi; endif; ?>" type="text" id="montant_ligne_saisi_0" name="montant_ligne_saisi" style="width: 50%;" onchange="calculeTotal()">-->
        </div>
        <div name="div_montant" id="div_montant_0" class="mws-form-row" <?php if(isset($montant_ligne)): ?> style="text-align: center;" <?php else: ?> style="text-align: center;display: none;"  <?php endif ?>>
            <label>Montant :</label>
            <input class="large" value="<?php if(isset($montant_ligne)): echo abs($total); endif; ?>" type="text" id="montant_ligne_0" name="montant_ligne" style="width: 50%;" onchange="calculeTotal()">
        </div>
        <div name="div_numero" id="div_numero_0" class="mws-form-row" <?php if(isset($numero_ligne)): ?> style="text-align: center;" <?php else: ?> style="text-align: center;display: none;"  <?php endif ?>>
            <label>Numéro Colonne :</label>
            <input class="large"  value="<?php if(isset($numero_ligne)): echo $numero_ligne; endif; ?>" type="text" id="numero_ligne_0" name="numero_ligne" style="width: 50%;">
        </div>
        <div name="div_taux" id="div_taux_0" class="mws-form-row" <?php if(isset($taux)): ?> style="text-align: center;" <?php else: ?> style="text-align: center;display: none;"  <?php endif ?>>
            <label>Taux :</label>
            <input class="large" value="<?php if(isset($taux)): echo $taux; endif; ?>" type="text" id="taux_0" name="taux" style="width: 50%;">
        </div>


    </td>
    <td>
        <div class="mws-form-row" style="text-align: center; margin-bottom: 5px;">
            <span style="margin-top: 5px; margin-left: 2%; float: left; font-weight: bold;">
                <input type="checkbox" name="ck_contre" id="ck_contre_0"/> Obligatoire
            </span>
            <select onchange="showContre(0)" name="specification_contre" id="specification_contre_0" class="mws-select2 large" style="width: 50%;">
                <!--<option value="-1"></option>-->

                <option value="fixe">Fixe</option>
                <option value="modifiable">Modifiable</option>
                <option value="sans" selected="true">Sans Spécification</option>
            </select>
        </div>
        <div class="mws-form-row" name="div_ligne_contre" id="div_ligne_contre_0" style="text-align: center;display: none; ">
            <select name="ligne_contre" id="ligne_contre_0" class="mws-select2 large" style="width: 96%;">
                <option value="-1"></option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?php echo $compte->getId(); ?>"><?php echo $compte->getNumeroCompte() . ' - ' . $compte->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>


    </td>

</tr>


<script  type="text/javascript">

    $('#ligne_0 select').attr('class', "chosen-select form-control");
    $('#ligne_0 select').attr('style', 'width: 100%;');
    $('#ligne_0 input:text').attr('style', 'width: 100%;');

    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
        //resize the chosen on window resize

        $(window)
                .off('resize.chosen')
                .on('resize.chosen', function () {
                    $('.chosen-select').each(function () {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed')
                return;
            $('.chosen-select').each(function () {
                var $this = $(this);
                $this.next().css({'width': $this.parent().width()});
            })
        });


        $('#chosen-multiple-style .btn').on('click', function (e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2)
                $('#form-field-select-4').addClass('tag-input-style');
            else
                $('#form-field-select-4').removeClass('tag-input-style');
        });
    }

    $('.chosen-container').attr("style", "width: 100%;");
    $('.chosen-container').trigger("chosen:updated");

</script>