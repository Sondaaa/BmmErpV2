<div tabindex="-1" >

    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Employés</h4>
            </div>

            <div class="modal-body" >
                <fieldset>
                    <table id="dynamics-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr><th style="width: 10%">Numéro</th> 
                                <th>Matricule</th>  
                                <th>Agent</th> 

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
                                <tr id="idde" ondblclick="chargerpersonne2('<?php echo $ag->getId(); ?>', '<?php echo $ag->getIdrh(); ?>', '<?php echo $ag->getNomcomplet(); ?>')">
                                    <td><?php echo $i ; ?></td>
                                    <td><?php echo $ag->getIdrh(); ?></td>
                                    <td><?php echo $ag->getNomcomplet() ." ". $ag->getPrenom(); ?> </td>

                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="modal-footer" >
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="Fermeragents2()" >

                        Fermer</button>


                </div>
            </div>


        </div>

    </div>
</div>

<script  type="text/javascript">
    function chargerpersonne2(id, mat, nom)
    {
        $('#my-modal2').removeClass('in');
        $('#my-modal2').css('display', 'none');
        $('#idp').val(id);
        $('#idfin').val(mat);
        $('#nomagentsfin').val(nom);

    }
    function Fermeragents2()
    {
        $('#my-modal2').removeClass('in');
        $('#my-modal2').css('display', 'none');
    }

</script>


