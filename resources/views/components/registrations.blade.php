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
            <div class="cell">Reg No.</div>
            <div class="cell">Seats</div>
            <div class="cell">Name</div>
            <div class="cell hide">Contact No.</div>
            <div class="cell hide">District</div>
            <div class="cell hide">Paid</div>
            <div class="cell hide">bKash No.</div>
            <div class="cell hide">Trx ID</div>
        </div>
        <div class="search" id="data-rows">
            <x-search-rows :entries="$entries" :count="$count" :totalTickets="$totalTickets" />
        </div>
    </div>
    <div class="table-foot">

    </div>
</section>