<?php

namespace MiladRahimi\PhpConfig\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $sampleData = [
        'Band' => 'Pink Floyd',
        'Albums' => [
            'The Division Bell',
            'The Dark Side Of The Moon',
            'Wish You Were Here',
            'Animals',
            'The Wall',
        ],
        'Members' => [
            'David_Gilmour' => [
                'Guitar',
                'Vocals',
            ],
            'Roger_Waters' => [
                'Bass Guitar',
                'Vocals',
            ],
            'Syd_Barrett' => [
                'Guitar',
                'Piano',
                'Vocals',
            ],
        ],
    ];

    protected $sampleData2 = [
        'Albums' => [
            'The Division Bell',
            'The Dark Side Of The Moon',
            'Wish You Were Here',
            'Animals',
            'The Wall',
        ],
        'Members' => [
            'David_Gilmour' => [
                'Guitar',
                'Vocals',
            ],
            'Roger_Waters' => [
                'Bass Guitar',
                'Vocals',
            ],
            'Syd_Barrett' => [
                'Guitar',
                'Piano',
                'Vocals',
            ],
        ],
    ];
}