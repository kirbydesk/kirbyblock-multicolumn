(function() {
  "use strict";
  function normalizeComponent(scriptExports, render, staticRenderFns, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render) {
      options.render = render;
      options.staticRenderFns = staticRenderFns;
      options._compiled = true;
    }
    if (scopeId) {
      options._scopeId = "data-v-" + scopeId;
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const _sfc_main$b = {
    props: {
      value: String,
      icon: String,
      layout: String
    }
  };
  var _sfc_render$b = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "blockinfo" }, [_c("div", [_c("svg", { staticClass: "k-icon", attrs: { "aria-hidden": "true" } }, [_c("use", { attrs: { "xlink:href": "#icon-" + _vm.icon } })]), _vm._v(" " + _vm._s(_vm.value) + " "), _vm.layout ? _c("span", [_vm._v("(" + _vm._s(_vm.layout) + ")")]) : _vm._e()])]);
  };
  var _sfc_staticRenderFns$b = [];
  _sfc_render$b._withStripped = true;
  var __component__$b = /* @__PURE__ */ normalizeComponent(
    _sfc_main$b,
    _sfc_render$b,
    _sfc_staticRenderFns$b,
    false,
    null,
    "26526d24"
  );
  __component__$b.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/blockinfo.vue";
  const pwBlockinfo = __component__$b.exports;
  const pwGridStyle = {
    computed: {
      gridVars() {
        return {
          "--grid-start-sm": Number(this.content.gridoffsetsm) + 1,
          "--grid-span-sm": Number(this.content.gridsizesm),
          "--grid-start-md": Number(this.content.gridoffsetmd) + 1,
          "--grid-span-md": Number(this.content.gridsizemd),
          "--grid-start-lg": Number(this.content.gridoffsetlg) + 1,
          "--grid-span-lg": Number(this.content.gridsizelg),
          "--grid-start-xl": Number(this.content.gridoffsetxl) + 1,
          "--grid-span-xl": Number(this.content.gridsizexl)
        };
      }
    }
  };
  const pwColorStyle = {
    data() {
      return {
        colors: null
      };
    },
    async created() {
      try {
        this.colors = await this.$api.get("pagewizard/colors");
      } catch (e) {
        this.colors = null;
      }
    },
    computed: {
      colorVars() {
        if (!this.colors) return {};
        const style = this.content.theme || "default";
        const vars = {};
        if (style === "custom") {
          for (const [key, value] of Object.entries(this.colors.default)) {
            vars["--" + key] = value;
          }
          if (this.content.textcolor) {
            vars["--pw-color-text"] = this.content.textcolor;
            vars["--pw-color-heading"] = this.content.textcolor;
            vars["--pw-color-tagline"] = this.content.textcolor;
            vars["--pw-color-link"] = this.content.textcolor;
            vars["--pw-color-quote"] = this.content.textcolor;
            vars["--pw-color-cite"] = this.content.textcolor;
          }
          if (this.content.backgroundcolor) {
            vars["--pw-color-block-background"] = this.content.backgroundcolor;
          }
          const btnStyle = this.content.buttonstyle || "default";
          if (btnStyle === "variant" && this.colors.variant) {
            const btnKeys = Object.keys(this.colors.variant).filter((k) => k.startsWith("pw-color-button"));
            for (const key of btnKeys) {
              vars["--" + key] = this.colors.variant[key];
            }
          }
        } else {
          const palette = style === "variant" ? { ...this.colors.default, ...this.colors.variant } : this.colors.default;
          for (const [key, value] of Object.entries(palette)) {
            vars["--" + key] = value;
          }
        }
        return vars;
      }
    }
  };
  const _sfc_main$a = {
    props: {
      value: String,
      align: { type: String, default: "left" },
      size: { type: String, default: null }
    }
  };
  var _sfc_render$a = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwtext", attrs: { "data-align": _vm.align, "data-size": _vm.size } }, [_vm.value ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.value) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-writer.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$a = [];
  _sfc_render$a._withStripped = true;
  var __component__$a = /* @__PURE__ */ normalizeComponent(
    _sfc_main$a,
    _sfc_render$a,
    _sfc_staticRenderFns$a,
    false,
    null,
    "fa3feda4"
  );
  __component__$a.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/writer.vue";
  const pwWriter = __component__$a.exports;
  const _sfc_main$9 = {
    props: {
      quote: String,
      author: String,
      alignQuoteDefault: { type: String, default: "left" },
      alignAuthorDefault: { type: String, default: "left" },
      alignQuote: { type: String, default: null },
      alignAuthor: { type: String, default: null }
    },
    computed: {
      parsedQuoteData() {
        const val = this.quote;
        if (!val) return { text: "", align: this.alignQuoteDefault, html: false };
        try {
          const d = typeof val === "string" ? JSON.parse(val) : val;
          if (d.mode !== void 0) {
            return { text: d.writer || d.textarea || d.markdown || "", align: d.align || this.alignQuoteDefault, size: d.size || "normal", html: d.mode === "writer" };
          }
          return { text: d.text || "", align: d.align || this.alignQuoteDefault, size: "normal", html: false };
        } catch (e) {
          return { text: val, align: this.alignQuoteDefault, html: false };
        }
      },
      parsedAuthorData() {
        const val = this.author;
        if (!val) return { text: "", align: this.alignAuthorDefault };
        try {
          const d = typeof val === "string" ? JSON.parse(val) : val;
          return { text: d.text || "", align: d.align || this.alignAuthorDefault };
        } catch (e) {
          return { text: val, align: this.alignAuthorDefault };
        }
      },
      quoteText() {
        const { text = "", html = false } = this.parsedQuoteData;
        return html ? text : this.nl2br(text);
      },
      authorText() {
        const { text = "" } = this.parsedAuthorData;
        return text;
      },
      size() {
        const { size = "2xl" } = this.parsedQuoteData;
        return size;
      },
      quoteAlign() {
        if (this.alignQuote) return this.alignQuote;
        const { align = this.alignQuoteDefault } = this.parsedQuoteData;
        return align;
      },
      authorAlign() {
        if (this.alignAuthor) return this.alignAuthor;
        const { align = this.alignAuthorDefault } = this.parsedAuthorData;
        return align;
      }
    },
    methods: {
      nl2br(text) {
        if (!text) return "";
        return text.replace(/\n/g, "<br>");
      }
    }
  };
  var _sfc_render$9 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwquote" }, [_vm.quoteText ? _c("div", { staticClass: "quote", attrs: { "data-align": _vm.quoteAlign, "data-size": _vm.size }, domProps: { "innerHTML": _vm._s(_vm.nl2br(_vm.quoteText)) } }) : _c("div", { staticClass: "quote placeholder", attrs: { "data-align": _vm.quoteAlign } }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.quote.placeholder")) + " ")]), _vm.authorText ? _c("div", { staticClass: "author", attrs: { "data-align": _vm.authorAlign } }, [_vm._v(_vm._s(_vm.authorText))]) : _c("div", { staticClass: "author placeholder", attrs: { "data-align": _vm.authorAlign } }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.author.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$9 = [];
  _sfc_render$9._withStripped = true;
  var __component__$9 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$9,
    _sfc_render$9,
    _sfc_staticRenderFns$9,
    false,
    null,
    "90325663"
  );
  __component__$9.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/quote.vue";
  const pwQuote = __component__$9.exports;
  const _sfc_main$8 = {
    props: {
      src: String,
      srcset: String,
      size: String,
      alignment: {
        type: String,
        default: "left"
      },
      image: Object,
      count: {
        type: Number,
        default: 0
      }
    },
    data() {
      return {
        imageContent: null
      };
    },
    computed: {
      computedCrop() {
        var _a;
        return ((_a = this.imageContent) == null ? void 0 : _a.imagecrop) || false;
      },
      computedRatio() {
        var _a;
        const ratio = (_a = this.imageContent) == null ? void 0 : _a.imageratio;
        if (!ratio || ratio === "auto") return null;
        return ratio;
      },
      computedZoom() {
        var _a;
        return ((_a = this.imageContent) == null ? void 0 : _a.imagezoom) || false;
      }
    },
    async mounted() {
      var _a;
      if ((_a = this.image) == null ? void 0 : _a.link) {
        await this.loadImageContent();
      }
    },
    methods: {
      async loadImageContent() {
        try {
          const response = await this.$api.get(this.image.link);
          this.imageContent = (response == null ? void 0 : response.content) || null;
        } catch (error) {
          console.error("Error loading image content:", error);
        }
      }
    }
  };
  var _sfc_render$8 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.src.length ? _c("div", { staticClass: "wrap", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "image" }, [_c("div", { staticClass: "pattern", class: _vm.size }, [_c("figure", { class: _vm.computedRatio ? ["k-frame", "k-image-frame", "k-image", { zoom: _vm.computedZoom }] : ["k-image", "ratio-auto", { zoom: _vm.computedZoom }], style: _vm.computedRatio ? {
      "--fit": _vm.computedCrop ? "cover" : "contain",
      "--ratio": _vm.computedRatio
    } : {} }, [_c("img", { attrs: { "src": _vm.src, "srcset": _vm.srcset } }), _c("div", [_c("k-icon", { attrs: { "type": "search" } })], 1)])])]), _vm.count > 1 ? _c("div", { staticClass: "controls" }, [_c("div", { staticClass: "dots", class: _vm.size }, _vm._l(_vm.count, function(n) {
      return _c("span", { key: n, staticClass: "dot" });
    }), 0)]) : _vm._e()]) : _vm._e();
  };
  var _sfc_staticRenderFns$8 = [];
  _sfc_render$8._withStripped = true;
  var __component__$8 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$8,
    _sfc_render$8,
    _sfc_staticRenderFns$8,
    false,
    null,
    "3063e108"
  );
  __component__$8.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/image.vue";
  const pwImage = __component__$8.exports;
  const _sfc_main$7 = {
    props: {
      url: String,
      source: String,
      size: String,
      alignment: {
        type: String,
        default: "left"
      },
      video: Object
    },
    data() {
      return {
        videoContent: null
      };
    },
    computed: {
      computedRatio() {
        var _a;
        return ((_a = this.videoContent) == null ? void 0 : _a.videoratio) || "16/9";
      },
      videoUrl() {
        var _a;
        return ((_a = this.video) == null ? void 0 : _a.url) || this.video;
      }
    },
    async mounted() {
      var _a;
      if ((_a = this.video) == null ? void 0 : _a.link) {
        await this.loadVideoContent();
      }
    },
    methods: {
      async loadVideoContent() {
        try {
          const response = await this.$api.get(this.video.link);
          this.videoContent = (response == null ? void 0 : response.content) || null;
        } catch (error) {
          console.error("Error loading video content:", error);
        }
      },
      getEmbedUrl(url) {
        if (url.includes("youtube.com/embed/") || url.includes("youtube-nocookie.com/embed/")) {
          return url.includes("?") ? url + `&origin=${window.location.origin}` : url + `?origin=${window.location.origin}`;
        }
        const ytMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_-]+)/);
        if (ytMatch && ytMatch[1]) {
          return `https://www.youtube.com/embed/${ytMatch[1]}?origin=${window.location.origin}`;
        }
        const vimeoMatch = url.match(/vimeo\.com\/(?:video\/)?(\d+)/);
        if (vimeoMatch && vimeoMatch[1]) {
          return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
        }
        return url;
      }
    }
  };
  var _sfc_render$7 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.url || _vm.videoUrl ? _c("div", { staticClass: "video", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "pattern", class: _vm.size }, [_vm.source == "internal" ? _c("k-frame", { attrs: { "ratio": _vm.computedRatio } }, [_c("video", { attrs: { "src": _vm.videoUrl, "controls": "" } })]) : _vm.source == "external" ? _c("k-frame", { staticClass: "external", attrs: { "ratio": "16/9" } }, [_c("iframe", { attrs: { "src": _vm.getEmbedUrl(_vm.url), "allow": "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share", "referrerpolicy": "origin", "allowfullscreen": "" } })]) : _vm._e()], 1)]) : _vm._e();
  };
  var _sfc_staticRenderFns$7 = [];
  _sfc_render$7._withStripped = true;
  var __component__$7 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$7,
    _sfc_render$7,
    _sfc_staticRenderFns$7,
    false,
    null,
    "301ff5b5"
  );
  __component__$7.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/video.vue";
  const pwVideo = __component__$7.exports;
  const _sfc_main$6 = {
    props: {
      value: String,
      content: {
        type: Object,
        default: () => ({})
      },
      alignDefault: { type: String, default: null },
      sizeDefault: { type: String, default: null }
    },
    computed: {
      parsedData() {
        var _a;
        const val = ((_a = this.content) == null ? void 0 : _a.heading) || this.value;
        if (!val) return { text: "", align: this.alignDefault };
        try {
          return typeof val === "string" ? JSON.parse(val) : val;
        } catch (e) {
          return { text: val, align: this.alignDefault };
        }
      },
      text() {
        const { text = "" } = this.parsedData;
        return text;
      },
      align() {
        const { align = this.alignDefault } = this.parsedData;
        return align;
      },
      size() {
        const { size = this.sizeDefault } = this.parsedData;
        return size;
      }
    }
  };
  var _sfc_render$6 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwHeading", attrs: { "data-align": _vm.align, "data-size": _vm.size } }, [_vm.text ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.text) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.heading.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$6 = [];
  _sfc_render$6._withStripped = true;
  var __component__$6 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$6,
    _sfc_render$6,
    _sfc_staticRenderFns$6,
    false,
    null,
    "ad832d63"
  );
  __component__$6.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/heading.vue";
  const pwHeading = __component__$6.exports;
  const _sfc_main$5 = {
    components: { pwWriter, pwQuote, pwImage, pwVideo, pwHeading },
    props: {
      blocks: { type: Array, default: () => [] },
      side: { type: String, default: "left" },
      vertical: { type: String, default: null },
      fieldDefaults: { type: Object, default: () => ({}) }
    },
    methods: {
      blockType(block) {
        return block.type.replace(/left$|right$/, "");
      },
      parseEditorValue(raw) {
        const alignDefault = this.fieldDefaults["align-text-" + this.side] || "left";
        if (!raw) return { value: "", align: alignDefault, size: null };
        try {
          const d = JSON.parse(raw);
          const value = d.mode ? d[d.mode] || "" : d.writer || d.textarea || d.markdown || "";
          return { value, align: d.align || alignDefault, size: d.size || null };
        } catch (e) {
          return { value: raw, align: alignDefault, size: null };
        }
      }
    }
  };
  var _sfc_render$5 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwColumn", class: _vm.side, attrs: { "data-vertical": _vm.vertical } }, [_vm.blocks.length ? _c("div", _vm._l(_vm.blocks, function(block, i) {
      var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j, _k, _l, _m, _n, _o, _p, _q, _r, _s, _t;
      return _c("div", { key: i }, [_vm.blockType(block) === "multicolumnheadline" ? _c("pwHeading", { attrs: { "content": block.content, "alignDefault": _vm.fieldDefaults["align-headline-" + _vm.side] || "left" } }) : _vm._e(), _vm.blockType(block) === "multicolumntext" ? _c("pwWriter", _vm._b({ class: { "ishidden": block.content.isHidden } }, "pwWriter", _vm.parseEditorValue(block.content.editor), false)) : _vm._e(), _vm.blockType(block) === "multicolumnquote" ? _c("pwQuote", { attrs: { "quote": block.content.quote, "author": block.content.author, "alignQuoteDefault": _vm.fieldDefaults["align-quote-" + _vm.side] || "left", "alignAuthorDefault": _vm.fieldDefaults["align-author-" + _vm.side] || "left" } }) : _vm._e(), _vm.blockType(block) === "multicolumnmedia" ? _c("div", [block.content.mediatype === "image" ? _c("pwImage", { attrs: { "src": ((_c2 = (_b = (_a = block.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) == null ? void 0 : _c2.url) || "", "srcset": ((_g = (_f = (_e = (_d = block.content) == null ? void 0 : _d.image) == null ? void 0 : _e[0]) == null ? void 0 : _f.image) == null ? void 0 : _g.srcset) || "", "size": block.content.mediasize, "alignment": block.content.mediaalignment || _vm.fieldDefaults["align-media-" + _vm.side], "image": ((_i = (_h = block.content) == null ? void 0 : _h.image) == null ? void 0 : _i[0]) || null } }) : _vm._e(), block.content.mediatype === "slideshow" ? _c("pwImage", { attrs: { "src": ((_l = (_k = (_j = block.content) == null ? void 0 : _j.images) == null ? void 0 : _k[0]) == null ? void 0 : _l.url) || "", "srcset": ((_p = (_o = (_n = (_m = block.content) == null ? void 0 : _m.images) == null ? void 0 : _n[0]) == null ? void 0 : _o.images) == null ? void 0 : _p.srcset) || "", "count": Array.isArray(block.content.images) ? block.content.images.length : 0, "size": block.content.mediasize, "alignment": block.content.mediaalignment || _vm.fieldDefaults["align-media-" + _vm.side], "image": ((_r = (_q = block.content) == null ? void 0 : _q.images) == null ? void 0 : _r[0]) || null } }) : _vm._e(), block.content.mediatype === "video" ? _c("pwVideo", { attrs: { "url": block.content.videourl, "source": block.content.videosource, "size": block.content.mediasize, "alignment": block.content.mediaalignment || _vm.fieldDefaults["align-media-" + _vm.side], "video": ((_t = (_s = block.content) == null ? void 0 : _s.video) == null ? void 0 : _t[0]) || null } }) : _vm._e()], 1) : _vm._e()], 1);
    }), 0) : _vm._e()]);
  };
  var _sfc_staticRenderFns$5 = [];
  _sfc_render$5._withStripped = true;
  var __component__$5 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$5,
    _sfc_render$5,
    _sfc_staticRenderFns$5,
    false,
    null,
    null
  );
  __component__$5.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/components/column.vue";
  const pwColumn = __component__$5.exports;
  const _sfc_main$4 = {
    components: {
      pwBlockinfo,
      pwColumn
    },
    mixins: [pwGridStyle, pwColorStyle],
    data() {
      return {
        settings: {},
        fieldDefaults: null
      };
    },
    computed: {
      leftBlocks() {
        return this.content.blocksleft || [];
      },
      rightBlocks() {
        return this.content.blocksright || [];
      }
    },
    async created() {
      try {
        const response = await this.$api.get("pagewizard/settings/pwmulticolumn");
        this.settings = response.settings;
        this.fieldDefaults = response.fields || {};
      } catch (e) {
        this.settings = {};
        this.fieldDefaults = {};
      }
    }
  };
  var _sfc_render$4 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", style: _vm.colorVars, attrs: { "data-kirbyblock": "multicolumn", "data-margintop": _vm.content.margintop === true ? "true" : null, "data-marginbottom": _vm.content.marginbottom === true ? "true" : null }, on: { "dblclick": _vm.open } }, [_c("pwBlockinfo", { attrs: { "value": _vm.$t("kirbyblock-multicolumn.name"), "icon": "layout-columns" } }), _c("div", { staticClass: "pwGrid" }, [_c("div", { staticClass: "pwGridItem", style: _vm.gridVars, attrs: { "data-paddingtop": _vm.content.paddingtop === true ? "true" : null, "data-paddingright": _vm.content.paddingright === true ? "true" : null, "data-paddingbottom": _vm.content.paddingbottom === true ? "true" : null, "data-paddingleft": _vm.content.paddingleft === true ? "true" : null } }, [_vm.fieldDefaults !== null ? _c("div", { staticClass: "pwColumns", attrs: { "data-dist-sm": _vm.content.distributionsm || null, "data-dist-md": _vm.content.distributionmd || null, "data-dist-lg": _vm.content.distributionlg || null, "data-dist-xl": _vm.content.distributionxl || null } }, [_c("pwColumn", { attrs: { "side": "left", "blocks": _vm.leftBlocks, "vertical": _vm.content.leftpositionvertical, "fieldDefaults": _vm.fieldDefaults } }), _c("pwColumn", { attrs: { "side": "right", "blocks": _vm.rightBlocks, "vertical": _vm.content.rightpositionvertical, "fieldDefaults": _vm.fieldDefaults } })], 1) : _vm._e()])])], 1);
  };
  var _sfc_staticRenderFns$4 = [];
  _sfc_render$4._withStripped = true;
  var __component__$4 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$4,
    _sfc_render$4,
    _sfc_staticRenderFns$4,
    false,
    null,
    null
  );
  __component__$4.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/index.vue";
  const pwmulticolumn = __component__$4.exports;
  const subBlockSide = {
    data() {
      return { subFieldDefaults: null, subSide: "left" };
    },
    mounted() {
      var _a;
      let node = (_a = this.$el) == null ? void 0 : _a.parentElement;
      while (node) {
        if (/multicolumn\w+right/.test(node.className || "")) {
          this.subSide = "right";
          break;
        }
        node = node.parentElement;
      }
    },
    async created() {
      try {
        const r = await this.$api.get("pagewizard/settings/pwmulticolumn");
        this.subFieldDefaults = r.fields || {};
      } catch (e) {
        this.subFieldDefaults = {};
      }
    }
  };
  const _sfc_main$3 = {
    components: { pwHeading },
    mixins: [subBlockSide]
  };
  var _sfc_render$3 = function render() {
    var _a, _b;
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("pwHeading", { attrs: { "content": _vm.content, "alignDefault": ((_a = _vm.subFieldDefaults) == null ? void 0 : _a["align-headline-" + _vm.subSide]) || "left", "sizeDefault": ((_b = _vm.subFieldDefaults) == null ? void 0 : _b["size-headline-" + _vm.subSide]) || null } })], 1);
  };
  var _sfc_staticRenderFns$3 = [];
  _sfc_render$3._withStripped = true;
  var __component__$3 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$3,
    _sfc_render$3,
    _sfc_staticRenderFns$3,
    false,
    null,
    null
  );
  __component__$3.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/sub-headline.vue";
  const pwmulticolumnHeadline = __component__$3.exports;
  const _sfc_main$2 = {
    components: { pwWriter },
    mixins: [subBlockSide],
    computed: {
      parsedContent() {
        var _a;
        const raw = this.content.editor;
        const alignDefault = ((_a = this.subFieldDefaults) == null ? void 0 : _a["align-text-" + this.subSide]) || "left";
        if (!raw) return { value: "", align: alignDefault };
        try {
          const d = JSON.parse(raw);
          const value = d.mode ? d[d.mode] || "" : d.writer || d.textarea || d.markdown || "";
          return { value, align: d.align || alignDefault };
        } catch (e) {
          return { value: raw, align: alignDefault };
        }
      }
    }
  };
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("pwWriter", _vm._b({}, "pwWriter", _vm.parsedContent, false))], 1);
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    null
  );
  __component__$2.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/sub-text.vue";
  const pwmulticolumnText = __component__$2.exports;
  const _sfc_main$1 = {
    components: { pwQuote },
    mixins: [subBlockSide]
  };
  var _sfc_render$1 = function render() {
    var _a, _b;
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_c("pwQuote", { attrs: { "quote": _vm.content.quote, "author": _vm.content.author, "alignQuoteDefault": ((_a = _vm.subFieldDefaults) == null ? void 0 : _a["align-quote-" + _vm.subSide]) || "left", "alignAuthorDefault": ((_b = _vm.subFieldDefaults) == null ? void 0 : _b["align-author-" + _vm.subSide]) || "left" } })], 1);
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1,
    false,
    null,
    null
  );
  __component__$1.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/sub-quote.vue";
  const pwmulticolumnQuote = __component__$1.exports;
  const _sfc_main = {
    components: { pwImage, pwVideo },
    mixins: [subBlockSide],
    computed: {
      mediaAlignDefault() {
        var _a;
        return ((_a = this.subFieldDefaults) == null ? void 0 : _a["align-media-" + this.subSide]) || "left";
      }
    }
  };
  var _sfc_render = function render() {
    var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j, _k, _l, _m, _n, _o, _p, _q, _r, _s, _t, _u, _v, _w, _x, _y, _z, _A, _B;
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", on: { "dblclick": _vm.open } }, [_vm.content.mediatype === "image" && ((_c2 = (_b = (_a = _vm.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) == null ? void 0 : _c2.url) ? _c("pwImage", { attrs: { "src": ((_f = (_e = (_d = _vm.content) == null ? void 0 : _d.image) == null ? void 0 : _e[0]) == null ? void 0 : _f.url) || "", "srcset": ((_j = (_i = (_h = (_g = _vm.content) == null ? void 0 : _g.image) == null ? void 0 : _h[0]) == null ? void 0 : _i.image) == null ? void 0 : _j.srcset) || "", "size": _vm.content.mediasize, "alignment": _vm.content.mediaalignment || _vm.mediaAlignDefault, "image": ((_l = (_k = _vm.content) == null ? void 0 : _k.image) == null ? void 0 : _l[0]) || null } }) : _vm.content.mediatype === "slideshow" && ((_o = (_n = (_m = _vm.content) == null ? void 0 : _m.images) == null ? void 0 : _n[0]) == null ? void 0 : _o.url) ? _c("pwImage", { attrs: { "src": ((_r = (_q = (_p = _vm.content) == null ? void 0 : _p.images) == null ? void 0 : _q[0]) == null ? void 0 : _r.url) || "", "srcset": ((_v = (_u = (_t = (_s = _vm.content) == null ? void 0 : _s.images) == null ? void 0 : _t[0]) == null ? void 0 : _u.image) == null ? void 0 : _v.srcset) || "", "count": Array.isArray(_vm.content.images) ? _vm.content.images.length : 0, "size": _vm.content.mediasize, "alignment": _vm.content.mediaalignment || _vm.mediaAlignDefault, "image": ((_x = (_w = _vm.content) == null ? void 0 : _w.images) == null ? void 0 : _x[0]) || null } }) : _vm.content.mediatype === "video" && (_vm.content.videourl || ((_z = (_y = _vm.content) == null ? void 0 : _y.video) == null ? void 0 : _z[0])) ? _c("pwVideo", { attrs: { "url": _vm.content.videourl, "source": _vm.content.videosource, "size": _vm.content.mediasize, "alignment": _vm.content.mediaalignment || _vm.mediaAlignDefault, "video": ((_B = (_A = _vm.content) == null ? void 0 : _A.video) == null ? void 0 : _B[0]) || null } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(_vm._s(_vm.$t("pw.field.media-upload.help")))])], 1);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns,
    false,
    null,
    null
  );
  __component__.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/sub-media.vue";
  const pwmulticolumnMedia = __component__.exports;
  panel.plugin("kirbydesk/kirbyblock-multicolumn", {
    blocks: {
      pwmulticolumn,
      multicolumnheadlineleft: pwmulticolumnHeadline,
      multicolumnheadlineright: pwmulticolumnHeadline,
      multicolumntextleft: pwmulticolumnText,
      multicolumntextright: pwmulticolumnText,
      multicolumnquoteleft: pwmulticolumnQuote,
      multicolumnquoteright: pwmulticolumnQuote,
      multicolumnmedialeft: pwmulticolumnMedia,
      multicolumnmediaright: pwmulticolumnMedia
    }
  });
})();
