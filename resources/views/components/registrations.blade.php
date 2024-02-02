<section id="table">

    <div class="table-head">
        <div class="title">
            <h2>Registrations <span>({{ $count }})</span></h2>
            <p>Seats Booked: {{ $totalTickets }}</p>
        </div>
        <div class="fund">
            <p>Fund Received:</p>
            <p class="stars">•••••••</p>
            <p class="hidden-text invisible">৳ {{$totalFund}}</p>
            <button class="visibility-btn">
                <i class="fa-regular fa-eye-slash eye"></i>
            </button>
        </div>
        <div class="search">
            <input type="text" id="search" placeholder="Search">
        </div>

    </div>
    <hr>
    <div class="table-body">
        <div class="row head">
            <div class="cell c1">Reg No.</div>
            <div class="cell c2">Name</div>
            <div class="cell c3">Seats</div>
            <div class="cell c4 hide">Contact No.</div>
            <div class="cell c5 hide">District</div>
            <div class="cell c6 hide">
                Amount Paid
                <p class="small">Date - Time</p>
            </div>
            <div class="cell c7 hide">
                bKash No.
                <p class="small">Transaction ID</p>
            </div>
        </div>
        <div class="search" id="data-rows">
            <x-search-rows :entries="$entries" :count="$count" :totalTickets="$totalTickets" />
        </div>
    </div>
    <div class="table-foot">

    </div>
</section>