<?php namespace GetNinja\Gravatar;

use Illuminate\Support\ServiceProvider;

class GravatarServiceProvider extends ServiceProvider {
	
	/**
	 * Register the service provider.
	 * 
	 * @return void
	 */
	public function register()
	{
		$this->app['gravatar.settings'] = $this->gravatarSettings();
		
		$this->app['gravatar'] = $this->app->share(function($app)
		{
			$options = $app['gravatar.settings'];
			
			return new Gravatar($options);
		});
	}
	
	/**
	 * Get the default gravatar settings.
	 * 
	 * @return array
	 */
	protected function gravatarSettings()
	{
		return array(
			'size' => 50,
			'rating' => 'g',
			'default' => null
		);
	}
}