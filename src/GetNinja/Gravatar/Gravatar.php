<?php

namespace GetNinja\Gravatar;

class Gravatar
{
    /**
     * Array of settings that can be overridden in the construct
     * 
     * @var Array
     */
    protected $settings = array(
        'size'    => 50,
        'rating'  => 'g',
        'default' => null,
        'secure'  => false
    );

    /**
     * Array of request headers for each profile format
     *
     * @var Array
     */
    protected $headers = array(
        'vcf'  => array('Content-type: text/x-vcard;'),
        'xml'  => array('Content-type: text/xml;')
    );

    /**
     * Constructor
     *
     * @param  Array $options
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->settings = array_merge($this->settings, $options);
    }

    /**
     * Returns a url for a gravatar for a given email address
     *
     * @param  String  $email
     * @param  Integer $size
     * @param  String  $rating
     * @param  String  $default
     * @param  Boolean $secure
     * @return String
     */
    public function getGravatar($email, $size = null, $rating = null, $default = null, $secure = null)
    {
        $hash = $this->getHash($email);

        $map = array(
            's' => $size ?: $this->settings['size'],
            'r' => $rating ?: $this->settings['rating'],
            'd' => $default ?: $this->settings['default'],
        );

        if (null === $secure) {
            $secure = $this->settings['secure'];
        }

        return ($secure ? 'https://secure' : 'http://www').'.gravatar.com/avatar/'.$hash.'?'.http_build_query(array_filter($map));
    }

    /**
     * Returns gravatar profile information for a given email address
     *
     * Valid Formats include: json, xml, php, vcf, qr
     * If a format is not specified, the profile will be returned in hCard format
     *
     * Due to the way the gravatar api's work, json and qr formats return a url
     * string for use in img and script tags
     *
     * @param  String       $email
     * @param  String       $format
     * @return Array|String
     */
    public function getProfile($email, $format = null, $secure = null)
    {
        $hash = $this->getHash($email);

        $extension = '';
        if (null !== $format) {
            $extension = strtolower($format);
        }

        if (null === $secure) {
            $secure = $this->settings['secure'];
        }

        $url = ($secure ? 'https://secure' : 'http://www').'.gravatar.com/'.$hash.'.'.$extension;

        if ($format === 'qr' || $format === 'json') {
            return $url;
        }

        $browser = new \Buzz\Browser();
        if ($format !== 'php') {
            $response = $browser->get($url, $this->headers[$format]);
        } else {
            $response = $browser->get($url);
        }

        if ($response->isOk()) {
            if ($format === 'php') {
                return unserialize($response->getContent());
            } else {
                return $response->getContent();
            }
        } elseif ($response->isNotFound()) {
            throw new GravatarException($response->getStatusCode().' Error: There is no profile associated with this email address.');
        } else {
            throw new GravatarException($response->getStatusCode().' Error: There was an error trying to fetch this profile.');
        }

        return;
    }

    /**
     * Get hashed email
     *
     * @param  String $email
     * @return String
     */
    public function getHash($email)
    {
        return hash('md5', strtolower(trim($email)));
    }
}
