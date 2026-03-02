<?php

// Config
$config   = pwConfig::load('pwmulticolumn');
$settings = $config['content'];

// Custom CSS
if ($block->content()->theme()->value() === 'custom'):
	snippet('customcss', [
		'blockid' => 'b'.$block->id(),
		'textcolor' => $block->content()->textcolor()->value(),
		'backgroundcolor' => $block->content()->backgroundcolor()->value()
	]);
endif;

// Section
echo '<section';
echo ' data-block="multicolumn"';
echo ' data-block-id="b'.$block->id().'"';
echo ' data-margin-top="'.$block->margintop()->value().'"';
echo ' data-margin-bottom="'.$block->marginbottom()->value().'"';
echo ' data-padding-top="'.$block->paddingtop()->value().'"';
echo ' data-padding-right="'.$block->paddingright()->value().'"';
echo ' data-padding-bottom="'.$block->paddingbottom()->value().'"';
echo ' data-padding-left="'.$block->paddingleft()->value().'"';
echo ' data-radius-top-left="'.$block->radiustopleft()->value().'"';
echo ' data-radius-top-right="'.$block->radiustopright()->value().'"';
echo ' data-radius-bottom-right="'.$block->radiusbottomright()->value().'"';
echo ' data-radius-bottom-left="'.$block->radiusbottomleft()->value().'"';
echo ' data-style="'.$block->theme()->value().'"';
echo ' data-block-size="'.$block->blocksize()->value().'"';
e(!empty($settings['buttons']) && $block->content()->theme()->value() === 'custom' && $block->buttonstyle()->value() === 'variant', ' data-button-style="variant"');
echo $block->fragment()->isNotEmpty() ? ' id="'.$block->fragment()->value().'"' : '';
echo '>'."\n";

// Grid
echo '<div data-layout="grid"><div data-layout="grid-item"';
echo ' data-grid-size-sm="'.$block->gridsizesm()->value().'"';
echo ' data-grid-size-md="'.$block->gridsizemd()->value().'"';
echo ' data-grid-size-lg="'.$block->gridsizelg()->value().'"';
echo ' data-grid-size-xl="'.$block->gridsizexl()->value().'"';
echo ' data-grid-offset-sm="'.$block->gridoffsetsm()->value().'"';
echo ' data-grid-offset-md="'.$block->gridoffsetmd()->value().'"';
echo ' data-grid-offset-lg="'.$block->gridoffsetlg()->value().'"';
echo ' data-grid-offset-xl="'.$block->gridoffsetxl()->value().'"';
echo '>'."\n";

// Columns Grid
echo '<div data-layout="columns" data-dist-sm="'.$block->distributionsm()->value().'" data-dist-md="'.$block->distributionmd()->value().'" data-dist-lg="'.$block->distributionlg()->value().'" data-dist-xl="'.$block->distributionxl()->value().'">'."\n";

	// Left column
	$items = $block->blocksleft()->toBlocks();
	if ($items->count() > 0):
		echo '<div data-layout="column" data-position="'.$block->leftpositionvertical()->value().'">'."\n";
		foreach ($items as $item):
			if ($item->type() === 'multicolumnheadlineleft'): snippet('heading', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntextleft'): snippet('editor', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnquoteleft'): snippet('quote', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnmedialeft'): snippet('media', ['content' => $item]); endif;
		endforeach;
		echo '</div>'."\n";
	endif;

	// Right column
	$items = $block->blocksright()->toBlocks();
	if ($items->count() > 0):
		echo '<div data-layout="column" data-position="'.$block->rightpositionvertical()->value().'">'."\n";
		foreach ($items as $item):
			if ($item->type() === 'multicolumnheadlineright'): snippet('heading', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntextright'): snippet('editor', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnquoteright'): snippet('quote', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnmediaright'): snippet('media', ['content' => $item]); endif;
		endforeach;
		echo '</div>'."\n";
	endif;

echo '</div>'."\n"; // End Columns Grid
echo '</div></div>'."\n"; // End Grid
echo '</section>'."\n";