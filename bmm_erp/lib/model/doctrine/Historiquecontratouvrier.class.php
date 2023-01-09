<?php

/**
 * Historiquecontratouvrier
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Historiquecontratouvrier extends BaseHistoriquecontratouvrier {

    public function ReadHtmlSpecialiteListe($id, $id_ouvrier, $annee) {
        $specialite = SpecialiteouvrierTable::getInstance()->find($id);

        $listes = Doctrine_Query::create()
                ->select("o.*")
                ->from('Ouvrier o')
                ->leftJoin('o.Contratouvrier c')
                ->leftJoin('c.Historiquecontratouvrier h')
                ->where('h.id_specialite = ' . $id);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        if ($id_ouvrier != '0'):
            $listes = $listes->andWhere('o.id = ' . $id_ouvrier);
        endif;

        $listes = $listes->execute();

        if ($annee == '')
            $annee = 'Toutes les années';

        $html = '<h3 style="font-size:18px;">Historique des Ouvriers<br> Spécialité <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الاختصاص)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $specialite . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Matricule</b></td>
                        <td style="width:47%;text-align:center;"><b>Ouvrier</b></td>
                        <td style="width:23%;text-align:center;"><b>C.I.N</b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $ouvrier):
                $html.='<tr>
                        <td style="height:20px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $ouvrier->getMatricule() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getCin() . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }

    public function ReadHtmlSpecialiteHistorique($id_specialite, $id_ouvrier, $annee) {
        $specialite = SpecialiteouvrierTable::getInstance()->find($id_specialite);
        $ouvrier = OuvrierTable::getInstance()->find($id_ouvrier);
        $listes = Doctrine_Query::create()
                ->select("h.*")
                ->from('Historiquecontratouvrier h')
                ->leftJoin('h.Contratouvrier c')
                ->where('h.id_specialite = ' . $id_specialite)
                ->andWhere('c.id_ouvrier = ' . $id_ouvrier);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        $listes = $listes->orderBy('h.datedebutcontrat')
                ->execute();

        if ($annee == '')
            $annee = 'Toutes les années';
        
        $html = '<h3 style="font-size:18px;">Historique d\'ouvrier<br>' . $ouvrier . '<br> Spécialité <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الاختصاص)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $specialite . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table cellspace="0" cellpadding="3">
                    <tr>
                        <td style="width:30%;"><b>Matricule :</b> ' . $ouvrier->getMatricule() . '</td>
                        <td style="width:50%;"><b>Ouvrier :</b> ' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="width:20%;"><b>C.I.N :</b> ' . $ouvrier->getCin() . '</td>
                    </tr>
                </table><hr>&nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Chantier <span style="font-size:16px;font-family:aealarabiya;color:#000;">(الحضيرة)</span></b></td>
                        <td style="width:40%;text-align:center;"><b>Lieu Affectation <span style="font-size:16px;font-family:aealarabiya;color:#000;">(مكان العمل)</span></b></td>
                        <td style="width:30%;text-align:center;"><b>Période <span style="font-size:16px;font-family:aealarabiya;color:#000;">(الفترة)</span></b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $historique):
                $html.='<tr>
                        <td style="width:7%;height:20px;text-align:center;">' . $i . '</td>
                        <td style="width:23%;text-align:center;">' . $historique->getChantier() . '</td>
                        <td style="width:40%;text-align:center;">' . $historique->getLieuaffectationouvrier() . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatedebutcontrat())) . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatefoncontrat())) . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }
    
    public function ReadHtmlLieuListe($id, $id_ouvrier, $annee) {
        $lieu = LieuaffectationouvrierTable::getInstance()->find($id);

        $listes = Doctrine_Query::create()
                ->select("o.*")
                ->from('Ouvrier o')
                ->leftJoin('o.Contratouvrier c')
                ->leftJoin('c.Historiquecontratouvrier h')
                ->where('h.id_lieu = ' . $id);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        if ($id_ouvrier != '0'):
            $listes = $listes->andWhere('o.id = ' . $id_ouvrier);
        endif;

        $listes = $listes->execute();

        if ($annee == '')
            $annee = 'Toutes les années';

        $html = '<h3 style="font-size:18px;">Historique des Ouvriers<br> Lieu Affectation <span style="font-size:20px;font-family:aealarabiya;color:#000;">(مكان العمل)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $lieu . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Matricule</b></td>
                        <td style="width:47%;text-align:center;"><b>Ouvrier</b></td>
                        <td style="width:23%;text-align:center;"><b>C.I.N</b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $ouvrier):
                $html.='<tr>
                        <td style="height:20px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $ouvrier->getMatricule() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getCin() . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }

    public function ReadHtmlLieuHistorique($id_lieu, $id_ouvrier, $annee) {
        $lieu = LieuaffectationouvrierTable::getInstance()->find($id_lieu);
        $ouvrier = OuvrierTable::getInstance()->find($id_ouvrier);
        $listes = Doctrine_Query::create()
                ->select("h.*")
                ->from('Historiquecontratouvrier h')
                ->leftJoin('h.Contratouvrier c')
                ->where('h.id_lieu = ' . $id_lieu)
                ->andWhere('c.id_ouvrier = ' . $id_ouvrier);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        $listes = $listes->orderBy('h.datedebutcontrat')
                ->execute();

        if ($annee == '')
            $annee = 'Toutes les années';
        
        $html = '<h3 style="font-size:18px;">Historique d\'ouvrier<br>' . $ouvrier . '<br> Lieu Affectation <span style="font-size:20px;font-family:aealarabiya;color:#000;">(مكان العمل)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $lieu . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table cellspace="0" cellpadding="3">
                    <tr>
                        <td style="width:30%;"><b>Matricule :</b> ' . $ouvrier->getMatricule() . '</td>
                        <td style="width:50%;"><b>Ouvrier :</b> ' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="width:20%;"><b>C.I.N :</b> ' . $ouvrier->getCin() . '</td>
                    </tr>
                </table><hr>&nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Chantier (الحضيرة)</b></td>
                        <td style="width:40%;text-align:center;"><b>Spécialité (الاختصاص)</b></td>
                        <td style="width:30%;text-align:center;"><b>Période (الفترة)</b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $historique):
                $html.='<tr>
                        <td style="width:7%;height:20px;text-align:center;">' . $i . '</td>
                        <td style="width:23%;text-align:center;">' . $historique->getChantier() . '</td>
                        <td style="width:40%;text-align:center;">' . $historique->getSpecialiteouvrier() . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatedebutcontrat())) . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatefoncontrat())) . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }
    
    public function ReadHtmlChantierListe($id, $id_ouvrier, $annee) {
        $chantier = ChantierTable::getInstance()->find($id);

        $listes = Doctrine_Query::create()
                ->select("o.*")
                ->from('Ouvrier o')
                ->leftJoin('o.Contratouvrier c')
                ->leftJoin('c.Historiquecontratouvrier h')
                ->where('h.id_chantier = ' . $id);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        if ($id_ouvrier != '0'):
            $listes = $listes->andWhere('o.id = ' . $id_ouvrier);
        endif;

        $listes = $listes->execute();

        if ($annee == '')
            $annee = 'Toutes les années';

        $html = '<h3 style="font-size:18px;">Historique des Ouvriers<br>Chantier <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الحضيرة)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $chantier . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Matricule</b></td>
                        <td style="width:47%;text-align:center;"><b>Ouvrier</b></td>
                        <td style="width:23%;text-align:center;"><b>C.I.N</b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $ouvrier):
                $html.='<tr>
                        <td style="height:20px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $ouvrier->getMatricule() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getCin() . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }

    public function ReadHtmlChantierHistorique($id_chantier, $id_ouvrier, $annee) {
        $chantier = ChantierTable::getInstance()->find($id_chantier);
        $ouvrier = OuvrierTable::getInstance()->find($id_ouvrier);
        $listes = Doctrine_Query::create()
                ->select("h.*")
                ->from('Historiquecontratouvrier h')
                ->leftJoin('h.Contratouvrier c')
                ->where('h.id_chantier = ' . $id_chantier)
                ->andWhere('c.id_ouvrier = ' . $id_ouvrier);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        $listes = $listes->orderBy('h.datedebutcontrat')
                ->execute();

        if ($annee == '')
            $annee = 'Toutes les années';
        
        $html = '<h3 style="font-size:18px;">Historique d\'ouvrier<br>' . $ouvrier . '<br>Chantier <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الحضيرة)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $chantier . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table cellspace="0" cellpadding="3">
                    <tr>
                        <td style="width:30%;"><b>Matricule :</b> ' . $ouvrier->getMatricule() . '</td>
                        <td style="width:50%;"><b>Ouvrier :</b> ' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="width:20%;"><b>C.I.N :</b> ' . $ouvrier->getCin() . '</td>
                    </tr>
                </table><hr>&nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:35%;text-align:center;"><b>Lieu Affectation <span style="font-size:16px;font-family:aealarabiya;color:#000;">(مكان العمل)</span></b></td>
                        <td style="width:28%;text-align:center;"><b>Spécialité <span style="font-size:16px;font-family:aealarabiya;color:#000;">(الاختصاص)</span></b></td>
                        <td style="width:30%;text-align:center;"><b>Période <span style="font-size:16px;font-family:aealarabiya;color:#000;">(الفترة)</span></b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $historique):
                $html.='<tr>
                        <td style="width:7%;height:20px;text-align:center;">' . $i . '</td>
                        <td style="width:35%;text-align:center;">' . $historique->getLieuaffectationouvrier() . '</td>
                        <td style="width:28%;text-align:center;">' . $historique->getSpecialiteouvrier() . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatedebutcontrat())) . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatefoncontrat())) . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }
    
    public function ReadHtmlSituationListe($id, $id_ouvrier, $annee) {
        $situation = SituationadminouvrierTable::getInstance()->find($id);

        $listes = Doctrine_Query::create()
                ->select("o.*")
                ->from('Ouvrier o')
                ->leftJoin('o.Contratouvrier c')
                ->leftJoin('c.Historiquecontratouvrier h')
                ->where('h.id_situtaion = ' . $id);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        if ($id_ouvrier != '0'):
            $listes = $listes->andWhere('o.id = ' . $id_ouvrier);
        endif;

        $listes = $listes->execute();

        if ($annee == '')
            $annee = 'Toutes les années';

        $html = '<h3 style="font-size:18px;">Historique des Ouvriers<br>Situation Administrative <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الوضع الاداري)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $situation . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:23%;text-align:center;"><b>Matricule</b></td>
                        <td style="width:47%;text-align:center;"><b>Ouvrier</b></td>
                        <td style="width:23%;text-align:center;"><b>C.I.N</b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $ouvrier):
                $html.='<tr>
                        <td style="height:20px;text-align:center;">' . $i . '</td>
                        <td style="text-align:center;">' . $ouvrier->getMatricule() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="text-align:center;">' . $ouvrier->getCin() . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }

    public function ReadHtmlSituationHistorique($id_situation, $id_ouvrier, $annee) {
        $situation = SituationadminouvrierTable::getInstance()->find($id_situation);
        $ouvrier = OuvrierTable::getInstance()->find($id_ouvrier);
        $listes = Doctrine_Query::create()
                ->select("h.*")
                ->from('Historiquecontratouvrier h')
                ->leftJoin('h.Contratouvrier c')
                ->where('h.id_situtaion = ' . $id_situation)
                ->andWhere('c.id_ouvrier = ' . $id_ouvrier);

        if ($annee != ''):
            $listes = $listes->andWhere("h.datedebutcontrat >= '" . $annee . "-01-01'")
                    ->andWhere("h.datefoncontrat <= '" . $annee . "-12-31'");
        endif;

        $listes = $listes->orderBy('h.datedebutcontrat')
                ->execute();

        if ($annee == '')
            $annee = 'Toutes les années';
        
        $html = '<h3 style="font-size:18px;">Historique d\'ouvrier<br>' . $ouvrier . '<br>Situation Administrative <span style="font-size:20px;font-family:aealarabiya;color:#000;">(الوضع الاداري)</span> : <span style="font-size:20px;font-family:aealarabiya;color:#000;">' . $situation . '</span><br>Année : ' . $annee . '</h3>
            &nbsp;<br>';

        $html.='<table cellspace="0" cellpadding="3">
                    <tr>
                        <td style="width:30%;"><b>Matricule :</b> ' . $ouvrier->getMatricule() . '</td>
                        <td style="width:50%;"><b>Ouvrier :</b> ' . $ouvrier->getNom() . ' ' . $ouvrier->getPrenom() . '</td>
                        <td style="width:20%;"><b>C.I.N :</b> ' . $ouvrier->getCin() . '</td>
                    </tr>
                </table><hr>&nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:7%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:17%;text-align:center;"><b>Chantier<br><span style="font-size:16px;font-family:aealarabiya;color:#000;">(الحضيرة)</span></b></td>
                        <td style="width:26%;text-align:center;"><b>Lieu Affectation<br><span style="font-size:16px;font-family:aealarabiya;color:#000;">(مكان العمل)</span></b></td>
                        <td style="width:20%;text-align:center;"><b>Spécialité<br><span style="font-size:16px;font-family:aealarabiya;color:#000;">(الاختصاص)</span></b></td>
                        <td style="width:30%;text-align:center;"><b>Période<br><span style="font-size:16px;font-family:aealarabiya;color:#000;">(الفترة)</span></b></td>
                    </tr>';
        $i = 1;
        if ($listes->count() != 0):
            foreach ($listes as $historique):
                $html.='<tr>
                        <td style="width:7%;height:20px;text-align:center;">' . $i . '</td>
                        <td style="width:17%;text-align:center;">' . $historique->getChantier() . '</td>
                        <td style="width:26%;text-align:center;">' . $historique->getLieuaffectationouvrier() . '</td>
                        <td style="width:20%;text-align:center;">' . $historique->getSpecialiteouvrier() . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatedebutcontrat())) . '</td>
                        <td style="width:15%;text-align:center;">' . date('d/m/Y', strtotime($historique->getDatefoncontrat())) . '</td>
                    </tr>';
                $i++;
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'ouvriers</td>
                    </tr>';
        endif;

        $html.='</table>';

        return $html;
    }

}
