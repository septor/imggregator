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
	'flickr' => 'Flickr',
);

$images = array();

foreach($galleryArray as $id => $gallery)
{
	$imagesArray = getHookImages($id, $count);
	foreach($imagesArray as $singleImage)
	{
		array_push($images, $singleImage);
	}
}

// Now that we have all the data, let's start building the page with the templates.
if($images)
{
	$text .= $tp->parseTemplate($template['page']['start'], false, $sc);

	foreach($images as $image)
	{
		$sc->setVars(array(
			'url' => $image,
			'size' => $pref['imageSize']
		));
		$text .= $tp->parseTemplate($template['page']['image'], false, $sc);
	}

	$text .= $tp->parseTemplate($template['page']['end'], false, $sc);
}

e107::getRender()->tablerender('Imggregator Gallery', $text);
require_once(FOOTERF);
?>
