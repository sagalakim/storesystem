@extends('sidebar')
@section('content')
<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                @if(session('success'))
                  @if(is_array(session('success')))
                      <div class="alert alert-danger text-center" style="margin-bottom:-20px; height:auto;">
                          <ul>
                              @foreach(session('success') as $success)
                                  <li>Out of Stock {{ $success }},</li>
                              @endforeach
                          </ul>
                      </div>
                  @else
                      <div class="alert alert-danger text-center" style="margin-bottom:-20px; height:10px;">
                          <p style="margin-top:-12px;">{{ session('success') }}<p>
                      </div>
                  @endif
                @endif
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
<form action="{{route('submitsolditems')}}" method="Post" enctype="multipart/form-data" class="w-full max-w-lg mx-auto">
  @csrf
  <div id="row" class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Item Name
      </label>
      <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="search" name="item[]" type="text" placeholder="Type..">
    </div>
    <div class="w-full md:w-1/2 px-3 mb-5">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Quantity
      </label>
      <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" name='quantity[]' type="text" placeholder="Doe">
    </div>
  </div>

</div>
<div class="text-right mt-4">
  <table>
  <thead>
    <tr>
      <th>
        <a href="javascript:void(0)" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded addRow">+</a>
      </th>
      <th>
        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" type='submit'>
          Submit
        </button>
      </th>
    </tr>
  </thead>
</table>
</form>
</div>

                </div>
                
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<script>
    $('thead').on('click', '.addRow', function(){
        var tr = '<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 border-t border-black text-center">' +
        '<a id="deleteRow" href="javascript:void(0)" class="btn btn-danger" style="margin-top:10px;margin-bottom:10px;">remove</a>'+
      '<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">Item Name</label>' +
      '<input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="search" name="item[]" type="text" placeholder="Type..">' +
      '<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Quantity</label>' +
      '<input required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" name="quantity[]" type="text" placeholder="Doe">' +
    '</div>'
        
        $('#row').append(tr);

        $('#row').find('input[name="item[]"]').last().typeahead({
            source: function(query,process){
                return $.get(route, {
                    query: query
                }, function (data){
                    return process(data);
                });
            }
        });
    });

    $('#row').on('click', '#deleteRow', function(){
        $(this).closest('.w-full').remove();
    })
</script>

<script type='text/javascript'>
  var route = "{{url('search-item')}}";
  $('#search').typeahead({
    source: function(query,process){
      return $.get(route, {
        query: query
      }, function (data){
        return process(data);
      });
    }
  });
</script>
@endsection