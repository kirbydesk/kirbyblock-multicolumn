<template>
	<div class="pwColumn" :class="side" :data-vertical="vertical">
		<div v-if="blocks.length">
			<div v-for="(block, i) in blocks" :key="i">

				<!-- Headline -->
				<pwHeading v-if="blockType(block) === 'multicolumnheadline'"
					:content="block.content"
					:alignDefault="fieldDefaults['align-headline-' + side] || 'left'"
				/>

				<!-- Writer -->
				<pwWriter v-if="blockType(block) === 'multicolumntext'" v-bind="parseEditorValue(block.content.editor)" :class="{ 'ishidden': block.content.isHidden }" />

				<!-- Quote -->
				<pwQuote v-if="blockType(block) === 'multicolumnquote'"
					:quote="block.content.quote"
					:author="block.content.author"
					:alignQuoteDefault="fieldDefaults['align-quote-' + side] || 'left'"
					:alignAuthorDefault="fieldDefaults['align-author-' + side] || 'left'"
				/>

				<!-- Button -->
				<pwButton v-if="blockType(block) === 'multicolumnbutton'"
					:content="block.content"
					:alignDefault="fieldDefaults['align-button-' + side] || 'left'"
				/>

				<!-- Media -->
				<div v-if="blockType(block) === 'multicolumnmedia'">

					<!-- Image -->
					<pwImage v-if="block.content.mediatype === 'image'"
						:src="block.content?.image?.[0]?.url || ''"
						:srcset="block.content?.image?.[0]?.image?.srcset || ''"
						:size="block.content.mediasize"
						:alignment="block.content.mediaalignment || fieldDefaults['align-media-' + side]"
						:image="block.content?.image?.[0] || null"
					/>

					<!-- Slideshow (First image) -->
					<pwImage v-if="block.content.mediatype === 'slideshow'"
						:src="block.content?.images?.[0]?.url || ''"
						:srcset="block.content?.images?.[0]?.images?.srcset || ''"
						:count="Array.isArray(block.content.images) ? block.content.images.length : 0"
						:size="block.content.mediasize"
						:alignment="block.content.mediaalignment || fieldDefaults['align-media-' + side]"
						:image="block.content?.images?.[0] || null"
					/>

					<!-- Video -->
					<pwVideo v-if="block.content.mediatype === 'video'"
						:url="block.content.videourl"
						:source="block.content.videosource"
						:size="block.content.mediasize"
						:alignment="block.content.mediaalignment || fieldDefaults['align-media-' + side]"
						:video="block.content?.video?.[0] || null"
					/>

				</div>
			</div>
		</div>
	</div>
</template>

<script>
import pwWriter  from '@/../../kirby-pagewizard/src/components/writer.vue';
import pwQuote   from '@/../../kirby-pagewizard/src/components/quote.vue';
import pwImage   from '@/../../kirby-pagewizard/src/components/image.vue';
import pwVideo   from '@/../../kirby-pagewizard/src/components/video.vue';
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue';
import pwButton  from '@/../../kirby-pagewizard/src/components/button.vue';

export default {
	components: { pwWriter, pwQuote, pwImage, pwVideo, pwHeading, pwButton },
	props: {
		blocks:       { type: Array,  default: () => [] },
		side:         { type: String, default: 'left' },
		vertical:     { type: String, default: null },
		fieldDefaults: { type: Object, default: () => ({}) },
	},
	methods: {
		blockType(block) {
			return block.type.replace(/left$|right$/, '');
		},
		parseEditorValue(raw) {
			const alignDefault = this.fieldDefaults['align-text-' + this.side] || 'left';
			if (!raw) return { value: '', align: alignDefault, size: null };
			try {
				const d = JSON.parse(raw);
				const value = d.mode ? (d[d.mode] || '') : (d.writer || d.textarea || d.markdown || '');
				return { value, align: d.align || alignDefault, size: d.size || null };
			} catch(e) {
				return { value: raw, align: alignDefault, size: null };
			}
		}
	}
}
</script>
