<template>
    <input class="form-control"
           :class="[errorClass()]"
           :name="$parent.name"
           :id="$parent.name"
           :value="inputValue()"
           @input="onInput($event.target.value)"
    />
</template>

<script>
import mixin from "./mixin";

export default {
    name: "v-input",
    mixins: [mixin],
}
</script>
