@extends('backend.layouts.master')

@section('title')
Post-Category Index
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endpush

<style>
    .dataTable_length{
        padding: 20px 0;
    }
</style>

@section('admin_content')
    <div class="row">
        <h1>{{ __('Category List Table') }}</h1>
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('post_category.trash') }}" class="btn btn-info">
                    <i class="fas fa-trash-restore"></i>
                    Restore
                </a>
                <a href="{{ route('post_category.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add New Category
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-4">
                <table id="dataTable" class="table table-bordered table-striped dataTable_length">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postCategories as $postCategory)
                            <tr>
                                <th scope="row">{{ $postCategories->firstItem()+$loop->index }}</th>
                                <td>{{ $postCategory->created_at->format('d M Y') }}</td>
                                <td class="">
                                    <img src="{{ asset('uploads/pcategories') }}/{{ $postCategory->pcategory_image }}"
                                    class="img-fluid rounded-circle" alt="" style="width:60px; height:60px;">
                                </td>
                                <td>{{ $postCategory->category_name }}</td>
                                <td>{{ $postCategory->category_slug }}</td>
                                <td>
                                    @if ($postCategory->is_active == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Setting
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('post_category.edit', $postCategory->category_slug) }}"><i class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                            <li>
                                                <form action="{{ route('post_category.destroy', $postCategory->category_slug) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"><i class="fa-solid fa-trash"></i> Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            pagingType: 'first_last_numbers',
        });

        $('.show_confirm').click(function(event){
            let form = $(this).closest('form');

            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })
        })
    });
</script>
@endpush
