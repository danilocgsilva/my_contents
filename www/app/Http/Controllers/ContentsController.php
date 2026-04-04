<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
use Domain\Interfaces\ContentInterface;
use App\Http\Requests\ContentRequest;
use Domain\Interfaces\ContentRepositoryInterface;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContentRepositoryInterface $contentRepository, Request $request)
    {
        // $contents = $contentRepository->rememberIds()->paginate($request->query('page') ?? 0, 10);
        $lengthAware = $contentRepository->rememberIds()->paginateWithLengthAware($request->query('page') ?? 0, 10);
        $contents = $lengthAware->items();

        $nextPageUrl = $lengthAware->nextPageUrl();
        $previousPageUrl = $lengthAware->previousPageUrl();
        $currentPage = $lengthAware->currentPage();

        return Inertia::render('Contents/Index', [
            'contents' => $contents,
            'nextPageUrl' => $nextPageUrl,
            'previousPageUrl' => $previousPageUrl,
            'currentPage' => $currentPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Contents/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentRequest $request)
    {
        $content = app(ContentInterface::class);

        DB::transaction(function () use ($request, $content) {
            foreach ($request->getMetaDatas() as $metaData) {
                $content->addMeta($metaData);
            }
            $content->persist();
        });

        return redirect()->route('contents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
