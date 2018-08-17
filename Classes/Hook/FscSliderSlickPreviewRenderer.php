<?php
namespace TmFrstn\FscSliderSlick\Hook;
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Contains a preview rendering for the page module of CType="fsc_slider_slick"
 */
class FscSliderSlickPreviewRenderer implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface
{
    /**
     * Preprocesses the preview rendering of a content element of type "fsc_slider_slick"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     * @return void
     */
    public function preProcess(
            \TYPO3\CMS\Backend\View\PageLayoutView &$parentObject,
            &$drawItem,
            &$headerContent,
            &$itemContent,
            array &$row
    ) {
        if ($row['CType'] === 'fsc_slider_slick') {
            switch($row['layout']){
                case 10:
                    $layoutCaption = $GLOBALS['LANG']->sL('LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:tt_content.template.I.10');
                    break;
                case 20:
                    $layoutCaption = $GLOBALS['LANG']->sL('LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:tt_content.template.I.20');
                    break;
                case 30:
                    $layoutCaption = $GLOBALS['LANG']->sL('LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:tt_content.template.I.30');
                    break;
                default:
                    $layoutCaption = $GLOBALS['LANG']->sL('LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:tt_content.template.I.Default');
                    break;
            }
            $headerContent .= 'Slick Slider ( ' . $layoutCaption . ' )';
            if ($row['assets']) {
                $itemContent .= $parentObject->thumbCode($row, 'tt_content', 'assets') . '<br />';
            }
            if ($row['file_collections']) {
                $fileCollectionsArray = explode (',', $row['file_collections']);

                $itemContent .=  '<br><b>File Collection:</b> ';
                foreach($fileCollectionsArray as $uid){
                    $collectionRecord = self::getDatabaseConnection()->exec_SELECTgetSingleRow(
                            '*',
                            'sys_file_collection',
                            'uid = ' . (int)$uid . \TYPO3\CMS\Backend\Utility\BackendUtility::deleteClause('sys_file_collection')
                    );
                    $itemContent .= $collectionRecord['title'] . '<br />';
                }
            }

            if ($row['related_content'] && $row['layout'] == 30) {
                $ttContentItems = explode(',',$row['related_content']);
                if(count($ttContentItems) > 0){
                    $itemContent .= '<br><b>Content Elemente: </b><br />';
                    foreach($ttContentItems as $uid){
                        $ttContentRecord = self::getDatabaseConnection()->exec_SELECTgetSingleRow(
                                '*',
                                'tt_content',
                                'uid = ' . (int)$uid . \TYPO3\CMS\Backend\Utility\BackendUtility::deleteClause('uid')
                        );
                        $itemContent .= $ttContentRecord['header'] . ' (uid: ' . $uid . ')<br />';
                    }
                }
            }
            $drawItem = false;
        }
    }

    /**
     * Gets the database object.
     *
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected static function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

}