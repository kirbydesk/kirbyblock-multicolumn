<template>
	<div class="pwPreview" @dblclick="open">
		<pwHeading
			:content="content"
			:alignDefault="subFieldDefaults?.['align-headline-' + subSide] || 'left'"
			:sizeDefault="subFieldDefaults?.['size-headline-' + subSide] || null"
		/>
	</div>
</template>

<script>
import pwHeading from '@/../../kirby-pagewizard/src/components/heading.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwHeading },
	mixins: [subBlockSide]
}
</script>