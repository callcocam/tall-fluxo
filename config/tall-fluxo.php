<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Tall\Fluxo\Core\Fields\Field;

return [
    'fildes'=>[
        'before'=>[
            Field::make(null,
            'nome_produto',
            'nome_produto',
            'text',
            null,
            12,
            1,
            'defer',
            'published')->form_attributes([
                'wire:model.defer'=>'data.nome_produto',
                'type'=>'text',
                'class'=>'block w-full rounded-md border-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'
            ]),
            Field::make(null,
            'cod_barras',
            'cod_barras',
            'text',
            null,
            12,
            1,
            'defer',
            'published')->form_attributes([
                'wire:model.defer'=>'data.cod_barras',
                'type'=>'text',
                'class'=>'block w-full rounded-md border-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'
            ])
        ],
        'after'=>[

        ]
    ],
    'views'=>[
        'form'=>[
            'text',
            'radio',
            'checkbox',
            'select',
            'date',
            'phone',
            'datetime-local',
            'range',
            'email',
            'number',
            'textarea'
        ],
        'db'=>[
            'db',
            'db-radio',
            'db-checkbox',
            'db-select',
            'db-range',
            'db-number',
        ],
        'table'=>[
            'db',
            'text',
            'cover',
            'status',
            'avatar',
            'email',
            'phone',
            'date',
            'datetime-local',
            'range',
            'money',
            'detail'
            ]
    ]
];