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

				<div class="pwColumns" :class="content.distribution">
					<!-- Left Column -->
					<div class="pwColumn left" :data-horizontal="content.leftpositionhorizontal" :data-vertical="content.leftpositionvertical">
						<div v-if="leftBlocks.length">
							<div v-for="(block, i) in leftBlocks" :key="i">
{{block.ishidden}}
								<!-- Writer -->
								<pwWriter	v-if="block.type === 'multicolumntext'" :debug="block" :value="block.content.text" :align="block.content.alignment" :class="{ 'ishidden': block.content.isHidden }" />

								<!-- Quote -->
								<pwQuote v-if="block.type === 'multicolumnquote'" :quote="block.content.quote" :author="block.content.author" />

								<!-- Media -->
								<div v-if="block.type === 'multicolumnmedia'">

									<!-- Image -->
									<pwImage v-if="block.content.mediatype === 'image'"
										:src="block.content?.image?.[0]?.url || ''"
										:srcset="block.content?.image?.[0]?.image?.srcset || ''"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:image="block.content?.image?.[0] || null"
									/>

									<!-- Slideshow (First image) -->
									<pwImage v-if="block.content.mediatype === 'slideshow'"
										:src="block.content?.images?.[0]?.url || ''"
										:srcset="block.content?.images?.[0]?.images?.srcset || ''"
										:count="Array.isArray(block.content.images) ? block.content.images.length : 0"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:image="content?.images?.[0] || null"
									/>

									<!-- Video -->
									<pwVideo v-if="block.content.mediatype === 'video'"
										:url="block.content.videourl"
										:source="block.content.videosource"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:video="block.content?.video?.[0] || null"
									/>

								</div>
							</div>
						</div>
					</div>

					<!-- Right Column -->
					<div class="pwColumn right" :data-horizontal="content.rightpositionhorizontal" :data-vertical="content.rightpositionvertical">

						<div v-if="rightBlocks.length">
							<div v-for="(block, i) in rightBlocks" :key="i">

								<!-- Writer -->
								<pwWriter	v-if="block.type === 'multicolumntext'" :value="block.content.text" :align="block.content.alignment" />

								<!-- Quote -->
								<pwQuote v-if="block.type === 'multicolumnquote'" :quote="block.content.quote" :author="block.content.author" />

								<!-- Media -->
								<div v-if="block.type === 'multicolumnmedia'">

									<!-- Image -->
									<pwImage v-if="block.content.mediatype === 'image'"
										:src="block.content?.image?.[0]?.url || ''"
										:srcset="block.content?.image?.[0]?.image?.srcset || ''"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:image="block.content?.image?.[0] || null"
									/>

									<!-- Slideshow (First image) -->
									<pwImage v-if="block.content.mediatype === 'slideshow'"
										:src="block.content?.images?.[0]?.url || ''"
										:srcset="block.content?.images?.[0]?.images?.srcset || ''"
										:count="Array.isArray(block.content.images) ? block.content.images.length : 0"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:image="content?.images?.[0] || null"
									/>

									<!-- Video -->
									<pwVideo v-if="block.content.mediatype === 'video'"
										:url="block.content.videourl"
										:source="block.content.videosource"
										:size="block.content.mediasize"
										:alignment="block.content.mediaalignment"
										:video="block.content?.video?.[0] || null"
									/>

								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';
import pwGridStyle from '@/../../kirby-pagewizard/src/mixins/gridStyle.js';
import pwColorStyle from '@/../../kirby-pagewizard/src/mixins/colorStyle.js';
import pwWriter from '@/../../kirby-pagewizard/src/components/writer.vue';
import pwQuote from '@/../../kirby-pagewizard/src/components/quote.vue';
import pwImage from '@/../../kirby-pagewizard/src/components/image.vue';
import pwVideo from '@/../../kirby-pagewizard/src/components/video.vue';

export default {
	components: {
		pwBlockinfo,
		pwWriter,
		pwQuote,
		pwImage,
		pwVideo
	},
	mixins: [pwGridStyle, pwColorStyle],
	data() {
		return {
			settings: {}
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
	methods: {
	},
	async created() {
		try {
			const response = await this.$api.get('pagewizard/settings/pwmulticolumn');
			this.settings = response.settings;
		} catch (e) {
			this.settings = {};
		}
	}
}
</script>

<style>
@media (min-width: 640px) {
	[data-kirbyblock="multicolumn"] .pwColumns {
		display: grid;
		grid-template-columns: repeat(6, 1fr); /* 6er Grid */

		&.dist-1-5 {
			> :first-child { grid-column: span 1; }
			> :last-child  { grid-column: span 5; }
		}
		&.dist-2-4 {
			> :first-child { grid-column: span 2; }
			> :last-child  { grid-column: span 4; }
		}
		&.dist-3-3 {
			> :first-child { grid-column: span 3; }
			> :last-child  { grid-column: span 3; }
		}
		&.dist-4-2 {
			> :first-child { grid-column: span 4; }
			> :last-child  { grid-column: span 2; }
		}
		&.dist-5-1 {
			> :first-child { grid-column: span 5; }
			> :last-child  { grid-column: span 1; }
		}

		.pwColumn {
			&.left {
				border-right: 1px dashed color-mix(in srgb, var(--pw-color-text) 40%, transparent);
				padding-right: 1.5rem;
			}
			&.right {
				padding-left: 1.5rem;
			}
		}
	}
}
[data-kirbyblock="multicolumn"] .pwColumns {
	.pwColumn[data-horizontal="left"] {
		justify-self: start;
	}
	.pwColumn[data-horizontal="center"] {
		justify-self: center;
	}
	.pwColumn[data-horizontal="right"] {
		justify-self: end;
	}
	.pwColumn[data-vertical="top"] {
		align-self: start;
	}
	.pwColumn[data-vertical="middle"] {
		align-self: center;
	}
	.pwColumn[data-vertical="bottom"] {
		align-self: end;
	}
}
.k-block {
	&.k-block-type-multicolumntext,
	&.k-block-type-multicolumnquote,
	&.k-block-type-multicolumnmedia {
		padding: 10px;
	}
}
.ishidden {
	opacity:.25;
}
</style>
