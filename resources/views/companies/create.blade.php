<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Add Company') }}
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
                        <form method="post" action="{{ route('companies.store') }}" @required(true)
                            enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="email">Name *</label>
                                <input type="text" name="name" class="form-control" id="email"
                                    aria-describedby="emailHelp" @required(true) placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" @required(true) name="email"
                                    id="email" aria-describedby="emailHelp" placeholder="Company email">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo *</label>
                                <input type="file" class="form-control" id="logo" @required(true)
                                    name="logo" accept="">
                            </div>
                            <div class="form-group">
                                <label for="website">Website *</label>
                                <input type="url" class="form-control" name="website" @required(true)
                                    accept="image/*" id="website" placeholder="">
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
