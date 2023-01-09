<div  >
    <fieldset class="col-lg-12">
        <table>
            <tbody> 
                <tr>
                    <?php if (!$form->getObject()->isNew()) { ?>

                    <tr>  
                <input type="hidden" id="sensprime" value="<?php echo trim($primes->getSensprime()) ?>">
                <input type="hidden" id="typemontant" value="<?php echo trim($primes->getTypemontant()) ?>">
                </tr>

            <?php } ?> 
            <td><label>Titre Prime</label></td>
            <td>
                <?php echo $form['id_titreprime']->renderError() ?>
                <?php echo $form['id_titreprime'] ?>
            </td>
            <td><label>Fonction </label></td>
            <td>
                <?php echo $form['id_fonction']->renderError() ?>
                <?php echo $form['id_fonction'] ?>
            </td>
            <td><label>Categorie</label></td>
            <td>
                <?php echo $form['id_categorie']->renderError() ?>
                <?php echo $form['id_categorie'] ?>
            </td>


            </tr>
            <tr> <td><label>Grade</label></td>
                <td>
                    <?php echo $form['id_grade']->renderError() ?>
                    <?php echo $form['id_grade'] ?>
                </td>
                <td><label>Corps</label></td>
                <td>
                    <?php echo $form['id_corpsdet']->renderError() ?>
                    <?php echo $form['id_corpsdet'] ?>
                </td>

                <td><label>Sous Corps</label></td>
                <td>
                    <?php echo $form['id_souscorps']->renderError() ?>
                    <?php echo $form['id_souscorps'] ?>
                </td>
            </tr>
            <tr>
<!--                    <td><label>Salaire de base</label></td>
                <td>
                <?php // echo $form['salairedebase']->renderError() ?>
                <?php // echo $form['salairedebase'] ?></td>-->

                <td><label>Poste</label></td>
                <td>
                    <?php echo $form['id_poste']->renderError() ?>
                    <?php echo $form['id_poste'] ?>
                </td>
                <td><label>  Montant</label></td>
                <td>
                    <?php echo $form['montant']->renderError() ?>
                    <?php echo $form['montant'] ?>
                </td>
                <td><label>Type Montant</label></td>
                <td>
                    <?php echo $form['typemontant']->renderError() ?>
                    <?php echo $form['typemontant'] ?>
                </td>
            </tr>
            <tr>
                <td  colspan="2"><label>Cotisable</label></td>
                <td style="text-align: center">
                    <?php echo $form['cotisable']->renderError() ?>
                    <?php echo $form['cotisable'] ?>
                </td>
                <td  colspan="2"><label>  Imposable</label></td>
                <td style="text-align: center">
                    <?php echo $form['imposable']->renderError() ?>
                    <?php echo $form['imposable'] ?>
                </td>


            </tr>



            <tr>   <td colspan="2"><label> Tenir Compte : Des Jour Feriés et Congé  </label></td>
                <td style="text-align: center">
                    <?php echo $form['tenirjourfconge']->renderError() ?>
                    <?php echo $form['tenirjourfconge'] ?>
                </td>
                <td colspan="2"><label> Tenir Compte : Des (Hr-Jr) Suppléments Avec Majoration  </label></td>
                <td style="text-align: center">
                    <?php echo $form['tenirhjsuppavec']->renderError() ?>
                    <?php echo $form['tenirhjsuppavec'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><label> Tenir Compte : Des (Hr-Jr) Suppléments Sans Majoration  </label></td>
                <td style="text-align: center">
                    <?php echo $form['tenirhjsuppsans']->renderError() ?>
                    <?php echo $form['tenirhjsuppsans'] ?>
                </td>

                <td colspan="2"><label>Prime Active Pour les Indémnités (Mois>12)</label></td>
                <td style="text-align: center">
                    <?php echo $form['primeactiveindemnite']->renderError() ?>
                    <?php echo $form['primeactiveindemnite'] ?>
                </td>
            </tr>
            <tr>
                <td ><label> Sens Prime</label></td>
                <td>
                    <?php echo $form['sensprime']->renderError() ?>
                    <?php echo $form['sensprime'] ?>
                </td>
                <td><label>  Type Formule </label></td>
                <td colspan="3">
                    <?php echo $form['id_typeformule']->renderError() ?>
                    <?php echo $form['id_typeformule'] ?>
                </td>
            </tr>
            </tbody>
        </table></br>


        <!--        <fieldset class="col-lg-6">-->
        <table  class="col-lg-6 " style="width: 50%">
            <thead>
                <tr>
                    <th>Variable Formule</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php $variables = Variableformule::getVariable(); ?>
                        <select id="variable">
                            <?php for ($i = 1; $i < sizeof($variables); $i++): ?>

                                <option  value="<?php echo $variables[$i][0]; ?>"><?php echo $variables[$i][1]; ?></option>

                            <?php endfor; ?>
                        </select>
                    </td>
                    <td >
                        <button type="button" class="btn btn-info btn-circle" ng-click="AjouterVariable()"><b>+</b></button>

                    </td>  

                </tr>
            </tbody>
        </table>
        <!--        </fieldset>-->

        <table style="width: 50%">
            <thead>
            <th>Opérateur</th>
            <th style="width: 10%">Action</th>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <?php $operateur = Variableformule::getOperateur(); ?>
                        <select id="operateur">
                            <?php for ($i = 0; $i < sizeof($operateur); $i++): ?>

                                <option value="<?php echo $operateur[$i]; ?>"><?php echo $operateur[$i]; ?></option>

                            <?php endfor; ?>
                        </select>
                    </td>
                    <td >
                        <button type="button" class="btn btn-info btn-circle" ng-click="AjouterOperator()"><b>+</b></button>

                    </td>  
                </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td><label>Formule </label></td>
                <td class="disabledbutton">
                    <?php echo $form['formule']->renderError() ?>
                    <?php echo $form['formule'] ?>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-warning btn-circle" ng-click="DeletePrimes()"><i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
        </table>  


    </fieldset>
</div>
<script>
    $(document).ready(function () {
        $('#primes_sensprime option[value=' + $('#sensprime').val() + ']').attr('selected', 'selected');
        $('#primes_sensprime').trigger("chosen:updated");

        $('#primes_typemontant option[value=' + $('#typemontant').val() + ']').attr('selected', 'selected');
        $('#primes_typemontant').trigger("chosen:updated");
    })


</script>