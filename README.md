# DogLaravel

I have completed Part 1 & Part 2 of the tasks but for Part 3 I have never used GraphQL for query testing before. I have setup GraphQL with the project but struggled to get it running.

## Part 1

web.php includes all the routes for this task, all of the functions are in the DogController

```php
Route::get('/breed', 'App\Http\Controllers\DogController@AllBreeds');
Route::get('/breed/random', 'App\Http\Controllers\DogController@GetRandomBreed');
Route::get('/breed/{breedid}/', 'App\Http\Controllers\DogController@GetBreed')->name('getbreed');
Route::get('/breed/{breedid}/image', 'App\Http\Controllers\DogController@GetBreedImage')->name('getbreedimage');
```

## Part 2
The first task in this one is to save all the breeds into a database table, this is called by:

```php
Route::get('/saveallbreeds', 'App\Http\Controllers\DogController@SaveAllBreeds');
```

I haven't used REDIS cache before but I implemented a caching method and a get cache method.

```php
Route::get('/cachedogs', 'App\Http\Controllers\DogController@CacheDogs');
Route::get('/getcache', 'App\Http\Controllers\DogController@GetCache');
```
Then there is the polymorphic models which you can see with User, Breed and Park model files with methods to associate the tables in the UserController and ParkController.

```php
Route::post('/user/{user_id}/associate', 'App\Http\Controllers\UserController@LinkUser');
Route::post('/park/{park_id}/associate', 'App\Http\Controllers\ParkController@LinkBreed');
```
To get all information that a dog breed has it is 
```php
Route::get('/breed/data/{breed_id}', 'App\Http\Controllers\DogController@GetBreedData');
```
## Testing


I have included a few test methods which use laravel unit testing, these are included in tests/feature/linkparktest.php
```php
//this tests the user linking to a park post request
    public function test_UserLinkPark()
    {
        $response = $this->post('/user/1/associate', ['type' => 'Park', 'id' => '1']);
        $responsedata = $response->getContent();
        $response->assertSee(200);
    }

    //this tests the user linking to a breed post request
    public function test_UserLinkBreed()
    {
        $response = $this->post('/user/1/associate', ['type' => 'Breed', 'id' => '8']);
        $responsedata = $response->getContent();
        $response->assertSee(200);
    }

     //this tests the user linking to a breed post request
     public function test_ParkLinkBreed()
     {
         $response = $this->post('/park/1/associate', ['type' => 'Breed', 'id' => '10']);
         $responsedata = $response->getContent();
         $response->assertSee(200);
     }
```
to run these tests do "./vendor/bin/phpunit" or "php artisan test" in the terminal window. They are used to test the post functions from part 2.   

