@extends('admin.layouts.master')

@section('title', 'لیست دسته بندی ها')

@section('content')
    <!-- Title -->
    <div class="row mb-3">
        <div class="col-12 d-sm-flex justify-content-between align-items-center">
            <h1 class="h3 mb-2 mb-sm-0 fs-5">لیست دسته بندی ها</h1>
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary mb-0">افزودن دسته بندی</a>
        </div>
    </div>

    {{-- <!-- Course boxes START -->
    <div class="row g-4 mb-4">
        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4 bg-primary bg-opacity-10 border border-primary rounded-3">
                <h6>دوره ها</h6>
                <h2 class="mb-0 fs-1 text-primary">1200</h2>
            </div>
        </div>

        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4 bg-success bg-opacity-10 border border-success rounded-3">
                <h6>دوره های فعال</h6>
                <h2 class="mb-0 fs-1 text-success">996</h2>
            </div>
        </div>

        <!-- Course item -->
        <div class="col-sm-6 col-lg-4">
            <div class="text-center p-4  bg-warning bg-opacity-15 border border-warning rounded-3">
                <h6>در حال ضبط</h6>
                <h2 class="mb-0 fs-1 text-warning">200</h2>
            </div>
        </div>
    </div>
    <!-- Course boxes END --> --}}

    <!-- Card START -->
    <div class="card bg-transparent border">

        <!-- Card header START -->
        <div class="card-header bg-light border-bottom">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between">
                <!-- Search bar -->
                <div class="col-md-8">
                    <form class="rounded position-relative">
                        <input class="form-control bg-body" type="search" placeholder="جستجوی دوره" aria-label="Search">
                        <button
                            class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                            type="submit">
                            <i class="fas fa-search fs-6 "></i>
                        </button>
                    </form>
                </div>

                <!-- Select option -->
                <div class="col-md-3">
                    <!-- Short by filter -->
                    <form>
                        <select class="form-select js-choice border-0 z-index-9" aria-label=".form-select-sm">
                            <option value="">مرتب سازی</option>
                            <option>جدیدترین</option>
                            <option>قدیمی ترین</option>
                            <option>تایید شده</option>
                            <option>رد شده</option>
                        </select>
                    </form>
                </div>
            </div>
            <!-- Search and select END -->
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <!-- Course table START -->
            <div class="table-responsive border-0 rounded-3">
                <!-- Table START -->
                <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">نام دسته بندی</th>
                            <th scope="col" class="border-0">وضعیت</th>
                            <th scope="col" class="border-0">اسلاگ</th>
                            <th scope="col" class="border-0 rounded-end">عملیات</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <h6 class="table-responsive-title mb-0 ms-2">
                                            <a href="#" class="stretched-link">{{ $category->name }}</a>
                                        </h6>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch form-check-md">
                                            <input class="form-check-input"
                                                hx-get="{{ route('category.status', $category->id) }}"
                                                hx-target="#category_{{ $category->id }}" hx-swap="outerHTML"
                                                type="checkbox" id="is_active" value="1" name="is_active"
                                                @checked($category->is_active == 1)>
                                            <span id="category_{{ $category->id }}">
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $category->slug }}</td>

                                <td>
                                    <a href="{{ route('category.edit', $category) }}" class="btn btn-sm btn-success-soft me-1 mb-1 mb-md-0">ویرایش</a>
                                    <button onclick="confirmDelete({{ $category->id }})"
                                        class="btn btn-sm btn-danger-soft mb-0">حذف</button>
                                    <form id="delete_category_{{ $category->id }}"
                                        action="{{ route('category.destroy', $category) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <!-- Table body END -->
                </table>
                <!-- Table END -->
            </div>
            <!-- Course table END -->
        </div>
        <!-- Card body END -->

        <!-- Card footer START -->
        <div class="card-footer bg-transparent pt-0">
            <!-- Pagination START -->
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <!-- Content -->
                <p class="mb-0 text-center text-sm-start">مجموع دسته بندی ها {{ $categories->count() }}</p>
                <!-- Pagination -->
                {{ $categories->links() }}

            </div>
            <!-- Pagination END -->
        </div>
        <!-- Card footer END -->
    </div>
    <!-- Card END -->
@endsection


@section('scripts')
    <script src="https://unpkg.com/htmx.org@2.0.3"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('مطمئن به حذف دسته بندی  مورد نظر هستی؟')) {
                document.getElementById(`delete_category_${id}`).submit();
            }
        }
    </script>
@endsection
