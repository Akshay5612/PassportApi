
<!DOCTYPE html>
<html lang="en">
<head>
  <title>test</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="jquery-3.7.1.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container">
            
  <table class="table" id="editableTable">
    <thead>
      <tr>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
      <tr data-id="{{$item->id}}">
          <td name="id" class="update_record" data-pk="{{$item->id}}" >{{$item->id}}</td>
          <td name="name" class="update_record" data-pk="{{$item->id}}" >{{$item->name}}</td>
          <td>
              <select class="product-dropdown update-age" data-product-id="{{ $item->id }}" name="age">
                  <option value="{{$item->age}}">{{$item->age}}</option>
                  <option value="35">35</option>
                  <option value="29">29</option>
              </select>
          </td>
      </tr>
  @endforeach
    </tbody>
  </table>

  <script>
  $(document).ready(function () {
    $('.update-age').change(function () {
        var selectedAge = $(this).val();
        var userId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: "{{ route('update.user.age') }}",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // Use dynamic retrieval of CSRF token
                userId: userId,
                selectedAge: selectedAge
            },
            success: function (data) {
                console.log('User age updated successfully');
            },
            error: function (error) {
                console.log('Error updating user age');
            }
        });
    });
});

</script>

  <script>
     $(document).ready(function () {
        // Set up CSRF token for Ajax requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $('.update_record').editable({
         url: "{{ route('update') }}",
         type:'text',
         name:'name',
         pk:1,
         title: 'Enter Field'
       });
       
    });
</script>
      



</div>

</body>
</html>
