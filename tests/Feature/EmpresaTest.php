<?php

namespace Tests\Feature;

use App\Models\{EmpresaModel,User};
use Illuminate\Foundation\Testing\{RefreshDatabase,WithFaker};
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_list_empresa(): void
    {
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresas = EmpresaModel::all();
        $empresas->each(function ($empresa) {
            echo "ID: {$empresa->id}, Nome fantasia: {$empresa->nome_fantasia}, CNPJ: {$empresa->cnpj_empresa}\n";
        });
    }

    public function test_create_empresa(): void
    {
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresa = [
            'nome_fantasia' => "Pão de queijo",
            'cnpj_empresa' => "10.895.928/0001-35",
        ];
        $this->post('/add-empresa', $empresa);
        //$response->assertStatus(201);
    }

    public function test_update_empresa(): void
    {
        $id = "value_id";
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresa = EmpresaModel::find($id);
        $atualizar_empresa = [
            'nome_fantasia' => "Pão de queijo",
            'cnpj_empresa' => "58.742.446/0001-71",
        ];
        $this->patch("/update-empresa/$empresa->id", $atualizar_empresa);
        //$response->assertStatus(200);
    }

    public function test_delete_empresa(): void
    {
        $id = "value_id";
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresa = EmpresaModel::find($id);
        $this->delete("/delete-empresa/$empresa->id");
        //$response->assertStatus(204);
    }

    public function test_search_empresa(): void
    {
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $filtro = "batata";
        $this->get("/search-empresa?search=$filtro");
        $empresas = EmpresaModel::where('nome_fantasia', 'LIKE', "%$filtro%")->get();
        $empresas->each(function ($empresa) {
            echo "ID: {$empresa->id}, Nome fantasia: {$empresa->nome_fantasia}, CNPJ: {$empresa->cnpj_empresa}\n";
        });
    }

    public function test_list_trash_empresa(): void
    {
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresas = EmpresaModel::onlyTrashed()->get();
        $empresas->each(function ($empresa) {
            echo "ID: {$empresa->id} | Nome fantasia: {$empresa->nome_fantasia} | CNPJ: {$empresa->cnpj_empresa} | Data de exclusão: {$empresa->deleted_at}\n";
        });
    }

    public function test_restore_empresa(): void
    {
        $id = "value_id";
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $empresa = EmpresaModel::onlyTrashed()->find($id);
        $this->get("/restore-empresa/$empresa->id");
        //$response->assertStatus(200);
    }

    public function test_search_trash_empresa(): void
    {
        $user = User::where('id', "value_user_id")->first();
        $this->assertNotNull("Usuário Nº$user não encontrado no banco de dados.");
        $this->actingAs($user);
        $filtro = "batata";
        $this->get("/search-empresa-trash?search=$filtro");
        $empresas = EmpresaModel::onlyTrashed()->where('nome_fantasia', 'LIKE', "%$filtro%")->get();
        $empresas->each(function ($empresa) {
            echo "ID: {$empresa->id} | Nome fantasia: {$empresa->nome_fantasia} | CNPJ: {$empresa->cnpj_empresa} | Data de exclusão: {$empresa->deleted_at}\n";
        });
    }

}
