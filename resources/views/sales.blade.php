@extends('sidebars')
@section('sets')
          <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{$itemsold}}</p>
              <p>Items sold</p>
            </div>
          </div>
          <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">₱{{$salesgot}}</p>
              <p>Sales</p>
            </div>
          </div>
          <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">₱{{$totalProfit}}</p>
              <p>Profit</p>
            </div>
          </div>
@endsection
@section('content')
<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="flex justify-start">
                    <div class="relative inline-block text-left ml-4">
                        <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" id="dropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Today
                        </button>
                        <ul class="dropdown-menu absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 m-0 bg-clip-padding border-none" aria-labelledby="dropdownButton">
                            <li>
                                <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="sales-week">This week</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="sales-month">This month</a>
                            </li>
                        </ul>
                    </div>
                </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
    <tr>
        <th scope="col" class="px-6 py-3 text-center">
            Product name
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            Quantity
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            Price
        </th>
        <th scope="col" class="px-6 py-3 text-center">
            Total
        </th>
    </tr>
</thead>
        <tbody>
            @if($sales->count() > 0)
            @foreach($sales as $sale)
            <tr class="bg-blue-500 border-b border-blue-400" >
                <td class = "px-6 py-3 text-center text-blue-50 font-medium">{{$sale->item_from->item_name}}</td>
                <td class = "px-6 py-3 text-center text-blue-50 font-medium">{{$sale->quantity}}</td>
                <td class = "px-6 py-3 text-center text-blue-50 font-medium">{{$sale->item_from->retails_price}}</td>
                <td class = "px-6 py-3 text-center text-blue-50 font-medium">{{$sale->total}}</td>
            </tr>
            @endforeach
            @else
            <tr class="bg-blue-500 border-b border-blue-400" >
                <td class = "px-6 py-3 text-center text-blue-50 font-medium"  colspan="4">No Items Found</td>
            </tr>
            @endif
            
        </tbody>
    </table>
</div>

                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection