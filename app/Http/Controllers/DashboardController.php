<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use App\Models\Usuario;
/**
 * Tela Inicial do Admin
 */
class DashboardController extends Controller {
    private $dados = ['menu' => 'dashboard'];

    /** Tela Inicial do Dashboard */
    public function index() {
        $this->dados['totalUsuarios'] = Usuario::count();
        $this->dados['totalLicitacoes'] = 0;
        return view('dashboard.index', $this->dados);
    }
}
