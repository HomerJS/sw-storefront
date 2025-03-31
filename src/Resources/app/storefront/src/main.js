import AjaxLoadPlugin from './example-plugin/example-plugin.plugin';
import FirstPlugin from './first-plugin/first-plugin.plugin';

window.PluginManager.register('AjaxLoadPlugin', AjaxLoadPlugin, '[data-ajax-helper]');

//import
// window.PluginManager.register('FirstPlugin', FirstPlugin, '[test-div]');

//async import
window.PluginManager.register('FirstPlugin', () => import('./first-plugin/first-plugin.plugin'), '[test-div]');