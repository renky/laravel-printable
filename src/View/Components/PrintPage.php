<?php

namespace Orlyapps\Printable\View\Components;

use Illuminate\View\Component;

class PrintPage extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $orientation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orientation = 'portrait')
    {
        $this->orientation = $orientation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('printable::components.print-page');
    }
}
