<template>
	<div class="pwPreview" @dblclick="open">
		<pwTagline
			:content="content"
			:alignDefault="subFieldDefaults?.['align-tagline-' + subSide] || 'left'"
		/>
	</div>
</template>

<script>
import pwTagline from '@/../../kirby-pagewizard/src/components/tagline.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwTagline },
	mixins: [subBlockSide]
}
</script>

<style scoped>
.pwPreview {
	padding: 2px 0;
}
</style>
