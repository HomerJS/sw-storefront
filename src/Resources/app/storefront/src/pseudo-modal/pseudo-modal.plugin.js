const { PluginBaseClass } = window;
import PseudoModalUtil from 'src/utility/modal-extension/pseudo-modal.util';

export default class PseudoModalPlugin extends PluginBaseClass {
    init() {
        // declaring some basic content
        const content = `
            <div class="js-pseudo-modal-template">
                <div class="js-pseudo-modal-template-title-element">Modal title</div>
                <div class="js-pseudo-modal-template-content-element">Modal content</div>
            </div>
        `;

        this.openModal(content);

        const updatedContent = `
            <div class="js-pseudo-modal-template">
                <div class="js-pseudo-modal-template-title-element">Modal title</div>
                <div class="js-pseudo-modal-template-content-element">Updated content</div>
            </div>
        `;

        this.modal.updateContent(updatedContent, this.onUpdateModal.bind(this));
    }

    openModal(content) {
        const useBackrop = false;

        // create a new modal instance
        this.modal = new PseudoModalUtil(content, useBackrop);

        // open the modal window and fire a callback function

        this.modal.open(this.onOpenModal.bind(this));
    }

    onOpenModal() {
        console.log('the modal is opened');
    }

    onUpdateModal() {
        console.log('the modal was updated');
    }
}