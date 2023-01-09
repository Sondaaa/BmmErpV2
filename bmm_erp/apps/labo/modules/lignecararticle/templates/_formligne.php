<table>
    <tr id="trarticle">
        <td><label>Article</label></td>
        <td colspan="3"><?php echo $form['id_article'] ?></td>

    </tr>
    <tr>


        <td><label>caractéristique</label><?php echo $form['id_car'] ?></td>
        <td><label>Valeur</label><?php echo $form['valeurlibelle'] ?></td>
        <td><br><a class="btn btn-sm btn-sm" ng-click="AjouterCara()">+</a>
        </td>
    </tr>


</table>
<table>
    <tr>
        <th>Caratéristique</th>
        <th>Valeur</th>
        <th></th>
    </tr>
    <tr ng-repeat="lg in listescar">
        <td>{{lg.libelle}}</td>
        <td>{{lg.valeurlibelle}}</td>
        <td><p class="btn btn-sm btn-danger" ng-click="DeleteCara(lg.id)">-</p></td>
    </tr>
</table>