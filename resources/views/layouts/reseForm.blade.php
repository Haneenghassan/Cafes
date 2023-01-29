@include('layouts.header')


<div class="content">


    {{-- {{dd($table)}} --}}
@if (auth()->check())

    <h1>reservation</h1>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4" style="background-color: #fff !important; ">
                <h5 class="mb-4">Add New reservation</h5>
                <form action="{{route('LandingPage.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">first name</label>
                        <input type="text" name="first_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">last name</label>
                        <input type="text" name="last_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">tel_number</label>
                        <input type="text" name="tel_number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">res_date</label>
                        <input type="datetime-local" onchange="showTable()" name="res_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">guest_number</label>
                        <input type="number" name="guest_number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Restautant Name</label>
                        <input type="hidden" name="category_id" class="form-control" value="{{ $categories->id }}">
                        <input type="text" name="category" class="form-control" disabled value="{{ $categories->name }}">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Choose Your Table</label>
                        <select id="table_id" name="table_id"
                            class="form-multiselect block w-full mt-1">
                            @foreach ($tables as $item)
                                <option value="{{ $item->id }}" <?php if($item->status == 'Reserved'){echo 'disabled';} ?>>
                                    {{ $item->name }} - {{ $item->location }} - {{ $item->guest_number }} Guest - {{$item->status}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="user_id" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add reservation</button>
                </form>
            </div>
        </div>


        @else

            {{view('auth.login')}}

        @endif

            @include('layouts.footer')

        <script>

        </script>

</body>

</html>
