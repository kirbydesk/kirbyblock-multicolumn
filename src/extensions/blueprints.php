<?php

/* Helper: media block fields, only mediaAlignment align differs */
function pwMulticolumnMediaFields(?string $alignMedia, ?array $alignOptions = null): array {
	return [
		'mediaAlignment' => [
			'type'          => 'pwalign',
			'align'         => $alignMedia,
			'default'       => $alignMedia,
			'alignOptions'  => $alignOptions,
			'alwaysVisible' => true,
		],
		'mediaType' => [
			'extends' => 'pagewizard/fields/media-type'
		],
		'mediaSize' => [
			'extends' => 'pagewizard/fields/media-size'
		],
		'mediaRadius' => [
			'extends' => 'pagewizard/fields/media-radius'
		],
		'radiusTopLeft' => [
			'extends' => 'pagewizard/fields/toggle',
			'label'   => 'pw.field.radius-top-left',
			'when'    => ['mediaRadius' => 'custom']
		],
		'radiusTopRight' => [
			'extends' => 'pagewizard/fields/toggle',
			'label'   => 'pw.field.radius-top-right',
			'when'    => ['mediaRadius' => 'custom']
		],
		'radiusBottomLeft' => [
			'extends' => 'pagewizard/fields/toggle',
			'label'   => 'pw.field.radius-bottom-left',
			'when'    => ['mediaRadius' => 'custom']
		],
		'radiusBottomRight' => [
			'extends' => 'pagewizard/fields/toggle',
			'label'   => 'pw.field.radius-bottom-right',
			'when'    => ['mediaRadius' => 'custom']
		],
		'image' => [
			'extends' => 'pagewizard/fields/image',
			'uploads' => 'pwImage',
			'query'   => 'page.images.template("pwImage")',
			'when'    => ['mediaType' => 'image']
		],
		'slideshow' => [
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
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['content'];
	$tabSettings  = $config['tabs'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];

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
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-multicolumn.sub.headline',
		'icon'   => 'title',
		'fields' => [
			'heading' => [
				'extends'      => 'pagewizard/fields/heading',
				'align'        => $fields['align-headline-left'],
				'level'        => $fields['level-headline-left'] ?? null,
				'size'         => $fields['size-headline-left'] ?? null,
				'sizeOptions'  => $fieldOptions['headline']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['headline']['align'] ?? null,
				'levelOptions' => $fieldOptions['headline']['level'] ?? null,
			],
		]
	];
},

'blocks/multicolumntextleft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['content'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$fieldOptions = $config['field-options'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($editor['text'] ?? [], $textSettings);
	$field['align']        = $fields['align-text-left'] ?? null;
	$field['size']         = $fields['size-text-left'] ?? null;
	$field['alignOptions'] = $fieldOptions['text']['align'] ?? null;
	$field['sizeOptions']  = $fieldOptions['text']['sizes'] ?? null;
	$field['defaultMode'] = $fields['mode-text-left'] ?? null;
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['editor' => $field]];
},

'blocks/multicolumnquoteleft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => [
				'extends'      => 'pagewizard/fields/quote',
				'align'        => $fields['align-quote-left'] ?? null,
				'size'         => $fields['size-quote-left'] ?? null,
				'sizeOptions'  => $fieldOptions['quote']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['quote']['align'] ?? null,
			],
			'author' => ['extends' => 'pagewizard/fields/author', 'align' => $fields['align-author-left'] ?? null],
		]
	];
},

'blocks/multicolumnmedialeft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-media.name',
		'icon'   => 'images',
		'fields' => pwMulticolumnMediaFields($fields['align-media-left'] ?? null, $fieldOptions['media']['align'] ?? null)
	];
},

/* ============================================================================
	Sub-Blocks — Right Column
============================================================================ */

'blocks/multicolumnheadlineright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-multicolumn.sub.headline',
		'icon'   => 'title',
		'fields' => [
			'heading' => [
				'extends'      => 'pagewizard/fields/heading',
				'align'        => $fields['align-headline-right'],
				'level'        => $fields['level-headline-right'] ?? null,
				'size'         => $fields['size-headline-right'] ?? null,
				'sizeOptions'  => $fieldOptions['headline']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['headline']['align'] ?? null,
				'levelOptions' => $fieldOptions['headline']['level'] ?? null,
			],
		]
	];
},

'blocks/multicolumntextright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$settings     = $config['content'];
	$defaults     = $config['defaults'];
	$fields       = $config['fields'];
	$editor       = $config['editor'];
	$fieldOptions = $config['field-options'];
	$textSettings = ['editor' => $settings['text'] ?? ['writer']];
	$field = pwEditor::contentField($editor['text'] ?? [], $textSettings);
	$field['align']        = $fields['align-text-right'] ?? null;
	$field['size']         = $fields['size-text-right'] ?? null;
	$field['alignOptions'] = $fieldOptions['text']['align'] ?? null;
	$field['sizeOptions']  = $fieldOptions['text']['sizes'] ?? null;
	$field['defaultMode'] = $fields['mode-text-right'] ?? null;
	return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['editor' => $field]];
},

