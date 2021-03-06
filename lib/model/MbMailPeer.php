<?php


/**
 * Skeleton subclass for performing query and update operations on the 'mb_mail' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Jun  8 16:04:14 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class MbMailPeer extends BaseMbMailPeer {

  public static function getPendientes()
  {
    $c = new Criteria();
    $c->add(MbMailtoPeer::CREATED_AT, time() - 3 * 60 * 60, Criteria::GREATER_THAN);
    $c->add(MbMailtoPeer::STATE, null, Criteria::ISNULL);
    $c->addJoin(MbMailPeer::ID, MbMailtoPeer::MAIL_ID);
    $c->add(self::STATE, null, Criteria::ISNULL);
    $c->setDistinct();
    
    return self::doSelect($c);
  }

  public static function countPendientes()
  {
    $c = new Criteria();
    $c->add(MbMailtoPeer::CREATED_AT, time() - 3 * 60 * 60, Criteria::GREATER_THAN);
    $c->add(MbMailtoPeer::STATE, null, Criteria::ISNULL);
    $c->addJoin(MbMailPeer::ID, MbMailtoPeer::MAIL_ID);
    $c->add(self::STATE, null, Criteria::ISNULL);
    $c->setDistinct();

    return self::doCount($c);
  }
  
  public static function getEnviados()
  {
    $c = new Criteria();
    $c->add(MbMailtoPeer::STATE, null, Criteria::ISNOTNULL);
    $c->addJoin(MbMailPeer::ID, MbMailtoPeer::MAIL_ID);
    $c->setDistinct();
    
    return self::doSelect($c);
  }

  public static function getNbRecipientsByState($mb_mail_id, $state = false)
  {
    $c = new Criteria();
    $c->add(MbMailtoPeer::MAIL_ID, $mb_mail_id);
    
    if($state)
      $c->add(MbMailtoPeer::STATE, $state);
    
    return MbMailtoPeer::doCount($c);
  }

} // MbMailPeer
