<?php
defined('TYPO3_MODE') or die();
call_user_func(function () {
    $languageFilePrefix = 'LLL:EXT:fluid_styled_content/Resources/Private/Language/Database.xlf:';
    $customLanguageFilePrefix = 'LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
    // Add the CType "fsc_slider_slick"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
            'tt_content',
            'CType',
            [
                    'LLL:EXT:fsc_slider_slick/Resources/Private/Language/locallang_be.xlf:wizard.title',
                    'fsc_slider_slick',
                    'content-image'
            ],
            'textmedia',
            'after'
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['fsc_slider_slick'] = $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textmedia'];
    $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] = $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .',layout';
    // Define what fields to display
    $GLOBALS['TCA']['tt_content']['types']['fsc_slider_slick'] = [
            'showitem'         => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.header;header,
                    pi_flexform,
            --div--;' . $customLanguageFilePrefix . 'tca.tab.sliderElements,
                 assets, file_collections,related_content,
            --div--;' . $frontendLanguageFilePrefix .'tabs.appearance,
				 layout,
				 --palette--;' . $languageFilePrefix . 'tt_content.palette.mediaAdjustments;mediaAdjustments,
			--div--;' . $frontendLanguageFilePrefix . 'tabs.access,
				hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
				--palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
        ',
            'columnsOverrides' => [
                    'assets' => [
                            'displayCond' => 'FIELD:layout:!=:30',
                    ],
                    'media' => [
                            'label'  => $languageFilePrefix . 'tt_content.media_references',
                            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('media', [
                                    'appearance'    => [
                                            'createNewRelationLinkTitle' => $languageFilePrefix . 'tt_content.media_references.addFileReference'
                                    ],
                                // custom configuration for displaying fields in the overlay/reference table
                                // behaves the same as the image field.
                                    'foreign_types' => $GLOBALS['TCA']['tt_content']['columns']['image']['config']['foreign_types']
                            ], $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'])
                    ],
                    'file_collections' => [
                            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:file_collections',
                            'displayCond' => 'FIELD:layout:!=:30',
                            'config' => [
                                    'type' => 'group',
                                    'internal_type' => 'db',
                                    'localizeReferencesAtParentLocalization' => true,
                                    'allowed' => 'sys_file_collection',
                                    'foreign_table' => 'sys_file_collection',
                                    'maxitems' => 1,
                                    'minitems' => 0,
                                    'size' => 1,
                            ],
                    ],
                    'layout' => [
                            'exclude' => 1,
                            'label' => $customLanguageFilePrefix . 'tt_content.template',
                            'config' => [
                                    'type' => 'select',
                                    'renderType' => 'selectSingle',
                                    'items' => [
                                        [$customLanguageFilePrefix . 'tt_content.template.I.Default', '0'],
                                        [$customLanguageFilePrefix . 'tt_content.template.I.50','50'],
                                        [$customLanguageFilePrefix . 'tt_content.template.I.10','60'],
                                        [$customLanguageFilePrefix . 'tt_content.template.I.20','20'],
                                        [$customLanguageFilePrefix . 'tt_content.template.I.30','30'],
                                            //[$customLanguageFilePrefix . 'tt_content.template.I.40','40'],

                                    ],
                                    'default' => 50,
                                    'onChange' => 'reload'
                            ]
                    ],
                    'related_content' => [
                            'exclude' => 1,
                            'label' => 'Inhalte',
                            'displayCond' => 'FIELD:layout:=:30',
                            'config' => [
                                    'type' => 'group',
                                    'internal_type' => 'db',
                                    'allowed' => 'tt_content',
                                    'size' => '1',
                                    'maxitems' => '200',
                                    'minitems' => '0',
                                    'size' => '5',
                                    'wizards' => [
                                            'suggest' => [
                                                    'type' => 'suggest'
                                            ]
                                    ]
                            ],
                    ]
            ]
    ];
});
$additionalColumns  = array(
    'related_content' => array(
        'exclude' => 1,
        'label' => 'Inhalte',
        'displayCond' => 'FIELD:layout:=:30',
        'config' => array(
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'tt_content',
            'size' => '5',
            'maxitems' => '200',
            'minitems' => '0',
            'show_thumbs' => '1',
            'wizards' => array(
                    'suggest' => array(
                            'type' => 'suggest',
                    ),
            ),
        ),
    ),
);
\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content']['columns'],
        $additionalColumns
);
