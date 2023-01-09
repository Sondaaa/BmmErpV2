<?php

require_once dirname(__FILE__) . '/../lib/BudgetdefinitifGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/BudgetdefinitifGeneratorHelper.class.php';

/**
 * Budgetdefinitif actions.
 *
 * @package    symfony
 * @subpackage Budgetdefinitif
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BudgetdefinitifActions extends autoBudgetdefinitifActions
{
    protected function buildQuery()
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        if ($this->type == "") {
            $query = $query->AndWhere("typebudget not like '%Prototype%'");
            if ($_SESSION['exercice_budget'])
                $query = $query->AndWhere("typebudget like 'Exercice:" . $_SESSION['exercice_budget'] . "%'")
                    ->AndWhere("id_tranches is not null and id_tranches <>''")->OrderBy('id desc');
        } else {
            $query = $query->AndWhere("typebudget like '%Prototype%'")->OrderBy('id desc');
        }

        return $query;
    }
    public function executeEdit(sfWebRequest $request)
    {
       
        $this->titrebudjet = $this->getRoute()->getObject();
        if(!$this->titrebudjet->getMntEncaissier()){
            if($this->titrebudjet->getIdTranches()){
                $ids_tranches=json_decode($this->titrebudjet->getIdTranches(),true);
                $listes_tranches=Doctrine_Core::getTable('Tranchebudget')->createQuery('a')
                ->select('sum(COALESCE(mntdebloque,0)) as encaissier')
                ->whereIn('id',$ids_tranches)->fetchArray();
                if(count($listes_tranches)>0){
                    $sum=$listes_tranches[count($listes_tranches)-1]['encaissier'];
                    $this->titrebudjet->setMntEncaissier($sum);
                    $this->titrebudjet->save();
                }
                
            }
            

        }
        $this->form = $this->configuration->getForm($this->titrebudjet);
    }
}
