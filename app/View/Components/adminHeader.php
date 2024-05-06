<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class adminHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public function __construct($title)
    {
        //
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = User::find(session()->get('id'));
        return view('components.admin-header',compact('user'));
    }
}
