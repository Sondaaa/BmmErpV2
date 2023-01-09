<div id="" class="panel panel-green">
    <div id="sf_admin_container"   >
        <h1>Mise à jour T.V.A Articles</h1>
    </div>
    <div id="sf_admin_content">
        <fieldset>
            <legend>T.V.A</legend>
            <form action="<?php echo url_for('article/misajourtva?param=misajour') ?>"   role="form" method="post" enctype="multipart/form-data">
                <div class="form-group col-lg-2">
                    <input type="hidden" name="acttous" value="0">
                    <select name="slttva">
                        <?php foreach ($tvas as $tva) { ?>
                            <option value="<?php echo $tva->getId() ?>"><?php echo $tva ?></option>
                        <?php } ?>
                    </select>
                </div>
                <input  type="submit" name="btnvalder" value="Valider" class="btn btn-outline btn-success">
            </form>
        </fieldset>
    </div>
    <div ng-controller="myCtrlbonstock" >
        <div class="row">
            <div class="col-xs-10">
                <h3 class="header smaller lighter blue">Liste Des Articles/TVA</h3>                
                <div>
                    <table>
                        <tr>
                            <th>Code</th>
                            <th style="width: 400px">Designation</th>
                            <th>T.V.A</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                        <form action="<?php echo url_for('article/misajourtva?param=misajour') ?>"   role="form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="acttous" value="1">
                            <td >
                                <input  type="text" name="codeart" ng-value="" ng-model="code.text" id="codearticle" autocomplete="off" class="form-control" ng-change="RechercheArticleByCodeAndDesignation()">                   
                            </td>
                            <td>
                                <input type="text" name="designation" value="" ng-model="designation.text" id="designation" class="form-control" ng-click="ChoisirArticle()" ng-change="ChoisirArticle()">
                            </td>
                            <td>
                                <select name="slttva">
                                    <?php foreach ($tvas as $tva) { ?>
                                        <option value="<?php echo $tva->getId() ?>"><?php echo $tva ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input  type="submit" value="Valider" class="btn btn-outline btn-success">
                            </td>
                        </form>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>