<?php

class Jogos {
    private $qtd_dezenas;
    private $resultado;
    private $total_jogos;
    private $jogos;
    private $mensagem;

    #4
    private function geraDezenas() {
        $numeros = range(1, 60);
        $dezenas = [];

        foreach(array_rand($numeros, $this->getQtdDezenas()) as $k => $num) {
            $dezenas[] = $numeros[$num];
        }

        return $dezenas;
    }

    private function validaQtdDezenas() {

        $valido = false;

        $value = $this->getQtdDezenas();

        if($value >= 6 && $value <= 10) {
            $valido = true;
        } else {
            $this->setMensagem("Quantidade de dezenas dever somente 6, 7, 8, 9 ou 10.");
        }
        
        return $valido;
    }

    public function __construct($qtd_dezenas, $total_jogos) {
        $this->setQtdDezenas($qtd_dezenas);
        $this->setTotalJogos($total_jogos);

        if($this->validaQtdDezenas()) {
            $this->realizaJogo();
            $this->realizaSorteio();
            $this->confereJogo();
        } else {
            echo $this->getMensagem();
        }
    }

    #5
    public function realizaJogo() {
        $result = [];

        for($i = 0; $i < $this->getTotalJogos(); $i++) {
            $result[] = $this->geraDezenas();
        }

        $this->setJogos($result);
    }

    #6
    public function realizaSorteio() {
        $numeros = range(1, 60);
        $resultado = [];

        foreach(array_rand($numeros, 6) as $k => $num) {
            $resultado[] = $numeros[$num];
        }

        $this->setResultado($resultado);
    }

    public function confereJogo() {
        $jogos = $this->getJogos();
        $resultado = $this->getResultado();

        echo '<table style="font-family: monospace; font-size: 14px; margin-bottom: 10px"><th colspan="6">Números Sorteados</th><tr>';
        foreach($resultado as $numero) {
            echo '<td style="border: 1px solid;">';
            echo str_pad($numero, 2, 0, STR_PAD_LEFT);
            echo '</td>';
        }

        echo '</tr>';

        foreach($jogos as $k => $jogo) {
            $acertos = array_intersect($jogo, $resultado);
            $index = $k + 1;
            $count_acertos = count($acertos);
            echo '<table style="font-family: monospace;  font-size: 14px; margin-bottom: 10px">';
            
            echo "<th colspan=\"10\">Jogo $index: $count_acertos acerto(s)</th></tr><tr>";
            foreach($jogo as $numero) {
                $cor_fonte = "";
                if(in_array($numero, $acertos)) {
                    $cor_fonte = "color: green";
                }
                echo "<td style=\"border: 1px solid;$cor_fonte\">";
                echo str_pad($numero, 2, 0, STR_PAD_LEFT);
                echo '</td>';
            }

            echo '</tr>';
            echo '</table>';    
        }
    }

    public function getQtdDezenas() {
        return $this->qtd_dezenas;
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function getTotalJogos() {
        return $this->total_jogos;
    }

    public function getJogos() {
        return $this->jogos;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setQtdDezenas($value = 6) {
        $this->qtd_dezenas = $value;
    }

    public function setResultado($value) {
        $this->resultado = $value;
    }

    public function setTotalJogos($value) {
        $this->total_jogos = $value;
    }

    public function setJogos($value) {
        $this->jogos = $value;
    }

    public function setMensagem($value) {
        $this->mensagem = $value;
    }

}

$output = new Jogos(8, 5);
