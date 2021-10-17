<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\StoreRequest;
use App\Http\Requests\Vacancy\UpdateRequest;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{
    /**
     * Get vacancies
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        // Grab page length from query params, otherwise use default
        $pageLength = $request->get('page_length') ?: 2;

        // Initialise vacancy query
        $vacancies = Vacancy::query()
                            ->orderBy('updated_at', 'desc');

        // Check for filtering
        if (!empty($request->get('query'))) {
            $filters = explode(",", $request->get('query'));

            foreach ($filters as $filter) {
                // Remove empty spaces from both left and right
                $filter = trim($filter);

                $vacancies->where(function ($q) use ($filter) {
                    $q->where("title", "LIKE", "%{$filter}%")
                      ->orWhere("location", "LIKE", "%{$filter}%");

                    // Check if filter is numeric to check salary range
                    if (is_numeric($filter)) {
                        $q->orWhere(function ($q) use ($filter) {
                            $q->where('salary_from', '<=', $filter)
                              ->where('salary_to', '>=', $filter);
                        });
                    }

                });
            }
        }

        return $vacancies->paginate($pageLength);
    }

    /**
     * Add new vacancy
     *
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        // Get only validated data from request
        $data = $request->validated();

        return Vacancy::create($data);
    }

    /**
     * Update vacancy
     *
     * @param UpdateRequest $request
     * @param Vacancy $vacancy
     * @return Vacancy|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|null
     */
    public function update(UpdateRequest $request, Vacancy $vacancy)
    {
        // Get only validated data from request
        $data = $request->validated();

        // Update vacancy
        $updated = $vacancy->update($data);

        // If successful updated return fresh model
        if (!empty($updated)) {
            return $vacancy->fresh();
        }

        return response("Unknown Server Error!", 500);
    }

    /**
     * Delete vacancy
     *
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Vacancy $vacancy)
    {
        return response()->json([
            "success" => !!$vacancy->delete()
        ]);
    }
}
