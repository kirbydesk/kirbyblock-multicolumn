<template>
	<!-- a sub-block of a column (tagline, headline, text, list, quote, media,
	     button) in the drawer: its info bar (its name, selected) and the
	     project's look in its block's colours, as the Project Wizard's panel
	     preview draws it; a double click opens it -->
	<div class="pwPreview" @dblclick="open">

		<pwBlockinfo
			:value="fieldset.name"
			:icon="fieldset.icon"
		/>

		<pw-block-panel-preview
			type="pwmulticolumn"
			:content="blockStyle"
			:sub="{ type: fieldset.type, content: content }"
		/>

	</div>
</template>

<script>
import pwBlockinfo from '@/../../kirby-pagewizard/src/components/blockinfo.vue';

export default {
	components: {
		pwBlockinfo
	},
	computed: {
		// the colours of its multicolumn block (the form around the column's
		// blocks field): its variant, or its own colours
		blockStyle() {
			let vm = this.$parent;
			while (vm && vm.$options.name !== 'k-fieldset') vm = vm.$parent;
			const values = (vm && vm.value) || {};
			return {
				theme: values.theme,
				backgroundcolor: values.backgroundcolor,
				textcolor: values.textcolor,
				buttonstyle: values.buttonstyle,
			};
		}
	}
}
</script>
