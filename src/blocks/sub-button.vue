<template>
	<div class="pwPreview" @dblclick="open">
		<pwButton
			:content="content"
			:alignDefault="subFieldDefaults?.['align-button-' + subSide] || 'left'"
		/>
	</div>
</template>

<script>
import pwButton from '@/../../kirby-pagewizard/src/components/button.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwButton },
	mixins: [subBlockSide]
}
</script>
