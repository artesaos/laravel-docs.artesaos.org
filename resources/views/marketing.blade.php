@extends('app')

@section('body-class')
home
@endsection

@section('content')

<nav id="slide-menu" class="slide-menu" role="navigation">

	<div class="brand">
		<a href="/">
			<img src="/assets/img/laravel-logo-white.png" height="50" alt="Laravel white logo">
		</a>
	</div>

	<ul class="slide-main-nav">
		@include('partials.main-nav')
	</ul>

</nav>

<section class="panel statement light">
	<div class="content">
		<h1>Gosta de código bonito? Nós também.</h1>
		<p>O Framework PHP para os Artesãos da Web</p>
		<div class='browser-window'>
			<div class='top-bar'>
				<div class='circles'>
					<div class="circle circle-red"></div>
					<div class="circle circle-yellow"></div>
					<div class="circle circle-green"></div>
				</div>
			</div>
			<div class='window-content'>
				<pre class="line-numbers"><code class="language-php">
&lt;?php


class Idea extends Eloquent {

	/**
	 * Sonhando com algo mais?
	 *
	 * @with Laravel
	 */
	 public function create()
	 {
	 	// Tenha um bom início...
	 }

}

	</code></pre>
				</div>
			</div>

		</div>
	</div>
	<a href="#features" class="next-up">
		Características Poderosas e Modernas
		<img src="/assets/img/down-arrow.png">
	</a>
</section>

<section class="panel features dark" id="features">
	<h1>Alguém disse rápido?</h1>
	<p>Aplicações elegantes entregues em velocidade dobrada.</p>
		<div class="blocks stacked">
			<div class="block odd">
				<div class="text">
					<h2>Expressiva e linda sintaxe.</h2>
                    <p>
                        Valoriza elegância, simplicidade e legibilidade? Você vai se encaixar bem. Laravel é projetado para pessoas como você. Se você precisar de ajuda para começar, veja o <a href="https://codecasts.com.br">Codecasts</a> e nossa <a href="/docs">grande documentação</a>.
                    </p>
				</div>
				<div class="media">

					<div class='browser-window'>
						<div class='top-bar'>
							<div class='circles'>
								<div class="circle circle-red"></div>
								<div class="circle circle-yellow"></div>
								<div class="circle circle-green"></div>
							</div>
						</div>
						<div class='window-content'>
							<pre class="line-numbers"><code class="language-php">
class Purchase implements ShouldBeQueued {

	/**
	 * Purchase a new podcast.
	 */
	 public function handle(Repository $repo)
	 {
	 	foreach ($this->purchases as $purchase)
	 	{
	 		//
	 	}
	 }
</code></pre>
						</div>
					</div>

				</div>
			</div><!-- /.block -->
			<div class="block even">
				<div class="text">
					<h2>Sob medida para sua equipe.</h2>
                    <p>
                        Não importa se você é um lobo solitário ou uma equipe gigante, Laravel é uma brisa de renovação.
                        Matenha todos em sincronia usando as <a href="/docs/migrations">migrações de banco de dados</a> agnósticas e o  <a href="/docs/schema">construtor de schemas</a> do Laravel.
                    </p>
				</div>
				<div class="media">
					<div class="terminal-window">
						<div class='top-bar'></div>
						<div class='window-content'>
							<div class="dark-code">
							<pre><code class="language-bash">
~/Apps $ php artisan make:migration create_users_table
Migration created successfully!

~/Apps $ php artisan migrate --seed
Migrated: 2015_01_12_000000_create_users_table
Migrated: 2015_01_12_100000_create_password_resets_table
Migrated: 2015_01_13_162500_create_projects_table
Migrated: 2015_01_13_162508_create_servers_table
</code></pre></div>
						</div>
					</div>
				</div>
			</div><!-- /.block -->
			<div class="block odd">
				<div class="text">
					<h2>Kit de Ferramentas Modernas.</h2>
					<p>Um <a href="/docs/eloquent">excelente ORM</a>, <a href="/docs/routing">rotas</a> rotas sem sofrimento, <a href="/docs/queues">filas</a> poderosas, e <a href="/docs/authentication">autenticação simples</a> lhe darão as ferramentas que você precisa para modernizar e manter seu PHP.
                        Nós melhoramos os pequenos detalhes para ajudar você a entregar aplicações surpreendentes.
				</div>
				<div class="media">

					<div class='browser-window'>
						<div class='top-bar'>
							<div class='circles'>
								<div class="circle circle-red"></div>
								<div class="circle circle-yellow"></div>
								<div class="circle circle-green"></div>
							</div>
						</div>
						<div class='window-content'>
							<pre class="line-numbers"><code class="language-php">
Route::resource('photos', 'PhotoController');

/**
 * Retrieve A User...
 */
Route::get('/user/{id}', function($id)
{
	return User::with('posts')->firstOrFail($id);
})
</code></pre>
					</div>
				</div>
			</div><!-- /.block -->
		</div>
@endsection
