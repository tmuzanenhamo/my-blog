<?php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Posts
{
    /**
     * @var string title
     *
    */
    public $title;
    /**
     * @var string excerpt
     */
    public $excerpt;
    /**
     * @var string $date
     */
    public $date;
    /**
     * @var string $body
     */
    public $body;

    /**
     * @var string $slug
     */

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    /**
     * return all the available posts
     *
     * @return object
     */
    public static function all() {
        // to improve perfomance, cache the blog posts
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path('posts')))
            ->map(function($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($document) {
                return new Posts(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            })->sortByDesc('date');
        });
    }

    /**
     * Find a post by slug
     *
     * @param string $slug
     * @return object
     */
    public static function find($slug) {
        return self::all()->firstWhere('slug', $slug);
    }

    /**
     * find a post by slug and fail if not found
     *
     * @param  string $slug
     * @return object
     */
    public  static function findOrFail($slug)
    {
        // find the first post where the slug matches the give slug
        $post = self::find($slug);
        if (!$post) {
            throw new ModelNotFoundException();
        }
        return $post;
    }
}
