const { PluginBaseClass } = window;

export default class AjaxLoadPlugin extends PluginBaseClass {
    init() {
        this.button = this.el.children['ajax-button'];
        this.textdiv = this.el.children['ajax-display'];

        this._registerEvents();
    }

    _registerEvents() {
        // fetch the timestamp, when the button is clicked
        this.button.onclick = this._fetch.bind(this);
    }

    async _fetch() {
        const response = await fetch('/ajax');
        const data = await response.json();
        this.textdiv.innerHTML = data.timestamp;
    }
}