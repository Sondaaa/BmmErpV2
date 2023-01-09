<div style="overflow: auto; width: 100%;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="smaller lighter blue no-margin"></h4>
            </div>
            <div class="modal-body" >
                <fieldset>
                    <table>
                        <tr> 
                            <?php
                            $type = Doctrine_Query::create()
                                    ->select("*")
                                    ->from('avance')
                                    ->execute();
                            ?>
                            <td>Type Avance</td>
                            <td>
                                <select  id="" >
                                    <option></option>
                                    <?php foreach ($type as $t) : ?>
                                        <option value="<?php echo $t->getId(); ?>">  <?php echo $t->getLibelle(); ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </td>
                            <td>
                                <select  id="demandeavance_mois" >
                                    <option <?php if (date('m') == '1'): ?>selected="true"<?php endif; ?> value="01">Janvier</option>
                                    <option <?php if (date('m') == '2'): ?>selected="true"<?php endif; ?> value="02">Février</option>
                                    <option <?php if (date('m') == '3'): ?>selected="true"<?php endif; ?> value="03">Mars</option>
                                    <option <?php if (date('m') == '4'): ?>selected="true"<?php endif; ?> value="04">Avril</option>
                                    <option <?php if (date('m') == '5'): ?>selected="true"<?php endif; ?> value="05">Mai</option>
                                    <option <?php if (date('m') == '6'): ?>selected="true"<?php endif; ?> value="06">Juin</option>
                                    <option <?php if (date('m') == '7'): ?>selected="true"<?php endif; ?> value="07">Juillet</option>
                                    <option <?php if (date('m') == '8'): ?>selected="true"<?php endif; ?> value="08">Août</option>
                                    <option <?php if (date('m') == '9'): ?>selected="true"<?php endif; ?> value="09">Septembre</option>
                                    <option <?php if (date('m') == '10'): ?>selected="true"<?php endif; ?> value="10">Octobre</option>
                                    <option <?php if (date('m') == '11'): ?>selected="true"<?php endif; ?> value="11">Nouvembre</option>
                                    <option <?php if (date('m') == '12'): ?>selected="true"<?php endif; ?> value="12">Décembre</option>
                                </select>
                            </td>
                            <td>Anée</td>
                            <td>
                                <select id="demandeavance_annee">
                                    <?php for ($i = 2018; $i <= date('Y'); $i++): ?>
                                        <option <?php if ($i == date('Y')): ?>selected="true"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <div class="modal-footer" >
                    <button type="button" value="Fermer" class="btn  pull-left"  onclick="fermeravance()" >

                        Fermer</button>


                </div>
            </div>


        </div>
    </div>
</div>
<script  type="text/javascript">
    function chargerpersonne1(id, mat, nom)
    {
        //alert(mat);
        $('#my-modal').removeClass('in');
        $('#my-modal').css('display', 'none');
        $('#inpersonne').val(id);
        $('#nomagentsdebut').val(nom);
        $('#iddebut').val(mat);

    }
    function fermeravance()
    {
        $('#my-modal').removeClass('in');
        $('#my-modal').css('display', 'none');
    }

</script>