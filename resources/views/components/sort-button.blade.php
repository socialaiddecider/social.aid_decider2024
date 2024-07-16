<div class="sort-action relative" x-data="{
    isSortOpen: false,
    sortby: '',
    orderby: '',
    orderOptions: { asc: 'Ascending', desc: 'Descending' },
    urlParams: new URLSearchParams(window.location.search),
    init() {
        if (this.urlParams.has('sortby')) {
            this.sortby = this.urlParams.get('sortby');
        }
        if (this.urlParams.has('orderby')) {
            this.orderby = this.urlParams.get('orderby');
        }
    },
    sortData() {
        this.urlParams.set('sortby', this.sortby);
        this.urlParams.set('orderby', this.orderby);
        window.location.search = this.urlParams;
    }
}" x-effect="console.log(sortby,orderby)">
    <button class="button items-center flex gap-2 bg-neutral-50 p-3 rounded-xl" @click="isSortOpen = !isSortOpen">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M2.6875 8.15954C3.05174 8.49776 3.6212 8.47667 3.95942 8.11243L6.29991 5.59191L6.29991 15.9C6.29991 16.3971 6.70285 16.8 7.19991 16.8C7.69696 16.8 8.09991 16.3971 8.09991 15.9V5.59191L10.4404 8.11243C10.7786 8.47667 11.3481 8.49776 11.7123 8.15954C12.0766 7.82132 12.0976 7.25186 11.7594 6.88762L7.85942 2.68762C7.68913 2.50423 7.45017 2.40002 7.19991 2.40002C6.94964 2.40002 6.71068 2.50423 6.54039 2.68762L2.64039 6.88762C2.30217 7.25186 2.32326 7.82132 2.6875 8.15954ZM12.2875 15.8405C11.9233 16.1787 11.9022 16.7482 12.2404 17.1124L16.1404 21.3124C16.3107 21.4958 16.5496 21.6 16.7999 21.6C17.0502 21.6 17.2891 21.4958 17.4594 21.3124L21.3594 17.1124C21.6976 16.7482 21.6765 16.1787 21.3123 15.8405C20.9481 15.5023 20.3786 15.5234 20.0404 15.8876L17.6999 18.4081V8.10003C17.6999 7.60297 17.297 7.20003 16.7999 7.20003C16.3028 7.20003 15.8999 7.60297 15.8999 8.10003V18.4081L13.5594 15.8876C13.2212 15.5234 12.6517 15.5023 12.2875 15.8405Z"
                fill="#7F7F7F" />
        </svg>
        <h6 class="text-neutral-500 font-medium">Sort</h6>
    </button>
    <div x-show="isSortOpen" class="absolute z-10 bg-neutral-50 shadow-lg w-80 right-0 top-14 px-6 py-4 rounded-lg"
        @click.away="isSortOpen=false">
        <div class="sort">
            <div class="title mb-1">
                <h5 class="text-lg">Urutkan Berdasarkan</h5>
            </div>
            <div class="grid grid-cols-2 mb-2">
                @foreach ($sortable as $sortby => $title)
                    <div class="form-group relative" id="{{ $sortby }}">
                        <div class="flex gap-10 ">
                            <div class="inline-flex relative items-center px-2 ">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    for="{{ $sortby }}">
                                    <input name="sortby" type="radio"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-neutral-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                        id="{{ $sortby }}" value="{{ $sortby }}" x-model="sortby" />
                                    <span
                                        class="absolute text-primary-base transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16"
                                            fill="currentColor">
                                            <circle data-name="ellipse" cx="8" cy="8" r="8">
                                            </circle>
                                        </svg>
                                    </span>
                                </label>
                                <label
                                    class="mt-px font-light text-sm text-nowrap text-gray-700 cursor-pointer select-none"
                                    for="{{ $sortby }}">
                                    {{ $title }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="order">
            <div class="title mb-1">
                <h5 class="text-lg">Urutkan sesuai</h5>
            </div>
            <div class="orderOption">
                <template x-for="(value, index) in orderOptions">
                    <div class="form-group relative" x-bind:id="index">
                        <div class="flex gap-10 ">
                            <div class="inline-flex relative items-center px-2 ">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    x-bind:for="index">
                                    <input name="orderby" type="radio"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-primary-200 text-neutral-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-primary-500 before:opacity-0 before:transition-opacity checked:border-primary-base checked:before:bg-primary-base hover:before:opacity-10"
                                        x-bind:id="index" x-bind:value="index" x-model="orderby" />
                                    <span
                                        class="absolute text-primary-base transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16"
                                            fill="currentColor">
                                            <circle data-name="ellipse" cx="8" cy="8" r="8">
                                            </circle>
                                        </svg>
                                    </span>
                                </label>
                                <label
                                    class="mt-px font-light text-sm text-nowrap text-gray-700 cursor-pointer select-none"
                                    x-bind:for="index" x-text="value">
                                </label>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <div class="action-sort flex justify-end">
            <button type="button" class=" px-4 py-2 bg-primary-base rounded-md" @click="sortData()">
                <h6 class="text-neutral-50 text-sm">Terapkan</h6>
            </button>
        </div>
    </div>
</div>
