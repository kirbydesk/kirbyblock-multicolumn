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
			'default'       => $alignMedia,
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
	$settings    = $config['content'];
	$tabSettings = $config['tabs'];
	$defaults    = $config['defaults'];

	/* -------------- Column block types (auto-append left/right) --------------*/
	$baseBlocks  = $settings['column-blocks'];
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
			'leftPositionVertical' => [
				'extends' => 'pagewizard/fields/position-vertical',
				'help'    => 'pw.field.position-vertical.column.help',
				'default' => $defaults['vertical-left-position']
			],
			'rightPositionVertical' => [
				'extends' => 'pagewizard/fields/position-vertical',
				'help'    => 'pw.field.position-vertical.column.help',
				'default' => $defaults['vertical-right-position']
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
	pwConfig::addTab($tabs, 'layout', $tabSettings['layout'] ?? true, pwLayout::options('pwmulticolumn', $defaults, [
		'headlineDistribution' => [
				'extends' => 'pagewizard/headlines/distribution'
			],
			'distributionSm' => [
				'extends'  => 'pagewizard/fields/distribution',
				'default'  => $defaults['distribution-sm'],
				'label'    => 'pw.field.columns.sm',
				'help'     => 'pw.field.columns.sm.help',
			],
			'distributionMd' => [
				'extends'  => 'pagewizard/fields/distribution',
				'default'  => $defaults['distribution-md'],
				'label'    => 'pw.field.columns.md',
				'help'     => 'pw.field.columns.md.help',
			],
			'distributionLg' => [
				'extends'  => 'pagewizard/fields/distribution',
				'default'  => $defaults['distribution-lg'],
				'label'    => 'pw.field.columns.lg',
				'help'     => 'pw.field.columns.lg.help',
			],
			'distributionXl' => [
				'extends'  => 'pagewizard/fields/distribution',
				'default'  => $defaults['distribution-xl'],
				'label'    => 'pw.field.columns.xl',
				'help'     => 'pw.field.columns.xl.help',
			]
	], $config['layout'] ?? []));

	/* -------------- Style Tab --------------*/
	pwConfig::addTab($tabs, 'style', $tabSettings['style'] ?? true, pwStyle::options('pwmulticolumn', $defaults, [], $config['style'] ?? []));

	/* -------------- Grid Tab --------------*/
	pwConfig::addTab($tabs, 'grid', $tabSettings['grid'] ?? false, pwGrid::layout('pwmulticolumn', $defaults));

	/* -------------- Settings Tab --------------*/
	pwConfig::addTab($tabs, 'settings', $tabSettings['settings'] ?? true, pwSettings::options('pwmulticolumn', $defaults, [], $config['settings'] ?? []));

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

'blocks/multicolumnheadlineleft' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-multicolumn.sub.headline',
		'icon'   => 'title',
		'fields' => [
			'heading' => ['extends' => 'pagewizard/fields/heading', 'align' => $fields['align-headline-left']],
		]
	];
},

'blocks/multicolumntextleft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['content'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($defaults, $editor['text'] ?? [], $textSettings, ['align-editor' => $fields['align-text-left'] ?? 'left']);
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['editor' => $field]];
},

'blocks/multicolumnquoteleft' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => ['extends' => 'pagewizard/fields/quote', 'align' => $fields['align-quote-left']  ?? 'left'],
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

'blocks/multicolumnheadlineright' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-multicolumn.sub.headline',
		'icon'   => 'title',
		'fields' => [
			'heading' => ['extends' => 'pagewizard/fields/heading', 'align' => $fields['align-headline-right']],
		]
	];
},

'blocks/multicolumntextright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['content'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($defaults, $editor['text'] ?? [], $textSettings, ['align-editor' => $fields['align-text-right'] ?? 'left']);
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['editor' => $field]];
},

'blocks/multicolumnquoteright' => function () {
	$config = pwConfig::load('pwmulticolumn');
	$fields = $config['fields'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => ['extends' => 'pagewizard/fields/quote', 'align' => $fields['align-quote-right']  ?? 'left'],
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
}

];
