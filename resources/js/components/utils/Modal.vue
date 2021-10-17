<template>
    <div class="modal fade">
        <div class="modal-dialog modal-center">
            <form class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <slot name="title"></slot>
                    </h4>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer" v-if="$slots.footer">
                    <slot name="footer"></slot>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Modal from 'bootstrap/js/src/modal'

export default {
    name: "modal",
    data() {
        return {
            instance: null
        }
    },
    mounted() {
        this.instance = new Modal(this.$el);
    },
    methods: {
        open(data) {
            this.instance.show();
            this.$parent.onOpen(data);
        }
    }
}
</script>
