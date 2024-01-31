<section id="table">

    <div class="table-head">
        <div class="title">
            <h2>Registrations <span>({{ $count }})</span></h2>
            <p>Seats Booked: {{ $totalTickets }}</p>
        </div>
        <div class="search">
            <input type="text" id="search" placeholder="Search">
        </div>
    </div>
    <hr>
    <div class="table-body">
        <div class="row head">
            <div class="cell">Reg No.</div>
            <div class="cell">Seats</div>
            <div class="cell">Name</div>
            <div class="cell">Contact No.</div>
            <div class="cell hide">District</div>
            <div class="cell hide">Paid</div>
            <div class="cell hide">bKash No.</div>
            <div class="cell hide">Trx ID</div>
        </div>
        <div id="data-rows">
            @foreach ($entries as $entry)
            @unless (is_null($entry->reg_no))
            <div class="row">
                <div class="cell">{{$entry->reg_no}}</div>
                <div class="cell">{{$entry->tickets}}</div>
                <div class="cell">{{$entry->name}}</div>
                <div class="cell">
                    <a href="tel:+88{{$entry->phone}}">
                        {{$entry->phone}}
                    </a>
                </div>
                <div class="cell hide">{{$entry->district}}</div>
                <div class="cell hide">{{$entry->amount}}</div>
                <div class="cell hide">{{$entry->bkash_number}}</div>
                <div class="cell hide">{{$entry->trx_id}}</div>
            </div>
            @endunless
            @endforeach
        </div>
    </div>
</section>