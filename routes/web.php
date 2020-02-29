<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Rotas de Estutante/Inscrição

Route::get('/nova_inscricao/{id}', 'User@create')->name('user.create');
Route::post('/salva_inscricao', 'User@store')->name('user.store');
Route::post('/get-user-by-cpf.json', 'User@findByCpf')->name('user.findByCpf');

//Rotas certificado sem autenticação
Route::get('/', 'CertificateController@screen_find_certicate')->name('certificate.screen_find_certicate');
Route::post('/certificados_por_estudante', 'CertificateController@certificateByCpf')->name('certificate.ByCpf');
Route::get('/certificate/{id}', 'CertificateController@show')->name('certificate.show');

Route::get('/valida_certificado/{code}', 'CertificateController@validate_certificate')->name('certificate.validate');


//Rotas autenticadas
Route::group(['middleware' => 'auth'], function(){	
	// Rotas de Eventos
	Route::post('/inscricao_evento', 'SubscriptionController@store')->name('subscription.store');
	Route::get('/confirmacao_inscricao', 'SubscriptionController@confirm')->name('subscription.confirm');
	Route::get('/meus_certificados/{id}', 'CertificateController@myCertificate')->name('certificate.myCertificate');
	Route::get('/inscricao_evento', 'EventController@select_event')->name('event.select');
	Route::get('/lista_inscricoes', 'SubscriptionController@index')->name('subscription.index');
	Route::get('/novo_evento', 'EventController@create')->name('event.create');
	Route::post('/salva_evento', 'EventController@store')->name('event.store');
	Route::get('/lista_eventos', 'EventController@index')->name('event.index');
	Route::get('/editar_evento/{id}', 'EventController@edit')->name('event.edit');
	Route::patch('/update_evento/{id}', 'EventController@update')->name('event.update');
	Route::get('/mostrar_evento/{id}', 'SubscriptionController@show')->name('event.show');
	Route::get('/eventos_finalizados', 'EventController@finish')->name('event.finish');
	//Rotas Escola
	Route::get('/nova_escola', 'SchoolController@create')->name('school.create');
	Route::post('/salvar_escola', 'SchoolController@store')->name('school.store');
	Route::get('/lista_escola', 'SchoolController@index')->name('school.index');
	Route::get('/editar_escola/{id}', 'SchoolController@edit')->name('school.edit');
	Route::patch('/update_escola/{id}', 'SchoolController@update')->name('school.update');

	// Rota de certificado
	Route::post('/store_certificate', 'CertificateController@store')->name('certificate.store');
	Route::get('/inscricao_certificado/{id}', 'SubscriptionController@finish')->name('subscription.finish');
	Route::delete('/deletar_certificado', 'CertificateController@destroy')->name('certificate.destroy');
	Route::get('/cadastrar_instrutor', 'InstructorController@create')->name('instructor.create');
	Route::post('/instructor_store', 'InstructorController@store')->name('instructor.store');
	Route::get('/lista_instrutor', 'InstructorController@index')->name('instructor.index');
	Route::get('/instrutor_editar/{id}', 'InstructorController@edit')->name('instructor.edit');
	Route::patch('/instructor_update/{id}', 'InstructorController@update')->name('instructor.update');	
	Route::get('/lista_usuarios', 'UserController@index')->name('user.index');
	Route::get('/detalhes_usuario/{id}', 'UserController@show')->name('user.show');
	Route::get('/perfil', 'UserController@edit')->name('user.perfil');
	Route::post('/torna_admin', 'UserController@make_admin')->name('user.make_admin');
	Route::get('/lista-participantes-pdf/{id}', 'SubscriptionController@subscribers')->name('subscription.subscribers');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
