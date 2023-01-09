<div id="sf_admin_container">
<h1>Attesttation de salaire : </h1>
    <table>
        <tr>
           <td>        <label> Choisir l'Agents </label></td>
                                    <td><?php
                                        $mags = Doctrine_Core::getTable('agents')->findAll();
                                        ?>

                                        <select id="magagents">
                                            <option></option>
                                            <?php foreach ($mags as $magagents) { ?>
                                                <option value="<?php echo $magagents->getId() ?>"><?php echo $magagents ?></option>
                                            <?php } ?>
                                        </select></td>

            </td>
        </tr>
    </table>
     <div style="text-align: center">    <a   href="<?php echo url_for('') ?>"  ng-model="BtnExporter"  target="_blanc" style="margin-left: 70%" type="button"    class="btn btn-primary1">Exporter PDF</a></div>
 
</div>

