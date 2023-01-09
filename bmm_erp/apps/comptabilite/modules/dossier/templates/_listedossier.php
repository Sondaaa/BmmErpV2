<div style="overflow: auto; width: 100%;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Dossiers </h4>
            </div>
            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N°</th>  
                                <th style="width: 20%">Code</th>  
                                <th style="width: 70%">Dossier Comptable</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('dossiercomptable')
                                    ->execute();
                            $dossier = new Dossiercomptable();
                            $i = 1;
                            foreach ($listes as $l) {
                                $doss = $l;
                                ?>
                                <tr style="cursor: pointer;" id="iddossier" ondblclick="chargerdossier('<?php echo $doss->getId(); ?>', '<?php echo $doss->getCode(); ?>', '<?php echo $doss->getRaisonsociale(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 20%"><?php echo $doss->getCode(); ?></td>
                                    <td style="width: 70%"><?php echo $doss->getRaisonsociale(); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>

                </fieldset>
                <div class="row"></div>
                <div class="modal-footer" >
                    <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermerDossier()" >
                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chargerdossier(id, code, libelle)
    {
        $('#my-modalListedossier').removeClass('in');
        $('#my-modalListedossier').css('display', 'none');
        $('#id_dossier').val(id);
        $('#code_dossier').val(code);
        $('#raison_sociale').val(libelle);
    }
    function fermerDossier()
    {
        $('#my-modalListedossier').removeClass('in');
        $('#my-modalListedossier').css('display', 'none');
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>

