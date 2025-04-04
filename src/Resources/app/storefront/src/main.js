import AjaxLoadPlugin from './example-plugin/example-plugin.plugin';
window.PluginManager.register('AjaxLoadPlugin', AjaxLoadPlugin, '[data-ajax-helper]');


//import
// import FirstPlugin from './first-plugin/first-plugin.plugin';
// window.PluginManager.register('FirstPlugin', FirstPlugin, '[test-div]');

//async import
window.PluginManager.register('FirstPlugin', () => import('./first-plugin/first-plugin.plugin'), '[test-div]');

window.PluginManager.override('CookiePermission', () => import('./my-cookie-permission/my-cookie-permission.plugin'), '[data-cookie-permission]');

import './reacting-cookie/reacting-cookie';

window.PluginManager.register('EventsPlugin', () => import('./events-plugin/events-plugin.plugin'));

//REMOVE JS PLUGIN
window.PluginManager.deregister('OffCanvasCart', '[data-off-canvas-cart]');


//PseudoModalPlugin
import PseudoModalPlugin from './pseudo-modal/pseudo-modal.plugin';

window.PluginManager.register('PseudoModalPlugin', PseudoModalPlugin, '[pseudo-modal]');