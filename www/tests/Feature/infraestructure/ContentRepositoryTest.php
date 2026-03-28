<?php

declare(strict_types=1);

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Interfaces\ContentInterface;
use Illuminate\Database\Eloquent\Collection;
use Domain\MetaData;

/**
 * @var ContentRepositoryInterface|null
 */
$contentRepository = null;

/**
 * @var \Function|null
 */
$createEntry = null;

// function createEntry() {
//     $content = $this->app->make(ContentInterface::class);
// }

beforeEach(function () use (&$contentRepository, &$createEntry) {
    $contentRepository = $this->app->make(ContentRepositoryInterface::class);
    $createEntry = function() {
        $content = $this->app->make(ContentInterface::class);
        $content->addMeta(new MetaData("name", "Robert"));
        $content->persist();
    };
});

test('Check the amount of generated content in contents table.', function () use (&$contentRepository) {
    $this->assertDatabaseCount('contents', 0);
    $contentRepository->create();
    $this->assertDatabaseCount('contents', 1);
});

test('Check the amount of generated content in contents table after three entries created.', function () use (&$contentRepository) {
    $this->assertDatabaseCount('contents', 0);
    $contentRepository->create();
    $contentRepository->create();
    $contentRepository->create();
    $this->assertDatabaseCount('contents', 3);
});

test('Check the type of generated content', function () use (&$contentRepository, &$createEntry) {
    $createEntry();
    $allEntries = $contentRepository->all();
    $this->assertInstanceOf(Collection::class, $allEntries);
});
