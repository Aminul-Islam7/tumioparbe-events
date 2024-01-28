<x-layout>

  <section id="home">
    <div class="container">
      <img class="logo" src="{{asset('images/logo.png')}}" alt="Tumio Parbe">
      <h1 class="title">
        Annual Awards Ceremony
        <br>
        & Cultural Function 2024
      </h1>
      <main class="registration-form">
        <h2 class="form-title">Event Registration</h2>
        <p class="action-text">Confirm your seats now!</p>
        <form class="needs-validation" action="/" method="POST">
          @csrf
          <div class="mb-4">
            <label for="name-field" class="form-label">Name</label>
            <input type="text" class="form-control" id="name-field" name="name" placeholder="Shamima Akter" required>
            <div id="nameHelp" lang="bn" class="form-text">ইংরেজিতে আপনার নাম লিখুন।</div>
          </div>
          <div class="mb-4">
            <label for="phone-field" class="form-label">Phone Number</label>
            <div class="input-group has-validation">
              <span class="input-group-text" id="addon">+88</span>
              <input type="number" class="form-control" id="phone-field" name="phone" placeholder="01XXXXXXXXX" required>
            <div class="invalid-feedback">
              ফোন নম্বরটি সঠিক নয়।
            </div>
            </div>
            <div id="phoneHelp" lang="bn" class="form-text">আপনার ১১-ডিজিটের ফোন নম্বর ইংরেজিতে লিখুন।</div>
          </div>
          <div class="mb-4">
            <label for="district-field" class="form-label">District</label>
            <input type="text" class="form-control" id="district-field" name="district" placeholder="Dhaka" required>
            <div id="districtHelp" lang="bn" class="form-text">আপনি কোন জেলায় থাকেন?</div>
          </div>

          <div class="mb-4">
            
            <div id="ticket-input">
              <label for="tickets-field" class="form-label">Tickets:</label>
              <input type="number" class="" id="tickets-field" name="tickets" value="2" min="1" required>
              <button type="button" id="increment"><i class="fa-solid fa-plus"></i></button>
              <button type="button" id="decrement"><i class="fa-solid fa-minus"></i></button>
            </div>
            <div id="districtHelp" lang="bn" class="form-text">আপনি কয়টি সিট বুক করতে চান?</div>
          </div>

          <p class="ticket-price mb-3">
            {{-- Seats: <span id="totalSeats"></span>
            <br> --}}
            Total Price: ৳ <span id="totalPrice"></span>
          </p>

          <button type="submit" id="pay-button" class="btn">
            <img src="{{asset('images/bkash-logo.png')}}" alt="bkash">
            Pay now
          </button>
        </form>
      </main>
    </div>
  </section>
</x-layout>
