<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Merchandise Order Lists</h3>
            @if ($merchandises->count())
                <a href="" class="btn btn-outline-theme mb-3">Download Excel</a>
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered" id="dataTables">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Notes</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach ($merchandises as $merchandise)
                            <tr>
                                <th>{{$merchandise->id}}</th>
                                <td>{{$merchandise->merchandiseTransaction->name}}</td>
                                <td>{{$merchandise->merchandiseTransaction->email}}</td>
                                <td>{{$merchandise->merchandiseTransaction->phone_number}}</td>
                                <td>{{$merchandise->merchandise->name}}</td>
                                <td>{{$merchandise->quantity}} Piece(s)</td>
                                <th> 
                                    @if ($merchandise->order_details)
                                        <a href="#" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#req{{$merchandise->id}}">
                                            <i class="fa-solid fa-exclamation text-"></i>
                                        </a>
                                    @else
                                        No Notes
                                    @endif
                                </th>
                                
                                <td class="d-flex justify-content-center"> 
                                    <a href="{{route('merchandise-orders.edit', $merchandise->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                        <i class="fa fa-edit"> </i>
                                    </a>
                                    
                                    <form method="POST" action="{{route('merchandise-orders.destroy',$merchandise->id)}}">
                                        <input type="hidden" name="_method" value = "DELETE">
                                        <a  href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$merchandise->id}}">
                                        <button class="btn btn-danger rounded btn-sm" title="delete" id ="delete">
                                            <i class="fa fa-x"></i>
                                        </button>
                                        </a>
                                        @csrf
                                    </form> 
                                </td>
                            </tr>
                            
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else <hr> <p class="text-center"> No Data</p>
            @endif
        </x-card>
    </div>
    @foreach ($merchandises as $merchandise)
        <div class="modal fade p-5" id="req{{$merchandise->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <h5 class="aeo-title">{{$merchandise->merchandise->name}}</h5>
                        <h4 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">{{$merchandise->merchandiseTransaction->name}}'s Special Request </h4>
                        <hr>
                    </div>
                    <div class="body mb-3">
                         {!!$merchandise->order_details!!}
                    </div>
                    <div class="modals-footer">
                        <button type="button" class="btn btn-outline-secondary w-100 rounded-pill"  data-bs-dismiss="modal">Back</button>
                    </div>
                </div>  
            </div>
        </div> 
    @endforeach
    
</x-admin>