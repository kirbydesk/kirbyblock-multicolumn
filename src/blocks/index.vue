<template>
	<!-- the block in the panel: its info bar and the shared preview of the
	     Project Wizard (the project's look, the real columns and their
	     sub-blocks); a double click opens the block -->
	<div class="pwPreview" data-kirbyblock="multicolumn" @dblclick="open">

		<pwBlockinfo
			:value="$t('kirbyblock-multicolumn.name')"
			:design="'pwmulticolumn'"
			icon="layout-columns"
		/>

		<pw-block-panel-preview type="pwmulticolumn" :content="content" />

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
