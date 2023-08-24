@extends('admin.main')

@section('content')

    <h2>Insert New Product</h2>

    <form action="{{ route('admin.update_product', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" value="{{$product->price}}">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image1" type="file" class="custom-file-input" accept="image/*" id="image1" onchange="updateLabel(this)">
                @if (isset($product->images[0]))
                    <label class="custom-file-label" for="image1">{{$product->images[0]->url}}</label>
                @else
                    <label class="custom-file-label" for="image1">Image 1</label>
                @endif
            </div>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image2" type="file" class="custom-file-input" accept="image/*" id="image2" onchange="updateLabel(this)">
                @if (isset($product->images[1]))
                    <label class="custom-file-label" for="image1">{{$product->images[1]->url}}</label>
                @else
                    <label class="custom-file-label" for="image1">Image 2</label>
                @endif
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image3" type="file" class="custom-file-input" accept="image/*" id="image3" onchange="updateLabel(this)">
                @if (isset($product->images[2]))
                    <label class="custom-file-label" for="image1">{{$product->images[2]->url}}</label>
                @else
                    <label class="custom-file-label" for="image1">Image 3</label>
                @endif
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function updateLabel(input) {
            var fileName = input.files[0].name;
            $(input).siblings('.custom-file-label').html(fileName);
        }
    </script>
    
@endsection