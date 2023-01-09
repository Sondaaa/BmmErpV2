<div id="sf_admin_container" class="panel panel-green" ng-controller="myCtrl">
    <h1>Nouvelle Fiche Transfert</h1>
    <style>
        ul li {
            cursor: pointer;
        }

        .testul ul {
            margin: 0 auto;
            padding: 0;
            max-height: 150px;

            overflow-y: auto;
            border: 1px solid rgba(0, 0, 0, 0.5);
            padding: 5px 5px 0 5px;
            border-left: 1px solid rgba(0, 0, 0, 0.5);
            border-right: 1px solid rgba(0, 0, 0, 0.5);
            background-color: white;
            position: absolute;
        }

        .testul li {
            list-style: none;
            width: 100%;
        }

    </style>
    <br>
    <div class="alert alert-success alert-dismissable" <?php  if(!isset($_REQUEST['msg'])) echo 'style="display: none"'; ?>  id="msg">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        Votre transfert a été effectuer avec succès
    </div>
    <table>
        <tfoot>
            <tr>
                <td colspan="4">
                    <input type="button" class="btn btn-outline btn-success" value="Valider" ng-click="AjouterTransfer()" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <th>Bureaux</th>
                <th>Article</th>
                <th>Vers Bureaux</th>
                <th>User</th>
            </tr>
            <tr>
                <td>
                    <input type="hidden" value="-1" id="idbd" ng-model="idbd">
                    <input type="text" id="txt_bd" class="form-control" ng-model="filterbd" ng-change="selectbd()" ng-click="selectbd()" >
<!--                    <div class="testul">
                        <ul style="display: none" id="sltbd" ng-change="selectAllBd()" ng-model="bd">
                            <li ng-repeat="b in bds| filter : filterbd" ng-mousedown="selectedBd(b.nom, b.id)">
                                {{b.nom}}
                            </li>
                        </ul>
                    </div>-->
                </td>
                <td>
                    <input type="hidden" value="-1" id="idarticle" ng-model="idarticle">
                    <input type="text" id="txt_article" class="form-control disabledbutton" ng-model="filterarticle" ng-change="selectarticle()" ng-click="selectarticle()" >
<!--                    <div class="testul">
                        <ul style="display: none" id="sltarticle" ng-model="article">
                            <li ng-repeat="art in articles| filter : filterarticle"  ng-mousedown="selectedArticle(art.nom, art.id)">
                                {{art.nom}}
                            </li>
                        </ul>
                    </div>-->
                </td>
                <td>
                    <input type="hidden" value="-1" id="idbv" ng-model="idbv">
                    <input type="text" id="txt_bv" class="form-control" ng-model="filterbv" ng-change="selectbv()" ng-click="selectbv()" >
<!--                    <div class="testul">
                        <ul style="display: none" id="sltbv">
                            <li ng-repeat="b in bvs| filter : filterbv" ng-mousedown="selectedBv(b.nom, b.id)">
                                {{b.nom}}
                            </li>
                        </ul>
                    </div>-->
                </td>
                <td>
                    <input type="hidden" value="-1" id="iduser" ng-model="iduser">
                    <input type="text" id="txt_user" class="form-control" ng-model="filteruser" ng-change="selectuser()" ng-click="selectuser()" >
<!--                    <div class="testul">
                        <ul style="display: none" id="sltuser">
                            <li ng-repeat="user in users| filter : filteruser" ng-mousedown="selectedUser(user.nom, user.id)">
                                {{user.nom}}
                            </li>
                        </ul>
                    </div>-->
                </td>
            <tr>
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td  style="float: right">
                                            <button type="button" class="btn btn-primary btn-xs" ng-click="AjouterArticle()"  >+Ajouter</button>
                                        </td>
                                    </tr>
                                </table>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Article</th>
                                            <th>Bureaux</th>
                                            <th>vers Bureaux</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="transfer in articletransfer">
                                            <td>{{transfer.article}}</td>
                                            <td>{{transfer.bureaux}}</td>
                                            <td>{{transfer.bureauxtransfer}}</td>
                                            <td>{{transfer.user}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>