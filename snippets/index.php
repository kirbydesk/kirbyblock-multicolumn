<?php

// Config
$config   = pwConfig::load('pwmulticolumn');
$settings = $config['content'];

// Helper: render single list sub-block
if (!function_exists('pwMulticolumnList')) {
function pwMulticolumnList($item): void {
	$items = $item->items()->toStructure();
	if ($items->count() === 0) return;
	$style = $item->liststyle()->isNotEmpty() ? $item->liststyle()->value() : 'bullet';
	$align = $item->listalignment()->isNotEmpty() ? $item->listalignment()->value() : 'left';
	$size  = $item->listsize()->isNotEmpty() ? $item->listsize()->value() : 'normal';
	$tag   = $style === 'ordered' ? 'ol' : 'ul';
	echo '<'.$tag.' data-field="list" data-style="'.$style.'" data-align="'.$align.'" data-editor-size="'.$size.'">'."\n";
	foreach ($items as $li):
		echo '<li>'.htmlspecialchars($li->text()->value(), ENT_QUOTES).'</li>'."\n";
	endforeach;
	echo '</'.$tag.'>'."\n";
}
}

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
		'icon'            => $item->icon()->value(),
		'iconPosition'    => $item->iconposition()->value(),
		'iconColor'       => $item->iconcolor()->value(),
	]);
	$linkHtml = ob_get_clean();
	if ($linkHtml) {
		echo '<div data-field="button" data-align="' . $align . '">' . $linkHtml . '</div>' . "\n";
	}
}
}

// Custom Background
pwSnippet::customCss($block);

// Section + Grid open
echo pwSnippet::sectionOpen('multicolumn', $block, $settings);
echo pwSnippet::gridOpen($block);

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
			if ($item->type() === 'multicolumnlistleft'): pwMulticolumnList($item); endif;
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
			if ($item->type() === 'multicolumnlistright'): pwMulticolumnList($item); endif;
			if ($item->type() === 'multicolumnquoteright'): snippet('quote', ['content' => $item]); endif;
			if ($item->type() === 'multicolumnmediaright'): snippet('media', ['content' => $item, 'sizes' => $mediaSizes['right']]); endif;
			if ($item->type() === 'multicolumnbuttonright'): pwMulticolumnButton($item); endif;
		endforeach;
		echo '</div>'."\n";
	endif;

echo '</div>'."\n"; // End Columns Grid

// Close
echo pwSnippet::gridClose();
echo pwSnippet::sectionClose();
