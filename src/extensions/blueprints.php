<?php

/* ============================================================================
	Sub-Block Field Factories
============================================================================ */

/** Media sub-block fields (identical structure left/right, only align differs). */
function pwMulticolumnMediaFields(?string $alignMedia, ?array $alignOptions = null): array {
	return [
		'mediaAlignment' => [
			'type'          => 'pwalign',
			'align'         => $alignMedia,
			'default'       => $alignMedia,
			'alignOptions'  => $alignOptions,
			'alwaysVisible' => true,
		],
		'mediaType'   => ['extends' => 'pagewizard/fields/media-type'],
		'mediaSize'   => ['extends' => 'pagewizard/fields/media-size'],
		'mediaRadius' => ['extends' => 'pagewizard/fields/media-radius'],
		'radiusTopLeft'     => ['extends' => 'pagewizard/fields/toggle', 'label' => 'pw.field.radius-top-left',     'when' => ['mediaRadius' => 'custom']],
		'radiusTopRight'    => ['extends' => 'pagewizard/fields/toggle', 'label' => 'pw.field.radius-top-right',    'when' => ['mediaRadius' => 'custom']],
		'radiusBottomLeft'  => ['extends' => 'pagewizard/fields/toggle', 'label' => 'pw.field.radius-bottom-left',  'when' => ['mediaRadius' => 'custom']],
		'radiusBottomRight' => ['extends' => 'pagewizard/fields/toggle', 'label' => 'pw.field.radius-bottom-right', 'when' => ['mediaRadius' => 'custom']],
		'image'       => ['extends' => 'pagewizard/fields/image',        'uploads' => 'pwImage', 'query' => 'page.images.template("pwImage")', 'when' => ['mediaType' => 'image']],
		'slideshow'   => ['extends' => 'pagewizard/fields/images',       'uploads' => 'pwImage', 'query' => 'page.images.template("pwImage")', 'when' => ['mediaType' => 'slideshow']],
		'videoSource' => ['extends' => 'pagewizard/fields/video-source', 'when' => ['mediaType' => 'video']],
		'videoUrl'    => ['extends' => 'pagewizard/fields/video-url',    'when' => ['mediaType' => 'video', 'videoSource' => 'external']],
		'video'       => ['extends' => 'pagewizard/fields/video',        'uploads' => 'pwVideo', 'query' => 'page.files.template("pwVideo")', 'when' => ['mediaType' => 'video', 'videoSource' => 'internal']],
	];
}

/** Left/right side blueprints share structure — build them from one factory. */
$sub = function (string $side) {
	return [
		'headline' => function () use ($side) {
			$config       = pwConfig::load('pwmulticolumn');
			$fields       = $config['fields'];
			$fieldOptions = $config['field-options'];
			return [
				'name'   => 'kirbyblock-multicolumn.sub.headline',
				'icon'   => 'title',
				'fields' => [
					'heading' => [
						'extends'      => 'pagewizard/fields/heading',
						'align'        => $fields['align-headline-' . $side] ?? $fields['align-headline'] ?? null,
						'level'        => $fields['level-headline-' . $side] ?? $fields['level-headline'] ?? null,
						'size'         => $fields['size-headline-'  . $side] ?? $fields['size-headline']  ?? null,
						'sizeOptions'  => $fieldOptions['headline']['sizes'] ?? null,
						'alignOptions' => $fieldOptions['headline']['align'] ?? null,
						'levelOptions' => $fieldOptions['headline']['level'] ?? null,
						'textbackground'        => $fields['textbackground-headline-' . $side] ?? $fields['textbackground-headline'] ?? null,
						'textbackgroundOptions' => $fieldOptions['headline']['textbackground'] ?? null,
					],
				],
			];
		},
		'text' => function () use ($side) {
			$config       = pwConfig::load('pwmulticolumn');
			$settings     = $config['content'];
			$fields       = $config['fields'];
			$editor       = $config['editor'];
			$fieldOptions = $config['field-options'];
			$textSettings = ['editor' => $settings['text'] ?? ['writer']];
			$field = pwEditor::contentField($editor['text'] ?? [], $textSettings);
			$field['align']        = $fields['align-text-' . $side] ?? null;
			$field['size']         = $fields['size-text-'  . $side] ?? null;
			$field['alignOptions'] = $fieldOptions['text']['align']  ?? null;
			$field['sizeOptions']  = $fieldOptions['text']['sizes']  ?? null;
			$field['defaultMode']  = $fields['mode-text-' . $side]   ?? null;
			return ['name' => 'kirbyblock-text.name', 'icon' => 'text', 'fields' => ['editor' => $field]];
		},
		'quote' => function () use ($side) {
			$config       = pwConfig::load('pwmulticolumn');
			$fields       = $config['fields'];
			$fieldOptions = $config['field-options'];
			return [
				'name'   => 'kirbyblock-quote.name',
				'icon'   => 'quote',
				'fields' => [
					'quote'  => [
						'extends'      => 'pagewizard/fields/quote',
						'align'        => $fields['align-quote-' . $side] ?? null,
						'size'         => $fields['size-quote-'  . $side] ?? null,
						'sizeOptions'  => $fieldOptions['quote']['sizes'] ?? null,
						'alignOptions' => $fieldOptions['quote']['align'] ?? null,
					],
					'author' => ['extends' => 'pagewizard/fields/author', 'align' => $fields['align-author-' . $side] ?? null],
				],
			];
		},
		'media' => function () use ($side) {
			$config       = pwConfig::load('pwmulticolumn');
			$fields       = $config['fields'];
			$fieldOptions = $config['field-options'];
			return [
				'name'   => 'kirbyblock-media.name',
				'icon'   => 'images',
				'fields' => pwMulticolumnMediaFields($fields['align-media-' . $side] ?? null, $fieldOptions['media']['align'] ?? null),
			];
		},
		'tagline' => function () use ($side) {
			$config       = pwConfig::load('pwmulticolumn');
			$fields       = $config['fields'];
			$fieldOptions = $config['field-options'];
			return [
				'name'   => 'kirbyblock-multicolumn.sub.tagline',
				'icon'   => 'tag',
				'fields' => [
					'tagline' => [
						'extends'      => 'pagewizard/fields/tagline',
						'align'        => $fields['align-tagline-' . $side] ?? $fields['align-tagline'] ?? null,
						'alignOptions' => $fieldOptions['tagline']['align'] ?? null,
					],
				],
			];
		},
		'button' => function () use ($side) {
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
					'linkTarget'      => ['extends' => 'pagewizard/fields/link-target',   'when' => ['linkType' => true]],
					'linkRel'         => ['extends' => 'pagewizard/fields/link-rel',      'when' => ['linkType' => true, 'linkTarget' => true]],
					'linkText'        => ['extends' => 'pagewizard/fields/link-text',     'width' => '3/4'],
					'buttonAlignment' => [
						'type'    => 'toggles',
						'label'   => 'pw.field.position-horizontal.label',
						'labels'  => false,
						'default' => $fields['align-button-' . $side] ?? 'left',
						'options' => $alignOptions,
						'width'   => '1/4',
					],
					'ariaLabel'       => ['extends' => 'pagewizard/fields/link-aria-label'],
					'ariaDescribedby' => ['extends' => 'pagewizard/fields/link-aria-describedby'],
				],
			];
		},
	];
};

