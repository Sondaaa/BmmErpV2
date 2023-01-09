<select id="pickList_journal" multiple="multiple" size="15">
<?php foreach ($journals as $journal) : ?>
    <option name="list_journal" value="<?php echo $journal->getId() ?>"><?php echo $journal->getCode() . ' ' . $journal->getLibelle() ?></option>
<?php endforeach; ?>
</select>