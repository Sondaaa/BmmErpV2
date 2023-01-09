<div id="my-modalfiltragecorpsetgrade"  class="modal fade" tabindex="-1" >
    <div id="sf_admin_container" >

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <?php $cat = Doctrine_Core::getTable('corps')->findOneById($id1); ?>
                     <?php $e = Doctrine_Core::getTable('grade')->findOneById($id2); ?>
                    <h4 class="smaller lighter blue no-margin"> Liste des Emplyés relié au Corps   "<?php echo $cat->getLibelle(); ?> " et au grade "<?php echo $e->getLibelle(); ?> "</h4>
                </div>

                <div class="modal-body" >
                    <fieldset>
                        <table id="dynamic-table1" class="dynamic-table" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th style="width: 10%">Numéro</th>  
                                    <th style="width: 30%">Matricule</th>  
                                    <th style="width: 40%">Agent</th> 
                                    <th style="display: none">Code Agents</th> 

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listes = Doctrine_Query::create()
                                        ->select('*')
                                        ->from('agents a,contrat c , salairedebase s, corps cor,grade g')
                                        ->where('c.id_agents=a.id and c.id_salairedebase=s.id and s.id_corps=cor.id and s.id_grade=g.id')
                                        ->andWhere('cor.id= ?', $id1)
                                        ->andWhere('g.id= ?', $id2)
                                        ->execute();
$i=1;                                
                                foreach ($listes as $ag) {
                                    ?>
                                    <tr id="idde" >
                                     <td style="width: 10%"><?php echo $i; ?></td>
                                    <td style="width: 30%"><?php echo $ag->getIdrh(); ?></td>
                                    <td style="width: 40%"><?php echo $ag->getNomcomplet()." ".$ag->getPrenom(); ?> </td>
                                    <td style="display: none"><?php echo $ag->getId(); ?> </td>    
                                    </tr>
                                    <?php
                              $i++;  }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <div class="modal-footer" >
                      <a id="button_print" target="_blanc" href="<?php echo url_for('agents/ImprimerAlllisteagentsparcorpsetgrade?idcorps='.$id1.'&idgrade='.$id2) ?>" class="btn  btn-success pull-left">
                            <i class="ace-icon fa fa-print bigger-110"></i>
                            <span class="bigger-110 no-text-shadow">Imprimer</span>
                        </a> 
                        <button type="button" value="Fermer" id="btn1"  class="btn  pull-left"  onclick="fermeragentscorpsgrade()">
                            Fermer</button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    $("table").addClass("table  table-bordered table-hover");
    function fermeragentscorpsgrade()
    {
        $('#my-modalfiltragecorpsetgrade').removeClass('in');
        $('#my-modalfiltragecorpsetgrade').css('display', 'none');
    }

</script>


