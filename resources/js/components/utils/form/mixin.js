import _ from "lodash";

export default {
    props: {
        value: {
            required: false
        },
        isInvalid: {
            type: Boolean,
            default: false
        },
        readonly: {
            type: Boolean,
        },
        debounce: Number
    },
    computed: {
        form() {
            return this.$parent.form;
        },
        name() {
            return this.$parent.name;
        },
        isReadOnly() {
            if(typeof this.readonly !== 'undefined')
                return this.readonly;
            return this.$parent.readonly;
        }
    },
    mounted() {
        if (typeof this.value !== 'undefined') {
            this.$watch('value', this.onValueChanged);
        }
        if (this.form) {
            this.$watch('form.data.' + this.$parent.name, this.onValueChanged);
        }
    },
    methods: {
        inputValue() {
            if(this.value) {
                return this.value;
            } else if (this.form) {
                return this.form.data[this.$parent.name];
            }
            return null;
        },
        onInput: _.debounce(function (value) {
            if (this.form) {
                this.form.data[this.$parent.name] = value;
                this.updateErrorClass();
            }
            this.$emit('input', value);
        }, 300),
        errorClass() {
            if (
                (this.form && this.form.errors.has(this.$parent.name)) ||
                this.isInvalid
            ) {
                return 'error';
            }
            return '';
        },
        updateErrorClass() {
            if (this.form && this.form.errors.has(this.$parent.name)) {
                this.form.errors.clear(this.$parent.name);
                this.$parent.$forceUpdate();
                this.$forceUpdate();
            }
        },
        onValueChanged() {
        }
    }
}
