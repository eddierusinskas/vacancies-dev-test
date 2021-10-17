<template>
  <textarea class="form-control"
            :class="[errorClass()]"
            :name="$parent.name"
            :id="$parent.name"
            @input="onInput($event.target.value)"
  >{{ inputValue() }}</textarea>
</template>

<script>
import mixin from "./mixin";

export default {
    name: "v-textarea",
    mixins: [mixin],
}
</script>
