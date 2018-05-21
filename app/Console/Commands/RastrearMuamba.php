<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Mail\RastrearEncomendaCronSend;

use App\Muamba;
use Correios;

class RastrearMuamba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rastrear:muamba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rastrear muamba e enviar por email, caso tenha atualização';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $muambas = Muamba::with('users')->where('fl_recebido', 0)->get();
        
        if (isset($muambas) && count($muambas) > 0) {
            foreach($muambas as $key => $muamba) {
                $eventos = Correios::rastrear($muamba->codigo_rastreio);

                if (isset($eventos) && count($eventos) > 0) {
                    if ($muamba->ultimo_status != $eventos[0]['status']) {
                        $muambaEspecifica = Muamba::where('id', $muamba->id)->first();
                        $muambaEspecifica->ultimo_status = $eventos[0]['status'];

                        if ($muambaEspecifica->save()) {
                            try {
                                Mail::send(new RastrearEncomendaCronSend($eventos[0], $muamba));
                        
                                $this->info('E-mail enviado com sucesso ...');
                            } catch (Exception $e) {
                                $this->info($this->error($e));  
                            }
                            
                        } else {
                            $this->info('Erro ao atualizar status da muamba ...');
                        }
                    }
                } else {
                    $this->info('Erro ao rastrear muamba ...');
                }
            }   
        } else {
            $this->info('Nenhuma muamba encontrada ...');
        }
    }
}
