<template>
    <modal>
        <template #title>{{ vacancy ? "Edit" : "Add" }} Vacancy</template>

        <v-form :form="form">
            <div class="row">
                <form-group class="col-12"
                            name="title">
                    <template #label>Title</template>
                    <v-input></v-input>
                </form-group>
                <form-group class="col-12"
                            name="location">
                    <template #label>Location</template>
                    <v-input></v-input>
                </form-group>
                <form-group class="col-6"
                            name="salary_from">
                    <template #label>Salary From</template>
                    <v-input type="number"></v-input>
                </form-group>
                <form-group class="col-6"
                            name="salary_to">
                    <template #label>Salary To</template>
                    <v-input type="number"></v-input>
                </form-group>
                <form-group class="col-12"
                            name="description">
                    <template #label>Description</template>
                    <v-textarea rows="3"></v-textarea>
                </form-group>
            </div>
        </v-form>

        <template #footer>
            <button @click.prevent="hide()" class="btn btn-default">Cancel</button>
            <button @click.prevent="submit()" class="btn btn-primary">{{ vacancy ? "Edit" : "Add" }} Vacancy</button>
        </template>
    </modal>
</template>

<script>
import modalMixin from "../../mixins/modalMixin";
import Form from "../../core/Form";
import FormGroup from "../utils/form/FormGroup";
import VInput from "../utils/form/VInput";
import VTextarea from "../utils/form/VTextarea";
import VForm from "../utils/form/VForm";

export default {
    name: "vacancy-modal",
    components: {VForm, VTextarea, VInput, FormGroup},
    mixins: [modalMixin],
    data() {
        return {
            vacancy: null,
            form: new Form()
        }
    },
    methods: {
        onOpen(model) {
            this.vacancy = model;
            this.form = new Form(model);
        },
        submit() {
            if (this.vacancy) return this.updateVacancy();
            return this.storeVacancy();
        },
        // Store new vacancy
        storeVacancy() {
            this.form.post('/api/vacancies')
                .then(response => {
                    this.$emit("added", response.data);
                    this.hide();
                });
        },
        // Update vacancy
        updateVacancy() {
            this.form.put('/api/vacancies/' + this.vacancy.id)
                .then(response => {
                    this.$emit("updated", response.data);
                    this.hide();
                });
        }
    }
}
</script>
