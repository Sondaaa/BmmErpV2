
<div id="" class="panel panel-green">
    <div id="replacediv" class="panel-heading">Inventaire</div>

    <div id="sf_admin_bar">

        <div class="sf_admin_filter">

           
            <form action="<?php echo url_for('Inventaire/new')?>" method="get" role="form">
                <table cellspacing="0" class="table table-striped table-bordered table-hover">

                    <tbody>
                        <tr class="sf_admin_form_row">
                            <td>
                                <label>Date</label>    </td>
                            <td>
                                <input type="date" name="date_debut"  value="<?php echo date("Y-m-d") ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Magasin/Dépôt</label>    </td>
                            <td>
                                <select  name="slt_siter">
                                     <option value="-1"></option>
                                    <?php foreach($sites as $site) { ?>
                                    <option value="<?php echo $site->getId() ?>"><?php echo $site->getLibelle() ?></option>
                                        <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Fournisseur</label>    </td>
                            <td>
                                <select  name="slt_frs">
                                 <option value="-1"></option>
                                    <?php foreach($frs as $fr) { ?>
                                    <option value="<?php echo $fr->getId() ?>"><?php echo $fr->getBpcnam() ?></option>
                                        <?php } ?>
                                </select>
                            </td>

                        </tr>
                         <tr>
                            <td>
                                <label>Document</label>    </td>
                            <td>
                                <select  name="slt_doc">
                                    <option value="-1"></option>
                                    <?php foreach($docs as $doc) { ?>
                                    <option value="<?php echo $doc->getId() ?>"><?php echo $doc." ".$doc->getTypedoc() ?></option>
                                        <?php } ?>
                                </select>
                            </td>

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

    <div id="sf_admin_content">
        <div class="sf_admin_list">



        </div>

    </div>


</div>




