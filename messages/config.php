<?php
return [
    
    'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
    'messagePath' => __DIR__,
    'languages' => ['en', 'sr-Latn'],
    'translator' => 'Yii::t',
    'sort' => false,
    'overwrite' => true,
    'removeUnused' => false,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
    ],
    'format' => 'php'
];