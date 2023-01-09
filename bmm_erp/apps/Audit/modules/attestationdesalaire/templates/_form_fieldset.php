
<div id="sf_admin_container" ng-controller="CtrlRessourcehumaine">


    <div id="sf_admin_content">  
        <div  class="panel-body">


            <div class="tab-content">  
                <div class="tab-pane fade active in" id="home" s>
                    <fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
                        <?php if ('NONE' != $fieldset): ?>
                            <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
                        <?php endif; ?>
                        <center>  <legend><i> Attestation de Salaire</i></legend></center>
                        <table style="width: 60%"><tr><td>   Le Directeur Général de l'Office de Développement de</td> 
                                <td> <?php echo $form['id_lieu'] ?></td></tr>
                            <tr><td>
                                    'soussigné, atteste par la présente que :
                                </td>    <td> <?php echo $form['id_agents'] ?></td>
                            </tr>
                        </table>
                        <br>
                        <table style="width: 60%">

                            <tr>
                                <td>    Matricule : </td>
                                <td>    
                                    <input data-width="fixed" type="text" placeholder="UI"id="idrh" > 

                                </td></tr>

                            </tr>
                            <tr>
                                <td>    Grade : </td>
                                <td><input data-width="fixed" type="text" placeholder="grade"   id="grade">
                                </td>
                            </tr>
                            <tr>
                                <td>     Situation administrative:</td>
                                <td> <input data-width="fixed" type="text" placeholder="Situation administrative"   id="situation">
                                </td>
                            </tr>
                        </table> 
                        <br> 'perçoit les émoluments annuels brut globaux suivants : 
                        <br> <br>    
                        <table style="width: 60%">
                            <thead>
                            <th>Indemnités et primes</th>
                            <th>Primes</th>
                            </thead>

                            <tbody>
                            <td>Salaire de base</td>

                            <td> <input data-width="fixed" type="text" placeholder="Montant"id="montant" > 
                            </td>
                            <td style="display: none"><!--style="display: none" -->
                                <?php echo $form['id_contrat'] ?>
                            </td>

                            <tr ng-repeat="ligne in listesPrimes">

                                <td>{{ligne.libelle}}</td>
                                <td>{{ligne.montant| currency: "" : 3}}</td>

                            </tr>
                            <tr>
                                <td>Total:</td>
                                <td id="idtotal"></td>
                            </tr>

                            </tbody>

                        </table>
                        Arrêtée  la présente attestation à la somme de <span id="totalatt"></span>
                        <br><br>

                    </fieldset>    




                </div>



            </div>  
        </div>
    </div>
</div>

<script  type="text/javascript">
    $('#attestationdesalaire_id_lieu').attr('style', 'width: 150px;');
</script>