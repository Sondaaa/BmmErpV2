<div id="" class="panel panel-green">
    <div id="sf_admin_container"   >
        <h1>Exporter les fiches articles / magasin</h1>
    </div>
    <div id="sf_admin_content" class="col-lg-6">
        <fieldset>
            <legend>Export Fiche Article</legend>
            <form action="<?php echo url_for('article/exportinv') ?>"  name="form_upload" role="form" method="post" enctype="multipart/form-data">

                <table>
                    <tr>
                        <td><?php
                            $mags = Doctrine_Core::getTable('magasin')->findAll();
                            ?>

                            <label>Magasin</label>
                            <select id="magtous" name="mag">
                                <option></option>
                                <?php foreach ($mags as $mag) { ?>
                                    <option value="<?php echo $mag->getId() ?>"><?php echo $mag ?></option>
                                <?php } ?>
                            </select></td>
                        <td><label>&emsp13;<br></label> <input  type="submit" class="btn btn-outline btn-success"></td>
                    </tr>
                </table>


            </form>

        </fieldset>

    </div>
    <div class="col-lg-12">
        <div>
            <fieldset>
                <legend>Liste destinée à l'équipe d'inventaire</legend>
                <table id="dynamic-table" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th class="center">
                                Code
                            </th>
                            <th>Article</th>
                            <th>Magasin</th>
                            <th>Qte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($stocks as $stock) {
                            ?>
                            <tr>
                                <td><?php echo $stock['codeart'] ?></td>  
                                <td><?php echo $stock['designation'] ?></td> 
                                <td><?php echo $stock['libelle'] ?></td> 
                                <td></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </fieldset>

            <fieldset>
                <legend>liste destinée à l'équipe de stock</legend>
                <table id="dynamic-table2" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th class="center">
                                Code
                            </th>
                            <th>Article</th>
                            <th>Magasin</th>
                            <th>Qte.Réel</th>
                            <th>Qte.Théorique</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($stocks2 as $stock) {
                            ?>
                            <tr>
                                <td><?php echo $stock['codeart'] ?></td>  
                                <td><?php echo $stock['designation'] ?></td> 
                                <td><?php echo $stock['libelle'] ?></td> 
                                <td><?php echo $stock['qtereel'] ?></td> 
                                <td><?php echo $stock['qtetheorique'] ?></td> 
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </fieldset>
        </div>  
    </div>
</div>