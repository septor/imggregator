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
	}
	else if($hook == 'flickr')
	{
		$user_id = explode(':', $tokens[0]);
		$api_key = explode(':', $tokens[1]);

		$xml = simplexml_load_file('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='.$api_key[1].'&user_id='.urlencode($user_id[1]).'&format=rest');
		
		foreach($xml->photos->photo as $photo)
		{
			if($photo['ispublic'] == 1)
			{
				$images[] .= 'https://farm'.$photo['farm'].'.staticflickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'.jpg';
			}
		}
	}

	return $images;
}

?>
