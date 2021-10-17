<?php

namespace Tests\Feature;

use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VacanciesTest extends TestCase
{
    private $vacancy;

    /**
     * Get vacancies.
     *
     * @return void
     */
    public function test_get_vacancies()
    {
        $response = $this->get('/api/vacancies');

        $response->assertStatus(200);
    }

    /**
     * Add vacancy
     */
    public function test_store_vacancy()
    {
        $response = $this->post('/api/vacancies', [
            "title"       => "Test",
            "description" => "Test",
            "location"    => "test",
            "salary_from" => 10000,
            "salary_to"   => 15000
        ]);

        $data = json_decode($response->getContent());

        $this->vacancy = Vacancy::query()->findOrFail($data->id);

        $response->assertSessionHasNoErrors();
    }

    /**
     * Update vacancy
     */
    public function test_update_vacancy()
    {
        $vacancy = Vacancy::query()
                          ->inRandomOrder()
                          ->first();

        $response = $this->put('/api/vacancies/' . $vacancy->getKey(), [
            "title"       => "Test Updated",
        ]);

        $response->assertSessionHasNoErrors();
    }

    /**
     * Destroy vacancy
     */
    public function test_destroy_vacancy()
    {
        $vacancy = Vacancy::query()
                          ->inRandomOrder()
                          ->first();

        $response = $this->delete('/api/vacancies/' . $vacancy->getKey());

        $response->assertSessionHasNoErrors();
    }
}
