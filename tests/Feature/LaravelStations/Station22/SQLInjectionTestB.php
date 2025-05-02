<?php

namespace Tests\Feature\LaravelStations\Station22;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SQLInjectionTestB extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Station22-Aのテストが実行済みであることを確認
        $filePath = base_path('test-outputs/temp/station22-a.txt');
        $this->assertTrue(
            file_exists($filePath),
            'Station22-Aのテストを先に実行し、SQLインジェクションにより全件取得されることを確認してください'
        );

        // ユーザー作成
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@techbowl.com',
            'password' => bcrypt('password123')
        ]);

        // テストデータ作成
        $genre = Genre::create(['name' => 'テストジャンル']);

        for ($i = 1; $i <= 5; $i++) {
            Movie::create([
                'title' => "テスト映画{$i}",
                'image_url' => "https://example.com/image{$i}.jpg",
                'published_year' => 2020 + $i,
                'description' => "テスト映画{$i}の説明",
                'is_showing' => $i % 2,
                'genre_id' => $genre->id
            ]);
        }
    }

    public function testSQLインジェクションによる全件取得ができない(): void
    {

        // ログイン
        $this->actingAs($this->user);

        $injectionKeyword = "' OR 1 = 1; --";

        $response = $this->get("/movies?keyword=" . urlencode($injectionKeyword));
        $response->assertStatus(200);

        // 全件取得されていないことを確認
        $responseContent = $response->getContent();
        if (!$responseContent) {
            $this->fail('検索ページのレスポンスが取得できませんでした');
        }

        $movies = Movie::all();
        $foundCount = 0;
        foreach ($movies as $movie) {
            if (str_contains($responseContent, $movie->title)) {
                $foundCount++;
            }
        }

        // 全件よりも少ない件数しか表示されていないことを確認
        $this->assertLessThan($movies->count(), $foundCount);
    }
}
