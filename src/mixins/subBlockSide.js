export default {
	data() {
		return { subFieldDefaults: null, subSide: 'left' }
	},
	mounted() {
		let node = this.$el?.parentElement;
		while (node) {
			if (/multicolumn\w+right/.test(node.className || '')) {
				this.subSide = 'right';
				break;
			}
			node = node.parentElement;
		}
	},
	async created() {
		try {
			const r = await this.$api.get('pagewizard/settings/pwmulticolumn');
			this.subFieldDefaults = r.fields || {};
		} catch(e) {
			this.subFieldDefaults = {};
		}
	}
}
