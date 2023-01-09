<div id="my-modalagentsParAnneeFinUnite" class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <?php $unite = Doctrine_Core::getTable('unite')->findOneById($idu); ?>

                    <h4 class="smaller lighter blue no-margin"> Liste des Emplyés  de "<?php  echo $unite->getLibelle() ; ?>"   participants à  La Formation de l'année  "<?php echo $idanne ?> " </h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table"  style="width: 100%" >
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
                                        ->select('*')
                                        ->from('agents a,regroupementtheme r , contrat c ,posterh pote ,unite u, besoinsdeformation b, planing p ,ligneplaning lp')
                                        ->where('lp.id_besoins=b.id and lp.id_regroupement=r.id and b.id_agents=a.id  ')
                                        ->andWhere('lp.realise=true')
                                        ->andWhere('p.annee = ?', $idanne)
                                         ->andWhere('c.id_agents=a.id and c.id_posterh=pote.id and pote.id_unite=u.id')
                                        ->andWhere('u.id= ?', $idu)
                                        ->execute();
                                $i = 1;
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr style="cursor: pointer;" id="idde" >
                                        <td style="width: 10%"><?php echo $i; ?></td>
                                        <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                        <td style="width: 40%"><?php echo $ag->getNomcomplet(); ?> </td>
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
                        <a id="button_print" target="_blanc" href="<?php echo url_for('planing/ImprimerAlllisteparAnneefinUnite?idannee=' . $idanne .'&idunite='.$idu ) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a>
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentsAnneefinUnite()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentsAnneefinUnite()
    {
        $('#my-modalagentsParAnneeFinUnite').removeClass('in');
        $('#my-modalagentsParAnneeFinUnite').css('display', 'none');
    }

</script>


