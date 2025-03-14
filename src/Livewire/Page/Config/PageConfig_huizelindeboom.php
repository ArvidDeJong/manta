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
            "edit" => false,
        ],
        "locale" => [
            "active" => true,
            "type" => "text",
            "title" => "Taal",
            "read" => true,
            "required" => false,
            "edit" => false,
        ],
        "homepage" => [
            "active" => false,
            "type" => "checkbox",
            "title" => "Homepage",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
            "edit" => true,
        ],
        "locked" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Vergrendeld",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
            "edit" => true,
        ],
        "fullpage" => [
            "active" => true,
            "type" => "checkbox",
            "title" => "Fullpage",
            "read" => true,
            "read_type" => "bool",
            "required" => false,
            "edit" => true,
        ],
        "template" => [
            "active" => false,
            "type" => "select",
            "title" => "Template",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "description" => [
            "active" => true,
            "type" => "text",
            "title" => "Omschrijving",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "title" => [
            "active" => true,
            "type" => "text",
            "title" => "Titel",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "title_2" => [
            "active" => true,
            "type" => "text",
            "title" => "Subtitel",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "title_3" => [
            "active" => true,
            "type" => "text",
            "title" => "Zin ter begleiding tekst",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "title_4" => [
            "active" => false,
            "type" => "text",
            "title" => "Subtitel",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "slug" => [
            "active" => true,
            "type" => "text",
            "title" => "Slug",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "seo_title" => [
            "active" => true,
            "type" => "text",
            "title" => "SEO titel",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "seo_description" => [
            "active" => true,
            "type" => "textarea",
            "title" => "SEO omschrijving",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "route" => [
            "active" => true,
            "type" => "routes",
            "title" => "Link",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "route_title" => [
            "active" => true,
            "type" => "text",
            "title" => "Link titel",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "tags" => [
            "active" => false,
            "type" => "textarea",
            "title" => "Tags",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "excerpt" => [
            "active" => false,
            "type" => "textarea",
            "title" => "Inleiding",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "content" => [
            "active" => true,
            "type" => "tinymce",
            "title" => "Bericht",
            "read" => true,
            "required" => false,
            "edit" => true,
        ]
    ]
];
