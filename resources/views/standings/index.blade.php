@extends('layouts.master')
@section('title')
Klasemen
@endsection
@section('content')
<div class="max-w-3xl text-center mx-auto">
  <h1 class="text-4xl font-bold mb-4">Klasemen Sementara Liga Empat Lima</h1>
  <p class="text-lg text-slate-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
      deleniti recusandae ut dolor voluptatibus ratione provident praesentium eum necessitatibus minima?</p>
</div>
<div class="w-full p-6 bg-transparent border border-slate-200 rounded-xl lg:rounded-3xl mt-12">
  <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-transparent dark:bg-gray-700 dark:text-gray-400">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      No
                  </th>
                  <th scope="col" class="px-6 py-3">
                     Club
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Main
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Menang
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Kalah
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Seri
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Gol Menang
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Gol Kalah
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Poin
                  </th>
              </tr>
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @forelse ($standings as $item)
                
            <tr class="bg-slate-50 border-b hover:bg-slate-100/40 dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    {{ $no++ }}
                </td>
                <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item->club->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $item->playing_games }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->wins }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->losses }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->draws }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->goals_wins }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->goals_losses }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->points }}
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="12" class="py-10 text-center">Belum ada data</td>
                </tr>
            @endforelse
          </tbody>
      </table>
  </div>

</div>
@endsection
    