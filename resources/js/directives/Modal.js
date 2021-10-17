import 'bootstrap/js/src/modal';

const bsModal = (el, binding, vNode) => {
    vNode.context.$nextTick(() => {
        let type = 'click',
            ref = binding.arg,
            modal = vNode.context.$root.modals.find((m) => (m.name === ref || m.$options.name === ref  + "-modal"));

        if(typeof modal !== 'undefined') {
            el.addEventListener(type, (e) => {
                e.preventDefault();
                modal.$children[0].open(binding.value);
            }, false);
        }


    },);
};

let Modal = {
    bind: bsModal,
    update: bsModal,
};
export default Modal;
