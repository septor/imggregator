<?php
/* 
* Imggregator - An image aggregator for e107
*
* Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
* For additional information refer to the README.md file.
*
*/
if(!defined('e107_INIT')){ exit; }

$IMGGREGATOR_TEMPLATE['menu'] = '
	{IMGGREGATOR_IMAGE}
';

$IMGGREGATOR_TEMPLATE['page']['start'] = '
	<div class="row">
';
$IMGGREGATOR_TEMPLATE['page']['image'] = '
	<div class="span2 col-xs-6 col-md-3">
		<div class="thumbnail">
			{IMGGREGATOR_IMAGE}
		</div>
	</div>';
$IMGGREGATOR_TEMPLATE['page']['end'] = '
	</div>
';
?>
