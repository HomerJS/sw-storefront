import AjaxLoadPlugin from './example-plugin/example-plugin.plugin';
window.PluginManager.register('AjaxLoadPlugin', AjaxLoadPlugin, '[data-ajax-helper]');


//import
// import FirstPlugin from './first-plugin/first-plugin.plugin';
// window.PluginManager.register('FirstPlugin', FirstPlugin, '[test-div]');

//async import
window.PluginManager.register('FirstPlugin', () => import('./first-plugin/first-plugin.plugin'), '[test-div]');

window.PluginManager.override('CookiePermission', () => import('./my-cookie-permission/my-cookie-permission.plugin'), '[data-cookie-permission]');