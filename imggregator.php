<?php
/* 
* Imggregator - An image aggregator for e107
*
* Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
* For additional information refer to the README.md file.
*
*/
require_once('../../class2.php');
require_once(HEADERF);
require_once(e_PLUGIN.'imggregator/_class.php');

$pref = e107::pref('imggregator');
$sql = e107::getDb();
$tp = e107::getParser();
$sc = e107::getScBatch('imggregator', true);
$template = e107::getTemplate('imggregator');
$template = array_change_key_case($template);

$count = (isset($_GET['count']) ? $_GET['count'] : $pref['imagesToDisplay']);

$galleryArray = array(
	'instagram' => 'Instagram',
);

foreach($galleryArray as $id => $gallery)
{
	$hook = $sql->retrieve('hooks', 'hook_tokens', 'hook_name="'.$id.'"');
	$tokens = explode(";", $hook);

	switch($id)
	{
		case 'instagram':
			$user_id = explode(':', $tokens[0]);
			$access_token = explode(':', $tokens[1]);

			$url = fetchData("https://api.instagram.com/v1/users/".$user_id[1]."/media/recent/?access_token=".$access_token[1]."&count=".$count);
			$result = json_decode($url);

			$title = $gallery;
			foreach($result->data as $post)
			{
				$images[] = $post->images->standard_resolution->url;
			}
			
			break;
	}
}

// Now that we have all the data, let's start building the page with the templates.
if($images)
{
	$sc->setVars(array($title));
	$text .= $tp->parseTemplate($template['page']['start'], false, $sc);
	
	foreach($images as $image)
	{
		$sc->setVars(array($image, $pref['imageSize']));
		$text .= $tp->parseTemplate($template['page']['image'], false, $sc);
	}

	$text .= $tp->parseTemplate($template['page']['end'], false, $sc);
}	


e107::getRender()->tablerender('Imggregator Gallery', $text);
require_once(FOOTERF);
?>
