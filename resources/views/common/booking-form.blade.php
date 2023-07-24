<div class="bg-white shadow" style="padding: 10px;">
    <form method="post" action="{{ url('check-availability') }}" >
        @csrf
        <div class="row g-2">
            <div class="col-md-10">
                
                    <div class="row g-2">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="CHECKIN">
                                <label for="name">CHECKIN</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="CHECKOUT">
                                <label for="name">CHECKOUT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name"  name="total_guest" placeholder="Enter total guests">
                                <label for="name">ENTER TOTAL GUEST</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" id="select2">
                                    @foreach(get_hotels() as $hotel)
                                    <option >{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                                <label for="select2">Select Hotel</label>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 py-3">Submit</button>
            </div>
        </div>
    </form>
</div>
