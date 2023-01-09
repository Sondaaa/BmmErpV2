<div id="sf_admin_container">
    <h1 id="replacediv"> Relvé de sevices</h1>
</div>
<div id="sf_admin_bar" >

    <div class="sf_admin_filter col-xs-6" ng-controller="CtrlRessourcehumaine"  >

<!--ng-init="AfficheAgent()"-->
        <form method="post" >
            <table cellspacing="0" >
                <tfoot>
                    <tr>
                        <td colspan="2">
                        <a href="<?php echo url_for('Documents/index') ?>">Effacer</a>
                          
                        <input type="button" value="Valider" ng-click="AfficheFicheAgentByCode()"/>
                        </td>
                    </tr>

                </tfoot>
                <tbody> 
                    <tr>
                        <td>Choisir Agent</td>
                        <td>
<!--                        <input type="hidden" ng-model="tet">
                         <input type="hidden" value="<?php // echo $idagent?>" id="idagentselcet">
                             <input type="text" value="">-->
                         <?php //echo $form['id_agents']->render(array('name' => 'idagent')); ?>
                    <input type="text" ng-value="" ng-model="codeagent.text" id="codeagent"  autocomplete="off"   placeholder="CODE" ng-change="AfficheAgentByText()">                   
                    <input type="text" value="" ng-model="nameagnet.text" id="nameagnet"  class="form-control" placeholder="Name" ng-change="AfficheAgentByText()">
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
                  <td><input id="nom" type="text" placeholder="nom" class="disabledbutton" ></td>
                </tr>
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
                </tr> 
                <tr> <td><label>Langue</label></td>
                     <td><input id="langue" type="text"  placeholder="Langue" class="disabledbutton" ></td>
                      <td><label>Diplome</label></td>
                     <td><input id="diplome" type="text"  placeholder="diplome" class="disabledbutton" ></td>
                </tr> 
               <tr> <td><label>Spécialité</label></td>
                     <td><input id="specialite" type="text"  placeholder="specialité" class="disabledbutton" ></td>
                      <td><label>Type permis</label></td>
                     <td><input id="typepermis" type="text"  placeholder="Type permis" class="disabledbutton" ></td>
                </tr> 
              
              
  </tbody>
</table>
</fieldset></div>
<div class="col-lg-6">
<fieldset >
    <legend><i> Informations Calculables </i></legend>
   
  <table>
            <tbody><tr> <td><label> Date d'entré</label></td>
                   
                <td><input id="dateentre" type="date" class="disabledbutton" ></td>
                  <td><label>Date d'acqusition</label></td>
                <td><input id="dateaccusition" type="date"  class="disabledbutton" ></td>
                
                  </tr>
                <tr>
                  <td><label>Ancienneté dans le grade</label></td>
                     <td><input id="ancienneteGrade" type="text"  placeholder="Ancienneté grade" class="disabledbutton" ></td>
                    
                 <td><label>Ancienneté générale</label></td>
                     <td><input id="ancienneteGeneral" type="text"  placeholder="Ancienneté générale" class="disabledbutton" ></td>
                </tr></tbody></table><table><tbody>
                <tr><td>Situation adminstratif</td>
                    <td colspan="4"><input id="situation" type="text" placeholder="Situation Administratif"></td></tr>
            </tbody></table></fieldset>
    <fieldset><table><tbody><legend><i> Listes des taches </i></legend>
               <tr>
                     <td><label>Poste </label></td>
                    <td><input id="poste" type="text"  placeholder="poste" class="disabledbutton" ></td>
                    <td><label>Bureau</label></td> 
                    <td><input id="bureau" type="text"  placeholder="bureau" class="disabledbutton" ></td>
               </tr></tbody></table>
        <table><tbody><tr>
              <textarea name="tache" placeholder="taches" class="disabledbutton">Taches</textarea>
                </tr>
            </tbody>
  </table>
</fieldset></div>
<fieldset></fieldset>