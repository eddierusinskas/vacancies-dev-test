<script>
import VacancyCard from "./vacancies/VacancyCard";
import Loading from "./utils/Loading";
import VacancyModal from "./vacancies/VacancyModal";
import Pagination from "./utils/Pagination";
import VInput from "./utils/form/VInput";
import ConfirmModal from "./utils/ConfirmModal";

export default {
    name: "VacanciesPage",
    components: {
        VInput,
        Loading,
        VacancyCard,
        VacancyModal,
        ConfirmModal,
        Pagination
    },
    data() {
        return {
            isLoading: true,
            vacancies: [],
            total: 0,
            totalPages: 0,
            filters: {
                page: 1,
                query: ""
            }
        }
    },
    created() {
        this.fetchVacancies();
    },
    methods: {
        // Fetch Vacancies
        fetchVacancies() {

            // Set page as loading
            this.isLoading = true;

            // Grab vacancies from API
            axios.get('/api/vacancies', {params: this.filters})
                 .then(response => {
                     this.vacancies = response.data.data;
                     this.total = response.data.total;
                     this.totalPages = response.data.last_page;

                     this.isLoading = false;
                 })
                 .catch(response => {
                     console.error(response);
                     this.isLoading = false;
                 })
        },
        setPage(page) {
            this.filters.page = page;
            this.fetchVacancies();
        },
        vacancyAdded(vacancy) {
            this.vacancies = [
                vacancy,
                ...this.vacancies
            ];
            this.total++;
        },
        vacancyUpdated(vacancy) {
            this.vacancies = [
                vacancy,
                ...this.vacancies.filter(v => v.id !== vacancy.id)
            ];
        },
        vacancyDeleted(vacancy) {
            axios.delete('/api/vacancies/' + vacancy.id)
                 .then(response => {
                     if (response.data.success) {
                         this.vacancies = this.vacancies.filter(v => v.id !== vacancy.id);
                         this.total--;
                     }
                 })

        }
    }
}
</script>
