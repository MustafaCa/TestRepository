<!DOCTYPE html>
<html>
<body>
<h2>Simple Twitter API Test</h2>

<?php
require_once('TwitterAPIExchange.php');
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2300920956-cHuyFOOk4KTUro3KgARV7Fzyah1ctgjJZRyYxfB",
    'oauth_access_token_secret' => "URxazvzfjN9xvDeGN9YXXkFcJxPc2o7XjuNy7wgmgK2BM",
    'consumer_key' => "FIRdyXxBksEfAij6cDZz81fAE",
    'consumer_secret' => "BEZwwJq9puLV5S5R0rpWgn2isTG2ayg436sw8JQNyOQtn1mB5L"
);
 
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=saglam&count=20';
$twitter = new TwitterAPIExchange($settings);

$string = json_decode($twitter->setGetfield($getfield)
	->buildOauth($url, $requestMethod)
	->performRequest(),$assoc = TRUE);

if($string["errors"][0]["message"] != ""){
	echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned".
	     " the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
	exit();
}
foreach($string as $items) {
	echo "Time and Date of Tweet: ".$items['created_at']."<br />";
	echo "Tweet: ". $items['text']."<br />";
	echo "Tweeted by: ". $items['user']['name']."<br />";
	echo "Screen name: ". $items['user']['screen_name']."<br />";
	echo "Followers: ". $items['user']['followers_count']."<br />";
	echo "Friends: ". $items['user']['friends_count']."<br />";
	echo "Listed: ". $items['user']['listed_count']."<br /><hr/>";
}
?>

</body>
</html>