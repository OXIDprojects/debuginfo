<?php
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
