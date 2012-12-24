<?php namespace GetNinja\Gravatar\Tests;

use Mockery as m;
use GetNinja\Gravatar\Gravatar;

class GravatarTest extends PHPUnit_Framework_TestCase {
	
	public function teardown()
	{
		m::close();
	}
	
	public function testGravatarUrlWithDefaultOptions()
	{
		$gravatar = new Gravatar();
		$this->assertEquals('http://www.gravatar.com/avatar/9b2108118a83e6266e758a3ac50e715c?s=50&r=g', $gravatar->getGravatar('luke@monkeywrench.cc'));
	}
	
	public function testGravatarSecureUrlWithDefaultOptions()
	{
		$gravatar = new Gravatar();
		$this->assertEquals('https://secure.gravatar.com/avatar/9b2108118a83e6266e758a3ac50e715c?s=50&r=g', $gravatar->getGravatar('luke@monkeywrench.cc', null, null, null, true));
	}
	
	public function testGravatarUrlWithDefaultImage()
	{
		$gravatar = new Gravatar();
		$this->assertEquals('http://www.gravatar.com/avatar/9b2108118a83e6266e758a3ac50e715c?s=50&r=g&d=mm', $gravatar->getGravatar('luke@monkeywrench.cc', 50, 'g', 'mm'));
	}
	
	public function testGravatarInitializedWithOptions()
	{
		$gravatar = new Gravatar(array(
			'size' => 35,
			'default' => 'mm',
		));
		
		$this->assertEquals('http://www.gravatar.com/avatar/9b2108118a83e6266e758a3ac50e715c?s=35&r=g&d=mm', $gravatar->getGravatar('luke@monkeywrench.cc'));
	}
}