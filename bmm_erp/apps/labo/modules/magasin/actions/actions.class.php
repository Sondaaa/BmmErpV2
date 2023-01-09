<?php

require_once dirname(__FILE__) . '/../lib/magasinGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/magasinGeneratorHelper.class.php';

/**
 * magasin actions.
 *
 * @package    symfony
 * @subpackage magasin
 * @author     Your name here
 * @version    SVN: $Id$
 */
class magasinActions extends autoMagasinActions
{
    protected function buildQuery()
    {
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        if ($user->getIdMagasin() && $user->getLaboName()) {

            $labo = $user->getLaboName();
            $id_emplacemnt = $labo->getId();
        }
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());
        $magasins = Doctrine_Core::getTable('magasin')
            ->createQuery('a');
        if ($id_emplacemnt)
            $magasins = $magasins->where('id_etage=' . $id_emplacemnt);
        $query = $magasins->OrderBy('id desc');
        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();

        return $query;
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $user = UtilisateurTable::getInstance()->find($this->getUser()->getAttribute('userB2m')->getId());
        if ($user->getIdMagasin() && $user->getLaboName()) {

            $labo = $user->getLaboName();
            $id_emplacemnt = $labo->getId();
        }
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

            try {
                $magasin = $form->save();
                if ($id_emplacemnt)
                    $magasin->setIdEtage($id_emplacemnt);
                $magasin->save();
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

            $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $magasin)));

            if ($request->hasParameter('_save_and_add')) {
                $this->getUser()->setFlash('notice', $notice . ' You can add another one below.');

                $this->redirect('@magasin_new');
            } else {
                $this->getUser()->setFlash('notice', $notice);

                $this->redirect(array('sf_route' => 'magasin_edit', 'sf_subject' => $magasin));
            }
        } else {
            $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
        }
    }
}
