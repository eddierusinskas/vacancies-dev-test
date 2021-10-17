<template>
    <modal>
        <template #title>Confirm</template>

        <slot></slot>

        <template #footer>
            <button @click.prevent="hide()" class="btn btn-default">Cancel</button>
            <button @click.prevent="submit()" class="btn btn-primary">Confirm</button>
        </template>
    </modal>
</template>

<script>
import modalMixin from "../../mixins/modalMixin";

export default {
    name: "confirm-modal",
    mixins: [modalMixin],
    data() {
        return {
            model: null
        }
    },
    methods: {
        onOpen(model) {
            this.model = model;
        },
        submit() {
            this.hide();
            this.$emit('submit', this.model);
        }
    }
}
</script>
