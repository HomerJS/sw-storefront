const { PluginBaseClass } = window;

export default class EventsPlugin extends PluginBaseClass {
    init() {
        const plugin = window.PluginManager.getPluginInstanceFromElement(document.querySelector('[data-cookie-permission]'), 'CookiePermission');

        plugin.$emitter.subscribe('hideCookieBar', this.onHideCookieBar);
    }

    onHideCookieBar() {
        console.log("The cookie bar has been hidden!");
    }
}