<div id="sf_admin_container" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="smaller lighter blue no-margin"> Liste des Echelons </h4>
            </div>

            <div class="modal-body">
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr>
                                <th style="width: 20%">Numéro</th> 
                                <th>Libellé</th> 

                                <th style="display: none">Code echelon</th> 

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('echelon')
                                    ->execute();
                            $ag = new Echelon();
                            $i=1;
                            foreach ($listes as $l) {
                                $ag = $l;
                                ?>
                                <tr style="cursor: pointer;" ondblclick="chechelon('<?php echo $ag->getId(); ?>', '<?php echo $ag->getLibelle(); ?>')">
                                    <td style="width: 20%"><?php echo $i; ?> </td>
                                    <td><?php echo $ag->getLibelle(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                </tr>
                                <?php
                         $i++;   }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <a id="button_print" target="_blanc" href="<?php echo url_for('echelon/ImprimerAlllisteEchelon') ?>" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-print bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">Imprimer</span>
                    </a>
                    <button type="button" value="Fermer" class="btn btn-sm pull-left"  onclick="fermerechelon()" >
                        Fermer</button>

                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chechelon(id, libelle)
    {
        $('#my-modalechelon').removeClass('in');
        $('#my-modalechelon').css('display', 'none');
        $('#idechelon').val(id);
        $('#echelon').val(libelle);
    }
    function fermerechelon()
    {
        $('#my-modalechelon').removeClass('in');
        $('#my-modalechelon').css('display', 'none');
    }
</script>


