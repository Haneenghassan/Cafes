@include('layouts.header')


<br><br><br><br>
@foreach($results as $result)
<div class="search-flex">

    <div class="search-div"> 
     <div><img src="{{URL::asset('image/aw1.jpeg')}}" alt="logo"></div> 
      <div class="masthead-subheading text-uppercase search-name"> Coffee Name </div>
    </div>
</div>    
    {{-- <div>{{ $result->image }}</div> --}}

      @endforeach
 
  <!-- Footer-->
  @include('layouts.footer')