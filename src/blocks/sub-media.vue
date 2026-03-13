<template>
	<div class="pwPreview" @dblclick="open">
		<pwImage v-if="content.mediatype === 'image' && content?.image?.[0]?.url"
			:src="content?.image?.[0]?.url || ''"
			:srcset="content?.image?.[0]?.image?.srcset || ''"
			:size="content.mediasize"
			:radius="content.mediaradius"
			:radiustopleft="content.radiustopleft"
			:radiustopright="content.radiustopright"
			:radiusbottomleft="content.radiusbottomleft"
			:radiusbottomright="content.radiusbottomright"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:image="content?.image?.[0] || null"
		/>
		<pwImage v-else-if="content.mediatype === 'slideshow' && content?.slideshow?.[0]?.url"
			:src="content?.slideshow?.[0]?.url || ''"
			:srcset="content?.slideshow?.[0]?.image?.srcset || ''"
			:count="Array.isArray(content.slideshow) ? content.slideshow.length : 0"
			:size="content.mediasize"
			:radius="content.mediaradius"
			:radiustopleft="content.radiustopleft"
			:radiustopright="content.radiustopright"
			:radiusbottomleft="content.radiusbottomleft"
			:radiusbottomright="content.radiusbottomright"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:image="content?.slideshow?.[0] || null"
		/>
		<pwVideo v-else-if="content.mediatype === 'video' && (content.videourl || content?.video?.[0])"
			:url="content.videourl"
			:source="content.videosource"
			:size="content.mediasize"
			:radius="content.mediaradius"
			:radiustopleft="content.radiustopleft"
			:radiustopright="content.radiustopright"
			:radiusbottomleft="content.radiusbottomleft"
			:radiusbottomright="content.radiusbottomright"
			:alignment="content.mediaalignment || mediaAlignDefault"
			:video="content?.video?.[0] || null"
		/>
		<div class="placeholder" v-else>{{ $t('pw.field.media-upload.help') }}</div>
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
