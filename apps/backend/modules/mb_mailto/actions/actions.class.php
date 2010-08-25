<?php

require_once dirname(__FILE__).'/../lib/mb_mailtoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mb_mailtoGeneratorHelper.class.php';

/**
 * mb_mailto actions.
 *
 * @package    mailbot
 * @subpackage mb_mailto
 * @author     Gustavo Garcia - UDT
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mb_mailtoActions extends autoMb_mailtoActions
{
  public function executeRecipients(sfWebRequest $request)
  {
    $filters = $this->getFilters();
    $filters['mail_id'] = $request->getParameter('mail_id');
    if($request->getParameter('state'))
      $filters['state'] = $request->getParameter('state');
    $this->setFilters($filters);
    
    return $this->redirect('mb_mailto/index');
  }

  public function executeListExport(sfWebRequest $request)
  {
    $filters = $this->getFilters();

    $this->mb_mail = MbMailQuery::create()->findPk($filters['mail_id']);
    
    $query = $this->buildQuery();
    $this->mb_mailto_list = $query->find();

    $this->getResponse()->clearHttpHeaders();
    $this->setLayout(false);
    $this->getResponse()->setContentType('application/msexcel');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'inline; filename="mailbot.xls"');
    
  }

  public function executeListBack(sfWebRequest $request)
  {
    return $this->redirect('@mb_mail');
  }

   /*
   * General
   */

  public function executeRefresh(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('refresh', $request->getParameter('mode', 'off'));
    return $this->redirect('mb_mailto/index');
  }
}
