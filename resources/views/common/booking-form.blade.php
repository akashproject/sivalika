<div class="bg-white shadow" style="padding: 10px;">
    <form method="post" action="{{ url('check-availability') }}" >
        @csrf
        <div class="row g-2">
            <div class="col-md-10">
                
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="t-datepicker">
                                <div class="t-check-in"></div>
                                <div class="t-check-out"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name"  name="total_guest" placeholder="Enter total guests" value="2" >
                                <label for="name">ENTER TOTAL GUEST</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" id="select2" name="hotel">
                                    @foreach(get_hotels() as $hotel)
                                    <option value="{{ $hotel->id }}" >{{ $hotel->name }}</option>
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
