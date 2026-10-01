// Blocks
import pwmulticolumn         from "@/blocks/index.vue";
// (every sub-block: one preview in the project's look)
import pwmulticolumnSub     from "@/blocks/sub.vue";

// Render
panel.plugin("kirbydesk/kirbyblock-multicolumn", {
	blocks: {
		pwmulticolumn,
		multicolumnheadlineleft:  pwmulticolumnSub,
		multicolumnheadlineright: pwmulticolumnSub,
		multicolumntextleft:      pwmulticolumnSub,
		multicolumntextright:     pwmulticolumnSub,
		multicolumnlistleft:      pwmulticolumnSub,
		multicolumnlistright:     pwmulticolumnSub,
		multicolumnquoteleft:     pwmulticolumnSub,
		multicolumnquoteright:    pwmulticolumnSub,
		multicolumnmedialeft:     pwmulticolumnSub,
		multicolumnmediaright:    pwmulticolumnSub,
		multicolumnbuttonleft:    pwmulticolumnSub,
		multicolumnbuttonright:   pwmulticolumnSub,
		multicolumntaglineleft:   pwmulticolumnSub,
		multicolumntaglineright:  pwmulticolumnSub,
	}
});
