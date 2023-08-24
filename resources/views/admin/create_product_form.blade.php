@extends('admin.main')

@section('content')

    <h2>Insert New Product</h2>

    <form action="{{ route('admin.create_product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image1" type="file" class="custom-file-input" accept="image/*" id="image1" onchange="updateLabel(this)">
                <label class="custom-file-label" for="image1">Image 1</label>
            </div>
        </div>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image2" type="file" class="custom-file-input" accept="image/*" id="image2" onchange="updateLabel(this)">
                <label class="custom-file-label" for="image2">Image 2</label>
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input name="image3" type="file" class="custom-file-input" accept="image/*" id="image3" onchange="updateLabel(this)">
                <label class="custom-file-label" for="image3">Image 3</label>
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

    <script>
      ClassicEditor
          .create(document.querySelector('#description'))
          .catch(error => {
              console.error(error);
          });
    </script>

    
@endsection
