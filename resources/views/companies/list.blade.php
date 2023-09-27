<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('message') && now() < session('expires_at'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="add-company-btn" onclick="gotoAddCompany()" style="float: right">
                        <x-primary-button>{{ __('Add Company') }}</x-primary-button>
                    </div>
                    @if (count($companies) > 0)
                        <div class="container" style="margin-top: 50px;">
                            <h2 style="    padding: 10px; font-weight: 600; font-size: larger;">Companies list</h2>

                            <table class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $key => $company)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email }}</td>
                                            <td><a href="{{ $company->website }}"
                                                    target="_blank">{{ $company->name }}</a></td>
                                            <td><img src="{{ asset('storage/company_logos/' . $company->logo) }}"
                                                    alt="{{ $company->name }} Logo" style="height: 50px;width: 50px;">
                                            </td>
                                            <td>
                                                <a href="{{url('/companies/'.$company->id)}}"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{url('/companies/'.$company->id.'/edit')}}"><i class="fa-solid fa-pencil"></i></i></a>
                                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <div class="pagination">
                                        {{ $companies->links() }}
                                    </div>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="empty-message" style="margin-top: 50px; text-align: center;">
                            {{ __('Company Table is empty') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function gotoAddCompany() {
        window.location.href = '/companies/create'
    }


</script>
