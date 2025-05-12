<?php

namespace App\Http\Controllers\Admin\Page;


class CreateController extends BaseController
{
    public function __invoke()
    {
        echo 'dddd';exit();
       $options = $this->service->getPageSelectOptions(request()->old('parent_id'));
       return view('admin.page.create', compact('options'));
    }
}
