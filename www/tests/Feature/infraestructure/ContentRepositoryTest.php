<?php

declare(strict_types=1);

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Interfaces\ContentInterface;
use Domain\MetaData;
use Domain\Content;
use DB;

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
    /**
     * 
     * @var MetaData[] $metas
     */
    $createEntry = function(array $metaDatas = []) {
        $content = $this->app->make(ContentInterface::class);
        if (empty($metaDatas)) {
            $metaDatas = [new MetaData("name", "Robert")];
        }
        foreach ($metaDatas as $metaData) {
            $content->addMeta($metaData);
        }
        // $content->addMeta(new MetaData("name", "Robert"));
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

test('Preserves content id from all content entries', function() use (&$createEntry, &$contentRepository) {
    DB::statement('ALTER TABLE contents AUTO_INCREMENT = 1');

    $createEntry();
    $entries = $contentRepository->rememberIds()->all();
    $firstEntry = $entries[0];
    $this->assertSame(1, $firstEntry->getId());
});

test('Don\'t preservers the id if not asked', function() use (&$createEntry, &$contentRepository) {
    DB::statement('ALTER TABLE contents AUTO_INCREMENT = 1');

    $createEntry();
    $entries = $contentRepository->all();
    $firstEntry = $entries[0];
    $this->assertSame(null, $firstEntry->getId());
});

test('Return of paginate - array', function() use (&$createEntry, &$contentRepository) {
    $createEntry();
    $entries = $contentRepository->rememberIds()->paginate(1, 10);
    $this->assertIsArray($entries);
});

test('Entry type of paginate', function() use (&$createEntry, &$contentRepository) {
    $createEntry();
    $entries = $contentRepository->rememberIds()->paginate(1, 10);
    $this->assertInstanceOf(Content::class, $entries[0]);
});

test('Check all metadatas are recovered after all method', function() use (&$createEntry, &$contentRepository) {
    $createEntry();
    $entries = $contentRepository->rememberIds()->all();
    $firstEntry = $entries[0];
    $metas = $firstEntry->getMetas();
    $this->assertCount(1, $metas);
});

test('Check all metadatas are recovered after paginate method', function() use (&$createEntry, &$contentRepository) {
    $createEntry();
    $entries = $contentRepository->rememberIds()->paginate(1, 10);
    $firstEntry = $entries[0];
    $metas = $firstEntry->getMetas();
    $this->assertCount(1, $metas);
});

