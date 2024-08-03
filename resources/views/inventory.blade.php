@extends('sidebar')
@section('content')
<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <button class="bg-blue-500 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" data-bs-toggle="modal" data-bs-target="#additemsmodal">
                    Iventory
                </button>
 
                
                <!-- Edit Item Details Modal -->
                <div class="modal fade bd-example-modal-md " id="edititemsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Items</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                    <form id="edititemForm" action="{{route('edit.item')}}" method='Post' enctype="multipart/form-data" class="w-full max-w-lg">
                    @csrf
                    <input style='display:none' id="itemid" name='itemid' type="text"  placeholder="Fill in"required>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/0 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Item Name
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="itemname" name='itemname' type="text"  placeholder="Fill in"required>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mt-3">
                        <div class="w-full md:w-1/3 px-3  md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Quantity
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white" id="quantity" name="quantity" type="number"  placeholder="0"required>
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Wholesale Price
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 mb-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="wprice" name='wholesale' type="number" placeholder="0"required>
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Retail Price
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded mb-2 py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="rprice" name='retail' type="number"  placeholder="0"required>
                        </div>
                        
                    </div>
                    </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="editsubmitForm" type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>
                <!-- end edit item modal -->
                 

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Whole-sale price
                </th>
                <th scope="col" class="px-6 py-3">
                    Retail price
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @if($itemlist->count() > 0 )
            @foreach($itemlist as $items)
            <tr class="bg-blue-500 border-b border-blue-400">
                <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                    {{$items->item_name}}
                </th>
                <td class="px-6 py-4">
                {{$items->quantity}}
                </td>
                <td class="px-6 py-4">
                {{$items->wholesale_price}}
                </td>
                <td class="px-6 py-4">
                {{$items->retails_price}}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-white hover:underline" data-bs-toggle="modal" data-bs-target="#edititemsmodal"  data-unit='{{$items}}'>Edit</a>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="bg-blue-500 border-b border-blue-400" >
                <th class = "px-6 py-3 text-center text-blue-50 font-medium"  colspan="5">No Items Found</th>
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