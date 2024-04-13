<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire\Posts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component
{
	public $title = 'Post title...';

public function fakePosts()
{
    $posts = [
        array (
            "id"      => "1",
            "title"   => "Title 1",
            "content" => "Content 1..."
        ),
        array (
            "id"      => "2",
            "title"   => "Title 2",
            "content" => "Content 2..."
        ),
    ];

    $posts = array_map(function($post) {
        return (object)$post;
    }, $posts);

    return $posts;
}

	// Optional render if well named component
	public function render()
	{
		return view('livewire.posts.create-post')->with([
			'author' => ucfirst(Auth::user()?->name) ?? 'Unknown',
			'posts'  => $this->fakePosts(),
		]);
	}
	//
	// Inline render
	// public function render()
	// {
	//     return <<<'HTML'
	//     <div>
	//         Your Blade template goes here...
	//     </div>
	//     HTML;
	// }
}