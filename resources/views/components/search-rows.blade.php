@if (!$count) <div class="row">
  <div class="cell">No entries found</div>
</div>
@else
@foreach ($entries as $entry)
@unless (is_null($entry->reg_no))
<div class="row">
  <div class="cell c1">{{$entry->reg_no}}</div>
  <div class="cell c2">
    <a href="tel:+88{{$entry->phone}}">
      {{$entry->name}}
    </a>
  </div>
  <div class="cell c3">{{$entry->tickets}}</div>
  <div class="cell c4 hide">
    <a href="tel:+88{{$entry->phone}}">
      {{$entry->phone}}
    </a>
  </div>
  <div class=" cell c5 hide">{{$entry->district}}
  </div>
  <div class="cell c6 hide">
    ৳ {{$entry->amount}}
    <p class="small">{{$entry->created_at->format('d M Y - h:i A')}}</p>
  </div>
  <div class="cell c7 hide">
    {{$entry->bkash_number}}
    <p class="small">{{$entry->trx_id}}</p>
  </div>
  {{-- <div class="cell hide"></div> --}}
</div>
@endunless
@endforeach
@endif