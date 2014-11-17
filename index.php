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
// $feed->registerFeed(new SocialStreamCombine\Providers\Facebook([]));
// $feed->registerFeed(new SocialStreamCombine\Providers\GooglePlus([]));
// $feed->registerFeed(new SocialStreamCombine\Providers\Youtube([]));

print_r($feed->getFeeds());
