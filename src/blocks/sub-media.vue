<template>
	<div class="pwPreview" @dblclick="open">
		<pwImage v-if="content.mediatype === 'image'"
			:src="content?.image?.[0]?.url || ''"
			:srcset="content?.image?.[0]?.image?.srcset || ''"
			:size="content.mediasize"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:image="content?.image?.[0] || null"
		/>
		<pwImage v-else-if="content.mediatype === 'slideshow'"
			:src="content?.images?.[0]?.url || ''"
			:srcset="content?.images?.[0]?.image?.srcset || ''"
			:count="Array.isArray(content.images) ? content.images.length : 0"
			:size="content.mediasize"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:image="content?.images?.[0] || null"
		/>
		<pwVideo v-else-if="content.mediatype === 'video'"
			:url="content.videourl"
			:source="content.videosource"
			:size="content.mediasize"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:video="content?.video?.[0] || null"
		/>
		<div class="placeholder" v-else>…</div>
	</div>
</template>

<script>
import pwImage from '@/../../kirby-pagewizard/src/components/image.vue';
import pwVideo from '@/../../kirby-pagewizard/src/components/video.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwImage, pwVideo },
	mixins: [subBlockSide],
	computed: {
		mediaAlignDefault() {
			return this.subFieldDefaults?.['align-media-' + this.subSide] || 'left';
		}
	}
}
</script>

<style scoped>
.placeholder { opacity: 0.4; padding: var(--spacing-2); }
</style>
