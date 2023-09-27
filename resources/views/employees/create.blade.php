<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Add Employee') }}
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
                        <form method="post" action="{{ route('employee.store') }}" @required(true)
                            enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="company">Company *</label>
                               <select name="company_id" id="company" class="form-control"> 
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach

                               </select>
                            </div>
                            <div class="form-group">
                                <label for="email">First Name *</label>
                                <input type="text" name="first_name" class="form-control" id="email"
                                    aria-describedby="emailHelp" @required(true) placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name *</label>
                                <input type="last_name" class="form-control" @required(true) name="last_name"
                                    id="last_name" aria-describedby="last_nameHelp" placeholder="Last name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" name="email" @required(true) id="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="number" class="form-control" name="phone" @required(true) id="phone" placeholder="">
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
