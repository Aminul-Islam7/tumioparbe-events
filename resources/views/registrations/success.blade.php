@php

use Rakibhstu\Banglanumber\NumberToBangla;

$numTo = new NumberToBangla();

$seats = $numTo->bnNum($tickets);

@endphp

<x-layout>
  <main class="box">
    <h2 class="box-title">Registration Successful!</h2>
    <p class="action-text">Transaction ID: {{ $trxID }}</p>

    <div class="info">
      <p lang="bn" class="info-text">
        ধন্যবাদ।
        <br>
        আমরা আপনার পেমেন্ট রিসিভ করেছি।
        <br>
        আপনাদের জন্য <strong>{{ $seats }} টি সিট</strong> বরাদ্দ করা হয়েছে।
      </p>

      <p class="reg-num">
        Registration No: {{ $regNo }}
      </p>

      <p lang="bn" class="info-text">
        রেজিস্ট্রেশান নম্বরটি সংরক্ষণ করুন। এটি আপনাকে SMS এর মাধ্যমেও পাঠিয়ে দেওয়া হবে।
      </p>
    </div>

  </main>
</x-layout>
