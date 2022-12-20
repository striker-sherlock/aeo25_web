<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">{{$order->merchandiseTransaction->name}}'s Order</h3>
            <form action="{{route('merchandise-orders.update',$order->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="product" class="col-form-label">Product<span class="text-danger">*</span> </label>
                    <input type="text"  class="form-control"  name="product" id="product" value="{{$order->merchandise->name}}" disabled>
                </div> 
                <div class="form-group mb-3">
                    <label for="quantity" class="col-form-label">Quantity<span class="text-danger">*</span> </label>
                    <input type="number"  class="form-control"  name="quantity" id="quantity" value="{{$order->quantity}}" required>
                </div> 
                <div class="form-group mb-3">
                    <label for="notes" class="col-form-label">Notes<span class="text-danger">*</span> </label>
                    <textarea name="notes" id="notes"  rows="3" class="form-control">{{$order->order_details}}</textarea>
                </div> 
                <button type="submit" class="btn btn-outline-theme rounded-pill w-100">Save Changes</button>
            </form>
        </x-card>
    </div>
</x-admin>