$left  = $sub('left');
$right = $sub('right');

/* ============================================================================
	Distribution helper (identical breakpoints, only label/help differs)
============================================================================ */

$distributionField = fn(string $breakpoint, $default) => [
	'extends' => 'pagewizard/fields/distribution',
	'default' => $default,
	'label'   => 'pw.field.columns.' . $breakpoint,
	'help'    => 'pw.field.columns.' . $breakpoint . '.help',
];

return [

	/* ============================================================================
		Main Block
	============================================================================ */

	'blocks/pwmulticolumn' => pwBlueprint::main('pwmulticolumn', function ($cfg) use ($distributionField) {
		$defaults    = $cfg['defaults'];
		$baseBlocks  = $cfg['content']['column-blocks'];
		$blocksLeft  = array_map(fn($b) => $b . 'left',  $baseBlocks);
		$blocksRight = array_map(fn($b) => $b . 'right', $baseBlocks);

		return [
			'name' => 'kirbyblock-multicolumn.name',
			'icon' => 'layout-columns',
			// multicolumn has a two-column content layout of its own — no
			// standard headlineContent header, no tagline/heading/editor/buttons.
			'noContentHeader' => true,
			'contentFields' => [
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
					'default' => $defaults['multicolumn-left']
				],
				'rightPositionVertical' => [
					'extends' => 'pagewizard/fields/position-vertical',
					'help'    => 'pw.field.position-vertical.column.help',
					'default' => $defaults['multicolumn-right']
				],
				'blocksLeft' => [
					'type'      => 'blocks',
					'label'     => 'pw.field.blocks',
					'width'     => '1/2',
					'fieldsets' => $blocksLeft,
				],
				'blocksRight' => [
					'type'      => 'blocks',
					'label'     => 'pw.field.blocks',
					'width'     => '1/2',
					'fieldsets' => $blocksRight,
				],
			],
			'layoutExtras' => [
				'headlineDistribution' => ['extends' => 'pagewizard/headlines/distribution'],
				'distributionSm'       => $distributionField('sm', $defaults['columns-sm']),
				'distributionMd'       => $distributionField('md', $defaults['columns-md']),
				'distributionLg'       => $distributionField('lg', $defaults['columns-lg']),
				'distributionXl'       => $distributionField('xl', $defaults['columns-xl']),
			],
		];
	}),

	/* ============================================================================
		Sub-Blocks — Left Column
	============================================================================ */

	'blocks/multicolumnheadlineleft' => $left['headline'],
	'blocks/multicolumntextleft'     => $left['text'],
	'blocks/multicolumnquoteleft'    => $left['quote'],
	'blocks/multicolumnmedialeft'    => $left['media'],
	'blocks/multicolumntaglineleft'  => $left['tagline'],
	'blocks/multicolumnbuttonleft'   => $left['button'],

	/* ============================================================================
		Sub-Blocks — Right Column
	============================================================================ */

	'blocks/multicolumnheadlineright' => $right['headline'],
	'blocks/multicolumntextright'     => $right['text'],
	'blocks/multicolumnquoteright'    => $right['quote'],
	'blocks/multicolumnmediaright'    => $right['media'],
	'blocks/multicolumntaglineright'  => $right['tagline'],
	'blocks/multicolumnbuttonright'   => $right['button'],
];
