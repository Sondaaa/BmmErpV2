<div id="sf_admin_container" class="panel panel-green">
    <h1>Inventaire</h1>
    <div id="sf_admin_bar">
        <div class="sf_admin_filter">
            <form action="<?php echo url_for('Inventaire/new')?>" method="post"  enctype="multipart/form-data">
                <table cellspacing="0" class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr class="sf_admin_form_row">
                            <td><label>Date début</label></td>
                            <td colspan="3">
                                <input type="date" name="date_debut" value="<?php echo $date_debut ?>">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Bureau</label></td>
                            <td>
                                <select name="slt_bureau" id="slt_bureau">
                                    <?php foreach($bureaux as $bureau) { ?>
                                    <option value="<?php echo $bureau->getId() ?>"><?php echo $bureau->getBureau() ?></option>
                                        <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Fichier </label></td>
                            <td><input type="file" name="filecodebarre"></td>
                        </tr>
                        <tr class="sf_admin_form_row">
                            <td colspan="2">
                                <input type="submit" value="Ouvrir Inventaire" class="btn btn-outline btn-success">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>
    </div>
<!--
    <div id="sf_admin_content">
        <div class="sf_admin_list">


            <table cellspacing="0" class="table table-striped table-bordered table-hover table-contenue">
                <thead>
                    <tr>
                        <th>Date</th>

                        <th>Numero</th>
                        <th>Magazin</th>


                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

//                    foreach ($emplacements as $empl):
//                        $immobilisations=Doctrine_Core::getTable('immobilisation')->findById($empl->getIdImmo());
//                        $immobilisation=new Immobilisation();
//                        foreach($immobilisations as $immo) {
//                            $immobilisation=$immo;
                            ?>
                    <tr>
                        <td><?php // echo $immobilisation->getDatecreation()?></td>

                        <td><?php // echo $immobilisation->getNumero() ?></td>
                        <td><?php // echo $immobilisation->getDesignation() ?></td>



                        <td><a href="<?php // echo url_for('Inventaire/show?idshow='.$immobilisation->getId()) ?>">Détail</a></td>

                    </tr>
                            <?php // }endforeach
; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>

                        <th>Numero</th>
                        <th>Magazin</th>


                        <th>Action</th>
                    </tr>

                </tfoot>
            </table>

        </div>
-->
    </div>


</div>