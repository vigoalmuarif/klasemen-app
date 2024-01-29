@extends('layouts.master')
@section('title')
    Match
@endsection
@section('content')
    <div class="w-full md:w-6/12 mx-auto p-6 bg-transparent border border-slate-200 rounded-xl lg:rounded-3xl mt-12">
        <a href="/match/create" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2.5 ml-3">
            Tambah Match
        </a>
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption
                    class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-transparent dark:text-white dark:bg-gray-800">
                    Exhbition Match
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quae, corrupti voluptates cumque illo provident molestias laborum itaque totam atque.</p>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-transparent dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Home
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Away
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Score
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($matches as $match)
                    
                    <tr class="bg-transparent border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $match->matchHome->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $match->matchAway->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $match->home_score .' - '.$match->away_score }}
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
