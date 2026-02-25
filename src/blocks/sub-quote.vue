<template>
	<div class="pwPreview" @dblclick="open">
		<pwQuote
			:quote="content.quote"
			:author="content.author"
			:alignQuoteDefault="subFieldDefaults?.['align-quote-' + subSide] || 'left'"
			:alignAuthorDefault="subFieldDefaults?.['align-author-' + subSide] || 'left'"
		/>
	</div>
</template>

<script>
import pwQuote from '@/../../kirby-pagewizard/src/components/quote.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwQuote },
	mixins: [subBlockSide]
}
</script>
