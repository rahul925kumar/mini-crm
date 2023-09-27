<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Company Info') }}
                            </h2>
                        </header>
                        @if(session('success') && now() < session('expires_at'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        <form method="post" action="{{ route('companies.update', $company->id) }}" @required(true)
                            enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="email">Name *</label>
                                <input type="text" name="name" class="form-control" id="email"
                                    aria-describedby="emailHelp" @required(true) value="{{$company->name}}" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" @required(true) name="email"
                                    id="email" aria-describedby="emailHelp" value="{{$company->email}}" placeholder="Company email">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo *</label>
                                <input type="file" class="form-control"  id="logo"  name="logo" accept="">
                                    <input type="hidden" name="old_image" value="{{$company->logo}}">
                                    @if($company->logo)
                                    <img src="{{ asset('storage/company_logos/' . $company->logo) }}" style="height: 100px;width: 100px;">
                                    @endif
                                </div>
                            <div class="form-group">
                                <label for="website">Website *</label>
                                <input type="url" class="form-control" name="website" @required(true)
                                    accept="image/*" value="{{$company->website}}" id="website" placeholder="">
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
