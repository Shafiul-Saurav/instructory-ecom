@extends('backend.layouts.master')

@section('title')
Post-Subcategory Index
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
        <h1>{{ __('Subcategory List Table') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('post_subcategory.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Subategories
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
                            <th scope="col">Category Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Subcategory Name</th>
                            <th scope="col">Subcategory Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postSubcategories as $postSubcategory)
                            <tr>
                                <th scope="row">{{ $postSubcategories->firstItem()+$loop->index }}</th>
                                <td>{{ $postSubcategory->updated_at->format('d M Y') }}</td>
                                <td>{{ $postSubcategory->postCategory->category_name }}</td>
                                <td class="">
                                    <img src="{{ asset('uploads/subcategories') }}/{{ $postSubcategory->subcategory_image }}"
                                    class="img-fluid rounded-circle" alt="" style="width:60px; height:60px;">
                                </td>
                                <td>{{ $postSubcategory->subcategory_name }}</td>
                                <td>{{ $postSubcategory->subcategory_slug }}</td>
                                <td>
                                    @if ($postSubcategory->is_active == 1)
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
                                            <li><a class="dropdown-item" href="{{ route('post_subcategory.restore',
                                            ['subcategory_slug' => $postSubcategory->subcategory_slug]) }}"><i class="fa-regular fa-pen-to-square"></i> Restore</a></li>
                                            <li>
                                                <form action="{{ route('post_subcategory.forcedelete', $postSubcategory->subcategory_slug) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"><i class="fa-solid fa-trash"></i> Force Delete</button>
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
