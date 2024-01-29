@extends('layouts.master')
@section('title')
    Klub/Tim
@endsection
@section('content')
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Daftar Klub Sepak Bola</h1>
        <p class="text-lg text-slate-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore
            deleniti recusandae ut dolor voluptatibus ratione provident praesentium eum necessitatibus minima?</p>
    </div>

    <div class="w-full lg:w-8/12 mx-auto mt-12">
        <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2.5 ml-3"
            type="button">
            Tambah Klub
        </button>
        <div class="p-6 bg-transparent border border-slate-200 rounded-xl lg:rounded-3xl">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-transparent dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Klub/Tim
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Provinsi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kota/Kab
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">#</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($clubs as $club)
                            <tr class="bg-transparent border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $no++ }}
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $club->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ Str::title(Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/province/' . $club->province_id . '.json')['name']) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::title(Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/regency/' . $club->regency_id . '.json')['name']) }}
                                </td>
                                <td class="px-6 py-4">
                                    $2999
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10">Belum ada data Klub</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Main modal -->
    <div id="create-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-2xl shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Form Tambah Klub
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white close"
                        data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="/klub" method="post" id="create-form">
                        @csrf
                        <div class="mb-4">
                            <label for="name" id="label-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Klub/Tim</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukan nama klub" autocomplete="off">
                            <p class="feedback-invalid" id="feedback-name"></p>
                        </div>
                        <div class="mb-4">
                            <label for="provinsi" id="label-provinsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Provinsi</label>
                            <select name="provinsi" id="provinsi" class="provinsi" style="width: 100%;">
                            </select>
                            <p class="feedback-invalid" id="feedback-provinsi"></p>
                        </div>
                        <div class="mb-4">
                            <label for="kota" id="label-kota"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Kota</label>
                            <select name="kota" id="kota" class="kota" style="width: 100%;">
                            </select>
                            <p class="feedback-invalid" id="feedback-kota"></p>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 mb-4 btn-create">Simpan</button>
                        <button type="button" data-modal-hide="create-modal"
                            class="w-full text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 close">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-head')
    <link href="/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush

@push('scripts-body')
    <script src="/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {

            // default
            $(".kota").prop('disabled', true)
            $(".kota").select2({
                placeholder: 'Pilih Kab/Kota'
            });

            // fetch data provinsi
            $('#provinsi').select2({
                dropdownParent: $('#create-modal'),
                delay: 250,
                placeholder: "Pilih Provinsi",
                ajax: {
                    type: "GET",
                    url: '/wilayah/provinces',
                    dataType: 'json',
                    processResults: function(data, page) {
                        return {
                            results: $.map(data, (item) => {
                                return {
                                    text: item.name,
                                    id: item.id,
                                }
                            })
                        };
                    },
                    cache: false
                }
            });



            // fetch data kab/kota
            $(".provinsi").on('change', function() {
                let id = $(this).val();
                $('#kota').prop('disabled', false);
                $('#kota').val('').trigger('change');
                $('#kota').select2({
                    dropdownParent: $('#create-modal'),
                    delay: 250,
                    placeholder: "Pilih Kab/Kota",
                    ajax: {
                        type: "GET",
                        url: '/wilayah/regencies',
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                id: id
                            }

                            // Query parameters will be ?search=[term]&type=public
                            return query;
                        },
                        processResults: function(data, page) {
                            return {
                                results: $.map(data, (item) => {
                                    return {
                                        text: item.name,
                                        id: item.id,
                                    }
                                })
                            };
                        },
                    }
                });
            });

            // close modal
            $(".close").click(function() {
                $("#create-form").trigger("reset")
                $(':input').removeClass('is-invalid')
                $('label').removeClass('label-feedback-invalid')
                $('.feedback-invalid').text('')
                $("select").val('').trigger('change')
            })

            // create data
            $('#create-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $(".btn-create").prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(res) {
                        if (res.status === false) {
                            if (res.data.name) {
                                $("#name").addClass('is-invalid')
                                $("#feedback-name").text(res.data.name)
                                $("#label-name").addClass('label-feedback-invalid')
                            } else {
                                $("#name").removeClass('is-invalid')
                                $("#feedback-name").text('')
                                $("#label-name").removeClass('label-feedback-invalid')
                            }
                            if (res.data.provinsi) {
                                $("#provinsi").addClass('is-invalid')
                                $("#feedback-provinsi").text(res.data.provinsi)
                                $("#label-provinsi").addClass('label-feedback-invalid')
                            } else {
                                $("#provinsi").removeClass('is-invalid')
                                $("#feedback-provinsi").text('')
                                $("#label-provinsi").removeClass('label-feedback-invalid')
                            }
                            if (res.data.kota) {
                                $("#kota").addClass('is-invalid')
                                $("#feedback-kota").text(res.data.kota)
                                $("#label-kota").addClass('label-feedback-invalid')
                            } else {
                                $("#kota").removeClass('is-invalid')
                                $("#feedback-kota").text('')
                                $("#label-kota").removeClass('label-feedback-invalid')
                            }
                        } else {
                            $(".close").click()
                            Swal.fire({
                                title: "Success!",
                                html: `Klub <span class="font-bold">${res.data.name}</span> Telah Ditambahkan`,
                                icon: "success"
                            }).then(result => {

                                window.location.reload();
                            });
                        }
                    },
                    complete: function() {
                        $(".btn-create").prop('disabled', false).text('Simpan');
                    },
                    error: function(data) {
                        console.log(data.status + ':' + data.statusText, data.responseText);
                    },
                })
            })
        });
    </script>
@endpush
