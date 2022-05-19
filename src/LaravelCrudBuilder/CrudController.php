<?php


namespace Idvazquezrivera\LaravelCrudBuilder;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\View as View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class CrudController extends Controller
{

      private $crud;
      private $fields = [
        'excluded' => [
          'form' => [
            'created_at',
            'deleted_at',
            'updated_at',
            'sort',
            'sort_dir',
            'id',
            '_id',
            'remember_token'
          ],
          'table' => ['password', 'remember_token']
        ],
        'show_only' => ['name', 'email']
      ];
      public function __construct(Request $request)
      {
        $uri = explode('/', $request->path());

        $table = $uri[0];
        $id = isset($uri[1]) && is_numeric($uri[1]) ? $uri[1] : null;
        $action = end($uri);
        if($table )
        {
          $data = DB::table($table)->where('id', $id)->first();
          $relations = [];
          $inputs = [];

          //$fk = DB::select('SELECT * FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_SCHEMA = "'.DB::table($this->crud['name'])->getTable().'"'));

          $this->fields['fillable'] = DB::select(
            'SHOW COLUMNS FROM '.$table .' '.
            'WHERE  Field NOT IN '.
            '("' .implode('","', $this->fields['excluded']['form']) .'")'
          );
          $this->crud = [
            'id' => $id,
            'uri' => $uri,
            'data' => $data,
            'name' => $uri[0],
            'fields' => $this->fields,
            'method' => Arr::get(['create' => 'POST', 'edit' => 'PUT'], $action),
          ];

          View::share('crud', $this->crud);
        }
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(Request $request)
      {
         if(View::exists($this->crud['name'].'.index'))
        {
            return view($this->crud['name'].'.index', [
              'rows' => DB::table($this->crud['name'])->paginate(15)
            ]);
        }
        return view('CrudViews::scaffold_crud.index', [
          'rows' => DB::table($this->crud['name'])->paginate(15)
        ]);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
        if(View::exists($this->crud['name'].'.form'))
        {

            return view($this->crud['name'].'.form');
        }

        return view('CrudViews::scaffold_crud.form');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
       public function store(Request $request)
      {
        $fillable_name_fields = Arr::pluck($this->crud['fields']['fillable'], 'Field');
        $register = DB::table($this->crud['name'])->insert($request->only($fillable_name_fields));
        return redirect(url($this->crud['name']))->with('message','Usuario Actualizado Correctamente');
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function show()
      {
        if(View::exists($this->crud['name'].'.show'))
        {
            return view($this->crud['name'].'.show');
        }
        return view('CrudViews::scaffold_crud.show');
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit()
      {
        if(View::exists($this->crud['name'].'.form'))
        {
            return view($this->crud['name'].'.form');
        }
        return view('CrudViews::scaffold_crud.form');
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update($id, Request $request)
      {
          $data = $request->only(Arr::pluck($this->fields['fillable'], 'Field'));
          /*
          if(isset($data['password']) && !empty($data['password']))
          {
            $data['password'] = $data['password'];
          }
          else
          {
            unset($data['password']);
          }
          */
          DB::table($this->crud['name'])
              ->where('id', $id)
              ->update($data);

          return redirect(url($this->crud['name']))->with('message','Row was been updated sucessfully');

      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {

        return DB::table($this->crud['name'])->where('id', $id)->delete();

      }

  }
