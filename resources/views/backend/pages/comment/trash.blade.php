@extends('backend.layouts.master')

@section('title')
Comment Trash
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
        <h1>{{ __('Comment List Table') }}</h1>
        <div class="col-12">
            <div>
                <a href="{{ route('post_comment.index') }}" class="btn btn-info">
                    <i class="fas fa-trash-restore"></i>
                    Restore
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-4">
                <table id="dataTable" class="table table-bordered table-striped dataTable_length">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Published On</th>
                            <th scope="col">Profile Image</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Post</th>
                            <th scope="col">Message</th>
                            <th scope="col">Approval</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <th scope="row">{{ $comments->firstItem()+$loop->index }}</th>
                                <td>{{ $comment->created_at->format('d M Y') }}</td>
                                @if ($comment->user->profile)
                                <td>
                                    <img src="{{ asset('uploads/users') }}/{{ $comment->user->profile->user_image }}"
                                    class="img-fluid rounded-circle" alt="" style="width:30px; height:30px;">
                                </td>
                                @else
                                <td>
                                    <img src="{{ asset('uploads/users') }}/default_user.jpg"
                                    class="img-fluid rounded-circle" alt="" style="width:30px; height:30px;">
                                </td>
                                @endif

                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->post->post_name }}</td>
                                <td>{{ $comment->commentor_comment }}</td>
                                <td>
                                    @if ($comment->is_approved == 1)
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
                                            <li><a class="dropdown-item" href="{{ route('post_comment.restore', ['id' => $comment->id]) }}"><i class="fas fa-trash-restore"></i> Restore</a></li>
                                            <hr>
                                            <li>
                                                <form action="{{ route('post_comment.forcedelete', ['id' => $comment->id]) }}" method="post">
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
