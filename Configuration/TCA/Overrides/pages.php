<?php

defined('TYPO3_MODE') || die();

// New Content element wizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'fsc_slider_slick',
    'Configuration/PageTS/Mod/Wizards/newContentElement.tsconfig',
    'FSC Slider Slick: New Content Element Wizards'
);
