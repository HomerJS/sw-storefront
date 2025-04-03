const { PluginBaseClass } = window;

export default class FirstPlugin extends PluginBaseClass {
    static options = {
        text: ' NEW NEW NEW Seems like there\'s nothing more to see here.',
    };

    init() {
        window.addEventListener('scroll', this.onScroll.bind(this));
        this.fetchData();
    }

    onScroll() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            // alert(this.options.text);
        }
    }

    async fetchData() {
        const response = await fetch('/ajax');
        const data = await response.text();

        console.log(data);
    }
}