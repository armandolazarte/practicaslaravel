<?php
namespace Siequipos\Services\Html;

class HtmlServiceProvider extends \Collective\Html\HtmlServiceProvider
{
	/**
	 * Register the HTML builder instance.
	 *
	 * @return void
	 */
	protected function registerHtmlBuilder()
	{
		$this->app->singleton('html', function($app)
		{
//			return new HtmlBuilder($app['url']);
      return new HtmlBuilder($app['url'], $app['view']);
		});
	}
	
	/**
	 * Register the form builder instance.
	 *
	 * @return void
	 */
	protected function registerFormBuilder()
	{
		$this->app->singleton('form', function($app)
		{
//			$form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());
      $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->getToken());

			return $form->setSessionStore($app['session.store']);
		});
	}
}