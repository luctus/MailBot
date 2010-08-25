<?php

require_once dirname(__FILE__).'/../lib/log_mailtoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/log_mailtoGeneratorHelper.class.php';

/**
 * log_mailto actions.
 *
 * @package    mailbot
 * @subpackage log_mailto
 * @author     Gustavo Garcia - UDT
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class log_mailtoActions extends autoLog_mailtoActions
{
  public function executeRecipients(sfWebRequest $request)
  {
    $filters = $this->getFilters();
    $filters['mail_id'] = $request->getParameter('mail_id');
    $this->setFilters($filters);

    return $this->redirect('@log_mailto');
  }

  public function executeListExport(sfWebRequest $request)
  {
    $filters = $this->getFilters();

    $this->log_mail = LogMailQuery::create()->findPk($filters['mail_id']);

    $query = $this->buildQuery();
    $this->log_mailto_list = $query->find();

    $this->getResponse()->clearHttpHeaders();
    $this->setLayout(false);
    $this->getResponse()->setContentType('application/msexcel');
    $this->getResponse()->setHttpHeader('Content-Disposition', 'inline; filename="mailbot.xls"');

  }

  public function executeListBack(sfWebRequest $request)
  {
    return $this->redirect('@log_mail');
  }
}
