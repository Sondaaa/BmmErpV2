<div style="overflow: auto; width: 100%;">
    <div class="modal-dialog" style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Agents</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="table table-bordered table-hover dynamic-table" style="width: 100%">
                        <thead>
                            <tr> 
                                <th style="width: 10%">Numéro</th>  
                                <th style="width: 30%">Matricule</th>  
                                <th style="width: 40%">Nom Complet</th> 
                                <th style="display: none">Code Agents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('agents')
                                    ->execute();
                            $ag = new Agents();
                            $i = 1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idde" ondblclick="chargerpersonne2('<?php echo $ag->getId(); ?>', '<?php echo $ag->getIdrh(); ?>', '<?php echo $ag->getNomcomplet() . " " . $ag->getPrenom(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                    <td style="width: 40%"><?php echo $ag->getNomcomplet() . " " . $ag->getPrenom(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer">
                    <button type="button" value="Fermer" class="btn  pull-left" onclick="fermeragents()">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function chargerpersonne2(id, mat, nom){
        $('#my-modalEmploye').removeClass('in');
        $('#my-modalEmploye').css('display', 'none');
        $('#idAg').val(id);
        $('#agents').val(nom);
        $('#idagents').val(mat);
    }
    function fermeragents(){
        $('#my-modalEmploye').removeClass('in');
        $('#my-modalEmploye').css('display', 'none');
    }

</script>