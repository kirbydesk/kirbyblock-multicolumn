<template>
	<div
		class="pwPreview"
		data-kirbyblock="multicolumn"
		@dblclick="open"
		:style="colorVars"
		:data-margintop="content.margintop === true ? 'true' : null"
		:data-marginbottom="content.marginbottom === true ? 'true' : null"
		>

		<pwBlockinfo
			:value="$t('kirbyblock-multicolumn.name')"
			icon="layout-columns"
		/>

		<div class="pwGrid">
			<div
				class="pwGridItem"
				:style="gridVars"
				:data-paddingtop="content.paddingtop === true ? 'true' : null"
				:data-paddingright="content.paddingright === true ? 'true' : null"
				:data-paddingbottom="content.paddingbottom === true ? 'true' : null"
				:data-paddingleft="content.paddingleft === true ? 'true' : null"
				>

				<div v-if="fieldDefaults !== null" class="pwColumns"
					:data-dist-sm="content.distributionsm || null"
					:data-dist-md="content.distributionmd || null"
					:data-dist-lg="content.distributionlg || null"
					:data-dist-xl="content.distributionxl || null"
				>
					<pwColumn
						side="left"
						:blocks="leftBlocks"
						:vertical="content.leftpositionvertical"
						:fieldDefaults="fieldDefaults"
					/>
					<pwColumn
						side="right"
						:blocks="rightBlocks"
						:vertical="content.rightpositionvertical"
						:fieldDefaults="fieldDefaults"
					/>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';
import pwColumn from '@/components/column.vue';

export default {
	components: {
		pwBlockinfo,
		pwColumn
	},
	mixins: [pwGridStyle, pwColorStyle],
	data() {
		return {
			settings: {},
			fieldDefaults: null
		}
	},
	computed: {
		leftBlocks() {
			return this.content.blocksleft || [];
		},
		rightBlocks() {
			return this.content.blocksright || [];
		}
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwmulticolumn');
			this.settings = response.settings;
			this.fieldDefaults = response.fields || {};
		} catch (e) {
			this.settings = {};
			this.fieldDefaults = {};
		}
	}
}
</script>

<style>
[data-kirbyblock="multicolumn"] .pwColumns .pwColumn {
	&.right {
		margin-top: 1rem;
	}

	& > div > div + div {
  	margin-top: var(--spacing-2); /* All direct children except the first (lobotomized owl) */
	}
}
@media (min-width: 640px) {
	[data-kirbyblock="multicolumn"] .pwColumns {
		&[data-dist-sm] {
			display: grid;
			.pwColumn { border: 1px dashed color-mix(in srgb, var(--pw-color-text) 40%, transparent); }
		}
		&[data-dist-sm="dist-1-5"] { grid-template-columns: 1fr 5fr; }
		&[data-dist-sm="dist-2-4"] { grid-template-columns: 2fr 4fr; }
		&[data-dist-sm="dist-3-3"] { grid-template-columns: 3fr 3fr; }
		&[data-dist-sm="dist-4-2"] { grid-template-columns: 4fr 2fr; }
		&[data-dist-sm="dist-5-1"] { grid-template-columns: 5fr 1fr; }

		.pwColumn.right {
			margin-top: 0;
		}
	}
}
@media (min-width: 768px) {
	[data-kirbyblock="multicolumn"] .pwColumns {
		&[data-dist-md] {
			display: grid;
			.pwColumn { border: 1px dashed color-mix(in srgb, var(--pw-color-text) 40%, transparent); }
		}
		&:not([data-dist-md]) { display: block; .pwColumn { border: none; } }
		&[data-dist-md="dist-1-5"] { grid-template-columns: 1fr 5fr; }
		&[data-dist-md="dist-2-4"] { grid-template-columns: 2fr 4fr; }
		&[data-dist-md="dist-3-3"] { grid-template-columns: 3fr 3fr; }
		&[data-dist-md="dist-4-2"] { grid-template-columns: 4fr 2fr; }
		&[data-dist-md="dist-5-1"] { grid-template-columns: 5fr 1fr; }
	}
}
@media (min-width: 1024px) {
	[data-kirbyblock="multicolumn"] .pwColumns {
		&[data-dist-lg] {
			display: grid;
			.pwColumn { border: 1px dashed color-mix(in srgb, var(--pw-color-text) 40%, transparent); }
		}
		&:not([data-dist-lg]) { display: block; .pwColumn { border: none; } }
		&[data-dist-lg="dist-1-5"] { grid-template-columns: 1fr 5fr; }
		&[data-dist-lg="dist-2-4"] { grid-template-columns: 2fr 4fr; }
		&[data-dist-lg="dist-3-3"] { grid-template-columns: 3fr 3fr; }
		&[data-dist-lg="dist-4-2"] { grid-template-columns: 4fr 2fr; }
		&[data-dist-lg="dist-5-1"] { grid-template-columns: 5fr 1fr; }
	}
}
@media (min-width: 1280px) {
	[data-kirbyblock="multicolumn"] .pwColumns {
		&[data-dist-xl] {
			display: grid;
			.pwColumn { border: 1px dashed color-mix(in srgb, var(--pw-color-text) 40%, transparent); }
		}
		&:not([data-dist-xl]) { display: block; .pwColumn { border: none; } }
		&[data-dist-xl="dist-1-5"] { grid-template-columns: 1fr 5fr; }
		&[data-dist-xl="dist-2-4"] { grid-template-columns: 2fr 4fr; }
		&[data-dist-xl="dist-3-3"] { grid-template-columns: 3fr 3fr; }
		&[data-dist-xl="dist-4-2"] { grid-template-columns: 4fr 2fr; }
		&[data-dist-xl="dist-5-1"] { grid-template-columns: 5fr 1fr; }
	}
}
[data-kirbyblock="multicolumn"] .pwColumns {
	gap: 1rem;
	.pwColumn[data-vertical="top"]    { align-self: start; }
	.pwColumn[data-vertical="middle"] { align-self: center; }
	.pwColumn[data-vertical="bottom"] { align-self: end; }
}
.k-block {
	&.k-block-type-multicolumnheadlineleft,
	&.k-block-type-multicolumntextleft,
	&.k-block-type-multicolumnquoteleft,
	&.k-block-type-multicolumnmedialeft,
	&.k-block-type-multicolumnheadlineright,
	&.k-block-type-multicolumntextright,
	&.k-block-type-multicolumnquoteright,
	&.k-block-type-multicolumnmediaright {
		padding: 10px;
	}
}
.ishidden {
	opacity:.25;
}
</style>
