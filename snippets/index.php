<?php

// Config
$config   = pwConfig::load('pwmulticolumn');
$settings = $config['content'];

// Helper: render single button sub-block
if (!function_exists('pwMulticolumnButton')) {
function pwMulticolumnButton($item): void {
	$align = $item->buttonalignment()->isNotEmpty() ? $item->buttonalignment()->value() : 'left';
	ob_start();
	snippet('link', [
		'linkType'        => $item->linktype()->toBool(),
		'linkInternal'    => $item->linkinternal()->value(),
		'linkExternal'    => $item->linkexternal()->value(),
		'linkText'        => $item->linktext()->isNotEmpty() ? $item->linktext()->value() : t('pw.field.link-text.placeholder'),
		'linkTarget'      => $item->linktarget()->toBool(),
		'linkRel'         => $item->linkrel()->value(),
		'ariaLabel'       => $item->arialabel()->value(),
		'ariaDescribedby' => $item->ariadescribedby()->value(),
	]);
	$linkHtml = ob_get_clean();
	if ($linkHtml) {
		echo '<div data-field="button" data-align="' . $align . '">' . $linkHtml . '</div>' . "\n";
	}
}
}

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
e($block->content()->theme()->value() === 'custom' && $block->buttonstyle()->value() !== 'default', ' data-button-style="' . $block->buttonstyle()->value() . '"');
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

// Precompute media sizes hints based on column distribution
$distParts = fn(string $dist): array => match($dist) {
	'dist-1-5' => [17, 83],
	'dist-2-4' => [33, 67],
	'dist-3-3' => [50, 50],
	'dist-4-2' => [67, 33],
	'dist-5-1' => [83, 17],
	default    => [100, 100],
};
$distSm = $distParts($block->distributionsm()->value());
$distMd = $distParts($block->distributionmd()->value());
$distLg = $distParts($block->distributionlg()->value());
$distXl = $distParts($block->distributionxl()->value());
$mediaSizes = [
	'left'  => "(min-width: 1280px) {$distXl[0]}vw, (min-width: 1024px) {$distLg[0]}vw, (min-width: 768px) {$distMd[0]}vw, {$distSm[0]}vw",
	'right' => "(min-width: 1280px) {$distXl[1]}vw, (min-width: 1024px) {$distLg[1]}vw, (min-width: 768px) {$distMd[1]}vw, {$distSm[1]}vw",
];

	// Left column
	$items = $block->blocksleft()->toBlocks();
	if ($items->count() > 0):
		echo '<div data-layout="column" data-position="'.$block->leftpositionvertical()->value().'">'."\n";
		foreach ($items as $item):
			if ($item->type() === 'multicolumnheadlineleft'): snippet('heading', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntaglineleft'): snippet('tagline', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntextleft'): snippet('editor', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnquoteleft'): snippet('quote', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnmedialeft'): snippet('media', ['content' => $item, 'sizes' => $mediaSizes['left']]); endif;
			if ($item->type() === 'multicolumnbuttonleft'): pwMulticolumnButton($item); endif;
		endforeach;
		echo '</div>'."\n";
	endif;

	// Right column
	$items = $block->blocksright()->toBlocks();
	if ($items->count() > 0):
		echo '<div data-layout="column" data-position="'.$block->rightpositionvertical()->value().'">'."\n";
		foreach ($items as $item):
			if ($item->type() === 'multicolumnheadlineright'): snippet('heading', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntaglineright'): snippet('tagline', ['content' => $item]); endif;
			if ($item->type() === 'multicolumntextright'): snippet('editor', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnquoteright'): snippet('quote', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnmediaright'): snippet('media', ['content' => $item, 'sizes' => $mediaSizes['right']]); endif;
			if ($item->type() === 'multicolumnbuttonright'): pwMulticolumnButton($item); endif;
		endforeach;
		echo '</div>'."\n";
	endif;

echo '</div>'."\n"; // End Columns Grid
echo '</div></div>'."\n"; // End Grid
echo '</section>'."\n";