@extends('admin.layouts.master')

@section('title', 'ویرایش دسته بندی')

@section('content')
    <x-validation-errors />
    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0 fs-5">ویرایش دسته بندی</h1>
            <a href="{{ route('category.index') }}" class="btn btn-sm dark-mode-item btn-light-soft mb-0">بازگشت</a>
            <a href="{{ route('category.index') }}" class="btn btn-sm light-mode-item btn-dark-soft mb-0">بازگشت</a>
        </div>
    </div>

    <form class="row g-4" method="POST" action="{{ route('category.update', $category) }}">
        @csrf
        @method('put')
        <div class="col-12">
            <label class="form-label" for="id_name">نام دسته بندی</label>
            <input class="form-control" required maxlength="50" type="text" placeholder="نام دسته بندی را وارد کنید"
                id="id_name" name="name" value="{{ old('name', $category->name) }}">
        </div>

        <div class="col-12">
            <label class="form-label" for="id_slug">اسلاگ</label>
            <input class="form-control" required type="text" maxlength="50" placeholder="اسلاگ آدرس بار" id="id_slug"
                name="slug" value="{{ str()->slug(old('slug', $category->slug), '-', null) }}">
        </div>

        <div class="col-12">
            <label class="form-label" for="id_description">توضیحات مختصر</label>
            <textarea class="form-control" rows="2" name="description" maxlength="100" id="id_description"
                placeholder="توضیحات (اختیاری)">{{ old('description', $category->description) }}</textarea>
            <small>حداکثر 160 کاراکتر</small>
        </div>

        <div class="col-12 d-flex align-items-center justify-content-start">
            <div class="form-check form-switch form-check-md">
                <input class="form-check-input" type="checkbox" id="is_active" value="1" @checked($category->is_active == 1)
                    name="is_active">
                <label class="form-check-label" for="is_active">وضعیت دسته بندی فعال / غیرفعال باشه؟</label>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary next-btn mb-0">ثبت اطلاعات</button>
        </div>
    </form>
@endsection
