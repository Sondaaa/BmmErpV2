<?php

/**
 * This class handles the configuration of the plugin.
 *
 * @see config/pdf_configs.yml
 *
 * @package    sfTCPDFPlugin
 * @author     COil
 * @since      1.6.0 - 7 apr 2009
 */

class sfTCPDFPluginConfigHandler extends sfYamlConfigHandler
{
  // Namespace of plugin configuration
  protected static
    $namespace           = 'sfTCPDFPlugin',
    $config_file_pattern = 'config/pdf_configs.yml'
  ;

  /**
   * Specific yml parse function.
   *
   * @param Array $configFiles
   * @return Array
   */
  public function execute($configFiles)
  {
    $config = self::parseYamls($configFiles);

    // compile data
    $retval = "<?php\n".
            
              "//\n";

    $retval = sprintf($retval, __CLASS__, date('Y/m/d H:i:s'), var_export($config, true));

    return $retval;
  }

  /**
   * Load the config.
   *
   * @author COil
   * @since  6 august 08
   */
  public static function load($config_key)
  {
    $config = sfConfig::get(self::$namespace);

    if (!$config)
    {
      $config = self::checkAndGetConfig($config_key);
      sfConfig::set(self::$namespace, $config);
    }

    return $config;
  }

  /**
   * Generate the config file if not present and return a configuration for
   * a given key or return the default configuration.
   * 
   * @author COil
   * @since  V1.6.0 - 7 apr 09
   *
   * @param $config String Config key
   *
   * @return Array
   */
  public static function checkAndGetConfig($config = null)
  {
    $configs = include(sfContext::getInstance()->getConfigCache()->checkConfig(self::$config_file_pattern));
    $checkAndGetConfig = $config && isset($configs[$config]) ? $configs[$config] : $configs['default'];

    return $checkAndGetConfig;
  }

  /**
   * Create all TCPDF specific constants.
   *
   * @author COil
   * @since  V1.6.0 - 7 apr 09
   *
   * @return Array
   */
  public static function applyTCPDFConfig($config)
  {
    foreach ($config as $key => $value)
    {
      switch ($key)
      {
        case 'K_TCPDF_EXTERNAL_CONFIG':
          if ($value)
          {
            define('K_TCPDF_EXTERNAL_CONFIG', true);
          }
          break;

        case 'K_PATH_MAIN':
          if (empty($value))
          {
            $value = sfConfig::get('sfTCPDFPlugin_dir');
          }

          define('K_PATH_MAIN', $value);
          break;

        case 'K_PATH_URL':
          
          if (empty($value) && sfContext::hasInstance())
          {
            $value = sfContext::getInstance()->getRequest()->getUriPrefix(). '/';
          }

          define('K_PATH_URL', $value);
          break;

        case 'K_PATH_FONTS':
          if (empty($value))
          {
            $value = K_PATH_MAIN.'fonts/';
          }

          define('K_PATH_FONTS', $value);
          break;

        case 'K_PATH_CACHE':
          if (empty($value))
          {
            $value = K_PATH_MAIN.'cache/';
          }

          define('K_PATH_CACHE', $value);
          break;

        case 'K_PATH_URL_CACHE':
          if (empty($value))
          {
            $value = K_PATH_URL. 'cache/';
          }
          define('K_PATH_URL_CACHE', $value);
          break;

        case 'K_PATH_IMAGES':
          if (empty($value))
          {
            $value = K_PATH_MAIN. 'images/';
          }

          define('K_PATH_IMAGES', $value);
          break;

        case 'K_BLANK_IMAGE':
          if (empty($value))
          {
            $value = K_PATH_MAIN. 'images/';
          }

          define('K_BLANK_IMAGE', K_PATH_IMAGES.'_blank.png');
          break;

        default:

          // Only define a constant if it's a known TCPDF constant
          if (in_array($key, self::getTCPDFConstantsList()))
          {
            define($key, $value);
          }

          break;
      }
    }
  }

  /**
   * Retrieve and load a TCPDF configuration.
   *
   * @param $config String Name of config to load ("default" by default)
   */
  public static function loadConfig($config_key = null)
  {
    $config = self::checkAndGetConfig($config_key);
    self::applyTCPDFConfig($config);
    sfConfig::set(self::$namespace, $config);

    return $config;
  }

  /**
   * Include a TCPDF language file, if the language file the culture is not founf
   * then the defaut language is included (en)
   *
   * @param $culture Language to inlcude
   */
  public static function includeLangFile($culture)
  {
    // Supported langs by TCPDF
    $culture_to_lang_file = array(
      'en' => 'eng',
      'it' => 'ita' 
    );

    $lang_file = in_array($culture, array_keys($culture_to_lang_file))
      ? $culture_to_lang_file[$culture]
      : $culture_to_lang_file['en']
    ;

    require_once(K_PATH_MAIN. 'config/lang/'. $lang_file. '.php');
  }

  /**
   * Retrieve the list of know TCPDF constant.
   *
   * @return Array
   */
  public static function getTCPDFConstantsList()
  {
    return array(
      'K_TCPDF_EXTERNAL_CONFIG',
      'K_PATH_MAIN', 
      'K_PATH_URL', 
      'K_PATH_FONTS', 
      'K_PATH_CACHE', 
      'K_PATH_URL_CACHE', 
      'K_PATH_IMAGES', 
      'K_BLANK_IMAGE', 
      'PDF_PAGE_FORMAT',
      'PDF_PAGE_ORIENTATION',
      'PDF_CREATOR',
      'PDF_AUTHOR',
      'PDF_HEADER_TITLE',
      'PDF_HEADER_STRING',
      'PDF_HEADER_LOGO',
      'PDF_HEADER_LOGO_WIDTH',
      'PDF_UNIT',
      'PDF_MARGIN_HEADER',
      'PDF_MARGIN_FOOTER',
      'PDF_MARGIN_TOP',
      'PDF_MARGIN_BOTTOM',
      'PDF_MARGIN_LEFT',
      'PDF_MARGIN_RIGHT',
      'PDF_FONT_NAME_MAIN',
      'PDF_FONT_SIZE_MAIN',
      'PDF_FONT_NAME_DATA',
      'PDF_FONT_SIZE_DATA',
      'PDF_FONT_MONOSPACED',
      'PDF_IMAGE_SCALE_RATIO',
      'HEAD_MAGNIFICATION',
      'K_CELL_HEIGHT_RATIO',
      'K_TITLE_MAGNIFICATION',
      'K_SMALL_RATIO',
      'K_THAI_TOPCHARS',
      'K_TCPDF_CALLS_IN_HTML'
    );
  }

  /**
   * Retrieve the list of know TCPDF constants with their values if defined.
   *
   * @return Array
   */
  public static function getTCPDFConstantsValues()
  {
    $constants = self::getTCPDFConstantsList();
    $values = array();

    foreach ($constants as $constant)
    {
      $values[$constant] = defined($constant) ? constant($constant) : 'This TCPDF constant is not defined';
    }

    return $values;
  }
}