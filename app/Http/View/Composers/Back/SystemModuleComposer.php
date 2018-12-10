<?php

namespace ReclutaTI\Http\View\Composers\Back;

use Illuminate\View\View;
use ReclutaTI\SystemModule;

class SystemModuleComposer
{
	protected $modules;

	public function __construct(SystemModule $modules)
	{
		$this->modules = $modules;
	}

	public function compose(View $view)
	{
		$view->with('modules', $this->modules->where('parent', 0)->with(['children'])->get());
	}
}