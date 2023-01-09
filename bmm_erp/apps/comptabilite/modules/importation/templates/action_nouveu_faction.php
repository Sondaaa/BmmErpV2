
public function executeGoPageAch(sfWebRequest $request) {

$exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
$date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
$date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
$reference = $request->getParameter('ref');
$fournisseur = $request->getParameter('frs');
$factures = FacturecomptableachatTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $fournisseur);

return $this->renderPartial("importation/liste_achat_partial", array("factures" => $factures));
}
 public function executeGoPageVen(sfWebRequest $request) {

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $clt = $request->getParameter('clt');
        $factures = FacturecomptableventeTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $clt);

        return $this->renderPartial("importation/liste_vente_partial", array("factures" => $factures));
    }
     public function executeGoPageOd(sfWebRequest $request) {

        $exercice = ExerciceTable::getInstance()->find($_SESSION['exercice_id']);
        $date_debut = $request->getParameter('date_debut', $exercice->getDateDebut());
        $date_fin = $request->getParameter('date_fin', $exercice->getDateFin());
        $reference = $request->getParameter('ref');
        $fournisseur = $request->getParameter('frs');
        $factures = FacturecomptableodTable::getInstance()->findByPeriodeAndType($date_debut, $date_fin, $reference, $fournisseur);

        return $this->renderPartial("importation/liste_od_partial", array("factures" => $factures));
    }
