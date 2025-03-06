<?php

return [
    "tab_title" => "name",
    "module_name" => [
        "single" => "Maillog",
        "multiple" => "Maillog"
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
            "active" => false,
            "type" => "",
            "title" => "Uploads",
            "read" => false,
            "required" => false,
            "edit" => false,
        ],
        "email" => [
            "active" => true,
            "type" => "email",
            "title" => "E-mail",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "event" => [
            "active" => true,
            "type" => "text",
            "title" => "Event",
            "read" => true,
            "required" => true,
            "edit" => true,
        ],
        "timestamp" => [
            "active" => true,
            "type" => "datetime",
            "title" => "Tijdstempel",
            "read" => true,
            "required" => true,
            "edit" => false,
        ],
        "sending_stream" => [
            "active" => true,
            "type" => "text",
            "title" => "Verzendstroom",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "category" => [
            "active" => true,
            "type" => "text",
            "title" => "Categorie",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
        "message_id" => [
            "active" => true,
            "type" => "text",
            "title" => "Bericht ID",
            "read" => true,
            "required" => true,
            "edit" => false,
        ],
        "event_id" => [
            "active" => true,
            "type" => "text",
            "title" => "Event ID",
            "read" => true,
            "required" => true,
            "edit" => false,
        ],
        "custom_variables" => [
            "active" => true,
            "type" => "json",
            "title" => "Aangepaste Variabelen",
            "read" => true,
            "required" => false,
            "edit" => true,
        ],
    ]
];
