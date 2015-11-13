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

$count = (isset($_GET['count']) ? $_GET['count'] : $pref['imagesToDisplay']);
$fetch = (isset($pref['imagesToFetch']) ? $pref['imagesToFetch'] : 10);

$imageDir = e_PLUGIN.'imggregator/images/';

$galleries = array(
	'instagram', 'flickr',
);

$cacheTime = (isset($pref['cacheTime']) ? $pref['cacheTime'] : 3600);
if(time() < (filemtime($imageDir.'.') + $cacheTime))
{
	foreach($galleries as $gallery)
	{
		getHookImages($gallery, $fetch);
	}
}

$images = glob(e_PLUGIN.'imggregator/images/*.{jpg,jpeg,gif,png}', GLOB_BRACE);

// Now that we have all the data, let's start building the page with the templates.
if($images)
{
	$text .= $tp->parseTemplate($template['page']['start'], false, $sc);

	$i = 0;
	foreach($images as $image)
	{
		if($i < $count)
		{	
			$sc->setVars(array(
				'url' => $image,
				'size' => $pref['thumbSize']
			));
			$text .= $tp->parseTemplate($template['page']['image'], false, $sc);
		}
		$i++;
	}

	$text .= $tp->parseTemplate($template['page']['end'], false, $sc);
}

e107::getRender()->tablerender('Imggregator Gallery', $text);
require_once(FOOTERF);
?>
