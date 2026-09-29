@extends('users.rayEmployee.layouts.master')

@extends('cruds.layouts.gallery')

@section('title1')
    {{ __('cruds.rays') }}
@endsection

@section('gallery')
    @foreach ($images as $image)
        <li class="col-sm-6 col-lg-4" data-sub-html="<h4>Gallery Image 1</h4>"
            data-responsive="{{ asset('backend/images/' . $image->path) }}"
            data-src="{{ asset('backend/images/' . $image->path) }}">
            <a href="">
                <img class="img-responsive" src="{{ asset('backend/images/' . $image->path) }}"
                    alt="{{ __('field.image.ray') }}">
            </a>
        </li>
    @endforeach
@endsection

@section('pagination')
    <div class="col-md-6 mt-1 d-none d-md-block">
        {{ $images->firstItem() }} - {{ $images->lastItem() }} {{ __('general.words.of') }} {{ $images->total() }}
        {{ __('field.image.*') }}
    </div>
    <div class="col-md-6">
        <div class="float-right">
            {{ $images->links() }}
        </div>
    </div>
@endsection
