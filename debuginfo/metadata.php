<?php
/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 *
 * @link      http://www.oxid-esales.com
 * @package   main
 * @copyright (c) OXID eSales AG 2003-#OXID_VERSION_YEAR#
 * @version   SVN: $Id: $
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.0';

/**
 * Module information
 */
$aModule = array(
    'id'           => 'debuginfo',
    'title'        => 'Debug info',
    'description'  => 'Nice debug info visualization',
    'thumbnail'    => 'picture.png',
    'version'      => '1.0',
    'author'       => 'Alfonsas Cirtautas',
    'extend'       => array(
        'oxshopcontrol' => 'debuginfo/core/acshopcontrol',
        'oxdebuginfo'   => 'debuginfo/core/acdebuginfo',
    ),
);