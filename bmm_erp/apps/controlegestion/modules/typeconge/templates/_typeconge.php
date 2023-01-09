<div style="overflow: auto; width: 100%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Types des Congés</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">Numéro</th>  
                                <th style="width: 30%">Type Congé</th>  
                                <th style="width: 40%">Nombre Jour</th> 
                                <th style="width: 10%">Modalité de calcul</th> 
                                <th style="width: 10%">Payé</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('typeconge')
                                    ->execute();
                            $liste = new Typeconge();
                            $i = 1;
                            foreach ($listes as $l) {
                                $liste = $l;
                                ?>
                            <tr style="cursor: pointer;" id="idde" ondblclick="charger('<?php echo $liste->getId(); ?>', '<?php echo str_replace("'", "\'", $liste->getLibelle()); ?>', '<?php echo $liste->getNbrjour(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $liste->getLibelle();  ?></td>
                                    <td style="width: 10%"><?php echo $liste->getNbrjour();   ?> </td>
                                    <td style="width: 40%"><?php echo $liste->getModalitecalcul();   ?> </td>
                                    <td>
                                        <?php if ($liste->getPaye() == 1): ?>
                                            <?php echo "Payé"; ?>
                                        <?php else: ?>
                                            <?php echo "Non Payé"; ?> 
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer">
                    <button type="button" value="Fermer" class="btn pull-left" onclick="fermer1()">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function charger(id, mat, nom){
        $('#my-modalType').removeClass('in');
        $('#my-modalType').css('display', 'none');
        $('#idtype').val(id);
        $('#id').val(nom);
        $('#type').val(mat);
    }
    function fermer1()
    {
        $('#my-modalType').removeClass('in');
        $('#my-modalType').css('display', 'none');
    }

</script>