<div id="sf_admin_container">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin">SUIVI BON DEPENSE AU COMPTANT Regroupe </h4>
            </div>
            <div class="modal-body">
                <fieldset class="col-lg-12">
                    <legend>Données de bon dépense au comptant Regroupe<input id="base_check" name="base_check" type="checkbox" style="float: right;" onchange="checkAllBase()"></legend>
                    <table style="width: 100%">
                        <tr> 
                            <td rowspan="2"><h4 class="smaller lighter blue no-margin"><i>BON DEPENSE AU COMPTANT</i></h4></td>
                            <td>BCI</td>
                            <td><input id="numero_bci" name="numero_bci" type="checkbox" style="width: 25px"></td>
                            <td>Date création</td>
                            <td><input id="date_creation" name="date_creation" type="checkbox" style="width: 25px"></td>
                            <td>Demandeur</td>
                            <td><input id="demandeur" name="demandeur" type="checkbox" style="width: 25px"></td>
                            <td>Décision</td>
                            <td><input id="decision" name="decision" type="checkbox" style="width: 25px"></td>
                        </tr>
                        
                        <tr> 
                            <td>BDC Provisoire</td>
                            <td><input id="numero_bce" name="numero_bce" type="checkbox" style="width: 25px"></td>
                            <td>N°BDC Définitif</td>
                            <td><input id="numero_bced" name="numero_bced" type="checkbox" style="width: 25px"></td>
                            <td>Montnt BDC</td>
                            <td><input id="montant_bced" name="montant_bced" type="checkbox" style="width: 25px"></td>
                            <td></td>
                            <td></td>
                        </tr> 
                        
                        <tr> <td><h4 class="smaller lighter blue no-margin"><i>FACTURATION</i></h4></td>
                            <td>N°Facture Système</td>
                            <td><input id="fac_sys" name="fac_sys" type="checkbox" style="width: 25px"></td>
                            <td>N°Facture Fournisseur </td>
                            <td><input id="fac_four" name="fac_four" type="checkbox" style="width: 25px"></td>
                            <td>Montant Facture </td>
                            <td><input id="montant_fac" name="montant_fac" type="checkbox" style="width: 25px"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr> <td><h4 class="smaller lighter blue no-margin"><i>BUDGT</i></h4></td>
                            <td>Engagement Budget </td>
                            <td><input id="eng_budget" name="eng_budget" type="checkbox" style="width: 25px"></td>
                            <td>Ordonnancement </td>
                            <td><input id="ordonnacement" name="ordonnacement" type="checkbox" style="width: 25px"></td>
                            <td>Date paiement </td>
                            <td><input id="datepai" name="datepai" type="checkbox" style="width: 25px"></td>
                            <td> Montant </td>
                            <td><input id="montantpaye" name="montantpaye" type="checkbox" style="width: 25px"></td>
                             </tr>
                      
                             <tr> 
                                  <td><h4 class="smaller lighter blue no-margin"><i>REGLEMENT</i></h4></td>
                            <td>Caisse</td>
                            <td><input id="caisse" name="caisse" type="checkbox" style="width: 25px"></td>
                            
                            <td>Montant </td>
                            <td><input id="montant_caisse" name="montant_caisse" type="checkbox" style="width: 25px"></td>
                            <td>  </td>
                            <td></td>
                            <td> </td>
                            <td></td>
                             </tr>
                    </table>
                    <br>
                   
                    <br>
                </fieldset>
                <div class="row"></div>
                <input type="hidden" id="id_imprime">
                <div class="modal-footer">
                    <button type="button" value="Initialiser" class="btn btn-sm btn-primary pull-left" onclick="InitilaiserChoixFiche()">
                        Initialiser</button>
                    <button type="button" value="Imprimer" id="bntimp" class="btn btn-sm pull-left" onclick="printfiche()">
                        Imprimer</button>
                    <button id="btnfermer" class="btn btn-sm pull-right" data-dismiss="modal" onclick="annuler()">
                        Fermer</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script  type="text/javascript">
    function annuler() {
        $('#my-modalimpression_bdcreg ').removeClass('in');
        $('#my-modalimpression_bdcreg ').css('display', 'none');
        InitilaiserChoixFiche();
    }

    function InitilaiserChoixFiche() {
        $("#base_check").prop("checked", false);
        checkAllBase();
       
    }
              
     
    function checkAllBase() {
        if ($('input[name=base_check]').is(':checked')) {
            $("#numero_bci").prop("checked", true);
            $("#date_creation").prop("checked", true);
            $("#demandeur").prop("checked", true);
            $("#decision").prop("checked", true);
            $("#numero_bce").prop("checked", true);
            $("#numero_bced").prop("checked", true);
            $("#montant_bced").prop("checked", true);
           
            $("#fac_sys").prop("checked", true);
            $("#fac_four").prop("checked", true);
             $("#eng_budget").prop("checked", true);
            $("#datepai").prop("checked", true);
            $("#montant_fac").prop("checked", true);
            
            $("#ordonnacement").prop("checked", true);
            $("#montantpaye").prop("checked", true);
            $("#caisse").prop("checked", true);
           
            $("#montant_caisse").prop("checked", true);
        } else {
            
            $("#numero_bci").prop("checked", false);
            $("#date_creation").prop("checked", false);
            $("#demandeur").prop("checked", false);
             $("#datepai").prop("checked", false);
            $("#decision").prop("checked", false);
            $("#eng_budget").prop("checked", false);
            $("#numero_bce").prop("checked", false);
            $("#numero_bced").prop("checked", false);
            $("#montant_bced").prop("checked", false);
            $("#fac_sys").prop("checked", false);
            $("#fac_four").prop("checked", false);
            $("#montant_fac").prop("checked", false);
            $("#ordonnacement").prop("checked", false);
            $("#montantpaye").prop("checked", false);
            $("#caisse").prop("checked", false);
            
            $("#montant_caisse").prop("checked", false);
        }
    }

   

    function printfiche() {
        var valide = false;
        var url = '';
        if ($('input[name=numero_bci]').is(':checked')) {
            if (url == '')
                url = '?numero_bci=' + $('#numero_bci').val();
            valide = true;
        }

        if ($('input[name=date_creation]').is(':checked')) {
            if (url == '')
                url = '?date_creation=' + $('#date_creation').val();
            else
                url = url + '&date_creation=' + $('#date_creation').val();
            valide = true;
        }

        if ($('input[name=demandeur]').is(':checked')) {
            if (url == '')
                url = '?demandeur=' + $('#demandeur').val();
            else
                url = url + '&demandeur=' + $('#demandeur').val();
            valide = true;
        }

        if ($('input[name=decision]').is(':checked')) {
            if (url == '')
                url = '?decision=' + $('#decision').val();
            else
                url = url + '&decision=' + $('#decision').val();
            valide = true;
        }

        if ($('input[name=numero_bce]').is(':checked')) {
            if (url == '')
                url = '?numero_bce=' + $('#numero_bce').val();
            else
                url = url + '&numero_bce=' + $('#numero_bce').val();
            valide = true;
        }
     
        if ($('input[name=numero_bced]').is(':checked')) {
            if (url == '')
                url = '?numero_bced=' + $('#numero_bced').val();
            else
                url = url + '&numero_bced=' + $('#numero_bced').val();
            valide = true;
        }

        if ($('input[name=montant_bced]').is(':checked')) {
            if (url == '')
                url = '?montant_bced=' + $('#montant_bced').val();
            else
                url = url + '&montant_bced=' + $('#montant_bced').val();
            valide = true;
        }

        

        if ($('input[name=fac_sys]').is(':checked')) {
            if (url == '')
                url = '?fac_sys=' + $('#fac_sys').val();
            else
                url = url + '&fac_sys=' + $('#fac_sys').val();
            valide = true;
        }

        if ($('input[name=fac_four]').is(':checked')) {
            if (url == '')
                url = '?fac_four=' + $('#fac_four').val();
            else
                url = url + '&fac_four=' + $('#fac_four').val();
            valide = true;
        }

        if ($('input[name=montant_fac]').is(':checked')) {
            if (url == '')
                url = '?montant_fac=' + $('#montant_fac').val();
            else
                url = url + '&montant_fac=' + $('#montant_fac').val();
            valide = true;
        }
      
        if ($('input[name=eng_budget]').is(':checked')) {
            if (url == '')
                url = '?eng_budget=' + $('#eng_budget').val();
            else
                url = url + '&eng_budget=' + $('#eng_budget').val();
            valide = true;
        }

        if ($('input[name=ordonnacement]').is(':checked')) {
            if (url == '')
                url = '?ordonnacement=' + $('#ordonnacement').val();
            else
                url = url + '&ordonnacement=' + $('#ordonnacement').val();
            valide = true;
        }

  if ($('input[name=datepai]').is(':checked')) {
            if (url == '')
                url = '?datepai=' + $('#datepai').val();
            else
                url = url + '&datepai=' + $('#datepai').val();
            valide = true;
        }
        if ($('input[name=montantpaye]').is(':checked')) {
            if (url == '')
                url = '?montantpaye=' + $('#montantpaye').val();
            else
                url = url + '&montantpaye=' + $('#montantpaye').val();
            valide = true;
        }

        if ($('input[name=caisse]').is(':checked')) {
            if (url == '')
                url = '?caisse=' + $('#caisse').val();
            else
                url = url + '&caisse=' + $('#caisse').val();
            valide = true;
        }

        

        if ($('input[name=montant_caisse]').is(':checked')) {
            if (url == '')
                url = '?montant_caisse=' + $('#montant_caisse').val();
            else
                url = url + '&montant_caisse=' + $('#montant_caisse').val();
            valide = true;
        }

        

        if (valide) {
            url = url + '&id=' + $('#id_imprime').val();
              url = url + '&start_date=' + $('#start').val() + '&end_date=' + $('#end').val() + '&id_bci=' + $('#id_bci').val();
          
            url = '<?php echo url_for('accueil/imprimerFicheBDCRegAvecChoix') ?>' + url;
            window.open(url, '_blank');
            win.focus();
        } else {
            bootbox.dialog({
                message: "<span class='bigger-110' style='margin:20px;'>Il faut choisir au moins un champ !</span>",
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
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>