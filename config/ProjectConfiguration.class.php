<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  static protected $swiftLoaded = false;
  static protected $simplehtmldomLoaded = false;
  static protected $phpexcelLoaded = false;

  static public function registerSwift()
  {
    if (self::$swiftLoaded)
    {
      return;
    }

    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    require_once sfConfig::get('sf_lib_dir').'/vendor/swift/lib/swift_required.php';
    
    self::$swiftLoaded = true;
  }

  static public function registerSimplehtmldom()
  {
    if (self::$simplehtmldomLoaded)
    {
      return;
    }

    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    require_once sfConfig::get('sf_lib_dir').'/vendor/simplehtmldom/simple_html_dom.php';

    self::$simplehtmldomLoaded = true;
  }

  static public function registerPhpExcel()
  {
    if (self::$phpexcelLoaded)
    {
      return;
    }

    set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
    /** PHPExcel */
    include sfConfig::get('sf_lib_dir').'/vendor/PHPExcel.php';
    /** PHPExcel_Writer_Excel2007 */
    include sfConfig::get('sf_lib_dir').'/vendor/PHPExcel/Writer/Excel2007.php';

    self::$simplehtmldomLoaded = true;
  }

  public function setup()
  {
    $this->enablePlugins('sfPropel15Plugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfAdminDashPlugin');
    $this->enablePlugins('sfGuardPlugin');
  }


}
