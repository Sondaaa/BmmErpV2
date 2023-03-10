<?php

/**
 * Attestationdesalaire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProjectTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Attestationdesalaire extends BaseAttestationdesalaire {

    public function ReadHtmlAttestationSalaire() {

        $html = '<div class="titre">'
                . '<h3> ATTESTAION DE SALAIRE' . '</h3>
                    </div><br>';
        $html.='<p >'
                . "<i> "
                . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                . "Le Directeur Général  de l'Office de Développement de <br>"
                . '&nbsp;&nbsp;&nbsp;' . $this->getLieutravail() . ','
                . " soussigné,  atteste   par la  présente que :<br><br>"
                . "&nbsp;&nbsp;&nbsp;"
                . "<table><tbody><tr><td><b>";

        if ($this->getAgents()->getSexe()->getId() == 1):
            $html.="Mr.";
        else:
            $html.="Mme.";
        endif;
        $html.=$this->getAgents()->getNomcomplet() . "  " . $this->getAgents()->getPrenom()
                . "</b></td><td><b>I.U:" . $this->getAgents()->getIdrh() . "</b></td></tr><br>"
                . "<tr><td>Grade: <b>" . $this->getContrat()->getSalairedebase()->getGrade() . "</b></td><td></td><br></tr>"
                . "<tr><td>Situation administrative: <b>" . $this->getContrat()->getTypecontrat()->getLibelle() . "</b></td><td></td></tr>"
                . "<tr><td>perçoit les émoluments annuels brut globaux suivants :<br></td><td></td></tr>"
                . "</tbody></table>"
        ;
        $html.= '<table id="tab" class="tableligne">
            <tbody>
                <tr> <td style="background-color:#ddd;"><h4>Indemnités et primes</h4></td>
                    <td style="background-color:#ddd;"><h4>Montant</h4></td></tr>
                <tr>';
        $html.='<td>' . 'Salaire de base' . '</td>' . '<td>' 
                . number_format($this->getContrat()->getSalairedebase()->getMotant() * 12, 3, '.', ' ') . '</td></tr>';

        $ligneprime = Doctrine_Core::getTable('ligneprimecontrat')->findByIdContrat($this->getContrat()->getId());
        $resultat1 = 0;
        foreach ($ligneprime as $p):
            $html.= '<tr>'
                    . '<td>' . $p->getPrimes()->getTitreprimes()->getLibelle() . '</td>'
                    . '<td>' . number_format($p->getPrimes()->getMontant() * 12, 3, '.', ' ') . '</td>'
                    . '</tr>';
            $resultat1 = $resultat1 + $p->getPrimes()->getMontant() * 12;
        endforeach;
        
        $resultat = $resultat1 + $this->getContrat()->getSalairedebase()->getMotant() * 12;
        $html.=' <tr>
                    <td style="background-color:#ddd;"><h4 style="float:right;font-weight:bold;">Total:</h4></td>
                    <td style="background-color:#ddd;">' . number_format($resultat, 3, '.', ' ') . '</td>
                </tr>           
            </tbody>
        </table>';
        
        $html.='<br><br><br><h11>Arrêtée  la présente attestation à la somme de  ' . chiffreToLettre::cvnbst($resultat) . '</h11> ';
        return $html;
    }

}
