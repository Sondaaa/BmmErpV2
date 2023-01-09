<?php if (count($series) == 0): ?>
    <tr>
        <td style="text-align:center; font-weight: bold; font-size: 16px !important;" colspan="8">Liste des series vide</td>
    </tr>
<?php endif; ?>
<?php foreach ($series as $serie): ?>
    <tr>
        <td style="text-align: center;"><?php echo $serie->getPrefixe(); ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($serie->getDatedebut())); ?></td>
        <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($serie->getDatefin())); ?></td>
        <td style="text-align: center;"><?php echo sprintf("%03s", $serie->getNumerodebut()); ?></td>
        <td style="text-align: center;"><?php echo sprintf("%03s", $serie->getNumerofin()); ?></td>
        <td style="text-align: center;"><?php echo sprintf("%03s", $serie->getAttendu()); ?></td>
        <td style="text-align: center; background-color: #D15B47">
            <?php
            $pieces_non_valide = PiececomptableTable::getInstance()->findByIdSerieAndValide($serie->getId(), 0);
            if ($pieces_non_valide->count() == 0)
                $serie_bloque_valide = 1;
            else
                $serie_bloque_valide = 0;
            $bloque = $serie->getIsBloque();
            if ($serie_bloque_valide = 1):
                if ($bloque == 1):
                    ?>
                    <i class="ace-icon fa fa-check-square-o bigger-140" onclick="checkBloque('<?php echo $serie->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer;"></i>
                <?php else: ?>
                    <i class="ace-icon fa fa-square-o bigger-140" onclick="checkBloque('<?php echo $serie->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer"></i>
                <?php endif; ?>
            <?php endif; ?>
        </td>
        <td style="text-align: center; background-color: #87B87F">
            <?php if ($serie->getIsValide() == 1): ?>
                <i class="ace-icon fa fa-check-square-o bigger-140" onclick="checkValide('<?php echo $serie->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer;"></i>
            <?php else: ?>
                <i class="ace-icon fa fa-square-o bigger-140" onclick="checkValide('<?php echo $serie->getId() ?>', '<?php echo $journal ?>')" style="cursor: pointer"></i>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>