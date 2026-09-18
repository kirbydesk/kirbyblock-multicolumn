<template>
	<div class="pwPreview" @dblclick="open">
		<component
			v-if="items.length"
			:is="tag"
			class="pwList"
			:data-style="content.liststyle || 'bullet'"
			:data-align="content.listalignment || 'left'"
			:data-editor-size="content.listsize || 'normal'"
		>
			<li v-for="(li, idx) in items" :key="idx">{{ li.text }}</li>
		</component>
		<div v-else class="placeholder">{{ $t('kirbyblock-multicolumn.sub.list.empty') }}</div>
	</div>
</template>

<script>
import subBlockSide from '@/mixins/subBlockSide.js';
export default {
	mixins: [subBlockSide],
	computed: {
		tag() {
			return this.content.liststyle === 'ordered' ? 'ol' : 'ul';
		},
		items() {
			const raw = this.content.items;
			if (!raw) return [];
			if (Array.isArray(raw)) return raw;
			try {
				const d = JSON.parse(raw);
				return Array.isArray(d) ? d : [];
			} catch(e) {
				return [];
			}
		}
	}
}
</script>

<style scoped>
.pwList {
	list-style-position: inside;
	padding-left: 0;
	margin: 0;
}
.pwList[data-style="bullet"]  { list-style-type: disc; }
.pwList[data-style="ordered"] { list-style-type: decimal; }
.pwList[data-style="none"]    { list-style-type: none; }
.pwList[data-align="left"]   { text-align: left; }
.pwList[data-align="center"] { text-align: center; }
.pwList[data-align="right"]  { text-align: right; }
.pwList[data-editor-size="lg"]  { font-size: var(--text-lg); }
.pwList[data-editor-size="xl"]  { font-size: var(--text-xl); }
.pwList[data-editor-size="2xl"] { font-size: var(--text-2xl); }
.pwList[data-editor-size="3xl"] { font-size: var(--text-3xl); }
.pwList > li { padding: 0.15em 0; }
.placeholder {
	color: var(--color-text-dimmed);
	font-style: italic;
}
</style>
