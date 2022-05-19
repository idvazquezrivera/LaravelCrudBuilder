<?php
 
namespace Idvazquezrivera\LaravelCrudBuilder;
 
use Illuminate\Support\ServiceProvider;
 
class CrudProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadViewsFrom(__DIR__.'/resources/views', 'CrudViews');
      $this->publishes([
        __DIR__.'/crud.php' => config_path('crud.php')
    ], 'crud');
  } 
  public function register()
  {
    $this->publishes([
      __DIR__.'/crud.php' => config_path('crud.php'),
    ], 'crud');
  }
}