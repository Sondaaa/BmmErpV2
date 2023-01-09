<div class="table-responsive">
    
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>Chemin</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($piecejoints as $piecejoint): ?>
                <tr>
                    <td>
                        <a target="_blanc" href="<?php echo sfconfig::get('sf_appdir') . 'uploads/scanner/' . $piecejoint->getChemin() ?>">
                            <?php echo $piecejoint->getChemin() ?>
                        </a>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>