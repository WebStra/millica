@foreach($locations as $location)
    <option @if(\Auth::check()) @if(\Auth::user()->location == $location) selected
            @endif @endif  value="{{$location}}">{{$location}}</option>
@endforeach