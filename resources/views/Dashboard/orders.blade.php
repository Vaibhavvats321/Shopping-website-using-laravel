<x-admin-header title="Orders"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-2">Our Orders</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Customer</th>
                          {{-- <th>Email</th>
                          <th>Customer Status</th> --}}
                          <th>Bill</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date</th>
                          <th>Ordered Products</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($ourOrders as $item)
                        @php
                        $i++;
                         @endphp
                            <tr>
                                <td>{{ $item->fullname }}</td>
                                {{-- <td>{{ $item->email }}</td>
                                <td class="text-info">{{ $item->userStatus }}</td> --}}
                                <td>$ {{ $item->bill }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td class="font-weight-medium"><div class="badge badge-success">{{ $item->status }}</div></td>
                                <td class="font-weight-medium"><div class="badge badge-info">{{ $item->created_at }}</div></td>
                                <td class="font-weight-medium">
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateModal{{ $i }}">
                                    Product
                                  </button>
                                  <!-- The Modal -->
                                  <div class="modal" id="UpdateModal{{ $i }}">
                                      <div class="modal-dialog">
                                      <div class="modal-content">
                                  
                                          <!-- Modal Header -->
                                          <div class="modal-header">
                                          <h4 class="modal-title">Ordered Product</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                  
                                          <!-- Modal body -->
                                          <div class="modal-body">
                                              <table class="table table-responsive">
                                                <thead>
                                                  <tr>
                                                    <th>Products</th>
                                                    <th>Picture</th>
                                                    <th>Price/Item</th>
                                                    <th>Quantity</th>
                                                    <th>Sub Total</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($orderItem as $oitem)
                                                    @if($oitem->orderId == $item->id)
                                                      <tr>
                                                        <td>{{ $oitem->title }}</td>
                                                        <td><img src="{{ URL::asset('uploads/products/'.$oitem->picture) }}" width="100px"></td>
                                                        <td>$ {{ $oitem->price }}</td>
                                                        <td> {{ $oitem->quantity }}</td>
                                                        <td>$ {{ $oitem->price*$oitem->quantity }}</td>
                                                      </tr>
                                                    @endif
                                                  @endforeach
                                                </tbody>
                                              </table>
                                          </div>
                                  
                                          
                                  
                                      </div>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                  @if($item->status=="Paid")
                                    <a href="{{URL::to('changeOrderStatus/Accepted/'.$item->id)}}" class="btn btn-success">Accept</a>
                                    <a href="{{URL::to('changeOrderStatus/Rejected/'.$item->id)}}" class="btn btn-danger">Reject</a>
                                  @elseif($item->status=="Accepted")
                                    <a href="{{URL::to('changeOrderStatus/Delivered/'.$item->id)}}" class="btn btn-success">Complete</a>
                                  @elseif($item->status=="Delivered")
                                    Already Completed
                                  @else
                                    <a href="{{URL::to('changeOrderStatus/Accepted/'.$item->id)}}" class="btn btn-success">Accept</a>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
 <x-admin-footer />