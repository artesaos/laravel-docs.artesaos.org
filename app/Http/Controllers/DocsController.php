<?php namespace App\Http\Controllers;

use App\Documentation;

class DocsController extends Controller {

	/**
	 * The documentation repository.
	 *
	 * @var Documentation
	 */
	protected $docs;

	/**
	 * Create a new controller instance.
	 *
	 * @param  Documentation  $docs
	 * @return void
	 */
	public function __construct(Documentation $docs)
	{
		$this->docs = $docs;
	}

	/**
	 * Show the root documentation page (/docs).
	 *
	 * @return Response
	 */
	public function showRootPage()
	{
		return redirect('docs/'.$this->docs->defaultVersion());
	}

	/**
	 * Show a documentation page.
	 *
	 * @return Response
	 */
	public function show($version, $page = null)
	{
		if ( ! $this->isVersion($version)) {
			return redirect('docs/'.$this->docs->defaultVersion().'/'.$version, 301);
		}

		if (!$this->docs->sectionExists($version, $page ?: 'installation')) {	
			abort(404);	
		}

		$section = '/'.$page;

		$doc = $this->docs->get($version, $page ?: 'installation');

		return view('docs', [
			'title' => $doc['title'],
			'index' => $this->docs->getIndex($version),
			'content' => $doc['content'],
			'currentVersion' => $version,
			'versionTitle' => $this->versionTitle($version),
			'versions' => $this->getEnabledVersions(),
			'currentSection' => $section,
		]);
	}

	/**
	 * Determine if the given URL segment is a valid version.
	 *
	 * @param  string  $version
	 * @return bool
	 */
	protected function isVersion($version)
	{
		//dd($this->getEnabledVersions());

		return in_array($version, array_keys($this->getEnabledVersions()));
	}

	/**
	 * Get the readable version title
	 * @param  string $version
	 * @return string
	 */
	protected function versionTitle($version){
		return array_get($this->getEnabledVersions(), $version);
	}

	/**
	 * Get the available documentation versions.
	 *
	 * @return array
	 */
	protected function getEnabledVersions()
	{
		return $this->docs->getDocsEnabledVersions();
	}

}
