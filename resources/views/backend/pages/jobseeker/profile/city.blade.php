@foreach($city as $c)
    <option class="opt_city" value="{{ $c->id }}">{{ $c->name }}</option>
@endforeach