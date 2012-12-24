<?php namespace GetNinja\Gravatar;

class Gravatar {
	
	/**
	 * Array of settings that can be overridden in the construct
	 * 
	 * @var array
	 */
	protected $settings = array(
		'size' => 50,
		'rating' => 'g',
		'default' => null
	);
	
	/**
	 * Constructor
	 *
	 * @param array $options
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->settings = array_merge($this->settings, $options);
	}
	
	/**
	 * Returns a url for a gravatar for a given email address
	 *
	 * @param string  $email
	 * @param integer $size
	 * @param string  $rating
	 * @param string  $default
	 * @param Boolean $secure
	 * @return string
	 */
	public function getGravatar($email, $size = null, $rating = null, $default = null, $secure = false)
	{
		$hash = md5(strtolower($email));
		
		$map = array(
			's' => $size ?: $this->settings['size'],
			'r' => $rating ?: $this->settings['rating'],
			'd' => $default ?: $this->settings['default'],
		);
		
		return ($secure ? 'https://secure' : 'http://www').'.gravatar.com/avatar/'.$hash.'?'.http_build_query(array_filter($map));
	}
}