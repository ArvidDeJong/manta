<?php

return [
    "tab_title" => "description",
    "module_name" => [
        "single" => "Tekst",
        "multiple" => "Teksten"
    ],
    "fields" => [
        "uploads" => [
            "active" => false,
            "type" => "",
            "title" => "Uploads",
            "read" => false,
            "required" => false,
        ],
        "locale" => [
            "active" => false,
            "type" => "text",
            "title" => "Taal",
            "read" => true,
            "required" => false,
        ],
        "homepage" => [
            "active" => false,
            "type" => "checkbox",
            "title" => "Homepage",
            "read" => true,
            "required" => false,
            "read_type" => "bool"
        ],
        "locked" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Vergrendeld",
            "read" => true,
            "required" => false,
            "read_type" => "bool"
        ],
        "fullpage" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Fullpage",
            "read" => true,
            "required" => false,
            "read_type" => "bool"
        ],
        "description" => [
            "active" => true,
            "type" => "text",
            "title" => "Omschrijving",
            "read" => true,
            "required" => true,
        ],
        "title" => [
            "active" => true,
            "type" => "text",
            "title" => "Titel",
            "read" => true,
            "required" => false,
        ],
        "title_2" => [
            "active" => true,
            "type" => "text",
            "title" => "Subtitel",
            "read" => true,
            "required" => false,
        ],
        "slug" => [
            "active" => true,
            "type" => "text",
            "title" => "Slug",
            "read" => true,
            "required" => true,
        ],
        "seo_title" => [
            "active" => true,
            "type" => "text",
            "title" => "SEO titel",
            "read" => true,
            "required" => false,
        ],
        "seo_description" => [
            "active" => true,
            "type" => "textarea",
            "title" => "SEO omschrijving",
            "read" => true,
            "required" => false,
        ],
        "tags" => [
            "active" => false,
            "type" => "textarea",
            "title" => "Tags",
            "read" => true,
            "required" => false,
        ],
        "excerpt" => [
            "active" => true,
            "type" => "textarea",
            "title" => "Inleiding",
            "read" => true,
            "required" => false,
        ],
        "content" => [
            "active" => true,
            "type" => "editor",
            "title" => "Bericht",
            "read" => true,
            "required" => false,
        ]
    ]
];
