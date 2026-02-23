<?php

/* Helper: media block fields, only mediaAlignment align differs */
function pwMulticolumnMediaFields(string $alignMedia): array {
	return [
		'mediaSize' => [
			'extends' => 'pagewizard/fields/media-size'
		],
		'mediaAlignment' => [
			'type'          => 'pwalign',
			'align'         => $alignMedia,
			'alwaysVisible' => true,
		],
		'mediaType' => [
			'extends' => 'pagewizard/fields/media-type'
		],
		'image' => [
			'extends' => 'pagewizard/fields/image',
			'uploads' => 'pwImage',
			'query'   => 'page.images.template("pwImage")',
			'when'    => ['mediaType' => 'image']
		],
		'images' => [
			'extends' => 'pagewizard/fields/images',
			'uploads' => 'pwImage',
			'query'   => 'page.images.template("pwImage")',
			'when'    => ['mediaType' => 'slideshow']
		],
		'videoSource' => [
			'extends' => 'pagewizard/fields/video-source',
			'when'    => ['mediaType' => 'video']
		],
		'videoUrl' => [
			'extends' => 'pagewizard/fields/video-url',
			'when'    => ['mediaType' => 'video', 'videoSource' => 'external']
		],
		'video' => [
			'extends' => 'pagewizard/fields/video',
			'uploads' => 'pwVideo',
			'query'   => 'page.files.template("pwVideo")',
			'when'    => ['mediaType' => 'video', 'videoSource' => 'internal']
		],
	];
}

return [

/* ============================================================================
	Main Block
============================================================================ */

'blocks/pwmulticolumn' => function () {

	/* -------------- Config --------------*/
	$config      = pwConfig::load('pwmulticolumn');
	$settings    = $config['settings'];
	$tabSettings = $config['tabs'];
	$defaults    = $config['defaults'];

	/* -------------- Column block types (auto-append left/right) --------------*/
	$baseBlocks  = $settings['column-blocks'] ?? ['multicolumntext', 'multicolumnquote', 'multicolumnmedia'];
	$blocksLeft  = array_map(fn($b) => $b . 'left',  $baseBlocks);
	$blocksRight = array_map(fn($b) => $b . 'right', $baseBlocks);

	/* -------------- Tabs --------------*/
	$tabs = [];

	/* -------------- Content Tab --------------*/
	$tabs['content'] = [
		'label'  => 'pw.tab.content',
		'fields' => [
			'headlineLeft' => [
				'type'  => 'headline',
				'label' => 'pw.headline.multicolumn.left',
				'help'  => 'pw.headline.multicolumn.left.help',
				'width' => '1/2'
			],
			'headlineRight' => [
				'type'  => 'headline',
				'label' => 'pw.headline.multicolumn.right',
				'help'  => 'pw.headline.multicolumn.right.help',
				'width' => '1/2',
				'class' => 'patch',
			],
			'blocksLeft' => [
				'type'      => 'blocks',
				'label'     => 'pw.field.blocks',
				'width'     => '1/2',
				'fieldsets' => $blocksLeft
			],
			'blocksRight' => [
				'type'      => 'blocks',
				'label'     => 'pw.field.blocks',
				'width'     => '1/2',
				'fieldsets' => $blocksRight
			]
		]
	];

	/* -------------- Layout Tab --------------*/
	$tabs['layout'] = pwLayout::options('pwmulticolumn', $defaults, [
		'headlineDistribution' => [
			'extends' => 'pagewizard/headlines/distribution'
		],
		'distribution' => [
			'extends' => 'pagewizard/fields/distribution',
			'default' => $defaults['distribution']
		],
		'headlineLeft' => [
			'type'  => 'headline',
			'label' => 'pw.headline.multicolumn.left',
			'help'  => 'pw.headline.multicolumn.left.positioning.help',
		],
		'leftPositionHorizontal' => [
			'extends' => 'pagewizard/fields/position-horizontal',
			'help'    => 'pw.field.position-horizontal.column.help',
			'default' => $defaults['horizontal-left-position']
		],
		'leftPositionVertical' => [
			'extends' => 'pagewizard/fields/position-vertical',
			'help'    => 'pw.field.position-vertical.column.help',
			'default' => $defaults['vertical-left-position']
		],
		'headlineRight' => [
			'type'  => 'headline',
			'label' => 'pw.headline.multicolumn.right',
			'help'  => 'pw.headline.multicolumn.right.positioning.help',
		],
		'rightPositionHorizontal' => [
			'extends' => 'pagewizard/fields/position-horizontal',
			'help'    => 'pw.field.position-horizontal.column.help',
			'default' => $defaults['horizontal-right-position']
		],
		'rightPositionVertical' => [
			'extends' => 'pagewizard/fields/position-vertical',
			'help'    => 'pw.field.position-vertical.column.help',
			'default' => $defaults['vertical-right-position']
		]
	]);

	/* -------------- Style Tab --------------*/
	$tabs['style'] = pwStyle::options('pwmulticolumn', $defaults);

	/* -------------- Common Tabs (grid, spacing, theme) --------------*/
	pwConfig::buildTabs('pwmulticolumn', $defaults, $tabSettings, $tabs);

	/* -------------- Settings Tab --------------*/
	$tabs['settings'] = pwSettings::options('pwmulticolumn', $defaults);

	/* -------------- Blueprint --------------*/
	return [
		'name'	=> 'kirbyblock-multicolumn.name',
		'icon'  => 'layout-columns',
		'tabs'	=> $tabs
	];
},

/* ============================================================================
	Sub-Blocks — Left Column
============================================================================ */

'blocks/multicolumntextleft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['settings'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($defaults, $editor['text'] ?? [], $textSettings, ['align-editor' => $fields['align-text-left'] ?? 'left']);
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['text' => $field]];
},

'blocks/multicolumnquoteleft' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => ['extends' => 'pagewizard/fields/text-quote', 'align' => $fields['align-quote-left']  ?? 'left'],
			'author' => ['extends' => 'pagewizard/fields/author',     'align' => $fields['align-author-left'] ?? 'left'],
		]
	];
},

'blocks/multicolumnmedialeft' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-media.name',
		'icon'   => 'images',
		'fields' => pwMulticolumnMediaFields($fields['align-media-left'] ?? 'left')
	];
},

/* ============================================================================
	Sub-Blocks — Right Column
============================================================================ */

'blocks/multicolumntextright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['settings'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($defaults, $editor['text'] ?? [], $textSettings, ['align-editor' => $fields['align-text-right'] ?? 'left']);
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['text' => $field]];
},

'blocks/multicolumnquoteright' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => ['extends' => 'pagewizard/fields/text-quote', 'align' => $fields['align-quote-right']  ?? 'left'],
			'author' => ['extends' => 'pagewizard/fields/author',     'align' => $fields['align-author-right'] ?? 'left'],
		]
	];
},

'blocks/multicolumnmediaright' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-media.name',
		'icon'   => 'images',
		'fields' => pwMulticolumnMediaFields($fields['align-media-right'] ?? 'left')
	];
},

];
