<div id="sf_admin_container">
    <h1 id="replacediv"> Listes des données administratifs </h1>
</div>
<div id="sf_admin_bar" >

    <div class="sf_admin_filter col-xs-6" ng-controller="CtrlRessourcehumaine" ng-init="AfficheAgent()" >


        <form action="" method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                        <a href="<?php echo url_for('Documents/index') ?>">Effacer</a>
                          
                            <input type="submit" value="Valider" />
                        </td>
                    </tr>

                </tfoot>
                <tbody> 
                    <tr>
                        <td>Choisir Agent</td>
                        <td>
                        <input type="hidden" ng-model="tet">
                         <input type="hidden" value="<?php echo $idagent?>" id="idagentselcet">
                             <input type="text" value="">
                         <?php //echo $form['id_agents']->render(array('name' => 'idagent')); ?>

                    </td>   
                    </tr>

                </tbody>
            </table>
        </form>

    </div>

  

</div>

<div class="col-lg-6">
<fieldset >
    <legend><i> Données administratifs</i></legend>
   
  <table>
            <tbody>
                <tr>
                    <td><label>Identifiant unique</label></td>
                     <td><input id="idrh" type="text"  placeholder="Idrh" class="disabledbutton" ></td>
                  <td><label>Nom complet</label></td>
                     <td><input id="nom" type="text"  placeholder="nom" class="disabledbutton" ></td>
                </tr><tr>
                     <td><label>Poste </label></td>
                    <td><input id="poste" type="text"  placeholder="poste" class="disabledbutton" ></td>
                 <td><label>Bureau</label></td>
               <td><input id="bureau" type="text"  placeholder="bureau" class="disabledbutton" ></td>
                <tr> <td><label>Fonction actuelle </label></td>
                   <td><input id="fonction" type="text"  placeholder="fonction" class="disabledbutton" ></td>
                <td><label>Services</label></td>
                   <td><input id="service" type="text"  placeholder="service" class="disabledbutton" ></td>
                </tr><tr>
               <td><label>Statut administratif</label></td>
                <td><input id="statut" type="text"  placeholder="statut" class="disabledbutton" ></td>
                
                 <td><label>Lieu de travail</label></td>
                <td><input id="gouvernera" type="text"  placeholder="gouvernera" class="disabledbutton" ></td>
                </tr>
                <tr>
                    <td><label>Salaire de base</label></td>
                     <td><input id="sal" type="text"  placeholder="salaire" class="disabledbutton" ></td>
                      <td><label>Corps</label></td>
                     <td><input id="corps" type="text"  placeholder="corps" class="disabledbutton" ></td>
                
                </tr>
                   <tr><td><label>Categorie</label></td>
                     <td><input id="cat" type="text"  placeholder="categorie" class="disabledbutton" ></td>
                      <td><label>Grade</label></td>
                     <td><input id="grade" type="text"  placeholder="grade" class="disabledbutton" ></td>
                
  </tr><tr> <td><label>Echelle</label></td>
                     <td><input id="echelle" type="text"  placeholder="echelle" class="disabledbutton" ></td>
                      <td><label>Echelon</label></td>
                     <td><input id="echelon" type="text"  placeholder="echelon" class="disabledbutton" ></td>
                </tr> <tr> <td><label> Date d'entré</label></td>
                <td><input id="dateentre" type="date" class="disabledbutton" ></td>
                   <td><label>Date titulaire</label></td>
                <td><input id="datetitulaire" type="date"  class="disabledbutton" ></td>
                  </tr>
             
              
              
  </tbody>
</table>
</fieldset></div>

