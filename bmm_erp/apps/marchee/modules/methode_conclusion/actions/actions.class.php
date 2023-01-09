<?php

require_once dirname(__FILE__).'/../lib/methode_conclusionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/methode_conclusionGeneratorHelper.class.php';

/**
 * methode_conclusion actions.
 *
 * @package    Bmm
 * @subpackage methode_conclusion
 * @author     Your name here
 * @version    SVN: $Id$
 */
class methode_conclusionActions extends autoMethode_conclusionActions
{
    public function preExecute()
    {
      $this->configuration = new methode_conclusionGeneratorConfiguration();
  
      if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
      {
        $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
  
      $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));
  
      $this->helper = new methode_conclusionGeneratorHelper();
  
      parent::preExecute();
    }
  
    public function executeIndex(sfWebRequest $request)
    {
      // sorting
      if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
      {
        $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
      }
  
      // pager
      if ($request->getParameter('page'))
      {
        $this->setPage($request->getParameter('page'));
      }
  
      $this->pager = $this->getPager();
      $this->sort = $this->getSort();
    }
  
    public function executeFilter(sfWebRequest $request)
    {
      $this->setPage(1);
  
      if ($request->hasParameter('_reset'))
      {
        $this->setFilters($this->configuration->getFilterDefaults());
  
        $this->redirect('@methode_conclusion');
      }
  
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
  
      $this->filters->bind($request->getParameter($this->filters->getName()));
      if ($this->filters->isValid())
      {
        $this->setFilters($this->filters->getValues());
  
        $this->redirect('@methode_conclusion');
      }
  
      $this->pager = $this->getPager();
      $this->sort = $this->getSort();
  
      $this->setTemplate('index');
    }
  
    public function executeNew(sfWebRequest $request)
    {
      $this->form = $this->configuration->getForm();
      $this->methode_conclusion = $this->form->getObject();
    }
  
    public function executeCreate(sfWebRequest $request)
    {
      $this->form = $this->configuration->getForm();
      $this->methode_conclusion = $this->form->getObject();
  
      $this->processForm($request, $this->form);
  
      $this->setTemplate('new');
    }
  
    public function executeEdit(sfWebRequest $request)
    {
      $this->methode_conclusion = $this->getRoute()->getObject();
      $this->form = $this->configuration->getForm($this->methode_conclusion);
    }
  
    public function executeUpdate(sfWebRequest $request)
    {
      $this->methode_conclusion = $this->getRoute()->getObject();
      $this->form = $this->configuration->getForm($this->methode_conclusion);
  
      $this->processForm($request, $this->form);
  
      $this->setTemplate('edit');
    }
  
    public function executeDelete(sfWebRequest $request)
    {
      $request->checkCSRFProtection();
  
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
  
      if ($this->getRoute()->getObject()->delete())
      {
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
      }
  
      $this->redirect('@methode_conclusion');
    }
  
    public function executeBatch(sfWebRequest $request)
    {
      $request->checkCSRFProtection();
  
      if (!$ids = $request->getParameter('ids'))
      {
        $this->getUser()->setFlash('error', 'You must at least select one item.');
  
        $this->redirect('@methode_conclusion');
      }
  
      if (!$action = $request->getParameter('batch_action'))
      {
        $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');
  
        $this->redirect('@methode_conclusion');
      }
  
      if (!method_exists($this, $method = 'execute'.ucfirst($action)))
      {
        throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
      }
  
      if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
      {
        $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
  
      $validator = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'MethodeConclusion'));
      try
      {
        // validate ids
        $ids = $validator->clean($ids);
  
        // execute batch
        $this->$method($request);
      }
      catch (sfValidatorError $e)
      {
        $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
      }
  
      $this->redirect('@methode_conclusion');
    }
  
    protected function executeBatchDelete(sfWebRequest $request)
    {
      $ids = $request->getParameter('ids');
  
      $records = Doctrine_Query::create()
        ->from('MethodeConclusion')
        ->whereIn('id', $ids)
        ->execute();
  
      foreach ($records as $record)
      {
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $record)));
  
        $record->delete();
      }
  
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
      $this->redirect('@methode_conclusion');
    }
  
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      if ($form->isValid())
      {
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
  
        try {
          $methode_conclusion = $form->save();
          
        } catch (Doctrine_Validator_Exception $e) {
  
          $errorStack = $form->getObject()->getErrorStack();
  
          $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
          foreach ($errorStack as $field => $errors) {
              $message .= "$field (" . implode(", ", $errors) . "), ";
          }
          $message = trim($message, ', ');
  
          $this->getUser()->setFlash('error', $message);
          return sfView::SUCCESS;
        }
  
        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $methode_conclusion)));
  
        if ($request->hasParameter('_save_and_add'))
        {
          $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
  
          $this->redirect('@methode_conclusion_new');
        }
        else
        {
          $this->getUser()->setFlash('notice', $notice);
  
          $this->redirect(array('sf_route' => 'methode_conclusion', 'sf_subject' => $methode_conclusion));
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
      }
    }
  
    protected function getFilters()
    {
      return $this->getUser()->getAttribute('methode_conclusion.filters', $this->configuration->getFilterDefaults(), 'admin_module');
    }
  
    protected function setFilters(array $filters)
    {
      return $this->getUser()->setAttribute('methode_conclusion.filters', $filters, 'admin_module');
    }
  
    protected function getPager()
    {
      $pager = $this->configuration->getPager('MethodeConclusion');
      $pager->setQuery($this->buildQuery());
      $pager->setPage($this->getPage());
      $pager->init();
  
      return $pager;
    }
  
    protected function setPage($page)
    {
      $this->getUser()->setAttribute('methode_conclusion.page', $page, 'admin_module');
    }
  
    protected function getPage()
    {
      return $this->getUser()->getAttribute('methode_conclusion.page', 1, 'admin_module');
    }
  
    protected function buildQuery()
    {
      $tableMethod = $this->configuration->getTableMethod();
      if (null === $this->filters)
      {
        $this->filters = $this->configuration->getFilterForm($this->getFilters());
      }
  
      $this->filters->setTableMethod($tableMethod);
  
      $query = $this->filters->buildQuery($this->getFilters());
  
      $this->addSortQuery($query);
  
      $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
      $query = $event->getReturnValue();
  
      return $query;
    }
  
    protected function addSortQuery($query)
    {
      if (array(null, null) == ($sort = $this->getSort()))
      {
        return;
      }
  
      if (!in_array(strtolower($sort[1]), array('asc', 'desc')))
      {
        $sort[1] = 'asc';
      }
  
      $query->addOrderBy($sort[0] . ' ' . $sort[1]);
    }
  
    protected function getSort()
    {
      if (null !== $sort = $this->getUser()->getAttribute('methode_conclusion.sort', null, 'admin_module'))
      {
        return $sort;
      }
  
      $this->setSort($this->configuration->getDefaultSort());
  
      return $this->getUser()->getAttribute('methode_conclusion.sort', null, 'admin_module');
    }
  
    protected function setSort(array $sort)
    {
      if (null !== $sort[0] && null === $sort[1])
      {
        $sort[1] = 'asc';
      }
  
      $this->getUser()->setAttribute('methode_conclusion.sort', $sort, 'admin_module');
    }
  
    protected function isValidSortColumn($column)
    {
      return Doctrine_Core::getTable('MethodeConclusion')->hasColumn($column);
    }
  }
