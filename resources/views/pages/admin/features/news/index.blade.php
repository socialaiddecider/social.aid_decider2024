@extends('layouts.admin.sidebar')

@section('contents-admin')
    <section class="berita py-6 px-8 overflow-y-auto no-scrollbar ">
        <div class="header mb-6">
            <div class="wrap flex justify-between">
                <div class="title text-2xl font-semibold">
                    <h1 class="">{{ $title }}</h1>
                </div>
                <div class="action">
                    <x-sort-button :sortable="$sortable"></x-sort-button>

                </div>
            </div>
        </div>
        <div class="content-body p-4 bg-neutral-50 rounded-2xl relative">
            <div class="table w-full">
                <div class="header-table flex justify-between items-center mb-6">
                    <div class="header-title">
                        <h1 class="text-2xl font-semibold">Masukkan Data Alternatif</h1>
                    </div>
                    <div class="header-action">
                        <a href="{{ $addLocation }}" class="bg-primary-base inline-flex p-3 rounded-lg gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 3.75C12.4142 3.75 12.75 4.08579 12.75 4.5V11.25H19.5C19.9142 11.25 20.25 11.5858 20.25 12C20.25 12.4142 19.9142 12.75 19.5 12.75H12.75V19.5C12.75 19.9142 12.4142 20.25 12 20.25C11.5858 20.25 11.25 19.9142 11.25 19.5V12.75H4.5C4.08579 12.75 3.75 12.4142 3.75 12C3.75 11.5858 4.08579 11.25 4.5 11.25H11.25V4.5C11.25 4.08579 11.5858 3.75 12 3.75Z"
                                    fill="white" />
                            </svg>
                            <h6 class="text-neutral-50 font-medium text-sm">Tambah Berita</h6>
                        </a>
                    </div>
                </div>
                <div class="table-wrap" x-data="itemSelected">
                    <div class="relative">
                        <table class="w-full table-auto">
                            <thead class="border-b-2 bg-neutral-50">
                                <tr class="">
                                    <th class="px-6 py-4 w-1 text-start">
                                        <div id="checkbox" class="inline-flex gap-2 items-center ">
                                            <label class="relative rounded-full cursor-not-allowed flex items-center">
                                                <input id="check-box" type="checkbox"
                                                    class="peer relative h-4 w-4 cursor-not-allowed appearance-none rounded-sm border border-primary-200 transition-all  checked:border-primary-base checked:bg-primary-base"
                                                    name="check-box" disabled />
                                                <span
                                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5"
                                                        viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                        stroke-width="1">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </label>

                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">No</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Judul</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Author</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Deskripsi</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">status</th>

                                    <th class="px-6 py-4 text-start text-sm font-semibold">Tanggal</th>
                                    <th class="px-6 py-4 text-start text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @php
                                    $statusStyle = [
                                        'draft' => 'bg-blue-200 text-blue-500',
                                        'publish' => 'bg-primary-200 text-primary-500',
                                    ];
                                @endphp
                                @foreach ($berita as $key => $item)
                                    <tr class="">
                                        <td class="px-6 py-4 relative z-30">
                                            <div id="checkbox" class="inline-flex gap-2 items-center">
                                                <label class="relative rounded-full cursor-pointer flex items-center">
                                                    <input id="check-box-{{ $item->id }}" type="checkbox"
                                                        class="peer relative h-4 w-4 cursor-pointer appearance-none rounded-sm border border-primary-200 transition-all  checked:border-primary-base checked:bg-primary-base"
                                                        name="check-box-{{ $item->id }}"
                                                        @change="toggleCheckbox(event)" />
                                                    <span
                                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5"
                                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-sm  w-64">{{ $item->title }}</td>
                                        <td class="px-6 py-4 text-sm w-32">{{ $item->author }}</td>
                                        <td class="px-6 py-4 text-sm text-wrap w-auto]">{{ $item->description }}</td>
                                        <td class="px-6 py-4 text-sm"><span
                                                class="px-4 py-1 rounded-full font-semibold {{ $item->status == 'draft' ? $statusStyle['draft'] : $statusStyle['publish'] }}">{{ $item->status }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm w-24">
                                            {{ date_format($item->created_at, 'H.i, d-m-Y ') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm inline-flex">
                                            <a href="{{ route($editLocation, $item->id) }}" class="p-2"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                    viewBox="0 0 25 24" fill="none">
                                                    <path
                                                        d="m17.362 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L11.082 16.07a4.5 4.5 0 0 1-1.897 1.13L6.5 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897zm0 0L20 7.125M18.5 14v4.75A2.25 2.25 0 0 1 16.25 21H5.75a2.25 2.25 0 0 1-2.25-2.25V8.25A2.25 2.25 0 0 1 5.75 6h4.75"
                                                        stroke="#0D2810" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg></a>

                                            <form action="{{ route($deleteLocation, $item->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="p-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24"
                                                        viewBox="0 0 25 24" fill="none">
                                                        <path
                                                            d="m15.24 9-.346 9m-4.788 0L9.76 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.66 19.673a2.25 2.25 0 0 1-2.244 2.077H8.584a2.25 2.25 0 0 1-2.244-2.077L5.272 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                                                            stroke="#F66868" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="absolute flex items-center gap-14 rounded-full p-3 bg-[#201E2B]">
            <button type="button" class="inline-flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25m-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94z"
                        fill="#fff" />
                </svg>
                <span class="text-neutral-50">2 item selected</span>
            </button>
            <button type="button" class="px-4 py-2 inline-flex gap-2 bg-error-base rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                        stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-neutral-50 font-semibold">Delete</span>
            </button>
        </div> --}}
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('itemSelected', () => ({
                selected: [],
                init() {
                    document.addEventListener('DOMContentLoaded', () => {
                        let checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        this.selected = Array.from(checkboxes).map((checkbox) => (checkbox
                            .checked ? checkbox
                            .name : null)).filter((name) => name !== null);
                        if (this.selected.length > 0)
                            this.showDisplay();
                    }, false);
                },

                toggleAll() {
                    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    if (this.selected.length === checkboxes.length) {
                        this.selected = [];
                    } else {
                        this.selected = Array.from(checkboxes).map((checkbox) => checkbox.name);
                    }
                },

                elementShow() {
                    let element = ` <div id="action-selected" class="absolute bottom-3 inset-x-0 flex justify-center">
                    <div class="inline-flex items-center gap-14 rounded-full p-3 bg-[#201E2B]">
            <button type="button" class="inline-flex gap-3" onclick="clearSelected()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25m-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94z"
                        fill="#fff" />
                </svg>
                <span class="text-neutral-50">${this.selected.length} item selected</span>
            </button>
            <button type="button" onclick="deleteSelected('${this.selected}')" class="px-4 py-2 inline-flex gap-2 bg-error-base rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21q.512.078 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48 48 0 0 0-3.478-.397m-12 .562q.51-.088 1.022-.165m0 0a48 48 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a52 52 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a49 49 0 0 0-7.5 0"
                        stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-neutral-50 font-semibold">Delete</span>
            </button> </div>
        </div>`
                    return element
                },

                showDisplay() {
                    let body = document.querySelector('main')
                    if (body.querySelector('#action-selected')) {
                        body.querySelector('#action-selected').remove()
                    }
                    $(body).append(this.elementShow())
                },

                toggleCheckbox(event) {
                    if (event.target.checked) {
                        this.selected.push(event.target.name);
                    } else {
                        this.selected = this.selected.filter((name) => name !== event.target
                            .name);
                    }
                    this.showDisplay();
                },
            }));
        });

        clearSelected = () => {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
            document.querySelector('#action-selected').remove();
            location.reload();
        }



        deleteSelected = (selected) => {
            selected = selected.split(',');

            selected.forEach((id) => {
                let url = `{{ route($deleteLocation, ':id') }}`;
                id = id.replace(/\D/g, '')
                url = url.replace(':id', id);

                $.ajax({
                    method: 'DELETE',
                    url: url,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',

                    },
                    success: console.log('success')
                })



            })

            $.ajax({
                type: "GET",
                url: location.href,
                success: function(response) {
                    response = new DOMParser().parseFromString(response,
                        'text/html').querySelector('main').innerHTML;
                    $('main').html(response);
                }
            })

        }
    </script>
@endpush
