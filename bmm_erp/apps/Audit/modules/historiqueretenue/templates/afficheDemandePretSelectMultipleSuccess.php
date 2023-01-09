<div class="col-lg-1"></div>
<div class="form-group">
    <div class="col-sm-12" id="zone_agent_pret">
        <legend class="control-label no-padding-top">Liste des Agents qui ont une demande De Prêt</legend>
        <select multiple="multiple" size="7" name="historiqueretenue[pret]" id="id_demandepret">
            <?php for ($i = 0; $i < sizeof($listedocs); $i++): ?>
                <option value="<?php echo $listedocs[$i]['id']; ?>"><?php echo $listedocs[$i]['libelle']; ?></option>
            <?php endfor; ?>
        </select>
        <div class="hr hr-16 hr-dotted"></div>
    </div>
</div>