@extends('CrudViews::layouts.app')

@section('content')
<h2>{{ $crud['id'] ? "Update" : "Create" }} {{ Str::singular($crud['name']) }}</h2>
@php
$_input = config('crud.input');
foreach ($crud['fields']['fillable'] as $field)
{
    $input = $_input;
    $_field = [];
    if(isset($input['type'][$field->Type]))
    {
        $_field = ['type' => $field->Type];
    }
    else
    {
      preg_match('/(?P<type>\w+)\((?P<length>\d+)?\)/', $field->Type, $_field);
    }

    if(!count($_field))
      continue;
    $input['name'] = $field->Field;
    $input['id'] = $field->Field;
    $input['value'] = isset($crud['data']->{$field->Field}) ? $crud['data']->{$field->Field} : '';
    $input['class'] = 'form-control';
    $type = isset($_field['type']) && isset($input['type'][$_field['type']]) ? $input['type'][$_field['type']] : 'text';
    $input['type'] = $type;
    $inputs[$field->Field] = implode('', $input);
}

@endphp

<form action="{{ url($crud['name']) }}{{ $crud['id'] ? '/'.$crud['id'] : "" }}" method="POST">
  {{ csrf_field() }}
  {{ method_field($crud['method']) }}
  @foreach ($inputs as $field => $input)
  <p>
    {{ $field }}
    {!! $input !!}
  </p>
  @endforeach
  <a href="{{ url($crud['name']) }}" class="btn btn-info">volver</a>

  <input type="submit" name="enviar"  class="btn btn-success" value="enviar">
</form>
@endsection
