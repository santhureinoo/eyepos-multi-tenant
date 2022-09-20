<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container w-[32rem]">
    <!-- Receipt Header Section -->
    <h1 class="text-3xl text-gray-400">Receipt</h1>
    <div class="flex flex-col">
        <span class="font-bold text-lg">Eyeviser Pte Ltd</span>
        <span>22 SIN MING LANE e06-76
            <br />
            MidView City
        </span>
        <span class="pt-2">
            SG 23123123
        </span>
    </div>
    {{-- Receipt No: Rec-1
<br>
Receipt Date: 19/05/2022
<br><br>
Description: Description
<br><br> --}}
    <!-- Bill/Receipt Section -->
    <div class="flex justify-between">
        <span>a</span>
        <span>b</span>
    </div>
    <table class="border-collapse border border-slate-500">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-slate-600 w-48 text-left">Product</th>
                <th class="border border-slate-600 w-64 text-left">Category</th>
                <th class="border border-slate-600 w-24 text-right">Brand</th>
                <th class="border border-slate-600 w-32 text-right">Qty</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td  class="border border-slate-600">Service Name</td>
                <td  class="border border-slate-600">Service</td>
                <td  class="border border-slate-600">-</td>
                <td  class="border border-slate-600">1</td>
            </tr>
            <tr>
                <td  class="border border-slate-600">Service Name</td>
                <td  class="border border-slate-600">Service</td>
                <td  class="border border-slate-600">-</td>
                <td  class="border border-slate-600">1</td>
            </tr>
            <tr>
                <td  class="border border-slate-600">Service Name</td>
                <td  class="border border-slate-600">Service</td>
                <td  class="border border-slate-600">-</td>
                <td  class="border border-slate-600">1</td>
            </tr>
            <tr>
                <td  class="border border-slate-600">Service Name</td>
                <td  class="border border-slate-600">Service</td>
                <td  class="border border-slate-600">-</td>
                <td  class="border border-slate-600">1</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Totals: </td>
                <td>total</td>
            </tr>
        </tbody>
    </table>
</div>
