<template>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ vacancy.title }}</h5>

            <div class="row pt-4">
                <div class="col-3">
                    <i class="ri-map-pin-line"></i> {{ vacancy.location }}
                </div>
                <div class="col-3">
                    <i class="ri-money-dollar-circle-line"></i>
                    <span v-if="vacancy.salary_from">
                        {{ vacancy.salary_from | currency }} - {{ vacancy.salary_to | currency }}
                    </span>
                    <span class="text-secondary" v-else>Not Disclosed</span>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-12 text-secondary">
                    {{ vacancy.description }}
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    <button type="button" class="btn btn-primary" v-modal:vacancy="vacancy">Update Vacancy</button>
                    <button type="button" class="btn btn-danger" v-modal:confirm="vacancy">Remove Vacancy</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VacancyCard",
    props: {
        vacancy: {
            required: true
        }
    }
}
</script>
