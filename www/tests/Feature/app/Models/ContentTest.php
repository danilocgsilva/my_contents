<?php

declare(strict_types=1);

use Domain\Interfaces\ContentInterface;
use Domain\MetaData;
use Domain\Content as DomainContent;
use App\Models\Content;
use DB;

/**
 * @var \Function|null
 */
$createEntry = null;

beforeEach(function () use (&$createEntry) {
    /**
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
        $content->persist();
    };
});

test('toDomain() method convert to Domain\Content', function () use (&$createEntry) {
    DB::statement('ALTER TABLE contents AUTO_INCREMENT = 1');
    
    $createEntry();
    $content = Content::find(1);
    $domainContent = $content->toDomain();
    $this->assertInstanceOf(DomainContent::class, $domainContent);
});

test('toDomain() method also must brings the metadata', function () use (&$createEntry) {
    DB::statement('ALTER TABLE contents AUTO_INCREMENT = 1');
    
    $createEntry();
    $content = Content::find(1);
    $contentMeta = $content->toDomain();
    $metas = $contentMeta->getMetas();
    $this->assertIsArray($metas);
});
