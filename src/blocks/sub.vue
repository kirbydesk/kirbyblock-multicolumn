<template>
	<!-- a sub-block of a column (tagline, headline, text, list, quote, media,
	     button) in the drawer: in the project's look, as the Project Wizard's
	     panel preview draws it; a double click opens it -->
	<div class="pwPreview" @dblclick="open">
		<pw-block-panel-preview
			type="pwmulticolumn"
			:content="{}"
			:sub="{ type: fieldset.type, content: content }"
		/>
	</div>
</template>
