<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Comprovante;
use Illuminate\Support\Facades\Storage;
use App\Models\Image; // Certifique-se de importar o modelo Image

use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function store(Request $request)
    {
       $request->validate([
            'imagem' => 'required|image|mimes:jpeg, jpg|max:999999', // Valide o tipo e tamanho do arquivo conforme necessário
        ]);
    
        // Obtenha o nome e a extensão do arquivo
        $nomeArquivo = $request->file('imagem')->getClientOriginalName();
        $extensao = $request->file('imagem')->getClientOriginalExtension();
    
        // Leitura do conteúdo binário da imagem
        $imagem = file_get_contents($request->file('imagem')->getRealPath());
    
        // Salve a imagem no banco de dados
        $image = new Image;
        $image->user_id = auth()->id(); // Se você deseja associar a imagem a um usuário
        $image->nome = $nomeArquivo;
        $image->extensao = $extensao;
        $image->imagem = $imagem;
        $image->save();

        if($image){
            
            return redirect('/MeuPlano')->with('success', 'Seu comprovante foi salvo com sucesso. 
            Aguarde a liberação ou solicite ao suporte.');

        }
        else{
            $message="Não foi salvo";
            return view('info.meuplano',['error'=>$message]);
        }
    }
    public function showComprovantes()
    {
        // Busque todos os comprovantes armazenados
        $comprovantes = Image::all();
        
        
        // Retorne a view com os comprovantes para exibição e exclusão
        return view('comprovantes.show', ['comprovantes' => $comprovantes]);
    }

    public function deleteComprovante($comprovanteId)
    {
        // Busque o comprovante pelo ID
        $comprovante = Image::findOrFail($comprovanteId)->delete();
    
        
    
        return redirect('/comprovantes');
    }
    

}
