<?php

require_once dirname(__FILE__).'/../lib/mb_mailGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mb_mailGeneratorHelper.class.php';

/**
 * mb_mail actions.
 *
 * @package    mailbot
 * @subpackage mb_mail
 * @author     Gustavo Garcia - UDT
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mb_mailActions extends autoMb_mailActions
{
  /*
   * object_actions
   */

  public function executeIndex(sfWebRequest $request)
  {
    $pendientes = MbMailPeer::countPendientes();
    $title_add = $pendientes > 0 ? (' (' . $pendientes . ')') : '';
    $this->getResponse()->setSlot('title', 'MailBot Portal'.$title_add);
    parent::executeIndex($request);
  }

  public function executeListStop(sfWebRequest $request)
  {
    $mb_mail = $this->getRoute()->getObject();
    if($mb_mail->isPending())
    {
      $mb_mail->setState('stop');
      $mb_mail->save();
    }
 
    return $this->redirect('@mb_mail');
  }

  public function executeListResume(sfWebRequest $request)
  {
    $mb_mail = $this->getRoute()->getObject();
    if($mb_mail->getState() == 'stop')
    {
      $mb_mail->setState(null);
      $mb_mail->save();
    }

    return $this->redirect('@mb_mail');
  }

  public function executeListFast(sfWebRequest $request)
  {
    $mb_mail = $this->getRoute()->getObject();
    if($mb_mail->isPending() && $mb_mail->getBatchSize() != 50)
    {
      $mb_mail->setBatchSize(50);
      $mb_mail->save();
    }
    return $this->redirect('@mb_mail');
  }

  public function executeListSlow(sfWebRequest $request)
  {
    $mb_mail = $this->getRoute()->getObject();
    if($mb_mail->isPending() && $mb_mail->getBatchSize() != 5)
    {
      $mb_mail->setBatchSize(5);
      $mb_mail->save();
    }
    return $this->redirect('@mb_mail');
  }


  /*
   * batch_actions
   */

  public function executeBatchStop(sfWebRequest $request)
  {
    $mb_mails = MbMailPeer::retrieveByPks($request->getParameter('ids'));
    foreach($mb_mails as $mb_mail)
    {
      if($mb_mail->getState() == null)
      {
        $mb_mail->setState('stop');
        $mb_mail->save();
      }
    }
    return $this->redirect('@mb_mail');
  }

  public function executeBatchResume(sfWebRequest $request)
  {
    $mb_mails = MbMailPeer::retrieveByPks($request->getParameter('ids'));
    foreach($mb_mails as $mb_mail)
    {
      if($mb_mail->getState() == 'stop')
      {
        $mb_mail->setState(null);
        $mb_mail->save();
      }
    }
    return $this->redirect('@mb_mail');
  }

  public function executeBatchtFast(sfWebRequest $request)
  {
    $mb_mails = MbMailPeer::retrieveByPks($request->getParameter('ids'));
    foreach($mb_mails as $mb_mail)
    {
      if($mb_mail->isPending() && $mb_mail->getBatchSize() != 50)
      {
        $mb_mail->setBatchSize(50);
        $mb_mail->save();
      }
    }
    return $this->redirect('@mb_mail');
  }

  public function executeBatchSlow(sfWebRequest $request)
  {
    $mb_mails = MbMailPeer::retrieveByPks($request->getParameter('ids'));
    foreach($mb_mails as $mb_mail)
    {
      if($mb_mail->isPending() && $mb_mail->getBatchSize() != 5)
      {
        $mb_mail->setBatchSize(5);
        $mb_mail->save();
      }
    }
    return $this->redirect('@mb_mail');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless($this->mb_mail = $this->getRoute()->getObject());
  }

  public function executeDownloadAttach(sfWebRequest $request)
  {
    $this->forward404Unless($mb_mail_attachment = MbMailAttachmentQuery::create()->findPk($request->getParameter('mb_mail_attachment_id')));

    $filepath = MailbotTools::getFullPath($mb_mail_attachment->getMbMail()->getPublicPath(), $mb_mail_attachment->getUrl());
    $filename = pathinfo($filepath);
    $filename = $filename['filename'].'.'.$filename['extension'];

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

  /*
   * General
   */

  public function executeRefresh(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('refresh', $request->getParameter('mode', 'off'));
    return $this->redirect('@mb_mail');
  }

  public function executeError(sfWebRequest $request)
  {
    //$account->getSomeData();
  }
}
