<?php

/*
 * This file is part of the package ucph_cardgroup.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'label' => 'header',
        'label_alt' => 'bodytext',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'title' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_card',
        'delete' => 'deleted',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'hideTable' => true,
        'hideAtCopy' => true,
        'prependAtCopy' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.prependAtCopy',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'languageField' => 'sys_language_uid',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'typeicon_classes' => [
            'default' => 'ucph-cardgroup-icon',
        ]
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                header,
                bodytext,
                cardlink,
                image,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,
            '
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => ''
        ],
        'access' => [
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel
            '
        ],
        'general' => [
            'showitem' => '
                tt_content
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_cards
            '
        ],
        // hidden but needs to be included all the time, so sys_language_uid is set correctly
        'hiddenLanguagePalette' => [
            'showitem' => 'sys_language_uid, l10n_parent',
            'isHiddenPalette' => true,
        ],
    ],
    'columns' => [
        'tt_content' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_tt_content',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID### AND tt_content.{#CType}=\'ucph_cardgroup\'',
                'maxitems' => 1,
                'default' => 0,
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language']
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '',
                        0
                    ]
                ],
                'foreign_table' => 'tx_ucph_cardgroup_item',
                'foreign_table_where' => 'AND tx_ucph_cardgroup_item.pid=###CURRENT_PID### AND tx_ucph_cardgroup_item.sys_language_uid IN (-1,0)',
                'default' => 0
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'header' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_card_header',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 100,
                'eval' => 'trim'
            ],
        ],
        'bodytext' => [
            'label' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_card_teaser',
            'l10n_mode' => 'prefixLangTitle',
            'l10n_cat' => 'text',
            'config' => [
                'type' => 'text',
                'cols' => '50',
                'rows' => '4',
                'max' => 150,
                'eval' => 'trim',
                'softref' => 'typolink_tag,email[subst],url',
                'enableRichtext' => true
            ],
        ],
        'cardlink' => [
            'label' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_card_link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                // Replace with the following in v.12:
                //'type' => 'link',
                //'allowedTypes' => ['page', 'url', 'record'],
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_card_image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'maxitems' => 1,
                    'filter' => [
                        0 => [
                            'parameters' => [
                                'allowedFileExtensions' => 'jpg,jpeg,png,svg',
                            ],
                        ],
                    ],
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'columns' => [
                            'uid_local' => [
                                'config' => [
                                    'appearance' => [
                                        'elementBrowserType' => 'file',
                                        'elementBrowserAllowed' => 'jpg,jpeg,png,svg'
                                    ],
                                ]
                            ],
                            'alternative' => [
                                'description' => 'LLL:EXT:ucph_cardgroup/Resources/Private/Language/locallang_be.xlf:ucph_cardgroup_cardimage_alt'
                            ]
                        ],
                        'types' => [
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                alternative,--linebreak--,crop,
                                --palette--;;filePalette'
                            ]
                        ]
                    ]
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
    ]
];