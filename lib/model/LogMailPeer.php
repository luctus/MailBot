<?php



/**
 * Skeleton subclass for performing query and update operations on the 'log_mail' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.5.3-dev on:
 *
 * Fri Jul  2 17:06:02 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class LogMailPeer extends BaseLogMailPeer {

  public static function getNbRecipientsByState($mb_mail_id, $state = false)
  {
    $c = new Criteria();
    $c->add(LogMailtoPeer::MAIL_ID, $mb_mail_id);

    if($state)
      $c->add(LogMailtoPeer::STATE, $state);

    return LogMailtoPeer::doCount($c);
  }
} // LogMailPeer
