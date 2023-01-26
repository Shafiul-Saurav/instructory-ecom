@extends('backend.layouts.master')

@section('title')
Dashboard
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
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
    </div>
     <!-- Stats Start -->
     <div class="row">
        <div class="col-12">
            <h2 class="small-title">Analytics Report</h2>

          <div class="mb-5">
            <div class="row g-2">
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="dollar" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">EARNINGS</div>
                    <div class="text-primary cta-4">৳ {{ $total_earning }}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="basket" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">ORDERS</div>
                    <div class="text-primary cta-4">{{ $total_order_count }}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="server" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">CATEGORIES</div>
                    <div class="text-primary cta-4">{{ $total_categories }}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="user" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">CUSTOMERS</div>
                    <div class="text-primary cta-4">{{ $total_customers }}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="arrow-top-left" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">PRODUCTS</div>
                    <div class="text-primary cta-4">{{ $total_products }}</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-md-4 col-lg-2">
                <div class="card h-100 hover-scale-up cursor-pointer">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                      <i data-cs-icon="message" class="text-primary"></i>
                    </div>
                    <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">COMMENTS</div>
                    <div class="text-primary cta-4">{{ $total_comments }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Stats End -->
      <div class="row">
        <h1>{{ __('Order List Table') }}</h1>
        <div class="col-8">
            <div class="table-responsive my-4">
                <table id="dataTable" class="table table-bordered table-striped dataTable_length">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">View Details</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Subtotal(BDT)</th>
                            {{-- <th scope="col">Discount</th> --}}
                            <th scope="col">Total(BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td> {{ $orders->firstItem()+$loop->index }} </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $order->id }}">Order Details</button>
                                <div class="modal fade" id="modal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $order->id }}Title" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 800px;">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="#modal{{ $order->id }}Title">Order Number #{{ $order->id }}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-striped table-inverse table-responsive">
                                                            <thead class="thead-inverse">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Unit Price(BDT)</th>
                                                                    <th>Sub total(BDT)</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($order->orderDetails as $item)
                                                                    <tr>
                                                                        <td>{{ $loop->index+1 }}</td>
                                                                        <td>{{ $item->product->name}}</td>
                                                                        <td>{{ $item->product_qty }}</td>
                                                                        <td>{{ $item->product_price }}</td>
                                                                        <td>{{ $item->product_price*$item->product_qty }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    <tr class="mb-5">
                                                                        <td colspan="4">
                                                                            Total Payable Amount:
                                                                        </td>
                                                                        <td><strong class="fw-bold text-danger"> ৳{{ $order->total }}</strong></td>
                                                                    </tr>
                                                                    <tr class="mt-5">
                                                                        <td colspan="50">
                                                                            <p class="text-primary">Billing Address:</p>
                                                                            <p>Recipent Name: {{ $order->billing->name }}</p>
                                                                            <p>Mobile Number: {{ $order->billing->phone_number}}</p>
                                                                            <p>Address: {{ $order->billing->address }}</p>
                                                                            <p>Upazila: {{ $order->billing->upazila->name }},</p>
                                                                            <p>Distrcit: {{ $order->billing->district->name }}</p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->created_at->format('d-M-Y H:i:s') }}</td>
                            <td>{{ $order->sub_total }}</td>
                            {{-- <td>{{ $order->discount_amount }}({{ $order->coupon_name }})</td> --}}
                            <td>{{ $order->total }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="50">
                                <p class="text-center">No order Found !!!</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-4">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['2020', '2021', '2022', '2023'],
            datasets: [{
                label: '# of Orders',
                data: <?php echo json_encode($order_yearwise); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    // 'rgba(75, 192, 192, 0.2)',
                    // 'rgba(255, 159, 64, 0.2)',
                    // 'rgba(55, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    // 'rgba(75, 192, 192, 1)',
                    // 'rgba(255, 159, 64, 1)',
                    // 'rgba(55, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endpush
