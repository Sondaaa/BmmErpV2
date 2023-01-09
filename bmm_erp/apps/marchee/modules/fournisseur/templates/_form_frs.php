
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">

            <h3 class="smaller lighter blue no-margin">Nouvelle Fiche Fournisseur</h3>
        </div>

        <div class="modal-body">
            <table>
                <tr>
                    <td><label>Raison social</label></td>
                    <td><input type="text" id="rs"></td>
                </tr>
                <tr>
                    <td><label>Matricule Fiscal</label></td>
                    <td><input type="text" id="mf"></td>
                </tr>
                <tr>
                    <td><label>Nom&Prénom(Contactez)</label></td>
                    <td><input type="text" id="nom">
                        <input type="text" id="prenom"></td>
                </tr>
            </table>

        </div>

        <div class="modal-footer">
            <button class="btn btn-sm btn-primary pull-right" data-dismiss="modal" ng-click="AjouterFrs()">
                <i class="ace-icon fa fa-plus"></i>
                Ajouter
            </button>
            <button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
                <i class="ace-icon fa fa-times"></i>
                fermer
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->