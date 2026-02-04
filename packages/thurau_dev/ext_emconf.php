<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Thurau Dev',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'ThurauDevelopment\\ThurauDev\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Dominik Thurau',
    'author_email' => 'domi.thurau@gmail.com',
    'author_company' => 'Thurau Development',
    'version' => '1.0.0',
];
