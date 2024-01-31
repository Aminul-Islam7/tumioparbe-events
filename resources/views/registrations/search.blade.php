@foreach ($registration as $entry)
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