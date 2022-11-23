<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SlideController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('slide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.slide.index');
    }

    public function create()
    {
        abort_if(Gate::denies('slide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.slide.create');
    }

    public function edit(Slide $slide)
    {
        abort_if(Gate::denies('slide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.slide.edit', compact('slide'));
    }

    public function show(Slide $slide)
    {
        abort_if(Gate::denies('slide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.slide.show', compact('slide'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['slide_create', 'slide_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')) {
            $this->validate(request(), [
                'file' => sprintf(
                'image|dimensions:max_width=%s,max_height=%s',
                request()->input('max_width', 100000),
                request()->input('max_height', 100000)
                ),
            ]);
        }

        $model                     = new Slide();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}
