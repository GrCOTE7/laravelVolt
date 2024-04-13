<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Livewire\Posts;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app2')]
class CreatePost extends Component
{
	// public $title = 'Post title...';

	public function fakePosts()
	{
		$posts = [
			[
				'id'      => '1',
				'title'   => 'Title 1',
				'content' => 'Content 1...',
			],
			[
				'id'      => '2',
				'title'   => 'Title 2',
				'content' => 'Content 2...',
			],
		];

		return array_map(function ($post) {
			return (object) $post;
		}, $posts);
	}

	public function save()
	{
		$post = Post::create([
			'title' => $this->title,
		]);

		return redirect()->to('/posts')
			->with('status', 'Post created!');
	}

	// Optional render if well named component
	// #[Layout('components.layouts.app2')]

    #[Title('Ttt')]
    public function render()
	{
		return view('livewire.posts.create-post')->with([
			// 'author' => ucfirst(Auth::user()?->name),
			'author' => ucfirst(Auth::user()?->name ?? 'Unknown'),
			'posts'  => $this->fakePosts(),
		]);
		// ->layout('components.layouts.app2');
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
