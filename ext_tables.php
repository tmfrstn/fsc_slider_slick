
<?php
defined('TYPO3_MODE') or die();

// Include new content elements to modWizards
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fsc_slider_slick/Configuration/PageTSconfig/FscSliderSlick.ts">'
);

// Register for hook to show preview of tt_content element of CType="fluid_styled_slider" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fsc_slider_slick']
        = \TmFrstn\FscSliderSlick\Hook\FscSliderSlickPreviewRenderer::class;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Slick Slider');

// Add a flexform to the fsc_slider_slick CType
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '',
        'FILE:EXT:fsc_slider_slick/Configuration/FlexForms/fsc_slider_slick_flexform.xml',
        'fsc_slider_slick'
);