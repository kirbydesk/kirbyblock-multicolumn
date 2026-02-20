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
  const _sfc_main$5 = {
    props: {
      value: String,
      icon: String,
      layout: String
    }
  };
  var _sfc_render$5 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "blockinfo" }, [_c("div", [_c("svg", { staticClass: "k-icon", attrs: { "aria-hidden": "true" } }, [_c("use", { attrs: { "xlink:href": "#icon-" + _vm.icon } })]), _vm._v(" " + _vm._s(_vm.value) + " "), _vm.layout ? _c("span", [_vm._v("(" + _vm._s(_vm.layout) + ")")]) : _vm._e()])]);
  };
  var _sfc_staticRenderFns$5 = [];
  _sfc_render$5._withStripped = true;
  var __component__$5 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$5,
    _sfc_render$5,
    _sfc_staticRenderFns$5,
    false,
    null,
    "26526d24"
  );
  __component__$5.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/blockinfo.vue";
  const pwBlockinfo = __component__$5.exports;
  const pwGridStyle = {
    computed: {
      gridVars() {
        return {
          "--grid-start-sm": Number(this.content.gridoffsetsm),
          "--grid-span-sm": Number(this.content.gridsizesm),
          "--grid-start-md": Number(this.content.gridoffsetmd),
          "--grid-span-md": Number(this.content.gridsizemd),
          "--grid-start-lg": Number(this.content.gridoffsetlg),
          "--grid-span-lg": Number(this.content.gridsizelg),
          "--grid-start-xl": Number(this.content.gridoffsetxl),
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
        const style = this.content.style || "default";
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
  const _sfc_main$4 = {
    props: {
      value: String,
      align: { type: String, default: "left" }
    }
  };
  var _sfc_render$4 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwtext", attrs: { "data-align": _vm.align } }, [_vm.value ? _c("div", { domProps: { "innerHTML": _vm._s(_vm.value) } }) : _c("div", { staticClass: "placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-writer.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$4 = [];
  _sfc_render$4._withStripped = true;
  var __component__$4 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$4,
    _sfc_render$4,
    _sfc_staticRenderFns$4,
    false,
    null,
    "fa3feda4"
  );
  __component__$4.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/writer.vue";
  const pwWriter = __component__$4.exports;
  const _sfc_main$3 = {
    props: {
      quote: String,
      author: String
    },
    computed: {
      parsedQuoteData() {
        const val = this.quote;
        if (!val) return { text: "", align: "left" };
        try {
          return typeof val === "string" ? JSON.parse(val) : val;
        } catch (e) {
          return { text: val, align: "left" };
        }
      },
      parsedAuthorData() {
        const val = this.author;
        if (!val) return { text: "" };
        try {
          return typeof val === "string" ? JSON.parse(val) : val;
        } catch (e) {
          return { text: val };
        }
      },
      quoteText() {
        const { text = "" } = this.parsedQuoteData;
        return text;
      },
      authorText() {
        const { text = "" } = this.parsedAuthorData;
        return text;
      },
      quoteAlign() {
        const { align = "left" } = this.parsedQuoteData;
        return align;
      },
      authorAlign() {
        const { align = "left" } = this.parsedAuthorData;
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
  var _sfc_render$3 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwquote" }, [_vm.quoteText ? _c("div", { staticClass: "quote", attrs: { "data-align": _vm.quoteAlign }, domProps: { "innerHTML": _vm._s(_vm.nl2br(_vm.quoteText)) } }) : _c("div", { staticClass: "quote placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.text-quote.placeholder")) + " ")]), _vm.authorText ? _c("div", { staticClass: "author", attrs: { "data-align": _vm.authorAlign } }, [_vm._v(_vm._s(_vm.authorText))]) : _c("div", { staticClass: "author placeholder" }, [_vm._v(" " + _vm._s(_vm.$t("pw.field.author.placeholder")) + " ")])]);
  };
  var _sfc_staticRenderFns$3 = [];
  _sfc_render$3._withStripped = true;
  var __component__$3 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$3,
    _sfc_render$3,
    _sfc_staticRenderFns$3,
    false,
    null,
    "90325663"
  );
  __component__$3.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/quote.vue";
  const pwQuote = __component__$3.exports;
  const _sfc_main$2 = {
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
        return ((_a = this.imageContent) == null ? void 0 : _a.imageratio) || "1/1";
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
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.src.length ? _c("div", { staticClass: "wrap", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "image" }, [_c("div", { staticClass: "pattern", class: _vm.size }, [_c("figure", { staticClass: "k-frame k-image-frame k-image", class: { "zoom": _vm.computedZoom }, style: {
      "--fit": _vm.computedCrop ? "cover" : "contain",
      "--ratio": _vm.computedRatio
    } }, [_c("img", { attrs: { "src": _vm.src, "srcset": _vm.srcset } }), _c("div", [_c("k-icon", { attrs: { "type": "search" } })], 1)])])]), _vm.count > 1 ? _c("div", { staticClass: "controls" }, [_c("div", { staticClass: "dots", class: _vm.size }, _vm._l(_vm.count, function(n) {
      return _c("span", { key: n, staticClass: "dot" });
    }), 0)]) : _vm._e()]) : _vm._e();
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2,
    false,
    null,
    "3063e108"
  );
  __component__$2.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/image.vue";
  const pwImage = __component__$2.exports;
  const _sfc_main$1 = {
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
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _vm.url || _vm.videoUrl ? _c("div", { staticClass: "video", attrs: { "data-align": _vm.alignment } }, [_c("div", { staticClass: "pattern", class: _vm.size }, [_vm.source == "internal" ? _c("k-frame", { attrs: { "ratio": _vm.computedRatio } }, [_c("video", { attrs: { "src": _vm.videoUrl, "controls": "" } })]) : _vm.source == "external" ? _c("k-frame", { staticClass: "external", attrs: { "ratio": "16/9" } }, [_c("iframe", { attrs: { "src": _vm.getEmbedUrl(_vm.url), "allow": "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share", "referrerpolicy": "origin", "allowfullscreen": "" } })]) : _vm._e()], 1)]) : _vm._e();
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1,
    false,
    null,
    "301ff5b5"
  );
  __component__$1.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirby-pagewizard/src/components/video.vue";
  const pwVideo = __component__$1.exports;
  const _sfc_main = {
    components: {
      pwBlockinfo,
      pwWriter,
      pwQuote,
      pwImage,
      pwVideo
    },
    mixins: [pwGridStyle, pwColorStyle],
    data() {
      return {
        settings: {}
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
    methods: {},
    async created() {
      try {
        const response = await this.$api.get("pagewizard/settings/pwmulticolumn");
        this.settings = response.settings;
      } catch (e) {
        this.settings = {};
      }
    }
  };
  var _sfc_render = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("div", { staticClass: "pwPreview", style: _vm.colorVars, attrs: { "data-kirbyblock": "multicolumn", "data-margintop": _vm.content.margintop === true ? "true" : null, "data-marginbottom": _vm.content.marginbottom === true ? "true" : null }, on: { "dblclick": _vm.open } }, [_c("pwBlockinfo", { attrs: { "value": _vm.$t("kirbyblock-multicolumn.name"), "icon": "layout-columns" } }), _c("div", { staticClass: "pwGrid" }, [_c("div", { staticClass: "pwGridItem", style: _vm.gridVars, attrs: { "data-paddingtop": _vm.content.paddingtop === true ? "true" : null, "data-paddingright": _vm.content.paddingright === true ? "true" : null, "data-paddingbottom": _vm.content.paddingbottom === true ? "true" : null, "data-paddingleft": _vm.content.paddingleft === true ? "true" : null } }, [_c("div", { staticClass: "pwColumns", class: _vm.content.distribution }, [_c("div", { staticClass: "pwColumn left", attrs: { "data-horizontal": _vm.content.leftpositionhorizontal, "data-vertical": _vm.content.leftpositionvertical } }, [_vm.leftBlocks.length ? _c("div", _vm._l(_vm.leftBlocks, function(block, i) {
      var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j, _k, _l, _m, _n, _o, _p, _q, _r, _s, _t;
      return _c("div", { key: i }, [_vm._v(" " + _vm._s(block.ishidden) + " "), block.type === "multicolumntext" ? _c("pwWriter", { class: { "ishidden": block.content.isHidden }, attrs: { "debug": block, "value": block.content.text, "align": block.content.alignment } }) : _vm._e(), block.type === "multicolumnquote" ? _c("pwQuote", { attrs: { "quote": block.content.quote, "author": block.content.author } }) : _vm._e(), block.type === "multicolumnmedia" ? _c("div", [block.content.mediatype === "image" ? _c("pwImage", { attrs: { "src": ((_c2 = (_b = (_a = block.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) == null ? void 0 : _c2.url) || "", "srcset": ((_g = (_f = (_e = (_d = block.content) == null ? void 0 : _d.image) == null ? void 0 : _e[0]) == null ? void 0 : _f.image) == null ? void 0 : _g.srcset) || "", "size": block.content.mediasize, "alignment": block.content.mediaalignment, "image": ((_i = (_h = block.content) == null ? void 0 : _h.image) == null ? void 0 : _i[0]) || null } }) : _vm._e(), block.content.mediatype === "slideshow" ? _c("pwImage", { attrs: { "src": ((_l = (_k = (_j = block.content) == null ? void 0 : _j.images) == null ? void 0 : _k[0]) == null ? void 0 : _l.url) || "", "srcset": ((_p = (_o = (_n = (_m = block.content) == null ? void 0 : _m.images) == null ? void 0 : _n[0]) == null ? void 0 : _o.images) == null ? void 0 : _p.srcset) || "", "count": Array.isArray(block.content.images) ? block.content.images.length : 0, "size": block.content.mediasize, "alignment": block.content.mediaalignment, "image": ((_r = (_q = _vm.content) == null ? void 0 : _q.images) == null ? void 0 : _r[0]) || null } }) : _vm._e(), block.content.mediatype === "video" ? _c("pwVideo", { attrs: { "url": block.content.videourl, "source": block.content.videosource, "size": block.content.mediasize, "alignment": block.content.mediaalignment, "video": ((_t = (_s = block.content) == null ? void 0 : _s.video) == null ? void 0 : _t[0]) || null } }) : _vm._e()], 1) : _vm._e()], 1);
    }), 0) : _vm._e()]), _c("div", { staticClass: "pwColumn right", attrs: { "data-horizontal": _vm.content.rightpositionhorizontal, "data-vertical": _vm.content.rightpositionvertical } }, [_vm.rightBlocks.length ? _c("div", _vm._l(_vm.rightBlocks, function(block, i) {
      var _a, _b, _c2, _d, _e, _f, _g, _h, _i, _j, _k, _l, _m, _n, _o, _p, _q, _r, _s, _t;
      return _c("div", { key: i }, [block.type === "multicolumntext" ? _c("pwWriter", { attrs: { "value": block.content.text, "align": block.content.alignment } }) : _vm._e(), block.type === "multicolumnquote" ? _c("pwQuote", { attrs: { "quote": block.content.quote, "author": block.content.author } }) : _vm._e(), block.type === "multicolumnmedia" ? _c("div", [block.content.mediatype === "image" ? _c("pwImage", { attrs: { "src": ((_c2 = (_b = (_a = block.content) == null ? void 0 : _a.image) == null ? void 0 : _b[0]) == null ? void 0 : _c2.url) || "", "srcset": ((_g = (_f = (_e = (_d = block.content) == null ? void 0 : _d.image) == null ? void 0 : _e[0]) == null ? void 0 : _f.image) == null ? void 0 : _g.srcset) || "", "size": block.content.mediasize, "alignment": block.content.mediaalignment, "image": ((_i = (_h = block.content) == null ? void 0 : _h.image) == null ? void 0 : _i[0]) || null } }) : _vm._e(), block.content.mediatype === "slideshow" ? _c("pwImage", { attrs: { "src": ((_l = (_k = (_j = block.content) == null ? void 0 : _j.images) == null ? void 0 : _k[0]) == null ? void 0 : _l.url) || "", "srcset": ((_p = (_o = (_n = (_m = block.content) == null ? void 0 : _m.images) == null ? void 0 : _n[0]) == null ? void 0 : _o.images) == null ? void 0 : _p.srcset) || "", "count": Array.isArray(block.content.images) ? block.content.images.length : 0, "size": block.content.mediasize, "alignment": block.content.mediaalignment, "image": ((_r = (_q = _vm.content) == null ? void 0 : _q.images) == null ? void 0 : _r[0]) || null } }) : _vm._e(), block.content.mediatype === "video" ? _c("pwVideo", { attrs: { "url": block.content.videourl, "source": block.content.videosource, "size": block.content.mediasize, "alignment": block.content.mediaalignment, "video": ((_t = (_s = block.content) == null ? void 0 : _s.video) == null ? void 0 : _t[0]) || null } }) : _vm._e()], 1) : _vm._e()], 1);
    }), 0) : _vm._e()])])])])], 1);
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
  __component__.options.__file = "/Users/christian/Projects/kirbydesk/site/plugins/kirbyblock-multicolumn/src/blocks/index.vue";
  const pwmulticolumn = __component__.exports;
  panel.plugin("kirbydesk/kirbyblock-multicolumn", {
    blocks: {
      pwmulticolumn
    }
  });
})();
