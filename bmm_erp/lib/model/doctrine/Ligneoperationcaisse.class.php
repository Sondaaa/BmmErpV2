<?php

/**
 * Ligneoperationcaisse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Ligneoperationcaisse extends BaseLigneoperationcaisse {

    public function NumeroSeqDocumentAchatProvisoire($idtype) {
        $doc = Doctrine_Query::create()
                        ->select('COALESCE(MAX(a.numeroo),0) as numero')
                        ->from('ligneoperationcaisse a')
                        ->where('id_categorie=' . $idtype)->execute();

        return sprintf('%06d', $doc[0]['numero'] + 1);
    }
 public function getNumerodocachatQuitance() {
      
        return sprintf('%06d', $this->getNumeroo());
    }
    public function getNumerodocachat() {
        $date=date('y');
        if($this->getDateoperation())
            $date=date('y',  strtotime ($this->getDateoperation ()));
        return $date.'/'.sprintf('%06d', $this->getNumeroo());
    }

    public function getArrayDocumentsachats() {
        $ligneoperation = Doctrine_Query::create()
                ->select('p.id_docachat as id')
                ->from('ligneoperationcaisse p')
                ->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        
        //die($doc_bci_non_imputer);
        return $ligneoperation;
    }

    public function getHtmlDocProvisoirecaisse() {
        $html = '<style>td{font-size:12px;}label{font-weight:bold;}</style>';
        //style="color: #146508" ;color:#840707 color:#840707
        $html.=' 
            <h3>FICHE QUITTANCE ' . $this->getCategorieoperation() . '</h3>
            <table border="1" style="padding:1%">
                <tr>
                    <td colspan="2" ><h4>Données De base</h4></td>
                </tr>
                <tr>
                    <td style="width:30%"><label>Numéro</label></td>
                    <td style="width:70%">' . $this->getNumerodocachat() . '</td>
                </tr>
                <tr>
                    <td><label>Date Création</label></td>
                    <td>' . date('d/m/Y', strtotime($this->getDateoperation())) . '</td>
                </tr>
                <tr>
                    <td><label>Utilisateur</label></td>
                    <td>' . $this->getUtilisateur() . '</td>
                </tr>
                <tr>
                    <td><label>Démarcheur </label></td>
                    <td>' . $this->getDemarcheur() . '</td>
                </tr>
            </table>
            
            <table border="1" style="padding:1%">
                <tbody>
                    <tr><td colspan="2" ><h4>Informations sur le Budget && Trésorerie</h4></td></tr>
                    <tr>
                        <td style="width:30%"><label>Budget</label></td>
                        <td style="width:70%">' . $this->getLigprotitrub() . '</td>
                    </tr>
                    <tr>
                        <td style="width:30%"><label>Trésorerie</label></td>
                        <td style="width:70%;">' . $this->getCaissesbanques()->getLibelle() . '</td>
                    </tr>
                    <tr><td colspan="2" ><h4>Données de document d\'achat</h4></td></tr>
                    <tr>
                        <td><label>Type Document achat</label></td>
                        <td>' . $this->getDocumentachat()->getTypedoc() . '</td>
                    </tr>
                    <tr>
                        <td><label>Document achats</label></td>
                        <td>' . $this->getDocumentachat()->getNumerodocachat() . '</td>
                    </tr>                    
                    <tr>
                        <td><label>Mnt. Encaisser</label></td>
                        <td>' . $this->getMntoperation() . ' TND</td>
                    </tr>
                </tbody>
            </table>';

        return $html;
    }

}
