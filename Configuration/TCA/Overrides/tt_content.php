<?php

/*
 * This file is part of the package ucph_cardgroup.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

call_user_func(function ($extKey ='ucph_cardgroup', $contentType ='ucph_cardgroup') {
    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }

    // Add content element PageTSConfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'ku_semi_collapsible_accordion',
        'Configuration/TsConfig/Page.tsconfig',
        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_title'
    );

    // Add content element to selector list
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_title',
            $contentType,
            'ucph-cardgroup-icon',
            $extKey
        ]
    );

    // Assign Icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$contentType] = 'ucph-cardgroup-icon';

    // Configure element type
    $GLOBALS['TCA']['tt_content']['types'][$contentType] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types']['ucph_cardgroup'],
        [
            'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header; LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_internal_title,
                tx_ucph_cardgroup_item,
            --div--;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_options,
                pi_flexform;LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_options,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            'columnsOverrides' => [
                'image' => [
                    'config' => [
                        'minitems' => 1,
                        'appearance' => [
                            'elementBrowserType' => 'file',
                            'elementBrowserAllowed' => 'jpg,jpeg,png,svg'
                        ],
                        'filter' => [
                            0 => [
                                'parameters' => [
                                    'allowedFileExtensions' => 'jpg,jpeg,png,svg',
                                ],
                            ],
                        ],
                        'overrideChildTca' => [
                            'columns' => [
                                'uid_local' => [
                                    'config' => [
                                        'appearance' => [
                                            'elementBrowserAllowed' => 'jpg,jpeg,png,svg',
                                        ],
                                    ],
                                ],
                                'alternative' => [
                                    'description' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_cardimage_alt'
                                ]
                            ],
                            'types' => [
                                \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                    'showitem' => '
                                    alternative,description,--linebreak--,crop,
                                    --palette--;;filePalette'
                                ]
                            ],
                        ],
                    ],
                ],
            ],
        ]
    );

    // Register fields
    $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['columns'],
        [
            'tx_ucph_cardgroup_item' => [
                'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_cards',
                'config' => [
                    'minitems' => 1,
                    'type' => 'inline',
                    'foreign_table' => 'tx_ucph_cardgroup_item',
                    'foreign_field' => 'tt_content',
                    'appearance' => [
                        'newRecordLinkTitle' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_add',
                        'useSortable' => true,
                        'showSynchronizationLink' => true,
                        'showAllLocalizationLink' => true,
                        'showPossibleLocalizationRecords' => true,
                        'expandSingle' => true,
                        'enabledControls' => [
                            'localize' => true,
                        ]
                    ],
                    'behaviour' => [
                        'mode' => 'select',
                    ]
                ]
            ]
        ]
    );

    // Add flexForms for content element configuration
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:' . $extKey . '/Configuration/FlexForms/UcphCardGroup.xml',
        $contentType
    );
});
