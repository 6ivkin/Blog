<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        // это метод при котором файлы которые добавляем в блог попадали в папку storage/app/images/...
        $data['preview_image'] = Storage::put('/images', $data['preview_image']);
        $data['main_image'] = Storage::put('/images', $data['main_image']);

        //Проверка на то чтобы данные не повторялись в таблице
        Post::firstOrCreate($data);

        return redirect()->route('admin.post.index');
    }
}
