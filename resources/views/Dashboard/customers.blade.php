<x-admin-header title="Customers"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-2">Our Customers</p>

                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>#.</th>
                          <th>Full Name</th>
                          <th>Picture</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Registration Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach($ourCustomers as $item)
                        @php
                        $i++;
                         @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->username }}</td>
                                <td><img src="{{ URL::asset('uploads/profiles/'.$item->picture) }}" width="100px"></td>
                                <td>{{ $item->email }}</td>
                                <td class="font-weight-bold">{{ $item->type }}</td>
                                <td class="font-weight-medium">{{ $item->created_at }}</td>
                                <td class="font-weight-medium">{{ $item->status }}</td>
                                @if($item->status=='Active')
                                  <td><a href="{{URL::to('changeUserStatus/Blocked/'.$item->id)}}" class="btn btn-danger">Block</a></td>
                                @else
                                 <td><a href="{{URL::to('changeUserStatus/Active/'.$item->id)}}" class="btn btn-success">UnBlock</a></td>
                                 @endif
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