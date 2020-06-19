@extends('layouts.master')
@section('page')

  <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> <i class="fas fa-plus"></i> Add New Product</a>
<table class="table data-table" >
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Title Product</th>
            <th class="text-center">Brand</th>
            {{-- <th class="text-center">Gender</th> --}}
            <th class="text-center">Category</th>
            <th class="text-center">Sub Category</th>

            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label">Title Product</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title product" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select class="form-control" id="brand" name="brand">
                          <option>Select brand</option>
                          <option value="deenay">deenay</option>
                          <option value="shisya">shisya</option>
                          <option value="zahira">zahira</option>
                          <option value="zahira">nike</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="brand">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option>Select Category</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id}}">{{ $cat->name }}</option>
                            @foreach($cat->children as $subcat)
                            <option value="{{ $subcat->id }}">&nbsp; - {{ $subcat->name }} </option>
                           @endforeach

                            @endforeach

                        </select>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                            <textarea id="description" name="description" required="" placeholder="Enter description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script type="text/javascript">
  $(function () {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'DT_RowIndex', id: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'brand', name: 'brand'},
            {data: 'cat', name: 'cat'},
            {data: 'subcat', name: 'subcat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('products.index') }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#title').val(data.title);
          $('#brand').val(data.brand);
          $('#category').val(data.category);
      })
   });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('products.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteProduct', function () {

        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('products.store') }}"+'/'+product_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

  });
</script>
@endpush
