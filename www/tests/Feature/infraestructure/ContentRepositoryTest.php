<?php

declare(strict_types=1);

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Interfaces\ContentInterface;
use Domain\MetaData;
use Domain\Content;

/**
 * @var ContentRepositoryInterface|null
 */
$contentRepository = null;

/**
 * @var \Function|null
 */
$createEntry = null;

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
    $this->assertIsArray($allEntries);
});

test('Type of one content entry', function () use (&$contentRepository, &$createEntry) {
    $createEntry();
    $allEntries = $contentRepository->all();
    $this->assertInstanceOf(Content::class, $allEntries[0]);
});

test('Save whole content with a meta tag', function () use (&$contentRepository) {
    $this->assertDatabaseCount('contents', 0);
    $this->assertDatabaseCount('metadata', 0);
    $this->assertDatabaseCount('string_metadata', 0);

    $content = $this->app->make(ContentInterface::class);
    $metaData = new MetaData("name", "John Doe");
    $content->addMeta($metaData);

    $contentRepository->save($content);

    $this->assertDatabaseCount('contents', 1);
    $this->assertDatabaseCount('metadata', 1);
    $this->assertDatabaseCount('string_metadata', 1);
});
