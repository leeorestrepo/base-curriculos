
//tamanho do valor do objeto 
function size(obj){

	return trim(obj).length;

}

//trim do valor do objeto 
function trim(id){

	return jQuery.trim($("#"+id).val());

}

function strTrim( str ){
	return jQuery.trim( str );
}

function strTrimSize( str ){
	return strTrim( str ).length;
}

//tam min requerido do valor do objeto 
function min(id, i){
	
	return ( isset(id) && size(id) >= i ) ? true : false ;

}

function max(id, i){

	return  size(id) <= i ? true : false ;

}

function validarCheck(_class, qtd){

	qtd = pOpcional(qtd, 1);

	if( $( "input[type=checkbox][class="+_class+"]:checked" ).length >= qtd ){

		return false;

	}

	return true;

}

function issetObjInClass(_class){
	
	return $(_class).length > 0 ? true : false;
	
}

function habilitar(){
	$('.habilitar').attr('disabled', '');
}

function comment(id){
	$(".comment").animate({"width": "50%"}, "slow");
}

function disabled(id){
	$('#'+id).attr('disabled', 'disabled');
}

function enable(id){
	$('#'+id).attr('disabled', '');
}

function displayOn(id){
	$('#'+id).css('display', 'block');
}

function displayOnClass(id){
	$('.'+id).css('display', 'block');
}

function displayOff(id){
	$('#'+id).css('display', 'none');
}

function displayOffClass(id){
	$('.'+id).css('display', 'none');
}

function displayOnAtrb(Atrb){
	$(Atrb).css('display', 'block');
}

function displayOffAtrb(Atrb){
	$(Atrb).css('display', 'none');
}

function redirecionarPorTempo(pagina, tempo){
	setTimeout( "location.href='"+pagina+"'" , tempo);
}

function pOpcional(obj,opcao){
	if (typeof(obj)=="undefined"||obj==null){
		return opcao;
	}
	return obj;
}

function verEsconder(id){
	if($("#"+id).css('display')=='none'){
		displayOn(id);
	}else{
		displayOff(id);		
	}
}

function verEsconderClass(id){
	if($("."+id).css('display')=='none'){
		displayOnClass(id);
	}else{
		displayOffClass(id);		
	}
}

function isset(id){
	if (typeof(getById(id))=="undefined"||getById(id)==null){
		return false;
	}
	return true;
}

function getById(id){
	return document.getElementById(id);
}


function validarTamanho(id,minimo){
	if(size($(id)) < minimo){
		return false;
	}else{
		return true;
	}
}

function eChecked(id){

	if($(id).attr('checked') == true){

		$(id).attr('checked', false);

	}else{

		$(id).attr('checked', true);

	}

}

function opener(url){
	window.top.location.href = url;
}

