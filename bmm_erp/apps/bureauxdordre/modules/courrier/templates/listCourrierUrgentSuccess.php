<div id="sf_admin_container">
    <h1 id="replacediv"> Courriers 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Urgents
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <table>
            <thead>
                <tr>
                    <th style="text-align: center; width: 10%;">Numéro</th>
                    <th style="text-align: center; width: 8%;">Date de Création</th>
                    <th style="width: 33%;">Titre</th>
                    <th style="text-align: center; width: 6%;">Type</th>
                    <th style="width: 17%;">Expéditeur</th>
                    <th style="text-align: center; width: 10%;">Courrier Source</th>
                    <th style="text-align: center; width: 8%;">Date M.P Réponse</th>
                    <th style="text-align: center; width: 8%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u'; ?>
                <?php for ($i = 0; $i < sizeof($courriers); $i++): ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $courriers[$i]["numero"]; ?></td>
                        <td style="text-align: center;"><?php echo false !== strtotime($courriers[$i]["datecreation"]) ? date('d/m/Y', strtotime($courriers[$i]["datecreation"])) : '&nbsp;' ?></td>
                        <td <?php if (preg_match($rtl_chars_pattern, trim($courriers[$i]["titre"]))): ?> style="text-align: right;"<?php endif; ?>>
                            <?php echo trim($courriers[$i]["titre"]); ?>
                        </td>
                        <td style="text-align: center;"><?php echo trim($courriers[$i]["type"]); ?></td>
                        <td><?php echo trim($courriers[$i]["nexp"]); ?></td>
                        <td style="text-align: center;">
                            <?php if ($courriers[$i]["id_courrier"]): ?>
                                <?php
                                $query = "select courrier.id as id, concat(typecourrier.prefix,utilisateur.id,courrier.numero) as numero "
                                        . " from courrier, utilisateur, typecourrier "
                                        . " WHERE courrier.id = " . $courriers[$i]["id_courrier"] . " "
                                        . " AND courrier.id_type = typecourrier.id "
                                        . " AND utilisateur.id = courrier.id_user";
                                $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
                                $courrier_source = $conn->fetchAssoc($query);
                                ?>
                                <?php if (sizeof($courrier_source) > 0): ?>
                                    <a target="_blank" href="<?php echo url_for('courrier/shocimprimer?idcourrier=' . $courrier_source[0]["id"]) ?>">
                                        <?php echo trim($courrier_source[0]["numero"]); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;<?php if ($courriers[$i]["diff_date"] < 0): ?> color: #A43A05;<?php else: ?> color: #DA8028;<?php endif; ?>">
                            <?php echo false !== strtotime($courriers[$i]["mdreponse"]) ? date('d/m/Y', strtotime($courriers[$i]["mdreponse"])) . "<br>" : '&nbsp;' ?>
                            <?php echo trim($courriers[$i]["diff_date"]); ?> Jour(s)
                        </td>
                        <td style="text-align: center;">
                            <a target="_blank" href="<?php echo url_for('courrier/shocimprimer?idcourrier=' . $courriers[$i]["id"]) ?>">
                                <i class="fa fa-print"></i> Voir et Imprimer
                            </a>
                        </td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>