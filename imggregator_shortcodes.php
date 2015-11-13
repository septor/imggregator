<?php
/*
 * Imggregator - An image aggregator for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
if(!defined('e107_INIT')){ exit; }

class imggregator_shortcodes extends e_shortcode
{
	function sc_imggregator_image($parm='')
	{
		list($width, $height) = explode('x', $this->var['size']);

		return '<img style="height:'.$height.'px; width:'.$width.'px;" src="'.$this->var['url'].'" />';
	}

	function sc_imggregator_source($parm='')
	{
		if(strpos($this->var['url'], 'instagram') !== false)
		{
			$source = 'Instagram';
		}
		else if(strpos($this->var['url'], 'flickr') !== false)
		{
			$source = 'Flickr';
		}
		else
		{
			$source = 'Unknown';
		}

		return $source;
	}
}
?>
