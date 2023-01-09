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
                                    ->from('lignecodesociale')
                                    ->execute();
                            $code = new Lignecodesociale();
                            $i = 1;
                            foreach ($listes as $c) {
                                $code = $c;
                                ?>
                                <tr style="cursor: pointer;"  ondblclick="chargercodesocialeF('<?php echo $code->getId(); ?>', '<?php echo trim($code->getCodesociale()->getLibelle()) . " - " . trim($code->getLibelle()); ?>', '<?php echo $code->getTaux() . " %" ?>')">
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
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermercodeF()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script>
    function chargercodesocialeF(id, code, taux)
    {
        $('#my-modalCaisseSocialeF').removeClass('in');
        $('#my-modalCaisseSocialeF').css('display', 'none');
        $('#idcodeF').val(id);
        $('#codeF').val(code);
        $('#tauxcodeF').val(taux);


    }
    function fermercodeF()
    {
        $('#my-modalCaisseSocialeF').removeClass('in');
        $('#my-modalCaisseSocialeF').css('display', 'none');
    }

</script>


