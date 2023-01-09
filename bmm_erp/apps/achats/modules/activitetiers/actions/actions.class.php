<?php

require_once dirname(__FILE__) . '/../lib/activitetiersGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/activitetiersGeneratorHelper.class.php';

/**
 * activitetiers actions.
 *
 * @package    Bmm
 * @subpackage activitetiers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class activitetiersActions extends autoActivitetiersActions
{

    //______________________________________________________________________Ajouter Activiter
    public function executeAjoutactiviter(sfWebRequest $request)
    {
        header('Access-Control-Allow-Origin: *');
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $libelle = $params['libelle'];
            $act = new Activitetiers();
            $activite = Doctrine_Core::getTable('activitetiers')->findOneByLibelle($libelle);
            if ($activite)
                $act = $activite;
            $act->setLibelle($libelle);
            $act->save();
            $listes = Doctrine_Query::create()
                ->select("*")
                ->from('activitetiers');

            $listes = $listes->fetchArray();
            die(json_encode($listes));
        }
        die('Erreur d\'ajout');
    }
    public function executeChooseUnderActivite(sfWebRequest $request){
        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $id = $params['activite_id'];
            $activites = Doctrine_Core::getTable('Activitetiers')->createQuery('q')
            ->Where('parent_id='.$id)->fetchArray();
           
            return $this->renderText(json_encode(array('data'=>$activites)));
        }
        return $this->renderText(json_encode(array('data'=>'')));
    }
    protected function buildQuery()
    {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);
        $filter = $this->getFilters();
        $query = $this->filters->buildQuery($this->getFilters());
        $activites = Doctrine_Core::getTable('Activitetiers')->createQuery('a');
        if (isset($filter['code'])) {
         
            $activites = $activites->where("code='" . $filter['code']['text']."'");
        }
        if (isset($filter['parent_id'])) {
          
            $activites = $activites->where("parent_id=" . $filter['parent_id']);
        }
      
        $query = $activites->OrderBy('id desc');
        $this->addSortQuery($query);

        // $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        // $query = $event->getReturnValue();

        return $query;
    }
}
