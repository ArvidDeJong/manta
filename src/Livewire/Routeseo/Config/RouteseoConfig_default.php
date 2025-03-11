<?php

return [
    "tab_title" => "seo_title",
    "module_name" => [
        "single" => "SEO",
        "multiple" => "SEO"
    ],
    'upload_data' => [
        'fields' =>
        [
            'title_1' => ['type' => 'string', 'required' => false, 'title' => 'Titel 1'],
            'title_2' => ['type' => 'string', 'required' => false, 'title' => 'Titel 2'],
            'button_1' => ['type' => 'string', 'required' => false, 'title' => 'Titel knop'],
            'url_1' => ['type' => 'route', 'required' => false, 'title' => 'Route knop'],
        ]
    ],
    "fields" => [
        "locale" => [
            "active" => false,
            "type" => "text",
            "title" => "Taal",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "uploads" => [
            "active" => true,
            "type" => "",
            "title" => "Uploads",
            "read" => false,
            "required" => false,
            "edit" => false,
        ],
        "title" => [
            "active" => true,
            "type" => "text",
            "title" => "Titel",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "route" => [
            "active" => true,
            "type" => "text",
            "title" => "Route",
            "read" => true,
            "required" => false,
            "edit" => false,
        ],
        "seo_title" => [
            "active" => true,
            "type" => "text",
            "title" => "SEO titel",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "seo_description" => [
            "active" => true,
            "type" => "textarea",
            "title" => "SEO omschrijving",
            "read" => true,
            "required" => true,
            "edit" => true,
        ]
    ]
];
