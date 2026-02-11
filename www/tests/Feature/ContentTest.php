<?php

use Domain\Content;
use Domain\Exceptions\NoDataToSaveException;

test('May return NoContentException if anything setted to save', function () {
    $content = new Content();
    $content->persist();
})->throws(NoDataToSaveException::class);;
