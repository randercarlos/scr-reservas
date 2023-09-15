$(document).foundation()

function validaDataIntervaloDatasBR(data_entrada, data_saida)
{
    //dtUm = "28/02/2015"; //Formato dd/mm/aaaa
    //dtDois = "28/03/2015"; //Formato dd/mm/aaaa

    //Convertendo em novas datas
    var data_entrada = new Date(data_entrada.replace(/(\d{2})\/(\d{2})\/(\d{4})/,'$2/$1/$3'));
    var data_saida = new Date(data_saida.replace(/(\d{2})\/(\d{2})\/(\d{4})/,'$2/$1/$3'));

    // se a data de entrada posterior a data de saída. Retorna falso
    if(data_entrada > data_saida) {
        return false;
    }

    // Se a data de saida for igual ou posterior a data de entrada. Retorna true
    return true;
}

function isDataValida(data) {
   if (data.length == 10) {
       er = /(0[0-9]|[12][0-9]|3[01])[-\.\/](0[0-9]|1[012])[-\.\/][0-9]{4}/;
       if (er.exec(data)) {
           return true;
       } else {
           return false;
       }

   } else {
       return false;
   }
}
