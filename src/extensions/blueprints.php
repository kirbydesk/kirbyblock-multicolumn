<?php return [ 'blocks/pwmulticolumn' => function () {

    /* -------------- Config --------------*/
    $config   = pwConfig::load('pwmulticolumn');
    $settings = $config['settings'];
    $defaults = $config['defaults'];

		/* -------------- Tabs --------------*/
    $tabs = [];

		/* -------------- Content Tab --------------*/
		$tabs['content'] = [
			'label'  => 'pw.tab.content',
			'fields' => [
				'headlineLeft' => [
					'type' => 'headline',
					'label' => 'pw.headline.multicolumn.left',
					'help' => 'pw.headline.multicolumn.left.help',
					'width' => '1/2'
				],
				'headlineRight' => [
					'type' => 'headline',
					'label' => 'pw.headline.multicolumn.right',
					'help' => 'pw.headline.multicolumn.right.help',
					'width' => '1/2',
					'class' => 'patch',
				],
				'blocksLeft' => [
					'type'      => 'blocks',
					'label'     => 'pw.field.blocks',
					'width'     => '1/2',
					'fieldsets' => $settings['column-blocks'] ?? ['multicolumntext', 'multicolumnquote', 'multicolumnmedia']
				],
				'blocksRight' => [
					'type'      => 'blocks',
					'label'     => 'pw.field.blocks',
					'width'     => '1/2',
					'fieldsets' => $settings['column-blocks'] ?? ['multicolumntext', 'multicolumnquote', 'multicolumnmedia']
				]
			]
		];

		/* -------------- Layout Tab --------------*/
		$tabs['layout'] = pwLayout::options('pwtext', $defaults, [
			'headlineDistribution' => [
				'extends' => 'pagewizard/headlines/distribution'
			],
			'distribution' => [
				'extends' => 'pagewizard/fields/distribution'
			],
			'headlineLeft' => [
				'type' => 'headline',
				'label' => 'pw.headline.multicolumn.left',
				'help' => 'pw.headline.multicolumn.left.positioning.help',
			],
			'leftPositionHorizontal' => [
				'extends' => 'pagewizard/fields/position-horizontal',
				'help' => 'pw.field.position-horizontal.column.help',
				'default' => 'left'
			],
			'leftPositionVertical' => [
				'extends' => 'pagewizard/fields/position-vertical',
				'help' => 'pw.field.position-vertical.column.help',
				'default' => 'top'
			],
			'headlineRight' => [
				'type' => 'headline',
				'label' => 'pw.headline.multicolumn.right',
				'help' => 'pw.headline.multicolumn.right.positioning.help',
			],
			'rightPositionHorizontal' => [
				'extends' => 'pagewizard/fields/position-horizontal',
				'help' => 'pw.field.position-horizontal.column.help',
				'default' => 'left'
			],
			'rightPositionVertical' => [
				'extends' => 'pagewizard/fields/position-vertical',
				'help' => 'pw.field.position-vertical.column.help',
				'default' => 'top'
			]
		]);

		/* -------------- Style Tab --------------*/
		$tabs['style'] = pwStyle::options('pwtext', $defaults);

		/* -------------- Common Tabs (grid, spacing, theme) --------------*/
		pwConfig::buildTabs('pwtext', $defaults, $settings, $tabs);

		/* -------------- Settings Tab --------------*/
		$tabs['settings'] = pwSettings::options('pwtext', $defaults);

		/* -------------- Blueprint --------------*/
		return [
			'name'	=> 'kirbyblock-multicolumn.name',
			'icon'  => 'layout-columns',
			'tabs'	=> $tabs
		];
	},

	/* ============================================================================
		Sub-Blocks (only available within Multicolumn block)
	============================================================================ */

	'blocks/multicolumntext' => function () {
		$config   = pwConfig::load('pwmulticolumn');
		$settings = $config['settings'];
		$defaults = $config['defaults'];
		$editor   = $config['editor'];

		$field = pwEditor::contentField($defaults, $editor, $settings);

		return [
			'name'   => 'kirbyblock-text.name',
			'icon'   => 'text',
			'fields' => ['text' => $field]
		];
	},

	'blocks/multicolumnquote' => [
		'name' => 'kirbyblock-quote.name',
		'icon' => 'quote',
		'fields' => [
			'quote' => [
				'extends' => 'pagewizard/fields/text-quote'
			],
			'author' => [
				'extends' => 'pagewizard/fields/author'
			]
		]
	],

	'blocks/multicolumnmedia' => [
		'name' => 'kirbyblock-media.name',
		'icon' => 'images',
		'fields' => [
			'mediaSize' => [
				'extends' => 'pagewizard/fields/media-size'
			],
			'mediaAlignment' => [
				'type' => 'pwalign',
				'default' => 'left'
			],
			'mediaType' => [
				'extends' => 'pagewizard/fields/media-type'
			],
			'image' => [
				'extends' => 'pagewizard/fields/image',
				'uploads' => 'pwImage',
				'query'   => 'page.images.template("pwImage")',
				'when'    => [
					'mediaType' => 'image'
				]
			],
			'images' => [
				'extends' => 'pagewizard/fields/images',
				'uploads' => 'pwImage',
				'query'   => 'page.images.template("pwImage")',
				'when'    => [
					'mediaType' => 'slideshow'
				]
			],
			'videoSource' => [
				'extends' => 'pagewizard/fields/video-source',
				'when'    => [
					'mediaType' => 'video'
				]
			],
			'videoUrl' => [
				'extends' => 'pagewizard/fields/video-url',
				'when'    => [
					'mediaType' => 'video',
					'videoSource' => 'external'
				]
			],
			'video' => [
				'extends' => 'pagewizard/fields/video',
				'uploads' => 'pwVideo',
				'query'   => 'page.files.template("pwVideo")',
				'when'    => [
					'mediaType' => 'video',
					'videoSource' => 'internal'
				]
			],
		]
	]
];