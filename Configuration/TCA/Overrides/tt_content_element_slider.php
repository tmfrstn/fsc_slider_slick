<?php
defined('TYPO3_MODE') or die();

// Add a flexform to the fsc_slider_slick CType
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '',
    'FILE:EXT:fsc_slider_slick/Configuration/FlexForms/fsc_slider_slick_flexform.xml',
    'fsc_slider_slick'
);