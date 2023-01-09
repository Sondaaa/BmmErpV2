<div style="overflow: auto; width: 100%; height: 100%"  >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"> Liste des Journaux</h4>
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
                                    ->from('journalcomptable')
                                    ->where('journalcomptable.id_dossier='. $_SESSION['dossier_id'])
                                    ->where('journalcomptable.id_exercice='. $_SESSION['exercice_id'])
                                    ->execute();
                            $journal = new Journalcomptable();
                            $i = 1;
                            foreach ($listes as $l) {
                                $jour = $l;
                                ?>
                                <tr style="cursor: pointer;" id="idjournal" ondblclick="chargerjournal('<?php echo $jour->getId(); ?>', '<?php echo $jour->getCode(); ?>', '<?php echo $jour->getLibelle(); ?>')">
                                    <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 20%"><?php echo $jour->getCode(); ?></td>
                                    <td style="width: 70%"><?php echo $jour->getLibelle(); ?></td>
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
                    <button type="button" value="Fermer" class="btn btn-sm  pull-left"  onclick="fermerJournal()" >
                        Fermer</button>
                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chargerjournal(id, code, libelle)
    {
        $('#my-modalListejournal').removeClass('in');
        $('#my-modalListejournal').css('display', 'none');
        $('#id_comptable').val(id);
        $('#code_comptable').val(code);
        $('#intitule').val(libelle);
    }
    function fermerJournal()
    {
        $('#my-modalListejournal').removeClass('in');
        $('#my-modalListejournal').css('display', 'none');
    }
</script>
<style>
    .table{margin-bottom: 0px;}
</style>

