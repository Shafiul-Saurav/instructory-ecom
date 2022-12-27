@extends('backend.layouts.master')

@section('title')
Post Trash
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
        <h1>{{ __('Post List Table') }}</h1>
        <div class="col-12">
            <div class="d-flex">
                <a href="{{ route('post.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-backward"></i>
                    Back to Posts
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
                            <th scope="col">User Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Subcategory</th>
                            <th scope="col">Image</th>
                            <th scope="col">Post Title</th>
                            <th scope="col">Approval</th>
                            {{-- <th scope="col">Status</th> --}}
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $posts->firstItem()+$loop->index }}</th>
                                <td>{{ $post->updated_at->format('d M Y') }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->category_name }}</td>
                                <td>{{ $post->subcategory->subcategory_name }}</td>
                                <td class="">
                                    <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}"
                                    class="img-fluid rounded-circle" alt="" style="width:60px; height:60px;">
                                </td>
                                <td>{{ $post->post_name }}</td>
                                <td>
                                    @if ($post->is_approved == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-warning">Disapproved</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Setting
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('post.restore', ['post_slug' => $post->post_slug]) }}"><i class="fa-regular fa-pen-to-square"></i> Restore</a></li>
                                            <li>
                                                <form action="{{ route('post.forcedelete', ['post_slug' => $post->post_slug]) }}" method="post">
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
