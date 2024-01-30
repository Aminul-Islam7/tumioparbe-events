<x-layout>
  <main class="box">
    <h2 class="box-title">Event Registration</h2>
    <p class="action-text">Confirm your seats now!</p>
    <form class="needs-validation" action="{{ url('/bkash/create-payment') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="name-field" class="form-label">Name</label>
        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name-field" name="name" placeholder="Shamima Akter" value="{{old('name')}}" required>
        <div lang="bn" class="invalid-feedback">
          নামটি সঠিক ভাবে লিখুন।
        </div>
        <div id="nameHelp" lang="bn" class="form-text">ইংরেজিতে আপনার নাম লিখুন।</div>
      </div>
      <div class="mb-4">
        <label for="phone-field" class="form-label">Contact Number</label>
        <div class="input-group has-validation">
          <span class="input-group-text" id="addon">+88</span>
          <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone-field" name="phone" placeholder="01XXXXXXXXX" value="{{old('phone')}}" required>
        <div lang="bn" class="invalid-feedback">
          ফোন নম্বরটি সঠিক নয়।
        </div>
        </div>
        <div id="phoneHelp" lang="bn" class="form-text">আপনার ১১-ডিজিটের ফোন নম্বর লিখুন।</div>
      </div>
      <div class="mb-4">
        <label for="district-field" class="form-label">District</label>
        <input type="text" class="form-control" id="district-field" name="district" placeholder="Dhaka" value="{{old('district')}}">
        <div lang="bn" class="invalid-feedback">
          জেলার নামটি সঠিক ভাবে লিখুন।
        </div>
        <div id="districtHelp" lang="bn" class="form-text">আপনি কোন জেলায় থাকেন?</div>
      </div>

      <div class="mb-4">
        
        <div id="ticket-input">
          <label for="tickets-field" class="form-label">Tickets:</label>
          <input type="number" @error('tickets') style="border: 2px solid #DC3534" @enderror id="tickets-field" name="tickets" value="{{old('tickets', '2')}}" min="1" required>
          <button type="button" id="increment"><i class="fa-solid fa-plus"></i></button>
          <button type="button" id="decrement"><i class="fa-solid fa-minus"></i></button>
          <p class="ticket-price">
            {{-- Seats: <span id="totalSeats"></span>
            <br> --}}
            ৳ <span id="totalPrice"></span>
          </p>
        </div>
        @error('tickets')
          <div lang="bn" class="mt-1" style="color:#DC3534;font-size:14px"> {{ $message }}</div>
        @enderror

        
        <div id="districtHelp" lang="bn" class="form-text">আপনি কয়টি সিট বুক করতে চান?</div>
      </div>

      

      <button type="submit" id="pay-button" class="btn">
        <img src="{{asset('images/bkash-logo.png')}}" alt="bkash">
        Pay now
        <i class="fa-solid fa-angle-right"></i>
      </button>
    </form>
  </main>
</x-layout>
