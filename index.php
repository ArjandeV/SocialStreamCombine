<?php
require 'vendor/autoload.php';

use SocialStreamCombine\Feed;
use Guzzle\Http\Client as GuzzleClient;

date_default_timezone_set('Europe/Amsterdam');

$feed = new Feed(new GuzzleClient);
$feed->registerProvider(new SocialStreamCombine\Providers\Twitter([
	'consumerKey' => '',
	'consumerSecret' => '',
	'accessToken' => '',
	'accessTokenSecret' => '',
	'username' => '',
])) ;
// $feed->registerFeed(new SocYolo\Providers\Facebook([]));
// $feed->registerFeed(new SocYolo\Providers\GooglePlus([]));
// $feed->registerFeed(new SocYolo\Providers\Youtube([]));

print_r($feed->getFeeds());
