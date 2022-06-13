<?php

use App\Filters\RulesBuilder;

return [
    [
        'payment_method_id' => 1,
        'fields' => [
            'countryCode' => [
                'type' => RulesBuilder::FILTER_TYPE_LIST,
                'values' => ['UK'],
                'rule_type' => 'show'
            ],
        ],
        'rule_type' => 'show'
    ],
    [
        'payment_method_id' => 3,
        'fields' => [
            'amount' => [
                'type' => RulesBuilder::FILTER_TYPE_VALUE,
                'operation' => '<',
                'value' => 30,
            ],
            'lang' => [
                'type' => RulesBuilder::FILTER_TYPE_VALUE,
                'operation' => '===',
                'value' => 'ru',
            ]
        ],
        'rule_type' => 'show'
    ],
    [
        'payment_method_id' => 4,
        'fields' => [
            'productType' => [
                'type' => RulesBuilder::FILTER_TYPE_VALUE,
                'operation' => '===',
                'value' => 'reward',
            ],
            'lang' => [
                'type' => RulesBuilder::FILTER_TYPE_VALUE,
                'operation' => '===',
                'value' => 'ru',
            ],
            'amount' => [
                'type' => RulesBuilder::FILTER_TYPE_VALUE,
                'operation' => '<',
                'value' => 10,
            ],
        ],
        'rule_type' => 'hide others'

    ],
    [
        'payment_method_id' => 6,
        'fields' => [
            'user_os' => [
                'type' => 'compare',
                'operation' => '===',
                'value' => 'android',
            ],
            'countryCode' => [
                'type' => 'list',
                'values' => ['IN'],
                'rule_type' => 'hide'
            ],
        ],
        'rule_type' => 'show'

    ],
    [
        'payment_method_id' => 5,
        'fields' => [
            'user_os' => [
                'type' => 'compare',
                'operation' => '===',
                'value' => 'ios',
            ],
        ],
        'rule_type' => 'show'

    ],
    [
        'payment_method_id' => 4,
        'fields' => [
            'productType' => [
                'type' => 'compare',
                'operation' => '===',
                'value' => 'walletRefill',
            ],
        ],
        'rule_type' => 'hide'
    ],
];
