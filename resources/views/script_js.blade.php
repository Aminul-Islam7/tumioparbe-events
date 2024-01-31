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


  // if visibility-btn is clicked, toggle visibility of hidden-text and stars
  $('.visibility-btn').on('click', function(e) {
    e.preventDefault();
    $('.hidden-text').toggleClass('invisible');
    $('.stars').toggleClass('invisible');

    if ($('.eye').hasClass('fa-eye')) {
      $('.eye').removeClass('fa-eye');
      $('.eye').addClass('fa-eye-slash');
    } else{
      $('.eye').removeClass('fa-eye-slash');
      $('.eye').addClass('fa-eye');
    }
  });
</script>