'blocks/multicolumnquoteright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-quote.name',
		'icon'   => 'quote',
		'fields' => [
			'quote'  => [
				'extends'      => 'pagewizard/fields/quote',
				'align'        => $fields['align-quote-right'] ?? null,
				'size'         => $fields['size-quote-right'] ?? null,
				'sizeOptions'  => $fieldOptions['quote']['sizes'] ?? null,
				'alignOptions' => $fieldOptions['quote']['align'] ?? null,
			],
			'author' => ['extends' => 'pagewizard/fields/author', 'align' => $fields['align-author-right'] ?? null],
		]
	];
},

'blocks/multicolumnmediaright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	return [
		'name'   => 'kirbyblock-media.name',
		'icon'   => 'images',
		'fields' => pwMulticolumnMediaFields($fields['align-media-right'] ?? null, $fieldOptions['media']['align'] ?? null)
	];
},

/* ============================================================================
	Sub-Blocks — Button (Left + Right)
============================================================================ */

'blocks/multicolumnbuttonleft' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	$alignOptions = array_map(fn($v) => ['value' => $v, 'icon' => 'text-' . $v, 'text' => ''], $fieldOptions['button']['align'] ?? ['left', 'center', 'right']);
	return [
		'name'   => 'pw.field.button',
		'icon'   => 'url',
		'fields' => [
			'headlineLink'    => ['extends' => 'pagewizard/headlines/link'],
			'linkType'        => ['extends' => 'pagewizard/fields/link-type'],
			'linkInternal'    => ['extends' => 'pagewizard/fields/link-internal', 'when' => ['linkType' => false]],
			'linkExternal'    => ['extends' => 'pagewizard/fields/link-external', 'when' => ['linkType' => true]],
			'linkTarget'      => ['extends' => 'pagewizard/fields/link-target', 'when' => ['linkType' => true]],
			'linkRel'         => ['extends' => 'pagewizard/fields/link-rel', 'when' => ['linkType' => true, 'linkTarget' => true]],
			'linkText'        => ['extends' => 'pagewizard/fields/link-text', 'width' => '3/4'],
			'buttonAlignment' => [
				'type'    => 'toggles',
				'label'   => 'pw.field.position-horizontal.label',
				'labels'  => false,
				'default' => $fields['align-button-left'] ?? 'left',
				'options' => $alignOptions,
				'width'   => '1/4',
			],
			'ariaLabel'       => ['extends' => 'pagewizard/fields/link-aria-label'],
			'ariaDescribedby' => ['extends' => 'pagewizard/fields/link-aria-describedby'],
		],
	];
},

'blocks/multicolumnbuttonright' => function () {
	$config       = pwConfig::load('pwmulticolumn');
	$fields       = $config['fields'];
	$fieldOptions = $config['field-options'];
	$alignOptions = array_map(fn($v) => ['value' => $v, 'icon' => 'text-' . $v, 'text' => ''], $fieldOptions['button']['align'] ?? ['left', 'center', 'right']);
	return [
		'name'   => 'pw.field.button',
		'icon'   => 'url',
		'fields' => [
			'headlineLink'    => ['extends' => 'pagewizard/headlines/link'],
			'linkType'        => ['extends' => 'pagewizard/fields/link-type'],
			'linkInternal'    => ['extends' => 'pagewizard/fields/link-internal', 'when' => ['linkType' => false]],
			'linkExternal'    => ['extends' => 'pagewizard/fields/link-external', 'when' => ['linkType' => true]],
			'linkTarget'      => ['extends' => 'pagewizard/fields/link-target', 'when' => ['linkType' => true]],
			'linkRel'         => ['extends' => 'pagewizard/fields/link-rel', 'when' => ['linkType' => true, 'linkTarget' => true]],
			'linkText'        => ['extends' => 'pagewizard/fields/link-text', 'width' => '3/4'],
			'buttonAlignment' => [
				'type'    => 'toggles',
				'label'   => 'pw.field.position-horizontal.label',
				'labels'  => false,
				'default' => $fields['align-button-right'] ?? 'left',
				'options' => $alignOptions,
				'width'   => '1/4',
			],
			'ariaLabel'       => ['extends' => 'pagewizard/fields/link-aria-label'],
			'ariaDescribedby' => ['extends' => 'pagewizard/fields/link-aria-describedby'],
		],
	];
}

];
