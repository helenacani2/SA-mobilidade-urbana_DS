function ao_entrar() {

    document.getElementById("linha").innerHTML = "Norte-Sul - Linha Roxa";
    
    document.getElementById("preco_passagem").innerHTML = "9.99";
    
    document.getElementById("linha_nome").innerHTML = "📍 Linha Férrea da Paçoca";

    setInterval(tempo_estimado, 1000);

};


let HorasTempo = (localStorage.getItem("TempoHora"));
let MinutosTempo = (localStorage.getItem("TempoMinuto"));
let NomeRotaSelecionada = (localStorage.getItem("NomeRotaSelecionada"));

let DiasTempo = 1;

function comeco(){

    HorasTempo = (localStorage.getItem("TempoHora"));
    MinutosTempo = (localStorage.getItem("TempoMinuto"));
    NomeRotaSelecionada = (localStorage.getItem("NomeRotaSelecionada"));

}

    
function tempo_estimadoTESTE() {

    alert("Mensagem ao clicar no mapa");

}


function tempo_estimado() {

    const data = new Date();

    var h = parseInt(data.getHours());

    var m = parseInt(data.getMinutes());

    HorasTempo = (localStorage.getItem("TempoHora"));
    MinutosTempo = (localStorage.getItem("TempoMinuto"));
    NomeRotaSelecionada = (localStorage.getItem("NomeRotaSelecionada"));

    DiasTempo = 0;

    MinutosChegada = m + MinutosTempo;

    while(MinutosChegada >= 60) {

        MinutosChegada = MinutosChegada - 60;   //essa parte foi parcialmente feita pelo João, créditos a ele

        h++;

    }

    HorasChegada = h + HorasTempo;

    while(HorasChegada >= 24) {

        HorasChegada = HorasChegada - 24;

        DiasTempo++

    }

    if(MinutosChegada < 10) {

        MinutosChegada = "0" + MinutosChegada;

    }

    if(HorasChegada < 10) {

        HorasChegada = "0" + HorasChegada;

    }

    //DiaChegada = d;


    //document.getElementById('hora').innerHTML = "Chega na estação em: Dia " + DiaChegada + ", às " + HorasChegada + ":" + MinutosChegada;

    if(DiasTempo > 0) {

        document.getElementById('hora').innerHTML = "Chega na estação às: " + HorasChegada + ":" + MinutosChegada + ", em " + DiasTempo + " dias.";

    } else {

        document.getElementById('hora').innerHTML = "Chega na estação às: " + HorasChegada + ":" + MinutosChegada + ", no dia de hoje.";

    }

    document.getElementById('rota_atual').innerHTML = "Rota atual: " + localStorage.getItem("NomeRotaSelecionada");

};

function hora_zero(h) {

    if (h < 10) {

        h = "0" + h;
    };

    return h;
};

function minuto_zero(m) {

    if (m < 10) {

        m = "0" + m;

    };

    return m;
};

function em_viagem() {

    var zero_um;

    zero_um = Math.random(1);

    if (zero_um >= 0.5) {

        viagem();

    } else {

        estacao();

    };
    
};

function viagem() {

    document.getElementById("em_viagem").innerHTML = "✰ Em viagem";

};

function estacao() {

    document.getElementById("em_viagem").innerHTML = "✰ Na estação";

};

MapaAtualiza = document.getElementById("MapaJanela");

MapaAtualiza.addEventListener("mouseover", tempo_estimado);
MapaAtualiza.addEventListener("mouseout", tempo_estimado);