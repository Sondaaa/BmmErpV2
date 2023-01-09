<?php

require_once dirname(__FILE__) . '/../lib/tableauxammortisementGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/tableauxammortisementGeneratorHelper.class.php';

/**
 * tableauxammortisement actions.
 *
 * @package    InventaireTest
 * @subpackage tableauxammortisement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tableauxammortisementActions extends autoTableauxammortisementActions {

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@tableauxammortisement');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());

        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($request->getParameter('btn_calcul')) {
            $id_immob = "";

            if ($this->filters['id_immobilisation']->getValue()) {
                $id_immob = $this->filters['id_immobilisation']->getValue();
                $immob = ImmobilisationTable::getInstance()->find($id_immob);
                if ($immob)
                    $this->CalculeTableauxAmmortisement($immob, '', '');
            }
        }
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@tableauxammortisement');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }

    protected function buildQuery() {

        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    public function executeCalcultimmob(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $contenu = $request->getParameter('contenu');
        $idtable = $request->getParameter('idtable');
        $immob = ImmobilisationTable::getInstance()->find($id);
        if ($immob)
            $this->CalculeTableauxAmmortisement($immob, $contenu, $idtable);

        $this->redirect('tableauxammortisement/index');
    }

    public function CalculeTableauxAmmortisement($immo, $amrti_00, $tableid) {

        //______date fin d'années
        //____________________verif existance
        $date_annees = date('Y') . "-12-31";

        $taux_ammortisement = 0;
        if (!$immo->getTauxammor2()) {
            if ($immo->getTauxammortisement()) {
                $taux_ammortisement = $immo->getTauxammortisement()->getTauxammortisement();
                $taux_ammortisement = str_replace("%", "", $taux_ammortisement);
            }
            $immo->setTauxammor2($taux_ammortisement / 100);
            $immo->save();
        } else
            $taux_ammortisement = $immo->getTauxammor2();

        if ($taux_ammortisement != 0) {
            $tableauxammortisement = Doctrine_Core::getTable('tableauxammortisement')->findByDatetableuxAndIdImmobilisation($date_annees, $immo->getId());
            if (count($tableauxammortisement) == 0) {
                $table = new Tableauxammortisement();

                $table->setIdImmobilisation($immo->getId());
                $table->setDateAquisition($immo->getDateacquisition());
                $table->setDatetableux($date_annees);
                $table->setTaux($taux_ammortisement);
                $table->setVorigine($immo->getMntttc());

                //_____________calcul Amortisement Interieur && dotation
                $tableaux = Doctrine_Core::getTable('tableauxammortisement')->findByIdImmobilisation($immo->getId());

                $date1 = strtotime($immo->getDateacquisition());
                $date2 = strtotime(date("Y") . "-12-31");
                $nbjour = ($date2 - $date1) / 86400;
                //$taux_ammo1=str_replace(",", ".", $immo->getTauxammortisement()->getTauxammortisement());
                $taux = $taux_ammortisement;

                if (count($tableaux) == 0) {
                    if ($nbjour <= 365) {
                        $table->setAmrtinterieur("0");
                        if ($taux != "1.0000")
                            $dotation = ($immo->getMntttc() * $taux * ($nbjour + 1)) / 365;
                        else
                            $dotation = $immo->getMntttc() * $taux;

                        $table->setDotation($dotation);
                        $table->setAmrtcumile($dotation);
                        $table->setVcn($immo->getMntttc() - $dotation);
                    }
                } else {
                    $table->setAmrtinterieur("" . $tableaux[count($tableaux) - 1]->getAmrtcumile() . "");
                    $dotation1 = $immo->getMntttc() * $taux;
                    $dotation2 = $immo->getMntttc() - $tableaux[count($tableaux) - 1]->getAmrtcumile();
                    $dotation = $dotation1;
                    if ($dotation1 < $dotation2) {
                        $table->setDotation($dotation1);
                    } else {
                        $table->setDotation($dotation2);
                        $dotation = $dotation2;
                    }
                    $table->setAmrtcumile($dotation + $tableaux[count($tableaux) - 1]->getAmrtcumile());
                    $vcn = $immo->getMntttc() - ($dotation + $tableaux[count($tableaux) - 1]->getAmrtcumile());

                    if ($vcn >= 0)
                        $table->setVcn($vcn);
                    else
                        $table->setVcn(0.000);
                }

                $table->save();
            } else {
                if ($tableid)
                    $table = Doctrine_Core::getTable('tableauxammortisement')->findOneById($tableid);

                if ($amrti_00 != "") {
                    $table->setAmrtinterieur($amrti_00);
                    $dotation1 = $immo->getMntttc() * $table->getTaux();
                    $dotation2 = $immo->getMntttc() - $amrti_00;
                    $dotation = $dotation1;
                    if ($dotation1 < $dotation2) {
                        $table->setDotation($dotation1);
                    } else {
                        $table->setDotation($dotation2);
                        $dotation = $dotation2;
                    }
                    $table->setAmrtcumile($dotation + $amrti_00);
                    $vcn = $immo->getMntttc() - ($dotation + $amrti_00);

                    if ($vcn >= 0)
                        $table->setVcn($vcn);
                    else
                        $table->setVcn(0.000);
                    $table->save();
                }
            }
        }
    }

    public function executeImprimer(sfWebRequest $request) {
        $this->id = $request->getParameter('id');
        $this->id_categorie = $request->getParameter('id_categorie');
        $this->id_famille = $request->getParameter('id_famille');
        $this->id_sousfamille = $request->getParameter('id_sousfamille');
        $this->annee = $request->getParameter('annee');
    }

    public function executeImprimerType(sfWebRequest $request) {
        $this->date = $request->getParameter('date');
        $this->type = $request->getParameter('type');
    }

    public function executeCalculerAmortissement(sfWebRequest $request) {
        //______date fin d'années
        //____________________verif existance
        $param = ParametreamortissementTable::getInstance()->findAll()->getFirst();
        if ($param) {
            $date_annees = $param->getDateamortissement();
            $date_annees_first = date('Y', strtotime($param->getDateamortissement())) . '-01-01';
        } else {
            $date_annees = date('Y') . "-12-31";
            $date_annees_first = date('Y') . "-01-01";
        }

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();

        //Vérification et insertion des taux d'amortissement des immobilisation
        $query = "UPDATE immobilisation
                    SET tauxammor2 = (select REPLACE(TO_CHAR(TO_NUMBER(REPLACE(tauxammortisement, '%', ''), '9999.99'), '9990.99'), ' ', '') as tauxammortisement from tauxammortisement where immobilisation.tauxammortisement = tauxammortisement.id limit 1)
                    WHERE tauxammor2 IS NULL";

        $resultat = $conn->fetchAssoc($query);

        //Suppression les anciens lignes de cette date d'amortissement
        $query_delete = "DELETE FROM tableauxammortisement WHERE datetableux = '" . $date_annees . "' ";

        $resultat_delete = $conn->fetchAssoc($query_delete);

        //Insertion des colonnes fixes des immobilisations
        //& calcule des dotations courantes et les valeurs antérieurs
        $query_insert = "INSERT INTO tableauxammortisement"
                . "(id_immobilisation, date_aquisition, vorigine, taux, dotation, amrtinterieur, datetableux)"
                . " SELECT id, dateacquisition, mntttc, tauxammor2, "
                . " ROUND(((mntttc * TO_NUMBER(tauxammor2, '9999.99') / 100))::numeric, 3), "
                . " CASE WHEN "
                . " extract(year from '" . $date_annees . "'::timestamp) - extract(year from dateacquisition::timestamp) > 1 "
                . " THEN "
                . " ROUND((((extract(year from '" . $date_annees . "'::timestamp) - extract(year from dateacquisition::timestamp) - 1) * (mntttc * TO_NUMBER(tauxammor2, '9999.99') / 100)) + ((extract(day from CONCAT(extract(year from dateacquisition::timestamp), '-12-31')::timestamp - dateacquisition::timestamp) / 365) * (mntttc * TO_NUMBER(tauxammor2, '9999.99') / 100)))::numeric, 3) "
                . " ELSE "
                . " ROUND(((extract(day from CONCAT(extract(year from dateacquisition::timestamp), '-12-31')::timestamp - dateacquisition::timestamp) / 365) * (mntttc * TO_NUMBER(tauxammor2, '9999.99') / 100))::numeric, 3) "
                . " END, "
                . " '" . $date_annees . "' "
                . " FROM immobilisation where dateacquisition IS NOT NULL and (datemiseenrebut IS NULL or extract(year from datemiseenrebut::timestamp) = extract(year from '" . $date_annees . "'::timestamp)) ";

        $resultat_insert = $conn->fetchAssoc($query_insert);

        //Vérification des valeurs antérieurs (remettre à zéro en cas de dépassement du valeur origine)
        $query_update_depassement_anterieur = "UPDATE tableauxammortisement SET dotation='0', amrtinterieur=vorigine, amrtcumile=vorigine, vcn='0' "
                . " WHERE datetableux= '" . $date_annees . "' AND TO_NUMBER(amrtinterieur, '9999999999.999') > TO_NUMBER(vorigine, '9999999999.999')";

        $resultat_update_depassement_anterieur = $conn->fetchAssoc($query_update_depassement_anterieur);

        //Vérification des dotations s'il y a de dépassement de la valeur origine (dotation + amrtinterieur > vorigine)
        $query_update_depassement_dotation = "UPDATE tableauxammortisement SET dotation=TO_NUMBER(vorigine, '9999999999.999') - TO_NUMBER(amrtinterieur, '9999999999.999'), amrtcumile=vorigine, vcn='0' "
                . " WHERE datetableux= '" . $date_annees . "' AND TO_NUMBER(amrtinterieur, '9999999999.999') + TO_NUMBER(dotation, '9999999999.999') > TO_NUMBER(vorigine, '9999999999.999')";

        $resultat_update_depassement_dotation = $conn->fetchAssoc($query_update_depassement_dotation);

        //Calcule de amortissement antérieur et VCN
        $query_update_reste = "UPDATE tableauxammortisement SET amrtcumile=TO_NUMBER(dotation, '9999999999.999') + TO_NUMBER(amrtinterieur, '9999999999.999'), vcn=TO_NUMBER(vorigine, '9999999999.999') - (TO_NUMBER(dotation, '9999999999.999') + TO_NUMBER(amrtinterieur, '9999999999.999')) "
                . " WHERE datetableux='" . $date_annees . "' AND (TO_NUMBER(amrtinterieur, '9999999999.999') + TO_NUMBER(dotation, '9999999999.999') <= TO_NUMBER(vorigine, '9999999999.999')) AND vcn IS NULL ";

        $resultat_update_reste = $conn->fetchAssoc($query_update_reste);

        die("OK");
    }

    public function executeVariation(sfWebRequest $request) {
        
    }

}
