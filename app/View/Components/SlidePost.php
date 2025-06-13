<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class SlidePost extends Component
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
        $post_list = Post::select('id', 'title', 'slug', 'thumbnail', 'detail', 'description')
            ->where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return view('components.slide-post', compact('post_list'));
    }
}
