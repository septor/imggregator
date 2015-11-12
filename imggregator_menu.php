<?php
/*
 * Imggregator - An image aggregator for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
if(!defined('e107_INIT')){ exit; }
require_once(e_PLUGIN.'imggregator/_class.php');

$pref = e107::pref('imggregator');
$tp = e107::getParser();
$sc = e107::getScBatch('imggregator', true);
$template = e107::getTemplate('imggregator');

$galleries = array(
	'instagram'
);

$images = getHookImages($galleries[array_rand($galleries)], $pref['imagesToDisplay']);

$sc->setVars(array(
	'url' => $images[array_rand($images)],
	'size' => $pref['imageSize']
));
$text = $tp->parseTemplate($template['menu'], false, $sc);

e107::getRender()->tablerender('Imggregator', $text);
?>
