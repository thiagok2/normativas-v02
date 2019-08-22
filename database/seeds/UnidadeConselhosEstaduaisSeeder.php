<?php

use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadeConselhosEstaduaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO ACRE', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'consed.educacao@ac.gov.br;consed.educacao@gmail.com',
            'url' => null,
            'sigla' => 'CONSED-AC',
            'contato' => 'PRESIDENTE: IRIS CÉLIA CABANELLAS ZANNINI',
            'contato2' => 'SECRETÁRIA EXECUTIVA: SUELY AMÉLIA BAYUM CORDEIRO',
            'endereco' => 'Rua Manoel Cesário, nº 19 – Capoeira CEP: 69.905-006', 
            'telefone' => '(68) 3224-1744 / 3223-9660',
            'user_id' => '1',
            'estado_id' => '1',
            'friendly_url' => 'consed-ac',
            'confirmado' => false
        ]);
    
        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE ALAGOAS', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee.alagoas@gmail.com',
            'url' => 'http://www.cee.al.gov.br',
            'sigla' => 'CEE-AL',
            'contato' => 'PRESIDENTE: ELIEL DOS SANTOS DE CARVALHO',
            'endereco' => ' Rua da Alegria, 379 – Centro Maceió/AL
                                CEP: 57020-320
                                Maceió – AL', 
            'telefone' => '(82) 3315-1401',
            'user_id' => '1',
            'estado_id' => '2',
            'friendly_url' => 'cee-al',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO AMAPÁ', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'wandinalvachagas@hotmail.com;cee@cee.ap.gov.br',
            //'url' => 'http://www.cee.al.gov.br',
            'sigla' => 'CEE-AP',
            'contato' => 'PRESIDENTE: MADALENA DE MOURA MENDONÇA',
            'contato2' => 'SECRETÁRIA EXECUTIVA:WANDINALVA DA COSTA CHAGAS DOS SANTOS 
                            SECRETÁRIO DO COLEGIADO: ALCIDES DE OLIVEIRA E SILVA FILHO',
            'endereco' => 'Avenida Feliciano Coelho, 1969. Bairro : Buritizal. CEP: 68.900-000. Macapá – AP', 
            'telefone' => '(96) 98126-5242/99204-7133',
            'user_id' => '1',
            'estado_id' => '3',
            'friendly_url' => 'cee-ap',            
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO AMAZONAS', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'ceeam@seduc.am.gov.br;edenelzadassuncao@seduc.am.gov.br;hortenciamacedo13@gmail.com',
            //'url' => 'http://www.cee.al.gov.br',
            'sigla' => 'CEE-AM',
            'contato' => 'PRESIDENTE: JOSÉ AUGUSTO DE MELO NETO',
            'contato2' => 'SECRETÁRIA EXECUTIVA: HORTENCIA MACÊDO DA SILVA',
            'endereco' => 'Rua José Paranaguá, nº 574 – Centro
                            CEP: 69.005-130
                            Manaus – AM', 
            'telefone' => '(92) 3234-5074',
            'user_id' => '1',
            'estado_id' => '4',
            'friendly_url' => 'cee-am',
            'confirmado' => false
        ]);

        

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DA BAHIA', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'conselho.bahia@educacao.ba.gov.br;
                            tercontreiras@hotmail.com;tercialopes@uol.com.br;welingtonaraujo@uol.com.br;
                            vanusa.pitanga@educacao.ba.gov.br',
            //'url' => 'http://www.cee.al.gov.br',
            'sigla' => 'CEE-BA',
            'contato' => 'PRESIDENTE: ANATÉRCIA RAMOS LOPES CONTREIRAS',
            'contato2' => 'VICE-PRESIDENTE: WELINGTON ARAÚJO SILVA
                            DIRETORA GERAL: VANUSA VIEIRA LOPES PITANGA',
            'endereco' => 'Av. Engelheiro Oscar Pontes-Prédio Oscar Cordeiro-Água de Menino-Calçada
                                CEP: 40.460-130
                                Salvador – BA', 
            'telefone' => '(71) 3346-0319/3240-5666/3346-1228/3345-5182/(73) 98805-5913',
            'user_id' => '1',
            'estado_id' => '5',
            'friendly_url' => 'cee-ba',
            'confirmado' => false
        ]);
    

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO CEARÁ', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'anamnogueira@gmail.com;ana.nogueira@cee.ce.gov.br;jose.linhares@cee.ce.gov.br',
            'url' => 'http://www.cee.ce.gov.br',
            'sigla' => 'CEE-CE',
            'contato' => 'PRESIDENTE: JOSÉ LINHARES PONTE',
            'contato2' => 'SECRETÁRIA EXECUTIVA: ANA MARIA NOGUEIRA MOREIRA',
            'endereco' => 'Rua Napoleão Laureano, nº 500 – Fátima
                            CEP: 60.411.170
                            Fortaleza – CE', 
            'telefone' => '(85) 3101-2005 / 3101-2011 / 3101-2017',
            'user_id' => '1',
            'estado_id' => '6',
            'friendly_url' => 'cee-ce',
            'confirmado' => false
        ]);


        Unidade::create([
            'nome' => 'CONSELHO DE EDUCAÇÃO DO DISTRITO FEDERAL', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cedf.df@gmail.com',
            'url' => 'http://cedf.se.df.gov.br',
            'sigla' => 'CEE-DF',
            'contato' => 'PRESIDENTE: MÁRIO SÉRGIO MAFRA',
            'contato2' => 'VICE-PRESIDENTE: ÁLVARO MOREIRA DOMINGUES JÚNIOR
                            SECRETÁRIA GERAL: CÍNTIA CRISTINA FAULHABER',
            'endereco' => 'Setor Bancário Norte Quadra 2 Bloco C – Edifício Phenicia, 10° Andar
                            CEP 70.040-020
                            Brasília-DF', 
            'telefone' => '(61) 3901-3151',
            'user_id' => '1',
            'estado_id' => '7',
            'friendly_url' => 'cee-df',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO ESPÍRITO SANTO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee_gab@yahoo.com.br',
            'url' => 'http://www.cee.es.com.br',
            'sigla' => 'CEE-ES',
            'contato' => 'PRESIDENTE: MARIA JOSÉ NOVAES CERUTTI',
            'contato2' => 'SECRETÁRIA GERAL: ROBERTA TAVARES GUAITOLINI EMERICK',
            'endereco' => 'Avenida Nossa Senhora dos Navegantes, n.º 635, 7.º andar, Enseada do Suá.
            CEP: 29.010-900
            Vitória – ES', 
            'telefone' => '(27) 3636-4850 / 3636-4855 / 3636-4854 / 3636-4853',
            'user_id' => '1',
            'estado_id' => '8',
            'friendly_url' => 'cee-es',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE GOIÁS', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'presidenciaceego@gmail.com',
            'url' => 'http://www.cee.go.gov.br',
            'sigla' => 'CEE-GO',
            'contato' => 'PRESIDENTE: MARCOS ELIAS MOREIRA',
            'contato2' => 'VICE-PRESIDENTE: FLÁVIO ROBERTO DE CASTRO
            SECRETÁRIO EXECUTIVO: MARIA ESTER GALVÃO DE CARVALHO',
            'endereco' => 'Rua 3, esquina com a Rua 23, nº 63 – Centro
            CEP: 74.015-120
            Goiânia – GO', 
            'telefone' => '(62) 3201.9811/9812',
            'user_id' => '1',
            'estado_id' => '9',
            'friendly_url' => 'cee-go',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO MARANHÃO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'conselhomaranhao@yahoo.com.br;acvalemartins@gmail.com',
            //'url' => 'http://www.cee.mt.gov.br',
            'sigla' => 'CEE-MA',
            'contato' => 'PRESIDENTE: MARIA DO PERPÉTUO SOCORRO AZEVEDO CARNEIRO',
            'contato2' => 'SECRETÁRIA GERAL: ANA CÉLIA VALE MARTINS',
            'endereco' => 'Rua do Sol 412 – Centro São Luís – MA
            CEP: 65.020-490
            São Luís – MA', 
            'telefone' => '(98)3214-1623(geral)/3214-1624(Presidência)/3232-6256(Assessoria)/3212-3643(Diretora Executiva)',
            'user_id' => '1',
            'estado_id' => '10',
            'friendly_url' => 'cee-ma',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO MATO GROSSO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'marly.oliveira@seduc.mt.gov.br;secex.cee@seduc.mt.gov.br',
            'url' => 'http://www.cee.mt.gov.br',
            'sigla' => 'CEE-MT',
            'contato' => 'PRESIDENTE: ADRIANA TOMASONI',
            'contato2' => 'SECRETÁRIA EXECUTIVA: MARLY DE OLIVEIRA CAMPOS',
            'endereco' => 'Av. Historiador Rubens de Mendonça, nº 800- bairro Bau
            CEP: 78.005-400
            Cuiabá – MT', 
            'telefone' => '(65) 3318-3208',
            'user_id' => '1',
            'estado_id' => '11',
            'friendly_url' => 'cee-mt',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO MATO GROSSO DO SUL', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'conselho.ceems@gmail.com',
            'url' => 'http://www.cee.ms.gov.br',
            'sigla' => 'CEE-MS',
            'contato' => 'PRESIDENTE:EVA MARIA KATAYAMA NEGRISOLLI',
            'contato2' => 'VICE-PRESIDENTE: HÉLIO QUEIRÓS DAHER
            COORDENADORA GERAL:CRISTIANE SAHIB GUIMARÃES',
            'endereco' => 'Rua Lima Felix, s/nº
            CEP: 79037-109
            Campo Grande – MS', 
            'telefone' => '(67) 3318-7080',
            'user_id' => '1',
            'estado_id' => '12',
            'friendly_url' => 'cee-ms',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE MINAS GERAIS', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => ' cee@educacao.mg.gov.br;santosmaisa35@yahoo.com.br',
            'url' => 'http://www.cee.mg.gov.br',
            'sigla' => 'CEE-MG',
            'contato' => 'PRESIDENTE: HÉLVIO DE AVELAR TEIXEIRA',
            'contato2' => 'VICE-PRESIDENTE: MARIA DAS GRAÇAS DE OLIVEIRA
            DIRETORA DA SUPERINTENDÊNCIA EXECUTIVA: CÁTIA MAISA SANTOS',
            'endereco' => 'Rua Rio de Janeiro, nº 2418 – Lourdes
            CEP: 30.160-042
            Belo Horizonte – MG', 
            'telefone' => '(31) 3071-4750',
            'user_id' => '1',
            'estado_id' => '13',
            'friendly_url' => 'cee-mg',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO PARÁ', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'suelymcmenezes@gmail.com;katiatarrio@gmail.com',
            'url' => 'http://www.cee.pa.gov.br',
            'sigla' => 'CEE-PA',
            'contato' => 'PRESIDENTE: SUELY MELO DE CASTRO MENEZES',
            'contato2' => 'SECRETÁRIA EXECUTIVA: KÁTIA CILENE DE VILHENA GOUVÊA TÁRRIO',
            'endereco' => 'Rua Arcipreste Manoel Teodoro 862, Campina
            CEP: 66015-040
            Belém – PA', 
            'telefone' => '(91) 3210-3200',
            'user_id' => '1',
            'estado_id' => '14',
            'friendly_url' => 'cee-pa',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DA PARAÍBA', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee@sec.pb.gov.br;cee.paraiba@gmail.com',
            //'url' => 'http://www.cee.pa.gov.br',
            'sigla' => 'CEE-PB',
            'contato' => 'PRESIDENTE:CARLOS ENRIQUE RUIZ FERREIRA',
            'contato2' => 'SECRETÁRIA EXECUTIVA: JEANNY SERAFIM GALDINO LUCENA',
            'endereco' => 'Av. Duarte da Silveira 450 – Centro (anexo à Escola Estadual Olivina Olívia)
            CEP: 58040-280
            João Pessoa – PB', 
            'telefone' => '(83) 3218-4227 / 3218-4229 / 3218-4230',
            'user_id' => '1',
            'estado_id' => '15',
            'friendly_url' => 'cee-pb',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO PARANÁ', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee-pr@seed.pr.gov.br;cleto_assis@seed.pr.gov.br;c.deassis@gmail.com',
            'url' => 'http://www.cee.pr.gov.br',
            'sigla' => 'CEE-PR',
            'contato' => 'PRESIDENTE: OSCAR ALVES',
            'contato2' => 'SECRETÁRIO GERAL: CLETO DE ASSIS',
            'endereco' => 'Av. Sete de Setembro, nº 5580 – Água Verde
            CEP: 80.240-001
            Curitiba – PR', 
            'telefone' => '(41) 3212-1150 / 3212-1151 (fax)',
            'user_id' => '1',
            'estado_id' => '16',
            'friendly_url' => 'cee-pr',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE PERNAMBUCO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'ceepe@educacao.pe.gov.br;contato.ceepe@gmail.com',
            'url' => 'http://www.cee.pe.gov.br',
            'sigla' => 'CEE-PE',
            'contato' => 'PRESIDENTE: RICARDO CHAVES LIMA',
            'contato2' => 'VICE-PRESIDENTE: HORÁCIO FRANCISCO DOS REIS FILHO
            SECRETÁRIA EXECUTIVA: ELZA DE ARAÚJO CARNEIRO LEÃO',
            'endereco' => 'Av. Rui Barbosa, nº 1559 – B. Graça
            CEP: 52.050-000
            Recife – PE', 
            'telefone' => '(81) 3181-2686',
            'user_id' => '1',
            'estado_id' => '17',
            'friendly_url' => 'cee-pe',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO PIAUÍ', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'secretario@ceepi.pro.br',
            'url' => 'http://www.ceepi.pro.br',
            'sigla' => 'CEE-PI',
            'contato' => 'PRESIDENTE: MARIA PEREIRA DA SILVA XAVIER',
            'contato2' => 'SECRETÁRIA EXECUTIVO: DÉBORA DE FÁTIMA MENDONÇA SANTOS',
            'endereco' => 'Rua Magalhães Filho, 2050 – Marquês, Teresina – PI
            CEP: 65.002-450
            Teresina – PI', 
            'telefone' => '3216-3211(geral); 3216-9090(Presidência); 3216-3286(Técnicos); 3216-9091(Sec. Executiva)',
            'user_id' => '1',
            'estado_id' => '18',
            'friendly_url' => 'cee-pi',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO RIO DE JANEIRO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'presidenciacee@educacao.rj.gov.br; malvina.tuttman@gmail.com; maria2.celi@gmail.com',
            //'url' => 'http://www.ceepi.pro.br',
            'sigla' => 'CEE-RJ',
            'contato' => 'PRESIDENTE: MALVINA TÂNIA TUTTIMAN',
            'contato2' => 'VICE-PRESIDENTE: MARIA CELI CHAVES VASCONCELOS
            SECRETÁRIA GERAL: ELIZABETH DE LIMA GIL VIEIRA',
            'endereco' => 'Avenida Erasmo Braga, nº 118 – 10º andar – Castelo
            CEP: 20.020-009
            Rio de Janeiro – RJ', 
            'telefone' => '(21) 2332-6965 – 2332-6963',
            'user_id' => '1',
            'estado_id' => '19',
            'friendly_url' => 'cee-rj',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO RIO GRANDE DO NORTE', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee@rn.gov.br',
            //'url' => 'http://www.ceepi.pro.br',
            'sigla' => 'CEE-RN',
            'contato' => 'PRESIDENTE: LAÉRCIO SEGUNDO DE OLIVEIRA',
            'contato2' => 'VICE-PRESIDENTE: PE. JOÃO MEDEIROS FILHO
            SECRETÁRIA GERAL: MARIA DA PAZ SANTOS',
            'endereco' => 'Avenida Marechal Floriano Peixoto, 555
            CEP: 59020-035
            Natal – RN', 
            'telefone' => '(84) 3232-6618',
            'user_id' => '1',
            'estado_id' => '20',
            'friendly_url' => 'cee-rn',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DO RIO GRANDE DO SUL', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'ceed@ceed.rs.gov.br; gabinete@ceed.rs.gov.br; iula_santanna@hotmail.com',
            'url' => 'http://www.ceed.rs.gov.br',
            'sigla' => 'CEED-RS',
            'contato' => 'PRESIDENTE: SÔNIA MARIA SEADI VERÍSSIMO DA FONSECA',
            'contato2' => 'VICE-PRESIDENTE: HILÁRIO BASSOTTO
            SECRETÁRIA GERAL: IULA SANTANNA TEIXEIRA',
            'endereco' => 'Centro Administrativo Fernando Ferrari (CAFF) – Av. Borges de Medeiro, nº 1501 – 9º andar
            CEP: 90.119-900
            Porto Alegre – RS', 
            'telefone' => '(51) 3225-6601 / 3225-5313 / 3286-2759',
            'user_id' => '1',
            'estado_id' => '21',
            'friendly_url' => 'ceed-rs',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE RONDÔNIA', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'ceerondonia@gmail.com; ceerondonia@seduc.ro.gov.br',
            'url' => 'http://www.seduc.ro.gov.br/cee',
            'sigla' => 'CEE-RO',
            'contato' => 'PRESIDENTE: FRANCISCA BATISTA DA SILVA',
            'contato2' => 'VICE-PRESIDENTE: HORÁCIO BATISTA GUEDES
            SECRETÁRIA GERAL: EMILIA YOSHIMI IGUCHI',
            'endereco' => 'venida Farqhuar 2749 Bairro Panair
            CEP: 76.801.341
            Porto Velho – RO', 
            'telefone' => '(69) 3216-5345',
            'user_id' => '1',
            'estado_id' => '22',
            'friendly_url' => 'cee-ro',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE RORAIMA', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee.rr@hotmail.com',
            'url' => 'http://www.cee.rr.gov.br',
            'sigla' => 'CEE-RR',
            'contato' => 'PRESIDENTE: SELMA MARIA DE SOUZA E SILVA MULINARI',
            'contato2' => 'VICE-PRESIDENTE: MARIA LUCIMAR DE SALES GOMES
            SECRETÁRIA GERAL: JOCELMA DE ALMEIDA AMORIM',
            'endereco' => 'Avenida Santos Dumont, nº 1917 – São Francisco
            CEP: 69.305-340
            Boa Vista – RR', 
            'telefone' => '(95) 99141-4592',
            'user_id' => '1',
            'estado_id' => '23',
            'friendly_url' => 'cee-rr',
            'confirmado' => false
        ]);


        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE SANTA CATARINA', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee@cee.sc.gov.br; osvaldir@cee.sc.gov.br; presidencia@cee.sc.gov.br',
            'url' => 'http://www.cee.sc.gov.br',
            'sigla' => 'CEE-SC',
            'contato' => 'PRESIDENTE: SELMA MARIA DE SOUZA E SILVA MULINARI',
            'contato2' => 'VICE-PRESIDENTE: MARIA LUCIMAR DE SALES GOMES
            SECRETÁRIA GERAL: JOCELMA DE ALMEIDA AMORIM',
            'endereco' => 'Av. Osmar Cunha 182, Bloco B, sala 303 – Centro
            CEP: 88.015-100
            Florianópolis – SC', 
            'telefone' => '(48) 3224-0104 (das 12 as 19 horas)',
            'user_id' => '1',
            'estado_id' => '24',
            'friendly_url' => 'cee-sc',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE SÃO PAULO', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'presidencia.ceesp@educacao.sp.gov.br;arthur.torres@educacao.sp.gov.br',
            'url' => 'http://www.ceesp.sp.gov.br',
            'sigla' => 'CEE-SP',
            'contato' => 'PRESIDENTE: HUBERT ALQUÉRES',
            'contato2' => 'VICE-PRESIDENTE: GHISLEINE TRIGO SILVEIRA
            CHEFE DE GABINETE: ARTHUR JOSÉ PAVAN TORRES',
            'endereco' => 'ACasa Caetano de Campos – Praça da República, nº 53, sala 237
            CEP: 01045-903 – São Paulo/SP', 
            'telefone' => '(11) 2075-4502 / (11) 2075-4500 (PABX)',
            'user_id' => '1',
            'estado_id' => '25',
            'friendly_url' => 'cee-sp',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE SERGIPE', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cee.se@seed.se.gov.br',
            'url' => 'http://www.cee.se.gov.br',
            'sigla' => 'CEE-SE',
            'contato' => 'PRESIDENTE: LUANA SILVA BOAMORTE DE MATOS',
            'contato2' => 'VICE-PRESIDENTE: JOSÉ SEBASTIÃO DOS SANTOS FILHO
            SECRETÁRIO GERAL: TATIANA SILVA SALES',
            'endereco' => 'Rua Arauá, nº. 892, Bairro São José
            CEP: 49.015-970
            Aracaju – SE', 
            'telefone' => '(79) 3205-3402',
            'user_id' => '1',
            'estado_id' => '26',
            'friendly_url' => 'cee-se',
            'confirmado' => false
        ]);

        Unidade::create([
            'nome' => 'CONSELHO ESTADUAL DE EDUCAÇÃO DE TOCANTINS', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'secretariaexecutiva@cee.to.gov.br',
            //'url' => 'http://www.cee.se.gov.br',
            'sigla' => 'CEE-TO',
            'contato' => 'PRESIDENTE: EVANDRO BORGES ARANTES',
            'contato2' => 'VICE-PRESIDENTE: JOSIEL GOMES DOS SANTOS
            SECRETÁRIO EXECUTIVO: JOANA D’ARC ALVES SANTOS',
            'endereco' => 'Av. 103 Sul, Rua SO 01, Lote 08, Centro
            CEP: 77.015-034
            Palmas – TO', 
            'telefone' => '(63) 3218-6221',
            'user_id' => '1',
            'estado_id' => '27',
            'friendly_url' => 'cee-to',
            'confirmado' => false
        ]);
    
    
    
    }
}
