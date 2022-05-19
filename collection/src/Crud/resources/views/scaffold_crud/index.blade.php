@extends('CrudViews::layouts.app')

@section('content')
  <h2 class="mt-3 mb-3">Listado de {{ $crud['name'] }}
    <a class="mt-1 btn btn-success btn-sm float-right"  href="{{ url($crud['name'], ['create']) }}">
      Nuevo {{ ($crud['name']) }}
    </a>
  </h2>
<table  class="table table-striped">
  @foreach ($rows as $i => $row)
    @if($i == 0)
      <thead>
        <tr>
          @foreach ($row as $key => $value)
            @if(in_array($key, $crud['fields']['show_only']))
              <th>{{ $key }}</th>
            @endif
          @endforeach
          <th class="text-right">Actions</th>
        </tr>
      </thead>
    @endif
    <tbody>
      <tr>
        @foreach ($row as $key => $value)
          @if(in_array($key, $crud['fields']['show_only']))
            <td>{{ $value }}</td>
          @endif
        @endforeach
        <td class="text-right">
          <a class="btn btn-sm btn-primary" href="{{ url($crud['name'], [$row->id]) }}">Ver</a>
          <a class="btn btn-sm btn-primary" href="{{ url($crud['name'], [$row->id, 'edit']) }}">
            Editar <i class="fa fa-chevron-right"></i>
          </a>


          <button data-href="{{ url($crud['name'], [$row->id])  }}"  data-method="delete" class="btn btn-sm btn-danger jquery-postback">
              Eliminar <i class="fa fa-remove"></i>
          </button>
          <meta name="csrf-token" content="{{ csrf_token() }}"/>
        </td>
      </tr>
    </tbody>
  @endforeach
</table>
<ceneter>
  {{ $rows->links() }}
</ceneter>


<script>
$.ajaxSetup({
});
$(document).on('click', 'button.jquery-postback', function(e) {
    e.preventDefault(); // does not go through with the link.
    if (!confirm("Are you sure to delte this row?"))
      return;

    var $this = $(this);

    $.post({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        type: "DELETE",
        url: $this.attr('data-href')
    }).done(function (result) {
        window.location.reload();
    });
});
</script>
@endsection
