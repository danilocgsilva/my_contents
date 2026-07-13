<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;
use Domain\Interfaces\ContentInterface;
use App\Http\Requests\ContentRequest;
use App\Models\Content;
use Domain\Interfaces\ContentRepositoryInterface;
use App\Views\Pagination;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContentRepositoryInterface $contentRepository, Request $request)
    {
        if ($request->has('page')) {
            session(['pagination_number' => $request->query('page')]);
        }
        $paginationNumber = $request->query('page') ?? session('pagination_number', 1);

        $viewPagination = new Pagination(
            $contentRepository
                ->rememberIds()
                ->paginateWithLengthAware($paginationNumber, 10)
        );

        $contentsItems = $viewPagination->items;

        return Inertia::render('Contents/Index', [
            'contents' => $contentsItems,
            'nextPageUrl' => $viewPagination->nextPageUrl,
            'previousPageUrl' => $viewPagination->previousPageUrl,
            'currentPage' => $viewPagination->currentPage,
            'lastPage' => $viewPagination->lastPage,
            'previousPageNumber' => $viewPagination->previousPageNumber,
            'nextPageNumber' => $viewPagination->nextPageNumber,
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
    public function show(Content $content)
    {
        $content->load('metadata');
        $domainContent = $content->toDomainWithIds();
        return Inertia::render('Contents/Show', [
            'content' => $domainContent,
            'csrfToken' => csrf_token(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        $content->load('metadata');
        $content = $content->toDomainWithIds();
        return Inertia::render('Contents/Edit', [
            'content' => $content,
            'csrfToken' => csrf_token(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContentRequest $request, Content $content, ContentRepositoryInterface $contentRepository)
    {
        $domainContent = app(ContentInterface::class);
        $domainContent->setId($content->id);

        foreach ($request->getMetaDatas() as $metaData) {
            $domainContent->addMeta($metaData);
        }

        DB::transaction(function () use ($contentRepository, $domainContent) {
            $contentRepository->update($domainContent);
        });

        return redirect()->route('contents.index')->with('success', 'Content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ContentRepositoryInterface $contentRepositoryInterface)
    {
        $contentRepositoryInterface->delete($id);
        $paginationNumber = session('pagination_number', 1);
        return redirect()->route('contents.index', ['page' => $paginationNumber]);
    }
}
