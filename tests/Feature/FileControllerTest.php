<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload() {
        $img = UploadedFile::fake()->image("risky.png");

        $this->post('/file/upload', [
            "picture" => $img
        ])->assertSeeText('OK: risky.png');
    }
}
