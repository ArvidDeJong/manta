<?php

return [
    "tab_title" => "description",
    "module_name" => [
        "single" => "Tekst",
        "multiple" => "Teksten"
    ],
    "fields" => [
        "uploads" => [
            "active" => true,
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
            "active" => true,
            "type" => "checkbox",
            "title" => "Homepage",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
        ],
        "homepageSort" => [
            "active" => true,
            "type" => "number",
            "title" => "Homepage volgorde",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
            "step" => 1,
        ],
        "locked" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Vergrendeld",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
        ],
        "fullpage" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Fullpage",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
        ],
        "template" => [
            "active" => true,
            "type" => "select",
            "title" => "Template",
            "read" => true,
            "required" => true,
            "options" => ['text' => 'Alleen tekst', 'image-right' => 'Plaatje rechts', 'image-left' => 'Plaatje links'],
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
            "required" => true,
        ],
        "title_2" => [
            "active" => false,
            "type" => "text",
            "title" => "Subtitel",
            "read" => true,
            "required" => false,
        ],
        "title_4" => [
            "active" => false,
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
        "title_3" => [
            "active" => true,
            "type" => "text",
            "title" => "Link beschrijving",
            "read" => true,
            "required" => false,
        ],
        "link" => [
            "active" => true,
            "type" => "text",
            "title" => "Link naar:",
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
            "active" => false,
            "type" => "textarea",
            "title" => "Inleiding",
            "read" => true,
            "required" => false,
        ],
        "content" => [
            "active" => true,
            "type" => "tinymce",
            "title" => "Bericht",
            "read" => true,
            "required" => false,
        ]
    ]
];
