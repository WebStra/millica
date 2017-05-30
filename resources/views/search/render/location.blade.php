@foreach($locations as $location)
    <option @if(\Auth::user()->location == $location) selected
            @endif value="{{$location}}">{{$location}}</option>
@endforeach