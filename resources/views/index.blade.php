@extends('layouts.app')

@section('page')
    <vacancies-page inline-template>
        <div class="row">
            <div class="col-3">
                <h3>Filter Vacancies</h3>
                <hr>
                <h4>Keywords</h4>
                <div class="form-group">
                    <v-input v-model="filters.query"
                             placeholder="Job Title, Location..."></v-input>
                </div>

                <div class="d-grid mt-2">
                    <button class="btn btn-primary" @click.prevent="fetchVacancies">Filter Results</button>
                </div>
            </div>
            <div class="col-9">
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <span class="fs-4">Available Vacancies <span v-if="!isLoading">(@{{ total }})</span></span>
                        <button class="btn btn-dark float-end" v-modal:vacancy>Add New Vacancy</button>
                    </div>
                </div>

                <loading v-if="isLoading"></loading>
                <div v-else>
                    <vacancy-card
                        v-for="vacancy in vacancies"
                        :key="vacancy.id"
                        :vacancy="vacancy"
                    ></vacancy-card>

                    <pagination
                        :total="totalPages"
                        :current="filters.page"
                        @page="setPage($event)"
                    ></pagination>
                </div>
            </div>

            <vacancy-modal
                @added="vacancyAdded($event)"
                @updated="vacancyUpdated($event)"
            ></vacancy-modal>
            <confirm-modal
                @submit="vacancyDeleted($event)">
                Are you sure you want to remove this vacancy?
            </confirm-modal>
        </div>
    </vacancies-page>
@endsection
