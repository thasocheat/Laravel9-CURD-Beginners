# Laravel9-CRUD-Beginners
គឺជាការរៀនបង្កើតនិងសាកល្បងនូវ laravel9 framwork ថ្មីដែលហៅថា (CRUD) create បង្កើត, read or look អាចឬមើល, update កែប្រែ, delete លុប ។
Step 1 – Download Laravel 9 App
First of all, download or install laravel 9 new setup. So, open the terminal and type the following command to install the new laravel 9 app into your machine:

// composer create-project --prefer-dist laravel/laravel LaravelCRUD //

Step 2 – Setup Database with App
Setup database with your downloaded/installed laravel app. So, you need to find .env file and setup database details as following:
//
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database-name
DB_USERNAME=database-user-name
DB_PASSWORD=database-password
//

Step 3 – Create Company Model & Migration For CRUD App
Open again your command prompt. And run the following command on it. To create model and migration file for form:

// php artisan make:model Company -m //

After that, open create_companies_table.php file inside LaravelCRUD/database/migrations/ directory. And the update the function up() with following code:

//
public function up()
{
    Schema::create('companies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('address');
        $table->timestamps();
    });
}
//

Then, open again command prompt and run the following command to create tables into database:

// php artisan migrate //

Step 4 – Create Routes
Then create routes for laravel crud app. So, open web.php file from the routes directory of laravel CRUD app. And update the following routes into the web.php file:

//
use App\Http\Controllers\CompanyCRUDController;
 
Route::resource('companies', CompanyCRUDController::class);
//

Step 5 – Create Company CRUD Controller By Artisan Command
Create a controller by using the following command on the command prompt to create a controller file:

//
php artisan make:controller CompanyCRUDController
//

After that, visit at app/Http/controllers and open CompanyCRUDController.php file. And update the following code into it:

//
<?php
namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
class CompanyCRUDController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['companies'] = Company::orderBy('id','desc')->paginate(5);
return view('companies.index', $data);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('companies.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'name' => 'required',
'email' => 'required',
'address' => 'required'
]);
$company = new Company;
$company->name = $request->name;
$company->email = $request->email;
$company->address = $request->address;
$company->save();
return redirect()->route('companies.index')
->with('success','Company has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\company  $company
* @return \Illuminate\Http\Response
*/
public function show(Company $company)
{
return view('companies.show',compact('company'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Company  $company
* @return \Illuminate\Http\Response
*/
public function edit(Company $company)
{
return view('companies.edit',compact('company'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\company  $company
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',
'email' => 'required',
'address' => 'required',
]);
$company = Company::find($id);
$company->name = $request->name;
$company->email = $request->email;
$company->address = $request->address;
$company->save();
return redirect()->route('companies.index')
->with('success','Company Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Company  $company
* @return \Illuminate\Http\Response
*/
public function destroy(Company $company)
{
$company->delete();
return redirect()->route('companies.index')
->with('success','Company has been deleted successfully');
}
}
//

Step 6 – Create Blade Views File
Create the directory and some blade view, see the following:

Make Directory Name Companies
index.blade.php
create.blade.php
edit.blade.php
Create directory name companies inside resources/views directory.
