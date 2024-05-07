/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**************************************!*\
  !*** ./assets/js/gutenberg-block.js ***!
  \**************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

const {
  registerBlockType
} = wp.blocks;
const {
  useState,
  useEffect
} = wp.element;
const {
  ToggleControl,
  PanelBody,
  PanelRow
} = wp.components;
const {
  InspectorControls
} = wp.blockEditor;
const {
  __
} = wp.i18n;
registerBlockType('rajan-vijayan/my-block', {
  title: __('My Block', 'rajan-vijayan'),
  icon: 'admin-site',
  category: 'common',
  edit: ({
    className,
    attributes,
    setAttributes
  }) => {
    const [data, setData] = useState(attributes.data);
    const [columnVisibility, setColumnVisibility] = useState(attributes.columnVisibility);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    useEffect(() => {
      fetchData();
    }, []);
    const fetchData = () => {
      jQuery.ajax({
        url: myplugin_ajax_object.ajax_url,
        type: 'GET',
        data: {
          action: 'my_plugin_fetch_data',
          // AJAX action hook
          nonce: myplugin_ajax_object.security // Nonce for security
        },
        success: function (response) {
          console.log(response);
          setLoading(false);
          setData(response.data);
          setError(null);
        },
        error: function (xhr, status, error) {
          setLoading(false);
          setError(xhr.responseText || error);
        }
      });
    };
    const toggleColumnVisibility = columnName => {
      const newState = {
        ...columnVisibility,
        [columnName]: !columnVisibility[columnName]
      };
      setColumnVisibility(newState);
      // Update the block's attributes with the new columnVisibility state
      setAttributes({
        columnVisibility: newState
      });
    };
    if (loading) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: className
      }, __('Loading...', 'miusage-plugin'));
    }
    if (error) {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: className
      }, __('Error: Unable to fetch data', 'miusage-plugin'));
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: className
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelBody, {
      title: "Toggle"
    }, Object.keys(columnVisibility).map(columnName => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(PanelRow, {
      key: `panel_${columnName}`
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
      label: columnName,
      checked: columnVisibility[columnName],
      onChange: () => toggleColumnVisibility(columnName)
    }))))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "miusage-table-wrapper",
      dangerouslySetInnerHTML: {
        __html: generateTableHTML(data, columnVisibility)
      }
    }));
  },
  save: () => {
    return null; // Save function is not used as the table is generated dynamically in the frontend
  },
  attributes: {
    data: {
      type: 'object',
      default: null
    },
    columnVisibility: {
      type: 'object',
      default: {
        id: true,
        fname: true,
        lname: true,
        email: true,
        date: true
      }
    }
  }
});
const generateTableHTML = (data, columnVisibility) => {
  if (!data) {
    return 'Empty'; // Return empty string if data is not available
  }

  // Generate HTML markup for the table
  let tableHTML = `
        <table class="miusage-table">
            <thead>
                <tr>
                    ${Object.keys(data.data.headers).map(header => columnVisibility[header] ? `<th>${data.headers[header]}</th>` : '').join('')}
                </tr>
            </thead>
            <tbody>
                ${Object.values(data.data.rows).map(row => `
                    <tr>
                        ${Object.keys(row).map(columnName => columnVisibility[columnName] ? `<td>${row[columnName]}</td>` : '').join('')}
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
  return tableHTML;
};
})();

/******/ })()
;
//# sourceMappingURL=gutenberg-block.js.map