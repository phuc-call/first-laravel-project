<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Topic;

class ListTopic extends Component
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
        $topic_list = Topic::select('id', 'name', 'slug', 'status', 'description')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('components.list-topic',compact('topic_list'));
    }
}
