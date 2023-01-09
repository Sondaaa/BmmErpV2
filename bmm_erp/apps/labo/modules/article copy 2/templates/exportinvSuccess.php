<div class="page-header">
    <h1>Exporter les fiches articles / magasin</h1>
</div>
<div class="row">
    <div class="col-xs-12">
    <div class="col-md-6">
        <fieldset>
            <legend>Export Fiche Article</legend>
            <form action="<?php echo url_for('article/exportinv') ?>" name="form_upload" role="form" method="post" enctype="multipart/form-data">

                <table  class="display nowrap" style="width:100%">
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
                            </select>
                        </td>
                        <td><label>&emsp13;<br></label> <input type="submit" class="btn btn-outline btn-success"></td>
                    </tr>
                </table>


            </form>

        </fieldset>

    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
            <h5>Liste destinée à l'équipe d'inventaire</h5>                   
                 <table id="dynamic-table"  style="width:100%">
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
            </div>
            <div class="col-md-6">
                <h5>liste destinée à l'équipe de stock</h5>
                <table id="dynamic-table2"  style="width:100%">
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
            </div>
        </div>
                
           
        
    </div>
    </div>
</div>