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
		return redirect('docs/'.DEFAULT_VERSION);
	}

	/**
	 * Show a documentation page.
	 *
	 * @return Response
	 */
	public function show($version, $page = null)
	{
		if ( ! $this->isVersion($version)) {
			return redirect('docs/'.DEFAULT_VERSION.'/'.$version, 301);
		}

		$doc = $this->docs->get($version, $page ?: 'installation');

		if (is_null($doc['content'])) {
			abort(404);
		}

		$section = '';
 		 
		if ($this->docs->sectionExists($version, $page)) {		
			$section .= '/'.$page;		
		}

		return view('docs', [
			'title' => $doc['title'],
			'index' => $this->docs->getIndex($version),
			'content' => $doc['content'],
			'currentVersion' => $version,
			'versionTitle' => $this->versionTitle($version),
			'versions' => $this->getDocVersions(),
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
		return in_array($version, array_keys($this->getDocVersions()));
	}

	/**
	 * Get the readable version title
	 * @param  string $version
	 * @return string
	 */
	protected function versionTitle($version){
		return array_get($this->getDocVersions(), $version);
	}

	/**
	 * Get the available documentation versions.
	 *
	 * @return array
	 */
	protected function getDocVersions()
	{
		return config('git-repos.docs-versions');
	}

}
