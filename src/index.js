// Blocks
import pwmulticolumn         from "@/blocks/index.vue";
import pwmulticolumnHeadline from "@/blocks/sub-headline.vue";
import pwmulticolumnText     from "@/blocks/sub-text.vue";
import pwmulticolumnQuote    from "@/blocks/sub-quote.vue";
import pwmulticolumnMedia    from "@/blocks/sub-media.vue";

// Render
panel.plugin("kirbydesk/kirbyblock-multicolumn", {
	blocks: {
		pwmulticolumn,
		multicolumnheadlineleft:  pwmulticolumnHeadline,
		multicolumnheadlineright: pwmulticolumnHeadline,
		multicolumntextleft:      pwmulticolumnText,
		multicolumntextright:     pwmulticolumnText,
		multicolumnquoteleft:     pwmulticolumnQuote,
		multicolumnquoteright:    pwmulticolumnQuote,
		multicolumnmedialeft:     pwmulticolumnMedia,
		multicolumnmediaright:    pwmulticolumnMedia,
	}
});
