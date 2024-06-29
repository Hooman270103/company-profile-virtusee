<table class="table table-borderless align-middle table-nowrap mb-0">
  <thead>
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Number</th>
        <th scope="col">
            <button type="button" class="btn btn-rounded btn-primary btn-sm" onclick="addButton()">
                <i class="ri-add-circle-line"></i>
            </button>
        </th>
    </tr>
  </thead>
  <tbody id="bodyData">
        {{-- {{ dd($counter) }} --}}
        @if (isset($counter))
            @foreach ($counter->data_counter as $key => $item)
                <tr class="form-input form_{{ $key }}" data-count="{{ $key }}" id="body_{{ $key }}">
                    <td>
                        <input type="text" class="form-control" id="title_data_{{ $key }}"  name="title_data[]" value="{{ $item->title }}">
                    </td>
                    <td>
                        <input type="number" class="form-control" id="number_data_{{ $key }}"  name="number_data[]" value="{{ $item->number }}">
                    </td>
                    <td>
                        <div class="hstack gap-3 fs-15">
                            <button type="button" class="btn btn-rounded btn-sm btn-danger delete_1" onclick="delButton(this)" data-target="1">
                                <i class="ri-indeterminate-circle-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="form-input form_1" data-count="1" id="body_1">
                <td>
                    <input type="text" class="form-control" id="title_data_0"  name="title_data[]" value="{{ old('title_data.0') }}">
                </td>
                <td>
                    <input type="number" class="form-control" id="number_data_0"  name="number_data[]" value="{{ old('number_data.0') }}">
                </td>
                <td>
                    <div class="hstack gap-3 fs-15">
                        <button type="button" class="btn btn-rounded btn-sm btn-danger delete_1" onclick="delButton(this)" data-target="1">
                            <i class="ri-indeterminate-circle-line"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>


<script>
  
  function makeid(length) {
      var result           = '';
      var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      var charactersLength = characters.length;
      for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      return result;
  }

  function addButton() {
        var rowCount = $('#bodyData tr').length;
        let count = makeid(10);

        let html = `
        <tr class="form-input form_${count}" data-count="${count}" id="body_${count}">

            <td>
                <input type="text" class="form-control" id="title_data_${count}" data-target="${count}"  name="title_data[]" >
            </td>
            <td>
              <input type="number" class="form-control" id="number_data_${count}" data-target="${count}"  name="number_data[]" >
            </td>
            <td>
                <div class="hstack gap-3 fs-15">
                    <button type="button" class="btn btn-rounded btn-danger btn-sm delete_${count}" onclick="delButton(this)" data-target="${count}">
                        <i class="ri-indeterminate-circle-line"></i>
                        </button>
                </div>
            </td>
        </tr>`;

        $('#bodyData').append(html)
    }

    function delButton(e) {
        let id = $(e).data('target');
        $('#body_'+id).remove();
    }

</script>