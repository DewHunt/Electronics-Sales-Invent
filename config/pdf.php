<?php
return [
	// ...
	'font_path' => base_path('/public/fonts/'),
	'font_data' => [
		'bangla' => [
            'R'  => 'SolaimanLipi.ttf',    // regular font
            'B'  => 'SolaimanLipi.ttf',       // optional: bold font
            'I'  => 'SolaimanLipi.ttf',     // optional: italic font
            'BI' => 'SolaimanLipi.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,   
            'useKashida' => 75, 
        ],

        'common' => [
            'R'  => 'Nikosh.ttf',    // regular font
            'B'  => 'Nikosh.ttf',       // optional: bold font
            'I'  => 'Nikosh.ttf',     // optional: italic font
            'BI' => 'Nikosh.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,   
            'useKashida' => 75, 
        ],

        [
	'format'           => 'A4',
	'author'           => 'John Doe',
	'subject'          => 'This Document will explain the whole universe.',
	'keywords'         => 'PDF, Laravel, Package, Peace', // Separate values with comma
	'creator'          => 'Laravel Pdf',
	'display_mode'     => 'fullpage'
]
		// ...add as many as you want.
	]
	// ...
];
?>