<template>
    <form @submit.prevent="$emit('submit')">
        <div class="alert alert-danger" role="alert" v-if="form.fatalError" v-html="form.fatalError"></div>
        <slot></slot>
    </form>
</template>

<script>
import Form from "../../../core/Form";

export default {
    name: "v-form",
    props: {
        form: {
            type: Form,
        },
    },
}
</script>
