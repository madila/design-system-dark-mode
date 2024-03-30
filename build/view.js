import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity":
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
/***/ ((module) => {

var x = (y) => {
	var x = {}; __webpack_require__.d(x, y); return x
} 
var y = (x) => (() => (x))
module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ })

/******/ });
/************************************************************************/
/******/ // The module cache
/******/ var __webpack_module_cache__ = {};
/******/ 
/******/ // The require function
/******/ function __webpack_require__(moduleId) {
/******/ 	// Check if module is in cache
/******/ 	var cachedModule = __webpack_module_cache__[moduleId];
/******/ 	if (cachedModule !== undefined) {
/******/ 		return cachedModule.exports;
/******/ 	}
/******/ 	// Create a new module (and put it into the cache)
/******/ 	var module = __webpack_module_cache__[moduleId] = {
/******/ 		// no module.id needed
/******/ 		// no module.loaded needed
/******/ 		exports: {}
/******/ 	};
/******/ 
/******/ 	// Execute the module function
/******/ 	__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 
/******/ 	// Return the exports of the module
/******/ 	return module.exports;
/******/ }
/******/ 
/************************************************************************/
/******/ /* webpack/runtime/make namespace object */
/******/ (() => {
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ })();
/******/ 
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*********************!*\
  !*** ./src/view.js ***!
  \*********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");
/**
 * WordPress dependencies
 *
 *
 */

const {
  state,
  actions
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('dark-mode', {
  state: {
    isDark: false,
    scrolled: false,
    get label() {
      const {
        isDark
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      return `Switch to ${isDark ? 'light' : 'dark'} mode`;
    },
    get prefersDarkMode() {
      return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    },
    get scheme() {
      return state.isDark ? 'dark' : 'light';
    }
  },
  actions: {
    toggle: () => {
      state.isDark = !state.isDark;
      localStorage.setItem("design-system-dark-mode--scheme", state.scheme);
    },
    bodyScrolled: e => {
      const isScrolled = window.scrollY > 0;
      if (state.scrolled !== isScrolled) {
        state.scrolled = isScrolled;
        e.target.documentElement.classList.toggle('scrolled', isScrolled);
      }
    },
    initScheme: () => {
      const hasPreference = localStorage.getItem("design-system-dark-mode--scheme");
      if (state.prefersDarkMode || hasPreference && hasPreference !== state.scheme) {
        state.isDark = hasPreference === 'dark' || state.prefersDarkMode && !hasPreference;
      }
    }
  },
  callbacks: {
    updateScheme: () => {
      document.documentElement.dataset.scheme = state.isDark ? 'dark' : 'light';
    }
  }
});
})();


//# sourceMappingURL=view.js.map