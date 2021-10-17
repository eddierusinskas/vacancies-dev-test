<template>
    <div class="form-group" :class="[hasError ? 'error' : '']">
        <label :for="name" class="form-control-label" v-if="hasLabelSlot">
            <slot name="label"></slot>
        </label>

        <slot></slot>

        <div class="invalid-feedback d-block" v-if="hasError" v-html="getError"></div>
    </div>
</template>

<script>
export default {
    name: "form-group",
    props: {
        name: {
            type: String
        },
        error: {
            type: String
        },
        readonly: {
            type: Boolean,
            default: false
        },
    },
    computed: {
        form() {
            return this.$parent.form;
        },
        hasLabelSlot() {
            return !!this.$slots.label;
        },
        hasError() {
            if(this.form && this.form.errors.has(this.name))
                return true;
            else if(this.error)
                return true;
            return false;
        },
        getError() {
            if(this.form && this.form.errors.has(this.name))
                return this.form.errors.get(this.name);
            else if(this.error)
                return this.error;
            return null;
        }
    },
}
</script>
