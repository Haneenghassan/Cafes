@include('layouts.header')



        <div class="content">



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
                <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                    <?php $arrayOfTable = [] ?>
                    @foreach ($reservation as $item)
                        @foreach ($tables as $table)
                            <?php
                                if ( $item->table_id == $table->id ){
                                    array_push($arrayOfTable, $table->id);
                                    $reservationMaxTime = strtotime($item->res_date) + 7200;
                                    $reservationMinTime = strtotime($item->res_date) - 7200;
                                    $customerTimeChoosed = Session::get('Reservatio_Date');
                                    if ( $customerTimeChoosed > $reservationMinTime && $customerTimeChoosed < $reservationMaxTime ) { ?>
                                        <option value="{{ $item->id }} " disabled>
                                            {{ $table->name }} - {{ $table->location }} - {{ $table->guest_number }} Guest - Reserved
                                        </option>
                                    <?php } else {  ?>
                                        <option value="{{ $table->id }}" >
                                            {{ $table->name  }}  - {{ $table->guest_number }} Guest
                                        </option>
                                <?php } } ?>
                        @endforeach
                    @endforeach
                    @foreach ($tables as $item)
                        <?php if (!in_array($item->id, $arrayOfTable)) {?>
                            <option value="{{ $item->id }}">
                            {{ $item->name }} - {{ $item->location }} - {{ $item->guest_number }} Guest
                            </option>
                             <?php } ?>
                    @endforeach
                </select>
            </div>


                                <div class="mb-3">
                                    <input type="hidden" name="user_id" class="form-control">
                                    <input type="hidden" name="res_date" value="{{Session::get('Reservatio_DateAndTime')}}" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Add reservation</button>
                            </form>
                            <a href="{{route('reseForm-create' , ['category_id'=>$categories['id']])}}"><button>Back To Date</button></a>
                        </div>
                    </div>


                    @else

                        {{view('auth.login')}}

                    @endif


                    <script>

                    </script>

@include('layouts.footer')


            </body>

            </html>
