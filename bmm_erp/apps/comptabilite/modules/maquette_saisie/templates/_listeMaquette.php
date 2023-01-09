<div style="overflow-y : scroll;overflow-x : hidden; width: 100%;height: 100%;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Maquettes de Saisie</h4>
            </div>
            <div class="modal-body" >
                <fieldset>
                    <table id="dynamic-table" class="dynamic-table" style="width: 100%" >
                        <thead>
                            <tr> 
                                <th style="width: 10%">N°</th>  
                                <th style="width: 20%">Code</th>  
                                <th style="width: 70%">Intitulé</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listes = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('maquette m')
                                    ->leftJoin('m.Journalcomptable j')
                                    ->where('j.id_dossier=' . $_SESSION['dossier_id'])
//                                    ->andWhere('j.id_exercice=' . $_SESSION['exercice_id'])
                                    ->execute();
                            $maq = new Maquette();
                            $i = 1;
                            foreach ($listes as $l) {
                                $maquette = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idmaquette" ondblclick="chargermaquette('<?php echo $maquette->getId(); ?>', '<?php echo $maquette->getCode(); ?>', '<?php echo $maquette->getLibelle(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 20%"><?php echo $maquette->getCode(); ?></td>
                                    <td style="width: 70%"><?php echo $maquette->getLibelle(); ?></td>
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
                    <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermerMaquette()" >
                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chargermaquette(id, code, libelle)
    {
        $('#my-modalListeMaquette').removeClass('in');
        $('#my-modalListeMaquette').css('display', 'none');
        $('#id_maquette').val(id);
        $('#code_maquette').val(code);
        $('#libelle').val(libelle);
    }
    function fermerMaquette()
    {
        $('#my-modalListeMaquette').removeClass('in');
        $('#my-modalListeMaquette').css('display', 'none');
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>

