<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

<script>
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
  
  $('#search').on('keyup', function(e) {
    e.preventDefault();
    let value = $(this).val();
    $.ajax({
      method: 'GET',
      url: '{{ route("search-entry") }}',
      data: {
        'search_string': value
      },
      success: function(data) {
        $('#data-rows').html(data);
      }
    });
  });
</script>