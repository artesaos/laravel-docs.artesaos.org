<?php return [
	'enabled' => ['master', '5.0', '5.1'],

	'docs-versions' => [
		'master' => 'Master',
		'5.1'  => '5.1',
		'5.0' => '5.0'
	],

	'repositories' => [
		'master' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR'
		],

		'5.1' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR'
		],

		'5.0' => [
			'url' => 'https://github.com/rhchristian/laravel-docs-pt-br.git',
			'branch' => 'master',
			'view-path' => ''
		],
	],


];
