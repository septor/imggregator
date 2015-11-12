<?php

function fetchData($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function getHookImages($hook, $count)
{
	$sql = e107::getDb();
	$pref = e107::pref('imggregator');

	$count = (isset($count) ? $count : $pref['imagesToDisplay']);

	$tokens = explode(';',$sql->retrieve('hooks', 'hook_tokens', 'hook_name="'.$hook.'"'));

	if($hook == 'instagram')
	{
		$user_id = explode(':', $tokens[0]);
		$access_token = explode(':', $tokens[1]);
		$url = fetchData('https://api.instagram.com/v1/users/'.$user_id[1].'/media/recent/?access_token='.$access_token[1].'&count='.$count);
		$result = json_decode($url);

		foreach($result->data as $image)
		{
			$images[] = $image->images->standard_resolution->url;
		}

		return $images;
	}
}

?>
