<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class ListPost extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $post_list = Post::select('id', 'title', 'detail', 'slug', 'thumbnail', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('components.list-post', compact('post_list'));
    }
}
