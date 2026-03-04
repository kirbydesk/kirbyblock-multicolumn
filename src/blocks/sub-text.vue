<template>
	<div class="pwPreview" @dblclick="open">
		<pwWriter v-bind="parsedContent" />
	</div>
</template>

<script>
import pwWriter from '@/../../kirby-pagewizard/src/components/writer.vue';
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	components: { pwWriter },
	mixins: [subBlockSide],
	computed: {
		parsedContent() {
			const raw = this.content.editor;
			const alignDefault = this.subFieldDefaults?.['align-text-' + this.subSide] || 'left';
			if (!raw) return { value: '', align: alignDefault };
			try {
				const d = JSON.parse(raw);
				const value = d.mode ? (d[d.mode] || '') : (d.writer || d.textarea || d.markdown || '');
				return { value, align: d.align || alignDefault };
			} catch(e) {
				return { value: raw, align: alignDefault };
			}
		}
	}
}
</script>

