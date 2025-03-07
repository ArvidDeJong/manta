<?php

return [
    'locale' => 'nl',

    'upload' => ['disk' => 'public'],

    'locales' => [
        ['locale' => 'nl', 'class' => 'fi-nl', 'title' => 'Nederlands', 'active' => true],
        // ['locale' => 'de', 'class' => 'fi-de', 'title' => 'Duits', 'active' => true],
        // ['locale' => 'en', 'class' => 'fi-en', 'title' => 'Engels', 'active' => true],
    ],

    'thumbnails' => [500, 800, 1080],

    'default' => [
        'mail_to_address' => env('MAIL_TO_ADDRESS'),
        'default_latitude' => env('DEFAULT_LATITUDE'),
        'default_longitude' => env('DEFAULT_LONGITUDE'),
        'default_company' => env('DEFAULT_COMPANY'),
        'default_contact' => env('DEFAULT_CONTACT'),
        'default_address' => env('DEFAULT_ADDRESS'),
        'default_zipcode' => env('DEFAULT_ZIPCODE'),
        'default_city' => env('DEFAULT_CITY'),
        'default_country' => env('DEFAULT_COUNTRY'),
        'default_phone' => env('DEFAULT_PHONE'),
        'default_email' => env('DEFAULT_EMAIL'),
        'default_kvk' => env('DEFAULT_KVK'),
        'default_vat' => env('DEFAULT_VAT'),
        'default_facebook' => env('DEFAULT_FACEBOOK'),
        'default_twitter' => env('DEFAULT_TWITTER'),
        'default_linkedin' => env('DEFAULT_LINKEDIN'),
        'default_youtube' => env('DEFAULT_YOUTUBE'),
        'default_tiktok' => env('DEFAULT_TIKTOK'),
        'google_maps_zoom' => env('GOOGLE_MAPS_ZOOM'),
    ],

    'modules' => [
        [
            "active" => false,
            "name" => "agenda",
            "routename" => "evenementen",
            "title" => "Evenementen",
            "route" => "agenda.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "news",
            "routename" => "nieuws",
            "title" => "Blog",
            "route" => "news.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "becomeamember",
            "routename" => "nieuwe-leden",
            "title" => "Nieuwe leden",
            "route" => "becomeamember.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "cartdetail",
            "routename" => "winkelwagen",
            "title" => "Winkelwagen",
            "route" => "cartdetail.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => true,
            "name" => "contact",
            "routename" => "contact",
            "title" => "Contact",
            "route" => "contact.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "contactperson",
            "routename" => "contactperson",
            "title" => "Contactpersonen",
            "route" => "contactperson.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "document",
            "routename" => "documentatie",
            "title" => "Documentatie",
            "route" => "document.list",
            "location" => "bottom",
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "knowledgebase",
            "routename" => "knowledgebase",
            "title" => "Kennisbank",
            "route" => "knowledgebase.list",
            "location" => "bottom",
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "faq",
            "routename" => "veel-gestelde-vragen",
            "title" => "Veelgestelde vragen",
            "route" => "faq.list",
            "location" => "bottom",
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "house",
            "routename" => "huizen",
            "title" => "Huizen",
            "route" => "house.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "menu",
            "routename" => "menu",
            "title" => "Menu",
            "route" => "menu.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "openinghour",
            "routename" => "openinghour",
            "title" => "Openingstijden",
            "route" => "openinghour.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => true,
            "name" => "page",
            "routename" => "page",
            "title" => "Teksten",
            "route" => "page.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "photoalbum",
            "routename" => "fotoalbums",
            "title" => "Fotoalbums",
            "route" => "photoalbum.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "popup",
            "routename" => "popup",
            "title" => "Popup",
            "route" => "popup.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "project",
            "routename" => "projecten",
            "title" => "Projecten",
            "route" => "project.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "product",
            "routename" => "producten",
            "title" => "Producten",
            "route" => "product.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "ticket",
            "routename" => "tickets",
            "title" => "Tickets",
            "route" => "ticket.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "reservation",
            "routename" => "reserveringen",
            "title" => "Reserveringen",
            "route" => "reservation.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "vacancy",
            "routename" => "vacatures",
            "title" => "Vacatures",
            "route" => "vacancy.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "vacancyreaction",
            "routename" => "vacancyreaction",
            "title" => "Vacature reacties",
            "route" => "vacancyreaction.list",
            "location" => null,
            "menu" => ""
        ],
        [
            "active" => false,
            "name" => "villageroftheyear",
            "routename" => "dorper-van-het-jaar",
            "title" => "Dorper van het jaar",
            "route" => "villageroftheyear.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "villageroftheyearSubmission",
            "routename" => "dorper-van-het-jaar-inzendingen",
            "title" => "Dorper van het jaar inzendingen",
            "route" => "villageroftheyearSubmission.list",
            "location" => null,
            "menu" => "general"
        ],
        [
            "active" => false,
            "name" => "translator",
            "routename" => "translator",
            "title" => "Algemene vertalingen",
            "route" => "translator.list",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "staff",
            "routename" => "gebruikers",
            "title" => "Gebruikers",
            "route" => "staff.list",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "settings",
            "routename" => "instellingen",
            "title" => "Instellingen",
            "route" => "cms.options",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "mailtrap",
            "routename" => "mailtrap",
            "title" => "Maillog",
            "route" => "mailtrap.list",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "upload",
            "routename" => "upload",
            "title" => "Upload",
            "route" => "upload.list",
            "location" => null,
            "menu" => ""
        ],
        [
            "active" => false,
            "name" => "user",
            "routename" => "klanten",
            "title" => "Klanten",
            "route" => "user.list",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "routeseo",
            "routename" => "routeseo",
            "title" => "Route SEO",
            "route" => "routeseo.list",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => false,
            "name" => "sandbox",
            "routename" => "zandbak",
            "title" => "Zandbak",
            "route" => "cms.sandbox",
            "location" => null,
            "menu" => "tools"
        ],
        [
            "active" => true,
            "name" => "chatgpt",
            "routename" => "chatgpt",
            "title" => "ChatGPT",
            "route" => "chatgpt.chat",
            "location" => null,
            "menu" => "tools"
        ]
    ]
];
