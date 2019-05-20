<ul>
    @foreach($products as $product)
        <li>{{$product->name}} - {{$product->category['name']}}</li>

    @endforeach
</ul>