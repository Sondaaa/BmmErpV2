<diV ng-controller="CtrlRessourcehumaine">
    <fieldset>

        <center> <legend><i> أمـر بمـهـمــة </i></legend></center>

        <table style="width: 80%; margin-left: 150px">
            <tr><td>Agents / Ouvrier</td>
                <td> <?php echo $form['id_agents'] ?> 
                    <?php echo $form['id_ouvrier'] ?>
                </td>
               
                <td class="align_right">(عامل) عيــن السيد
                </td>

            </tr>
            <tr>
                <td></td>
                <td style="text-align: center"><input type="text" data='fixed' id='matricule' placeholder="Matriculeرقم  "></td>
            
            <tr>
                <td colspan="3" style="text-align: center">
                    التــابع لـديوان تنمية رجيم معتوق 
                </td>
            </tr>
            <tr><td>Pour aller à</td>
                <td> <?php echo $form['id_lieu'] ?>   
                </td>
                <td colspan="2" class="align_right"> للذهـاب إلى 
                </td>

            </tr>
            <tr><td>Nombre de jour </td>
                <td> <?php echo $form['duree'] ?>   
                </td>
                <td colspan="2" class="align_right"> يـوم
                </td>

            </tr>

            <tr> <td >Date Sortie</td> 

                <td>   <?php echo $form['datesortie'] ?> </td>
                <td colspan="2" class="align_right">تاريخ الخروج   </td>     
            <tr>


                <td> Par</td>
                <td>     <?php echo $form['moyentransport'] ?></td>
                <td colspan="2" class="align_right">بواسطــة       </span></td>

            </tr>
            <tr>
                <td>
                    <span>Pour effectuer une tâche</span> </td>
                <td>  <?php echo $form['mission'] ?></td> 
                <td colspan="2" class="align_right">للقيــام بمهمـة </td>
            </tr>
            <tr>
                <td>
                    <span>Référence</span> </td>
                <td>  <?php echo $form['reference'] ?></td> 
                <td colspan="2" class="align_right"> المرجع </td>
            </tr>
            
            
            <tr>
                <td>
                    <span>profiter le logement</span> </td>
                <td>  <?php echo $form['logenment'] ?></td> 
                <td colspan="2" class="align_right"> يتمتع بالإقامة </td>
            </tr>
            
             
            
        </table>
        <table style="width: 10%"  class="pull-right" >
            <tr>
             <td>إمضاء وختم الرئيس المباشر     </td> 
            </tr>
            <tr>
            <td><?php echo $form['signaturedirecteur']  ?></td>
            </tr>
        </table>
        <table style="width: 10% " class="pull-left">
            <tr>
            <td> العميد الحسين عبيدلي </br>
                المكلف بتسيير ديوان تنمية رجيم معتوق</td> 
            </tr>
       
        </table>
        
        
        <br><br>
        <table style="width: 80%;margin-left: 150px" >
            <tr>
                <td>Date & Heure Sortie </td>
                <td><?php echo $form['datesortie'] ?>
                    <?php echo $form['heuresortie'] ?>
                </td>
                <td class="align_right">  تاريخ الخروج وساعة </td>
            </tr>
            <tr>
                <td>Date & Heure Arrivé </td>
                <td><?php echo $form['datearrive'] ?>
                    <?php echo $form['heurearrive'] ?>
                </td>
                <td class="align_right">  تاريخ العودة وساعة  </td>
            </tr>
        </table>
        <br><br><br>
    
         <table style="width: 10%" class="pull-right" >
             <tr><td>إمضاء العون</td></tr>
             <tr>
                <td><?php echo $form['signatureagents'] ?></td>
            </tr>
        </table>  
     <table style="width: 20%" class="pull-left" >
         <tr><td>إمضاء وختم الرئيس المباشر</td></tr>
         <tr>
                <td><?php echo $form['signaturedirecteur'] ?></td>
            </tr>
        </table>  
        
    </fieldset>        
</diV>
<style>

    .align_right{
        text-align: right;
        margin-right: 10px;
        font-size: 14px;
    }

</style>
