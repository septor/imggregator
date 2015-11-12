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
}
?>
