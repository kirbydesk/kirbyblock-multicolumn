<template>
	<!-- a sub-block of a column (tagline, headline, text, list, quote, media,
	     button) in the drawer: its info bar (its name, selected) and the
	     project's look, as the Project Wizard's panel preview draws it; a
	     double click opens it -->
	<div class="pwPreview" @dblclick="open">

		<pwBlockinfo
			:value="fieldset.name"
			:icon="fieldset.icon"
		/>

		<pw-block-panel-preview
			type="pwmulticolumn"
			:content="{}"
			:sub="{ type: fieldset.type, content: content }"
		/>

	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';

export default {
	components: {
		pwBlockinfo
	}
}
</script>
