
<?php
defined('TYPO3_MODE') or die();

// Register for hook to show preview of tt_content element of CType="fluid_styled_slider" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['fsc_slider_slick']
        = \TmFrstn\FscSliderSlick\Hook\FscSliderSlickPreviewRenderer::class;