@extends('layouts.master')
@section('title')
    create match
@endsection
@section('content')
    <div class="md:w-9/12 mx-auto alert-error" hidden>
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Ada bebrapa validasi yang harus diselesaikan:</span>
                <ul class="mt-1.5 list-disc list-inside error">

                </ul>
            </div>
        </div>
    </div>

    <form action="/match" method="post" id="create-form">
        @csrf
        <div class="card w-full lg:w-9/12 mx-auto my-8">
            <div class="flex flex-col md:flex-row flex-wrap gap-x-4 justify-center">
                <div class="flex w-full md:w-[42%] gap-x-4 justify-center">
                    <div class="mb-4 w-9/12">
                        <label for="klub" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klub
                            Home</label>
                        <select id="klub" name="klub[0][home]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected hidden>Pilih Klub</option>
                            @foreach ($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                        <p class="feedback-invalid" id="feedback-home"></p>
                    </div>
                    <div class="mb-4 w-3/12">
                        <label for="score-home" id="label-score-home"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Score</label>
                        <input type="text" name="klub[0][score-home]" id="score-home"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="" autocomplete="off" value="">
                        <p class="feedback-invalid" id="feedback-score-home"></p>
                    </div>
                </div>
                <span
                    class="bg-blue-100 self-center text-blue-700 text-sm font-medium  px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Match</span>
                <div class="flex w-full md:w-[42%] gap-x-4 flex-row-reverse md:flex-row justify-center">

                    <div class="mb-4 w-3/12">
                        <label for="score-away" id="label-score-away"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Score</label>
                        <input type="text" name="klub[0][score-away]" id="score-away"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="" autocomplete="off" value="">
                        <p class="feedback-invalid" id="feedback-score-away"></p>
                    </div>
                    <div class="mb-4 w-9/12">

                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klub
                            Away</label>
                        <select id="countries" name="klub[0][away]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected hidden>Pilih Klub</option>
                            @foreach ($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>

                        <p class="feedback-invalid" id="feedback-away"></p>
                    </div>
                </div>

            </div>
        </div>


        <div class="wrapper-paste"></div>

        <div class="mt-3 w-full md:w-9/12 mx-auto flex items-center">

            <button id="btn-copy"
                class="flex-inline text-gray-800 bg-gray-200 hover:bg-gray-300/50 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center dark:bg-gray-200 dark:hover:bg-gray-300 dark:focus:ring-gray-800 mb-2.5 ml-3"
                type="button">
                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </button>
            <button
                class="flex-inline text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-2.5 ml-3 btn-store"
                type="submit">
                Simpan
            </button>
        </div>
    </form>
@endsection

@push('scripts-head')
    <link href="/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush

@push('scripts-body')
    <script src="/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {


            //dynamic field
            var maxFiled = 100; //maksimal untuk menambbahakan field
            var btnCopy = $("#btn-copy");
            var wrapper = $(".wrapper-paste");

            ' <div class="card  w-full lg:w-9/12 mx-auto mt-10"><div class="flex flex-col md:flex-row flex-wrap gap-x-4 justify-center "><div class="flex w-full md:w-[42%] gap-x-4 justify-center"><div class="mb-4 w-9/12"><label for="klub" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select anoption</label><select id="klub" name="home[][home]"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><option selected>Choose a country</option><option value="US">United States</option><option value="CA">Canada</option><option value="FR">France</option><option value="DE">Germany</option></select><p class="feedback-invalid" id="feedback-home"></p></div><div class="mb-4 w-3/12"> <label for="score-home" id="label-score-home" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label><input type="text" name="home[][score-home]" id="score-home"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"placeholder="" autocomplete="off" value=""><p class="feedback-invalid" id="feedback-score-home"></p> </div> </div> <span class="bg-green-100 self-center text-green-800 text-sm font-medium  px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Match</span><div class="flex w-full md:w-[42%] gap-x-4 flex-row-reverse md:flex-row justify-center"><div class="mb-4 w-3/12"><label for="score-away" id="label-score-away"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label><input type="text" name="away[][score-away]" id="score-away" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"placeholder="" autocomplete="off" value=""><p class="feedback-invalid" id="feedback-score-away"></p></div><div class="mb-4 w-9/12"><label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectan option</label><select id="countries" name="away[][away]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><option selected>Choose a country</option><option value="US">United States</option><option value="CA">Canada</option><option value="FR">France</option><option value="DE">Germany</option></select><p class="feedback-invalid" id="feedback-away"></p></div></div></div></div>';
            var x = 0; //dimulai dari 0

            $(btnCopy).click(function() {
                if (x < maxFiled) {
                    x++;
                    $(wrapper).append(
                        '<div class="card w-full lg:w-9/12 mx-auto my-8 field-copy"><div class="flex flex-col md:flex-row flex-wrap gap-x-4 justify-center"><div class="flex w-full md:w-[42%] gap-x-4 justify-center"><div class="mb-4 w-9/12"><label for="klub" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klub Home</label><select id="klub" name=\"klub[' +
                        x +
                        '][home]\"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><option value="" selected hidden>Pilih Klub</option>@foreach ($clubs as $club)<option value="{{ $club->id }}">{{ $club->name }}</option>@endforeach</select><p class="feedback-invalid" id="feedback-home"></p></div><div class="mb-4 w-3/12"> <label for="score-home" id="label-score-home" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label><input type="text" name="\klub[' +
                        x +
                        '][score-home]\" id="score-home"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"placeholder="0" autocomplete="off"><p class="feedback-invalid" id="feedback-score-home"></p> </div> </div> <span class="bg-green-100 self-center text-green-800 text-sm font-medium  px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Match</span><div class="flex w-full md:w-[42%] gap-x-4 flex-row-reverse md:flex-row justify-center"><div class="mb-4 w-3/12"><label for="score-away" id="label-score-away"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Score</label><input type="text" name="\klub[' +
                        x +
                        '][score-away]\" id="score-away" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"placeholder="0" autocomplete="off" value=""><p class="feedback-invalid" id="feedback-score-away"></p></div><div class="mb-4 w-9/12"><label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klub Away</label><select id="countries" name="\klub[' +
                        x +
                        '][away]\" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><option value="" selected hidden>Pilih Klub</option>@foreach ($clubs as $club) <option value="{{ $club->id }}">{{ $club->name }}</option>@endforeach</select><p class="feedback-invalid" id="feedback-away"></p></div></div>  <button class="remove_copy" type="button"><svg class="w-6 h-6 text-red-500/80 dark:text-white hover:text-red-400/90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/></svg></button></div></div>'
                    );
                    $(".count").val(x);
                } else {
                    alert('maskimal 100 field, silahkan disimpan dulu yaa');
                }
            })


            // proses store data
            $("#create-form").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '/match',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        $(".btn-store").prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(res) {
                        if (res.error) {
                            $(".alert-error").show() //tampilkan alert error
                            $(".error").html('')
                            res.error.map((item) => {
                                var error = '<li>' + item +
                                    '</li>' //dapatkan kesalahannya dari validasi
                                $(".error").append(error)
                            })
                        } else {
                            Swal.fire({
                                title: "Success!",
                                html: `Match terbaru Telah Ditambahkan`,
                                icon: "success"
                            }).then(result => {

                                window.location.href = '/match';
                            });
                        }

                    },
                    complete:function(){
                        $(".btn-store").prop('disabled', false).text('Simpan');
                    },
                    error: function(data) {
                        console.log(data.status + ':' + data.statusText, data.responseText);
                    },
                })
            })



            // {{-- remove form --}}
            $('body').on('click', '.remove_copy', function(e) {
                e.preventDefault();
                $(this).closest('.field-copy').remove();
                x--;
            });

        })
    </script>
@endpush
