<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documentos')->delete();
        TipoDocumento::create(['nome' => 'Ata', 'descricao' => 'É o documento de valor jurídico, que consiste no resumo fiel dos fatos, ocorrências e decisões de sessões, reuniões ou assembléias, realizadas por comissões, conselhos, congregações, ou outras entidades semelhantes, de acordo com uma pauta, ou ordem-do-dia, previamente divulgada. É geralmente lavrada em livro próprio, autenticada, com as páginas rubricadas pela mesma autoridade que redige os termos de abertura e de encerramento.', 'sigla' => 'ATA']);

        TipoDocumento::create(['nome' => 'Autorização', 'descricao' => 'Autorização é o ato administrativo ou particular que permite ao pretendente realizar atividades ou utilizar determinado bem fora das rotinas estabelecidas.', 'sigla' => 'AUT']);

        TipoDocumento::create(['nome' => 'Decreto', 'descricao' => 'Ato administrativo destinado a prover situações gerais e individuais, abstratamente previstas de modo expresso, ou implícito na lei. São da competência exclusiva dos chefes do Executivo.', 'sigla' => 'DECR']);

        TipoDocumento::create(['nome' => 'Deliberação', 'descricao' => 'É espécie do gênero ato administrativo normativo ou decisório praticado pelo órgão colegiado', 'sigla' => 'DEL']);

        TipoDocumento::create(['nome' => 'Declaração', 'descricao' => 'Declaração é o documento de manifestação administrativa, declaratório da existência ou não de um direito ou de um fato.', 'sigla' => 'DECL']);

        TipoDocumento::create(['nome' => 'Edital', 'descricao' => 'Instrumento pelo qual a Administração dá conhecimento ao público sobre: licitações,
        concursos públicos, atos deliberativos etc.', 'sigla' => 'EDI']);        


        TipoDocumento::create(['nome' => 'Instrução Normativa', 'descricao' => 'Ato assinado por titular de órgão responsável por atividades sistêmicas, visando a orientar órgãos setoriais e seccionais, a fim de facilitar a tramitação de expedientes relacionados com o sistema e que estejam com instrução e resolução sob responsabilidade desses órgãos. Trata, também, da execução de leis, decretos e regulamentos.', 'sigla' => 'INS']);
        

        TipoDocumento::create(['nome' => 'Lei', 'descricao' => 'É a ordem ou regra imposta à obediência de todos, pela autoridade competente.', 'sigla' => 'LEI']);

        TipoDocumento::create(['nome' => 'Parecer', 'descricao' => 'Manifestação de órgãos especializados sobre assuntos submetidos à sua consideração; indica a solução, ou razões e fundamentos necessários à decisão a ser tomada pela autoridade competente. Pode ser enunciativo, opinativo ou normativo. Em se tratando de parecer emitido por colegiado, este somente surtirá efeitos se aprovado pelo plenário, caso em que deve ser explicitado
        no documento.', 'sigla' => 'PAR']);

        TipoDocumento::create(['nome' => 'Portaria', 'descricao' => 'Ato pelo qual as autoridades competentes (titulares de órgãos) determinam providências de caráter administrativo, visando a estabelecer normas de serviço e procedimentos para o(s) órgão(s), bem como definir situações funcionais e medidas de ordem disciplinar', 'sigla' => 'PORT']);
                
        TipoDocumento::create(['nome' => 'Relatório', 'descricao' => 'É a exposição circunstanciada de atividades levadas a termo por funcionário, no desempenho das funções do cargo que exerce, ou por ordem de autoridade superior. É geralmente feito para expor: situações de serviço, resultados de exames, eventos ocorridos em relação a planejamento, prestação de contas ao término de um exercício etc.', 'sigla' => 'RES']);

        TipoDocumento::create(['nome' => 'Resolução', 'descricao' => 'Ato assinado por Secretários de Estado e / ou titulares de Órgãos diretamente subordinados ao Governador do Estado, visando a instruir normas a serem observadas no âmbito da respectiva área de atuação.', 'sigla' => 'DES']);

        TipoDocumento::create(['nome' => 'Nota Técnica', 'descricao' => '.', 'sigla' => 'NOT']);
        
        TipoDocumento::create(['id'=>0, 'nome' => 'Indeterminado', 'descricao' => 'Tipo de documento não informado ou indeterminado', 'sigla' => 'NI']);

        TipoDocumento::create(['nome' => 'Indicação', 'descricao' => 'Tipo de documento muito utilizado no conselho de estadual de SP.', 'sigla' => 'INDI']);

        TipoDocumento::create(['nome' => 'Publicação', 'descricao' => 'Tipo de documento muito utilizado no conselho de estadual de CE.', 'sigla' => 'PUB']);

        TipoDocumento::create(['nome' => 'Portaria', 'descricao' => '.', 'sigla' => 'POR']);

        TipoDocumento::create(['nome' => 'Instrução', 'descricao' => '.', 'sigla' => 'INSTR']);
        TipoDocumento::create(['nome' => 'Pauta', 'descricao' => '.', 'sigla' => 'PAU']);

        TipoDocumento::create(['nome' => 'Ementa', 'descricao' => '.', 'sigla' => 'EME']);
    }
}
