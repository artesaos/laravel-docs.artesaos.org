<?php return [
	'enabled' => ['master', 'master-en_US', '5.1', '5.1-en_US', '5.0', '5.0-en_US'],

	'docs-versions' => [
		'master' => 'Master',
		'master-en_US' => 'Master English',

		'5.1'  => '5.1',
		'5.1-en_US'  => '5.1 English',

		'5.0' => '5.0',
		'5.0-en_US' => '5.0 English'
	],

	'repositories' => [
		'master' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR'
		],

		'master-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => 'master',
			'view-path' => ''
		],

		'5.1' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR'
		],

		'5.1-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => '5.1',
			'view-path' => ''
		],

		'5.0' => [
			'url' => 'https://github.com/rhchristian/laravel-docs-pt-br.git',
			'branch' => 'master',
			'view-path' => ''
		],

		'5.0-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => '5.0',
			'view-path' => ''
		],
	],


];
