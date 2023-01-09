<div id="my-modalagentPardomaine" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $domaine = Doctrine_Core::getTable('domaineuntilisation')->findOneById($idd); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Agents particpants à  La Formation du  Domaine d'utilisation "<?php echo $domaine->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                <th style="width: 30%">Matricule</th>  
                                <th style="width: 40%">Nom & Prénom</th> 
                                <th style="display: none">Code Agents</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,sousrubrique s,rubriqueformation ru , contrat c , besoinsdeformation b, planing p ,ligneplaning lp')
                                        ->where('lp.id_besoins=b.id  and b.id_agents=a.id  ')
                                        ->andWhere('lp.realise=true')
                                        ->andWhere('lp.id_sousrubrique=s.id')
                                        ->andWhere('s.id_rubrique=ru.id')
                                        ->andWhere('ru.id_domaine= ?', $idd)
                                        ->execute();
            $i=1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr style="cursor: pointer;" id="idde" >

                                        <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                    <td style="width: 40%"><?php echo $ag->getNomcomplet() ." " .$ag->getPrenom(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>
                                    </tr>
                                    <?php
                   $i++;             }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteparDomaine?iddomaine='.$idd) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentsDomaine()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsDomaine()
    {
        $('#my-modalagentPardomaine').removeClass('in');
        $('#my-modalagentPardomaine').css('display', 'none');
    }

</script>


