import Modal from "../components/utils/Modal";

export default {
    components: {
        Modal
    },
    props: ['name'],
    created() {
        this.$root.modals.push(this);
    },
    methods: {
        onOpen(model) {},
        hide() {
            this.$children[0].instance.hide();
        }
    }
}
