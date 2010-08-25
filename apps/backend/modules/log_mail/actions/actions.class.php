<?php

require_once dirname(__FILE__).'/../lib/log_mailGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/log_mailGeneratorHelper.class.php';

/**
 * log_mail actions.
 *
 * @package    mailbot
 * @subpackage log_mail
 * @author     Gustavo Garcia - UDT
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class log_mailActions extends autoLog_mailActions
{

  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless($this->log_mail = $this->getRoute()->getObject());
  }

  public function executeDownloadAttach(sfWebRequest $request)
  {
    $this->forward404Unless($log_mail_attachment = LogMailAttachmentQuery::create()->findPk($request->getParameter('log_mail_attachment_id')));

    $filepath = MailbotTools::getFullPath($log_mail_attachment->getLogMail()->getPublicPath(), $log_mail_attachment->getUrl());
    $filename = $log_mail_attachment->getUrl();

    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->addCacheControlHttpHeader("Cache-control","private");
    $this->getResponse()->setHttpHeader("Content-Description","File Transfer");
    $this->getResponse()->setContentType('application/octet-stream',TRUE);
    $this->getResponse()->setHttpHeader("Content-Length",(string) filesize($filepath), TRUE);
    $this->getResponse()->setHttpHeader('content-transfer-encoding', 'binary', TRUE);
    $this->getResponse()->setHttpHeader("Content-Disposition","attachment; filename=".$filename, TRUE);
    $this->getResponse()->sendHttpHeaders();

    $fp=fopen($filepath,'rb');
    while(!feof($fp))
    {
      set_time_limit(0);
      $buffer=fread($fp,1024*1024); // can set amount to read lower, this is just an example.
      echo $buffer;
      ob_flush();
      flush();
    }
    fclose($fp);
    return sfView::NONE;
  }

  public function executeReport(sfWebRequest $request)
  {
    $this->forward404Unless($this->log_mail = LogMailQuery::create()->findPk($request->getParameter('id')));
    $this->forward404Unless($this->log_mail->getToken() == $request->getParameter('token'));
  }

}
