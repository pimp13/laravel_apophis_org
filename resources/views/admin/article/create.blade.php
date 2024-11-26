@extends('admin.layouts.master')

@section('title', 'ایجاد مقاله جدید')

@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
    <link rel="stylesheet" type="text/css" href="https://eduport.webestica.com/rtl/assets/vendor/choices/css/choices.min.css">
    <link rel="stylesheet" type="text/css" href="https://eduport.webestica.com/rtl/assets/vendor/glightbox/css/glightbox.css">
    <link rel="stylesheet" type="text/css" href="https://eduport.webestica.com/rtl/assets/vendor/quill/css/quill.snow.css">
    <link rel="stylesheet" type="text/css"
        href="https://eduport.webestica.com/rtl/assets/vendor/stepper/css/bs-stepper.min.css">
@endsection

@section('content')
    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0 fs-5">ایجاد مقاله جدید</h1>
            <a href="{{ route('category.index') }}" class="btn btn-sm dark-mode-item btn-light-soft mb-0">بازگشت</a>
            <a href="{{ route('category.index') }}" class="btn btn-sm light-mode-item btn-dark-soft mb-0">بازگشت</a>
        </div>
    </div>

    <hr>

    <form class="row g-4" method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="col-12">
            <label class="form-label" for="id_name">نام دسته بندی</label>
            <input class="form-control" required maxlength="50" type="text" placeholder="نام دسته بندی را وارد کنید"
                id="id_name" name="name" value="{{ old('name') }}">
        </div>

        <!-- Course category -->
        <div class="col-md-6">
            <label class="form-label" for="category_id">دسته بندی</label>
            <select class="form-select" name="" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Course level -->
        <div class="col-md-6">
            <label class="form-label" for="published_at">تاریخ انتشار</label>
            <input type="datetime-local" class="form-control" value="{{ old('published_at', now()) }}" name="published_at"
                id="published_at">
        </div>


        <div class="col-12">
            <label class="form-label" for="id_slug">اسلاگ</label>
            <input class="form-control" required type="text" maxlength="50" placeholder="اسلاگ آدرس بار" id="id_slug"
                name="slug" value="{{ str()->slug(old('slug'), '-', null) }}">
        </div>

        <div class="col-12">
            <label class="form-label" for="summary">متن خلاصه</label>
            <textarea class="form-control" rows="2" name="summary" maxlength="100" id="summary"
                placeholder="متن خلاصه مقاله">{{ old('summary') }}</textarea>
            <small>حداکثر 250 کاراکتر</small>
        </div>

        <div class="col-12">
            <label class="form-label" for="body">متن اصلی مقاله</label>
            <textarea class="form-control" rows="2" name="body" maxlength="100" id="body"
                placeholder="متن اصلی مقاله">{{ old('body') }}</textarea>
            <small>حداکثر 3000 کاراکتر</small>
        </div>

        <div class="col-12">
            <div
                class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                <!-- Image -->
                <img src="https://eduport.webestica.com/rtl/assets/images/element/gallery.svg" class="h-50px"
                    alt="">
                <div>
                    <h6 class="my-2">Upload course image here, or<a href="#!" class="text-primary"> Browse</a></h6>
                    <label style="cursor:pointer;">
                        <span>
                            <input class="form-control stretched-link" type="file" name="my-image" id="image"
                                accept="image/gif, image/jpeg, image/png">
                        </span>
                    </label>
                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested dimensions are 600px *
                        450px. Larger image will be cropped to 4:3 to fit our thumbnails/previews.</p>
                </div>
            </div>
        </div>

        <hr>


        <div class="col-12">
            <label class="form-label" for="body">توضیحات سئو</label>
            <textarea class="form-control" rows="2" name="body" maxlength="100" id="body"
                placeholder="متن اصلی مقاله">{{ old('body') }}</textarea>
            <small>حداکثر 160 کاراکتر</small>
        </div>


        <div class="col-12 d-flex align-items-center justify-content-start">
            <div class="form-check form-switch form-check-md">
                <input class="form-check-input" type="checkbox" id="is_active" value="1" name="is_active">
                <label class="form-check-label" for="is_active">وضعیت دسته بندی فعال / غیرفعال باشه؟</label>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary next-btn mb-0">ثبت اطلاعات</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://eduport.webestica.com/rtl/assets/vendor/choices/js/choices.min.js"></script>
    <script src="https://eduport.webestica.com/rtl/assets/vendor/glightbox/js/glightbox.js"></script>
    <script src="https://eduport.webestica.com/rtl/assets/vendor/quill/js/quill.min.js"></script>
    <script src="https://eduport.webestica.com/rtl/assets/vendor/stepper/js/bs-stepper.min.js"></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"

            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph,
            Indent,
            IndentBlock,
            BlockQuote,
            Heading,
            Link,
            Code,
            Underline,
            CodeBlock,
            Highlight,
            SourceEditing
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#summary'), {
                language: {
                    ui: 'en',
                    content: 'fa'
                },
                plugins: [
                    Essentials,
                    Bold,
                    Italic,
                    Font,
                    Paragraph,
                    Indent,
                    IndentBlock,
                    BlockQuote,
                    Heading,
                    Link,
                    Code,
                    Underline,
                    CodeBlock,
                    Highlight,
                    SourceEditing
                ],
                toolbar: [
                    'undo', 'redo', '|',
                    'heading', '|',
                    'bold', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'outdent', 'indent', 'blockquote', 'link', 'code', 'underline', 'codeBlock', 'highlight', '|',
                    'sourceEditing'
                ],
                codeBlock: {
                    languages: [{
                            language: 'plaintext',
                            label: 'Plain text',
                            class: ''
                        },
                        {
                            language: 'php',
                            label: 'PHP',
                            class: 'php-code text-primary'
                        },
                        {
                            language: 'javascript',
                            label: 'JavaScript',
                            class: 'js javascript js-code'
                        },
                        {
                            language: 'python',
                            label: 'Python'
                        },
                        {
                            language: 'c#',
                            label: 'C#'
                        }
                    ]
                },
                fontFamily: {
                    options: [
                        'default',
                        'Ubuntu, Arial, sans-serif',
                        'Ubuntu Mono, Courier New, Courier, monospace',
                        'IRANSans',
                        'vazir',
                        'vazir-bold'
                    ]
                },

            });
        ClassicEditor
            .create(document.querySelector('#body'), {
                language: {
                    ui: 'en',
                    content: 'fa'
                },
                plugins: [
                    Essentials,
                    Bold,
                    Italic,
                    Font,
                    Paragraph,
                    Indent,
                    IndentBlock,
                    BlockQuote,
                    Heading,
                    Link,
                    Code,
                    Underline,
                    CodeBlock,
                    Highlight,
                    SourceEditing
                ],
                toolbar: [
                    'undo', 'redo', '|',
                    'heading', '|',
                    'bold', 'italic', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'outdent', 'indent', 'blockquote', 'link', 'code', 'underline', 'codeBlock', 'highlight', '|',
                    'sourceEditing'
                ],
                codeBlock: {
                    languages: [{
                            language: 'plaintext',
                            label: 'Plain text',
                            class: ''
                        },
                        {
                            language: 'php',
                            label: 'PHP',
                            class: 'php-code text-primary'
                        },
                        {
                            language: 'javascript',
                            label: 'JavaScript',
                            class: 'js javascript js-code'
                        },
                        {
                            language: 'python',
                            label: 'Python'
                        },
                        {
                            language: 'c#',
                            label: 'C#'
                        }
                    ]
                },
                fontFamily: {
                    options: [
                        'default',
                        'Ubuntu, Arial, sans-serif',
                        'Ubuntu Mono, Courier New, Courier, monospace',
                        'IRANSans',
                        'vazir',
                        'vazir-bold'
                    ]
                },

            });
    </script>
@endsection
