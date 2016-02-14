<?php return [
	/*
	 * Git repositories
	 * To download all enabled repos just use the artisan command:
	 * php artisan git:docs:clone
	 */

	/*
	 * Default version to be displayed 
	 */
	'default-version' => 'master',

	/*
	 * Git repositories 
	 * "folder to clone (unique)" => [
	 *    "url" => "https://git url"
	 *    "branch" => "branch to checkout"
	 *    "view-path" => "sub-path of 'folder' to be displayed"
	 * ]
	 */
	'repositories' => [
		'master' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR',
			'title' => 'Master',
			'enabled' => true
		],

		'master-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => 'master',
			'view-path' => '',
			'title' => 'Master English',
			'enabled' => true
		],

		'5.2' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => '5.2',
			'view-path' => 'pt_BR',
			'title' => '5.2',
			'enabled' => true
		],

		'5.2-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => '5.2',
			'view-path' => '',
			'title' => '5.2 English',
			'enabled' => true
		],
		
		'5.1' => [
			'url' => 'https://github.com/artesaos/laravel-docs.git',
			'branch' => 'master',
			'view-path' => 'pt_BR',
			'title' => '5.1',
			'enabled' => true
		],

		'5.1-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => '5.1',
			'view-path' => '',
			'title' => '5.1 English',
			'enabled' => true
		],

		'5.0' => [
			'url' => 'https://github.com/rhchristian/laravel-docs-pt-br.git',
			'branch' => 'master',
			'view-path' => '',
			'title' => '5.0',
			'enabled' => true
		],

		'5.0-en_US' => [
			'url' => 'https://github.com/laravel/docs.git',
			'branch' => '5.0',
			'view-path' => '',
			'title' => '5.0 English',
			'enabled' => true
		],
	],


];