function popup(url){
	window.open(url, 'EPICO', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');
}

function openerBlank(url){
	window.open(url, '_blank');
}

function openerBlankRemote(url){
	window.open(url, '_blank');
}

function removerObj(id){
	$("#"+id).remove();
}

function removerObjElement(obj){
	$("#"+obj.id).remove();
}

function removerObjThis(obj){
	$(obj).remove();
}

function confirma(msg){
	return window.confirm(msg);
}

function removerDiv(divId){
	$("#"+divId).remove();
}
function jVal(_obj){
	return $(_obj).val();
}
function notIsNumber( val ){
	if( isNaN( val ) ){
		cleanPopUp("O valor informado ("+val+") não é um numero!");
		return true;
	}
	return false;
}

function removeParentDiv(obj){
	
	$(obj).parent("div").remove();
	
}
function passarValor( _this, obj ){
	
	$( obj ).val( $( _this ).val() );

}
function removerHtmlInvalido( strMultiLineText, replaceWith ){

	return strMultiLineText.replace(new RegExp( "\\n", "g" ),replaceWith).replace(new RegExp( "\\t", "g" ),replaceWith).replace("<tbody>",replaceWith).replace("</tbody>",replaceWith).replace("<a","<span").replace("</a","</span");

}

function removerHtmlInvalidoToDecimal( strMultiLineText, replaceWith ){

	var string = removerHtmlInvalido( strMultiLineText, replaceWith );
	
	return toDecimal( string );

}

function toDecimal(string) {
	
	// LETRAS

	string = replaceAll(string, 'á', '&#225;');
	string = replaceAll(string, 'à', '&#224;');
	string = replaceAll(string, 'ã', '&#227;');
	string = replaceAll(string, 'ä', '&#228;');
	string = replaceAll(string, 'â', '&#236;');
	
	string = replaceAll(string, 'é', '&#233;');
	string = replaceAll(string, 'è', '&#232;');
	string = replaceAll(string, 'ë', '&#235;');
	string = replaceAll(string, 'ê', '&#234;');

	string = replaceAll(string, 'í', '&#237;');
	string = replaceAll(string, 'ì', '&#236;');
	string = replaceAll(string, 'ï', '&#239;');
	string = replaceAll(string, 'î', '&#238;');
	
	string = replaceAll(string, 'ó', '&#243;');
	string = replaceAll(string, 'ò', '&#242;');
	string = replaceAll(string, 'õ', '&#245;');
	string = replaceAll(string, 'ö', '&#246;');
	string = replaceAll(string, 'ô', '&#244;');
	
	string = replaceAll(string, 'ú', '&#250;');
	string = replaceAll(string, 'ù', '&#249;');
	string = replaceAll(string, 'ü', '&#252;');
	string = replaceAll(string, 'û', '&#251;');
	
	string = replaceAll(string, 'ç', '&#231;');

	string = replaceAll(string, 'Á', '&#193;');
	string = replaceAll(string, 'À', '&#192;');
	string = replaceAll(string, 'Ã', '&#195;');
	string = replaceAll(string, 'Ä', '&#196;');
	string = replaceAll(string, 'Â', ' &#194;');
	
	string = replaceAll(string, 'É', '&#201;');
	string = replaceAll(string, 'È', '&#200;');
	string = replaceAll(string, 'Ë', '&#203;');
	string = replaceAll(string, 'Ê', '&#202;');
	
	string = replaceAll(string, 'Í', '&#205;');
	string = replaceAll(string, 'Ì', '&#204;');
	string = replaceAll(string, 'Ï', '&#207;');
	string = replaceAll(string, 'Î', '&#206;');
	
	string = replaceAll(string, 'Ó', '&#211;');
	string = replaceAll(string, 'Ò', '&#210;');
	string = replaceAll(string, 'Õ', '&#213;');
	string = replaceAll(string, 'Ö', '&#214;');
	string = replaceAll(string, 'Ô', '&#212;');
	
	string = replaceAll(string, 'Ú', '&#218;');
	string = replaceAll(string, 'Ù', '&#217;');
	string = replaceAll(string, 'Ü', '&#220;');
	string = replaceAll(string, 'Û', '&#219;');

	string = replaceAll(string, 'Ç', '&#199;');
	
	// SINAIS 
	
	// string = replaceAll(string, '!', '&#33;');
	// string = replaceAll(string, '"', '&#34;');
	// string = replaceAll(string, '\'', '&#92;');
	// string = replaceAll(string, '#', '&#35;');
	string = replaceAll(string, '$', '&#36;');
	string = replaceAll(string, '%', '&#37;');
	string = replaceAll(string, '¨', '&#168;');
	// string = replaceAll(string, '*', '&#42;');
	// string = replaceAll(string, '(', '&#40;');
	// string = replaceAll(string, ')', '&#41;');
	// string = replaceAll(string, '-', '&#45;');
	// string = replaceAll(string, '_', '&#95;');
	// string = replaceAll(string, '+', '&#43;');
	// string = replaceAll(string, '=', '&#61;');
	// string = replaceAll(string, '.', '&#46;');
	// string = replaceAll(string, '|', '&#124;');
	// string = replaceAll(string, ',', '&#44;');
	string = replaceAll(string, 'ª', '&#170;');
	string = replaceAll(string, 'º', '&#186;');
	string = replaceAll(string, '§', '&#167;');
	string = replaceAll(string, '¢', '&#162;');
	string = replaceAll(string, '¬', '&#172;');
	
	return string;
	
}

function replaceAll(string, token, newtoken) {
	
	while (string.indexOf(token) != -1) {
		
 		string = string.replace(token, newtoken);
 		
	}
	
	return string;
	
}

function ocorrencia(parte, todo){

	var qtd = 0;

	for(var i = 0; i < (todo.length - parte.length + 1); i++){

		var res = todo.substring(i, (i + parte.length));

		if( res == parte ){

			qtd++;

		}

	}

	return qtd;

}

/**
 * dataMaior
 * @param idDataUm
 * @param idDataDois
 * @returns {Boolean}
 */
function dataMaior( idDataUm, idDataDois ){

	var strDataUm	=	$("#"+idDataUm).val();

	var strDataDois	=	$("#"+idDataDois).val();
	
	if( min( strDataUm, 8 ) == false || min( strDataDois, 8 ) == false ){

		cleanPopUp( "Não foi possível comparar as datas. <br> Uma ou outra data não foi informada corretamente." );

		return false;

	}

	return strDataMaior(strDataUm, strDataDois);

};

function strDataMaior( strDataUm, strDataDois ){

	var dataUm		=	parseInt( strDataUm.split("/")[2].toString() + strDataUm.split("/")[1].toString() + strDataUm.split("/")[0].toString() );

	var dataDois	=	parseInt( strDataDois.split("/")[2].toString() + strDataDois.split("/")[1].toString() + strDataDois.split("/")[0].toString() );

	if( dataUm > dataDois ){

		return true;

	}

	return false;

};

/**
 * dataMenor
 * @param idDataUm
 * @param idDataDois
 * @returns {Boolean}
 */
function dataMenor(idDataUm, idDataDois){

	var strDataUm	=	$("#"+idDataUm).val();

	var strDataDois	=	$("#"+idDataDois).val();

	var dataUm		=	parseInt( strDataUm.split("/")[2].toString() + strDataUm.split("/")[1].toString() + strDataUm.split("/")[0].toString() );

	var dataDois	=	parseInt( strDataDois.split("/")[2].toString() + strDataDois.split("/")[1].toString() + strDataDois.split("/")[0].toString() );

	if( dataUm < dataDois ){

		return true;

	}

	return false;

};

var dateDif = {
	dateDiff: function(strDate1,strDate2){
		return (((Date.parse(strDate2))-(Date.parse(strDate1)))/(24*60*60*1000)).toFixed(0);
	}
};

function diasEntreDatas(dataInicial, dataFinal){

	var mes = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	var arrDataFinal = dataFinal.split('/');

	var arrDataInicial = dataInicial.split('/');

	var novaDataInicial = mes[(arrDataInicial[1] - 1)] + ' ' + arrDataInicial[0] + ' ' + arrDataInicial[2];

	var novaDataFinal = mes[(arrDataFinal[1] - 1)] + ' ' + arrDataFinal[0] + ' ' + arrDataFinal[2];

	var diasEntreDatas = dateDif.dateDiff(novaDataInicial, novaDataFinal);

	return diasEntreDatas;

}

function validarData( id ){

	var dataPtBr = $("#"+id).val();

	if( isset( id ) && min( id, 5 ) ){ 
	
		var ano = dataPtBr.split("/")[2].toString();
	
		var mes = dataPtBr.split("/")[1].toString();
	
		var dia = dataPtBr.split("/")[0].toString();
	
		if( dia > 31 || dia < 1 || mes > 12 || mes < 1 || ano > 2100 || ano < 1900 ){
	
			cleanPopUp('Você só pode estar brincando! <br/> A data ' + dia +'/'+ mes +'/'+ ano + ' não pode ser aceita. ');
	
			return false;
	
		}
	
		return true;
		
	}else{
		
		return false;
		
	}

};

/**
 * HoraMaior
 * @param idHoraUm
 * @param idHoraDois
 * @returns {Boolean}
 */
function horaMaior(idHoraUm, idHoraDois){

	var strHoraUm	=	$("#"+idHoraUm).val();

	var strHoraDois	=	$("#"+idHoraDois).val();

	var horaUm		=	strHoraUm.split(":")[0].toString();

	var minUm		=	strHoraUm.split(":")[1].toString();

	var horaDois	=	strHoraDois.split(":")[0].toString();

	var minDois		=	strHoraDois.split(":")[1].toString();

	var horaUm		=	parseInt( horaUm[0] == "0" ? horaUm[1] : horaUm ) ;

	var horaDois	=	parseInt( horaDois[0] == "0" ? horaDois[1] : horaDois ) ;

	var minUm		=	parseInt( minUm[0] == "0" ? minUm[1] : minUm ) ;

	var minDois		=	parseInt( minDois[0] == "0" ? minDois[1] : minDois ) ;

	if( horaUm == horaDois && minUm == minDois ){

		return false;

	}

	if( horaUm > horaDois ){

		return true;

	}else if( horaUm == horaDois && minUm > minDois ){

		return true;

	}

	return false;

};

/**
 * HoraMenor
 * @param idHoraUm
 * @param idHoraDois
 * @returns {Boolean}
 */
function horaMenor(idHoraUm, idHoraDois){

	var strHoraUm	=	$("#"+idHoraUm).val();

	var strHoraDois	=	$("#"+idHoraDois).val();

	var horaUm		=	strHoraUm.split(":")[0].toString();

	var minUm		=	strHoraUm.split(":")[1].toString();

	var horaDois	=	strHoraDois.split(":")[0].toString();

	var minDois		=	strHoraDois.split(":")[1].toString();

	var horaUm		=	parseInt( horaUm[0] == "0" ? horaUm[1] : horaUm ) ;

	var horaDois	=	parseInt( horaDois[0] == "0" ? horaDois[1] : horaDois ) ;

	var minUm		=	parseInt( minUm[0] == "0" ? minUm[1] : minUm ) ;

	var minDois		=	parseInt( minDois[0] == "0" ? minDois[1] : minDois ) ;

	if( horaUm == horaDois && minUm == minDois ){

		return false;

	}

	if( horaUm < horaDois ){

		return true;

	}else if( horaUm == horaDois && minUm < minDois ){

		return true;

	}

	return false;

};

function upperText() {
	
	$(".alta").bind('paste', function(e) {
		var el = $(this);
		setTimeout(function() {
			var text = $(el).val();
			el.val(text.toUpperCase());
		}, 100);
	});

	$(".alta").keypress(function() {
		var el = $(this);
		setTimeout(function() {
			var text = $(el).val();
			el.val(text.toUpperCase());
		}, 100);
	});
	
}

function minText(id, qtd){
	
	return jQuery.trim($("#"+id).text()).length >= qtd ? true : false; 
	
}

function enviarFormulario( idForm, botaoForm){
	
	removerObj( botaoForm );
	
	$("#"+idForm).submit();
	
}
function evidenciar( _key, volta, cor, cor_volta){
	
	if( isset( _key ) || issetObjInClass( _key ) ){
	
		var _cor	= pOpcional( cor, "#FFA1A1" );
		
		var _cor_volta	= pOpcional( cor_volta, "#FFFFFF" );
		
		var _volta	=	pOpcional( volta, 1 );
		
		if( _volta == 1 ){
		
			$( _key ).css("background-color", _cor );
			
			setTimeout( "evidenciar('"+_key+"', '2', '"+_cor+"', '"+_cor_volta+"')" , 5000 );
			
		}else{
			
			$( _key ).css("background-color", _cor_volta );
	
		}
		
	}
	
}

function F5(){
	
	window.top.location.href = window.location.pathname;
	
}

function isMobileIOS(){
	
    return (
        
    	//Detect iPhone
        (navigator.platform.indexOf("iPhone") != -1) ||
        
        //Detect iPod
        (navigator.platform.indexOf("iPod") != -1) || 
        
        //Detect iPad
        (navigator.platform.indexOf("iPad") != -1)
    	
    );
    
}

function getStrIdS( elementS, separador ){
	
	 var _separador = pOpcional( separador, " " ); // pipe  
	 
	 var _elementS = pOpcional( elementS, "body :input" );
	
     var strIdS = "";
     
     $( _elementS ).each(function (index){
    	 
    	 strIdS += $(this).attr('id') + _separador ;
    	 
     });
     
     return strIdS;
}

function ucfirst(str) {
	return str.substr(0,1).toUpperCase()+str.substr(1);
}

function ucfirstId(id) {
	var val = $("#".id).va();
	return val.substr(0,1).toUpperCase()+val.substr(1);
}

function gerarChavePorData(){
	
	var data = new Date();
	
	var chave = data.getHours() + "" + data.getMinutes() + "" + data.getSeconds() + "" + data.getMilliseconds();
	
	return chave;
	
}