<div style="overflow: auto; width: 100%;" >

    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Caisse de Sécurité Sociale </h4>
            </div>
            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="table table-bordered table-hover dynamic-table"  style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">Numéro</th>  
                                <th style="width: 40%">Libellé</th> 
                                <th >Taux Cotisation</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('lignecodesociale l ')
                                    ->where('l.id_codesoc <> 1')
                                    ->execute();
                            $code = new Lignecodesociale();
                            $i = 1;
                            foreach ($listes as $c) {
                                $code = $c;
                                ?>
                                <tr style="cursor: pointer;"  ondblclick="chargercodesocialesRecap('<?php echo $code->getId(); ?>', '<?php echo trim($code->getCodesociale()->getLibelle()) . " - " . trim($code->getLibelle()); ?>', '<?php echo $code->getTaux() . " %" ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 40%"><?php echo $code->getCodesociale()->getLibelle() . " - " . $code->getLibelle(); ?></td>
                                    <td style="width: 50%"><?php echo $code->getTaux(); ?>  </td>

                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermercodesocialeRecap()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script>
    function chargercodesocialesRecap(id, code, taux)
    {
        $('#my-modalCaisSocialeRecap').removeClass('in');
        $('#my-modalCaisSocialeRecap').css('display', 'none');
        $('#idcodedecl_recap').val(id);
        $('#codesoc_recap').val(code);
        $('#tauxcodesoc_recap').val(taux);
    }
    function fermercodesocialeRecap()
    {
        $('#my-modalCaisSocialeRecap').removeClass('in');
        $('#my-modalCaisSocialeRecap').css('display', 'none');
    }

</script>


