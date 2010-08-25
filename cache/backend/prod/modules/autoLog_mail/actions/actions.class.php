<?php

require_once(dirname(__FILE__).'/../lib/BaseLog_mailGeneratorConfiguration.class.php');
require_once(dirname(__FILE__).'/../lib/BaseLog_mailGeneratorHelper.class.php');

/**
 * log_mail actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage log_mail
 * @author     ##AUTHOR_NAME##
 */
abstract class autoLog_mailActions extends sfActions
{
  public function preExecute()
  {
    $this->configuration = new log_mailGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new log_mailGeneratorHelper();
  }

  public function executeIndex(sfWebRequest $request)
  {
    // filtering
    if ($request->getParameter('filters'))
    {
      $this->setFilters($request->getParameter('filters'));
    }
    
    // sorting
    if ($request->getParameter('sort'))
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

      $this->redirect('@log_mail');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    unset($this->filters['username']);
    unset($this->filters['body_html']);
    unset($this->filters['body_text']);
    unset($this->filters['reply_to']);
    unset($this->filters['notify_to']);
    unset($this->filters['public_path']);
    unset($this->filters['batch_size']);
    unset($this->filters['error']);
    unset($this->filters['token']);

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@log_mail');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->LogMail = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->LogMail = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->LogMail = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->LogMail);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->LogMail = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->LogMail);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@log_mail');
  }


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $LogMail = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $LogMail)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@log_mail_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'log_mail_edit', 'sf_subject' => $LogMail));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('log_mail.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('log_mail.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $query = $this->buildQuery();
    $paginateMethod = $this->configuration->getPaginateMethod();
    $pager = $query->$paginateMethod($this->getPage(), $this->configuration->getPagerMaxPerPage());

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('log_mail.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('log_mail.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    unset($this->filters['username']);
    unset($this->filters['body_html']);
    unset($this->filters['body_text']);
    unset($this->filters['reply_to']);
    unset($this->filters['notify_to']);
    unset($this->filters['public_path']);
    unset($this->filters['batch_size']);
    unset($this->filters['error']);
    unset($this->filters['token']);
    }

    $query = $this->filters->buildCriteria($this->getFilters());
    
    foreach ($this->configuration->getWiths() as $with) {
      $query->joinWith($with);
    }
    
    foreach ($this->configuration->getQueryMethods() as $method) {
      $query->$method();
    }
    
    $this->processSort($query);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $query);
    $query = $event->getReturnValue();

    return $query;
  }


  protected function processSort($query)
  {
    $sort = $this->getSort();
    if (array(null, null) == $sort)
    {
      return;
    }

    
    try
    {
      $column = LogMailPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME);
    }
    catch (PropelException $e)
    {
      // probably a fake column, using a custom orderByXXX() query method
      $column = sfInflector::camelize($sort[0]);
    }
    
    $method = sprintf('orderBy%s', $column);
    
    try
    {
      $query->$method('asc' == $sort[1] ? 'asc' : 'desc');
    }
    catch(PropelException $e)
    {
      // non-existent sorting method
      // ignore the sort parameter
      $this->setSort(array(null, null));
    }
  }

  protected function getSort()
  {
    $sort = $this->getUser()->getAttribute('log_mail.sort', null, 'admin_module');
    if (null === $sort)
    {
      $sort = $this->configuration->getDefaultSort();
      $this->setSort($sort);
    }

    return $sort;
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('log_mail.sort', $sort, 'admin_module');
  }

}
