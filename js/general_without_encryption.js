/************************************************************************************************************
Basado en Dragable RSS boxes y modificado por Miquel Camps Orteza
(C) www.dhtmlgoodies.com, January 2006
www.dhtmlgoodies.com
Alf Magne Kalleland
************************************************************************************************************/	

var inlinks=new Array('1-Google-0','2-'+TXT_IMG_GOOGLE+'-0','3-Yahoo-0','4-Live-0');
var rank=new Array('5-Google PageRank-0','6-Technorati-0','7-Alexa-0','8-DMOZ-0');
var valid=new Array('9-XHTML-0','10-CSS-0','11-RSS-0');
var siteinfo=new Array('12-'+TXT_URL+'-0','13-'+TXT_TITLE+'-0','14-'+TXT_KEYWORDS+'-1','15-'+TXT_DESCR+'-0','16-'+TXT_HTML_SIZE+'-1','17-'+TXT_HTML_TAGS+'-0','18-Favicon-0');
var bookmarks=new Array('19-del.icio.us-0','20-Digg-0','21-Mister Wong-0','22-Meneame-0','23-Webeame-0','24-Fresqui-0','25-Clipmarks-0');
var sindicacion=new Array('26-'+TXT_FEED_PEOPLE+'-1','27-'+TXT_FEED_VISITS,'28-'+TXT_FEED_BLOGLINES+'-0');
var backlinks=new Array('29-Google-0','30-Yahoo-0','45-Alexa-0','31-Live-0','32-Technorati-0','33-Webcrawler-0','34-Clusty-0','35-Orange-0','36-Lycos-0','37-Altavista-0','38-AlltheWeb-0','39-Ask Jeeves-0','40-HotBot-0');
var dominio=new Array('41-IP-0','43-'+TXT_ONLINE+'-0','46-'+TXT_AUTHOR+'-0','42-'+TXT_COUNTRY+'-0');
var captura=new Array('44-'+TXT_PHOTO+'-0');

var h_siteinfo = 240;
var h_backlinks = 260;
var h_inlinks = 100;
var h_rank = 100;
var h_valid = 80;
var h_bookmarks = 180;
var h_sindicacion = 80;
var h_dominio = 100;
var h_captura = 177;

/* USER VARIABLES */
var numberOfColumns=3;// Number of columns for dragable boxes
var columnParentBoxId='floatingBoxParentContainer';// Id of box that is parent of all your dragable boxes
var transparencyWhenDragging=true;
var autoScrollSpeed=4;// Autoscroll speed- Higher=faster
var dragObjectBorderWidth=1;// Border size of your RSS boxes - used to determine width of dotted rectangle
var useCookiesToRememberRSSSources=true;
var nameOfCookie='dragable_rss_boxes';// Name of cookie

/* END USER VARIABLES */
var cargattot=false;
var numeroop;
var columnParentBox;
var dragableBoxesObj;
var ajaxObjects=new Array();
var autoScrollActive=false;
var dragableBoxesArray=new Array();
dragDropCounter=-1;
var dragObject=false;
var dragObjectNextSibling=false;
var dragObjectParent=false;
var destinationObj=false;
var mouse_x;
var mouse_y;
var el_x;
var el_y;
var rectangleDiv;
var okToMove=true;
var documentHeight=false;
var documentScrollHeight=false;
var dragableAreaWidth=false;
var opera=navigator.userAgent.toLowerCase().indexOf('opera')>=0?true:false;
var cookieCounter=0;
var cookieRSSSources=new Array();
var staticObjectArray=new Array();

function addLoadEvent(func) {
	var oldonload=window.onload;
	if (typeof window.onload != 'function') {
		window.onload=func;
	}
	else {
		window.onload=function() {
			oldonload();
			func();
	};
	}
};

/*
These cookie functions are downloaded from 
http://www.mach5.com/support/analyzer/manual/html/General/CookiesJavaScript.htm
*/	
function Get_Cookie(name) { 
	var start=document.cookie.indexOf(name+"="); 
	var len=start+name.length+1; 
	if ((!start) && (name != document.cookie.substring(0,name.length))) return null; 
	if (start == -1) return null; 
	var end=document.cookie.indexOf(";",len); 
	if (end == -1) end=document.cookie.length; 
	return unescape(document.cookie.substring(len,end)); 
};

// This function has been slightly modified
function Set_Cookie(name,value,expires,path,domain,secure) { 
	expires=expires * 60*60*24*1000;
	var today=new Date();
	var expires_date=new Date( today.getTime() + (expires) );
    var cookieString=name + "=" +escape(value) + 
       ( (expires) ? ";expires=" + expires_date.toGMTString() : "") + 
       ( (path) ? ";path=" + path : "") + 
       ( (domain) ? ";domain=" + domain : "") + 
       ( (secure) ? ";secure" : ""); 
    document.cookie=cookieString; 
};

function autoScroll(direction,yPos){
	if(document.documentElement.scrollHeight>documentScrollHeight && direction>0)return;
	if(opera)return;
	window.scrollBy(0,direction);
	if(!dragObject)return;
	if(direction<0){
		if(document.documentElement.scrollTop>0)dragObject.style.top=(el_y - mouse_y + yPos + document.documentElement.scrollTop) + 'px';		
		else autoScrollActive=false;
	}else{
		if(yPos>(documentHeight-50))dragObject.style.top=(el_y - mouse_y + yPos + document.documentElement.scrollTop) + 'px';			
		else autoScrollActive=false;
	}
	if(autoScrollActive)setTimeout('autoScroll('+direction+',' + yPos + ')',5);
};

function initDragDropBox(e){
	dragDropCounter=1;
	if(document.all)e=event;
	if (e.target) source=e.target;
		else if (e.srcElement) source=e.srcElement;
		if (source.nodeType == 3) // defeat Safari bug
			source=source.parentNode;
	if(source.tagName.toLowerCase()=='img' || source.tagName.toLowerCase()=='a' || source.tagName.toLowerCase()=='input' || source.tagName.toLowerCase()=='td' || source.tagName.toLowerCase()=='tr' || source.tagName.toLowerCase()=='table')return;
	mouse_x=e.clientX;
	mouse_y=e.clientY;
	var numericId=this.id.replace(/[^0-9]/g,'');
	el_x=getLeftPos(this.parentNode.parentNode)/1;
	el_y=getTopPos(this.parentNode.parentNode)/1 - document.documentElement.scrollTop;
	dragObject=this.parentNode.parentNode;
	documentScrollHeight=document.documentElement.scrollHeight + 100 + dragObject.offsetHeight;
	if(dragObject.nextSibling){
		dragObjectNextSibling=dragObject.nextSibling;
		if(dragObjectNextSibling.tagName!='DIV')dragObjectNextSibling=dragObjectNextSibling.nextSibling;
	}
	dragObjectParent=dragableBoxesArray[numericId]['parentObj'];
	dragDropCounter=0;
	initDragDropBoxTimer();	
	return false;
};

function initDragDropBoxTimer(){
	if(dragDropCounter>=0 && dragDropCounter<10){
		dragDropCounter++;
		setTimeout('initDragDropBoxTimer()',10);
		return;
	}
	if(dragDropCounter==10)mouseoutBoxHeader(false,dragObject);
};

function moveDragableElement(e){
	if(document.all)e=event;
	if(dragDropCounter<10)return;
	if(document.all && e.button!=1 && !opera){
		stop_dragDropElement();
		return;
	}
	if(document.body!=dragObject.parentNode){
		dragObject.style.width=(dragObject.offsetWidth - (dragObjectBorderWidth*2)) + 'px';
		dragObject.style.position='absolute';
		dragObject.style.textAlign='left';
		if(transparencyWhenDragging){
			dragObject.style.filter='alpha(opacity=70)';
			dragObject.style.opacity='0.7';
		}	
		dragObject.parentNode.insertBefore(rectangleDiv,dragObject);
		rectangleDiv.style.display='block';
		document.body.appendChild(dragObject);
		rectangleDiv.style.width=dragObject.style.width;
		rectangleDiv.style.height=(dragObject.offsetHeight - (dragObjectBorderWidth*2)) + 'px';
	}
	if(e.clientY<50 || e.clientY>(documentHeight-50)){
		if(e.clientY<50 && !autoScrollActive){
			autoScrollActive=true;
			autoScroll((autoScrollSpeed*-1),e.clientY);
		}		
		if(e.clientY>(documentHeight-50) && document.documentElement.scrollHeight<=documentScrollHeight && !autoScrollActive){
			autoScrollActive=true;
			autoScroll(autoScrollSpeed,e.clientY);
		}
	}else autoScrollActive=false;
	var leftPos=e.clientX;
	var topPos=e.clientY + document.documentElement.scrollTop;
	dragObject.style.left=(e.clientX - mouse_x + el_x) + 'px';
	dragObject.style.top=(el_y - mouse_y + e.clientY + document.documentElement.scrollTop) + 'px';
	if(!okToMove)return;
	okToMove=false;
	destinationObj=false;
	rectangleDiv.style.display='none';
	var objFound=false;
	var tmpParentArray=new Array();
	if(!objFound){
		for(var no=1;no<dragableBoxesArray.length;no++){
			if(dragableBoxesArray[no]['obj']==dragObject)continue;
			tmpParentArray[dragableBoxesArray[no]['obj'].parentNode.id]=true;
			if(!objFound){
				var tmpX=getLeftPos(dragableBoxesArray[no]['obj']);
				var tmpY=getTopPos(dragableBoxesArray[no]['obj']);
				if(leftPos>tmpX && leftPos<(tmpX + dragableBoxesArray[no]['obj'].offsetWidth) && topPos>(tmpY-20) && topPos<(tmpY + (dragableBoxesArray[no]['obj'].offsetHeight/2))){
					destinationObj=dragableBoxesArray[no]['obj'];
					destinationObj.parentNode.insertBefore(rectangleDiv,dragableBoxesArray[no]['obj']);
					rectangleDiv.style.display='block';
					objFound=true;
					break;
				}
				if(leftPos>tmpX && leftPos<(tmpX + dragableBoxesArray[no]['obj'].offsetWidth) && topPos>=(tmpY + (dragableBoxesArray[no]['obj'].offsetHeight/2)) && topPos<(tmpY + dragableBoxesArray[no]['obj'].offsetHeight)){
					objFound=true;
					if(dragableBoxesArray[no]['obj'].nextSibling){
						destinationObj=dragableBoxesArray[no]['obj'].nextSibling;
						if(!destinationObj.tagName)destinationObj=destinationObj.nextSibling;
						if(destinationObj!=rectangleDiv)destinationObj.parentNode.insertBefore(rectangleDiv,destinationObj);
					}else{
						destinationObj=dragableBoxesArray[no]['obj'].parentNode;
						dragableBoxesArray[no]['obj'].parentNode.appendChild(rectangleDiv);
					}
					rectangleDiv.style.display='block';
					break;
				}
				if(!dragableBoxesArray[no]['obj'].nextSibling && leftPos>tmpX && leftPos<(tmpX + dragableBoxesArray[no]['obj'].offsetWidth)
				&& topPos>topPos>(tmpY + (dragableBoxesArray[no]['obj'].offsetHeight))){
					destinationObj=dragableBoxesArray[no]['obj'].parentNode;
					dragableBoxesArray[no]['obj'].parentNode.appendChild(rectangleDiv);
					rectangleDiv.style.display='block';
					objFound=true;
				}
			}
		}
	}
	if(!objFound){
		for(var no=1;no<=numberOfColumns;no++){
			if(!objFound){
				var obj=document.getElementById('dragableBoxesColumn' + no);
				var left=getLeftPos(obj)/1;
				var width=obj.offsetWidth;
				if(leftPos>left && leftPos<(left+width)){
					destinationObj=obj;
					obj.appendChild(rectangleDiv);
					rectangleDiv.style.display='block';
					objFound=true;
				}
			}
		}
	}
	setTimeout('okToMove=true',5);
};



function stop_dragDropElement(){
	if(dragDropCounter<10){
		dragDropCounter=-1;
		return;
	}
	dragDropCounter=-1;
	if(transparencyWhenDragging){
		dragObject.style.filter=null;
		dragObject.style.opacity=null;
	}		
	dragObject.style.position='static';
	dragObject.style.width=null;
	var numericId=dragObject.id.replace(/[^0-9]/g,'');
	if(destinationObj && destinationObj.id!=dragObject.id){
		if(destinationObj.id.indexOf('dragableBoxesColumn')>=0){
			destinationObj.appendChild(dragObject);
			dragableBoxesArray[numericId]['parentObj']=destinationObj;
		}else{
			destinationObj.parentNode.insertBefore(dragObject,destinationObj);
			dragableBoxesArray[numericId]['parentObj']=destinationObj.parentNode;
		}				
	}else{
		if(dragObjectNextSibling)dragObjectParent.insertBefore(dragObject,dragObjectNextSibling);	
		else dragObjectParent.appendChild(dragObject);
	}
	autoScrollActive=false;
	rectangleDiv.style.display='none'; 
	dragObject=false;
	dragObjectNextSibling=false;
	destinationObj=false;
	if(useCookiesToRememberRSSSources)setTimeout('saveCookies()',100);
	documentHeight=document.documentElement.clientHeight;	
};

function agafarElementsColumna(n){
	var obj=document.getElementById('dragableBoxesColumn'+n).getElementsByTagName('div');
	var taula=new Array();
	for(i=0;i<obj.length;i++){
		if(  obj[i].className=='dragableBox' ){
		visible=(obj[i].style.display=='') ? 1 : 0;
		taula[taula.length]=obj[i].id.replace('dragableBox','') + '-' + visible;
		}
	}
	return taula;
};

function saveCookies(){
	avisar=(document.getElementById('avisar').checked) ? 1 : 0;
	autorun=(document.getElementById('autorun').checked) ? 1 : 0;
	valor=lang+'|'+document.getElementById('url').value.replace(/http\:\/\//i,'')+'|'+avisar+'|'+autorun+'|'+agafarElementsColumna(1).join(',') + ';' + agafarElementsColumna(2).join(',') + ';' + agafarElementsColumna(3).join(',');
	Set_Cookie(nameOfCookie,valor ,60000);
};
	
function getTopPos(inputObj){
	var returnValue=inputObj.offsetTop;
	while((inputObj=inputObj.offsetParent) != null){
		if(inputObj.tagName!='HTML')returnValue += inputObj.offsetTop;
	}
	return returnValue;
};

function getLeftPos(inputObj){
	var returnValue=inputObj.offsetLeft;
	while((inputObj=inputObj.offsetParent) != null){
		if(inputObj.tagName!='HTML')returnValue += inputObj.offsetLeft;
	}
	return returnValue;
};

function createColumns(){
	if(!columnParentBoxId){
		alert('No parent box defined for your columns');
		return;
	}
	columnParentBox=document.getElementById(columnParentBoxId);
	var columnWidth=Math.floor(100/numberOfColumns);
	var sumWidth=0;
	for(var no=0;no<numberOfColumns;no++){
		var div=document.createElement('DIV');
		if(no==(numberOfColumns-1))columnWidth=99 - sumWidth;
		sumWidth=sumWidth + columnWidth;
		div.style.cssText='float:left;width:'+columnWidth+'%;padding:0px;margin:0px;';
		div.style.height='100%';
		div.style.styleFloat='left';
		div.style.width=columnWidth + '%';
		div.style.padding='0px';
		div.style.margin='0px';
		div.id='dragableBoxesColumn' + (no+1);
		columnParentBox.appendChild(div);
		var clearObj=document.createElement('HR');
		clearObj.style.clear='both';
		clearObj.style.visibility='hidden';
		div.appendChild(clearObj);
	}	
	var clearingDiv=document.createElement('DIV');
	columnParentBox.appendChild(clearingDiv);
	clearingDiv.style.clear='both';
};

function mouseoverBoxHeader(){
	if(typeof(window['dragDropCounter'])!='undefined'){
		if(dragDropCounter==10)return;
		var id=this.id.replace(/[^0-9]/g,'');
		//document.getElementById('dragableBoxExpand' + id).style.visibility='visible';
		//document.getElementById('dragableBoxRefreshSource' + id).style.visibility='visible';
		document.getElementById('dragableBoxCloseLink' + id).style.visibility='visible';
		//if(document.getElementById('dragableBoxEditLink' + id))document.getElementById('dragableBoxEditLink' + id).style.visibility='visible';
	}
};

function mouseoutBoxHeader(e,obj){
	if(!obj)obj=this;
	var id=obj.id.replace(/[^0-9]/g,'');
	//document.getElementById('dragableBoxExpand' + id).style.visibility='hidden';
	//document.getElementById('dragableBoxRefreshSource' + id).style.visibility='hidden';
	if(mcont=document.getElementById('dragableBoxCloseLink' + id))mcont.style.visibility='hidden';
	//if(document.getElementById('dragableBoxEditLink' + id))document.getElementById('dragableBoxEditLink' + id).style.visibility='hidden';
};

function mouseover_CloseButton(){
	this.className='closeButton_over';
	setTimeout('dragDropCounter=-5',5);
};

function highlightCloseButton(){
	this.className='closeButton_over';
};

function mouseout_CloseButton(){
	this.className='closeButton';
};

function closeDragableBox(e,inputObj){
	if(!inputObj)inputObj=this;
	var numericId=inputObj.id.replace(/[^0-9]/g,'');
	document.getElementById('dragableBox' + numericId).style.display='none';
	document.getElementById('chk_' + numericId).checked =false;
	document.getElementById('sel_tot').checked =false;
	saveCookies();
	setTimeout('dragDropCounter=-5',5);
};

function addBoxHeader(parentObj,externalUrl,notDrabable,boxIndex){
	var div=document.createElement('DIV');
	div.className='dragableBoxHeader';
	div.id='dragableBoxHeader' + boxIndex;
	div.onmouseover=mouseoverBoxHeader;
	div.onmouseout=mouseoutBoxHeader;
	if(!notDrabable){
		div.onmousedown=initDragDropBox;
		div.style.cursor='move';
	}
	var textSpan=document.createElement('SPAN');
	textSpan.id='dragableBoxHeader_txt' + boxIndex;
	div.appendChild(textSpan);
	parentObj.appendChild(div);
	var closeLink=document.createElement('A');
	closeLink.style.cssText='float:right';
	closeLink.style.styleFloat='right';
	closeLink.id='dragableBoxCloseLink' + boxIndex;
	closeLink.innerHTML='x';
	closeLink.className='closeButton';
	closeLink.onmouseover=mouseover_CloseButton;
	closeLink.onmouseout=mouseout_CloseButton;
	closeLink.style.cursor='pointer';
	closeLink.style.visibility='hidden';
	closeLink.onmousedown=closeDragableBox;
	div.appendChild(closeLink);

};

function addBoxContentContainer(parentObj,heightOfBox,boxIndex){
	var div=document.createElement('DIV');
	div.className='dragableBoxContent';
	if(opera)div.style.clear='none';
	div.id='dragableBoxContent' + boxIndex;
	parentObj.appendChild(div);
	if(heightOfBox && heightOfBox/1>40){
		div.style.height=heightOfBox + 'px';
		div.setAttribute('heightOfBox',heightOfBox);
		div.heightOfBox=heightOfBox;	
		if(document.all)div.style.overflowY='auto';else div.style.overflow='-moz-scrollbars-vertical;';
		if(opera)div.style.overflow='auto';
	}
};

function createABox(columnIndex,heightOfBox,externalUrl,uniqueIdentifier,notDragable,boxIndex,visible){
	var maindiv=document.createElement('DIV');
	maindiv.className='dragableBox';
	maindiv.id='dragableBox' + boxIndex;
	maindiv.style.display=visible;
	var div=document.createElement('DIV');
	div.className='dragableBoxInner';
	maindiv.appendChild(div);
	addBoxHeader(div,externalUrl,notDragable,boxIndex);
	addBoxContentContainer(div,heightOfBox,boxIndex);
	var obj=document.getElementById('dragableBoxesColumn' + columnIndex);
	var subs=obj.getElementsByTagName('DIV');
	if(subs.length>0)obj.insertBefore(maindiv,subs[0]);
	else obj.appendChild(maindiv);
	dragableBoxesArray[boxIndex]=new Array();
	dragableBoxesArray[boxIndex]['obj']=maindiv;
	dragableBoxesArray[boxIndex]['parentObj']=maindiv.parentNode;
	dragableBoxesArray[boxIndex]['uniqueIdentifier']=uniqueIdentifier;
	dragableBoxesArray[boxIndex]['heightOfBox']=heightOfBox;
	dragableBoxesArray[boxIndex]['boxState']=1;	// Expanded
	staticObjectArray[uniqueIdentifier]=boxIndex;
	return boxIndex;
};

function createHelpObjects(){
	rectangleDiv=document.createElement('DIV');
	rectangleDiv.id='rectangleDiv';
	rectangleDiv.style.display='none';
	document.body.appendChild(rectangleDiv);
};

function cancelSelectionEvent(e){
	if(document.all)e=event;
	if (e.target) source=e.target;
		else if (e.srcElement) source=e.srcElement;
		if (source.nodeType == 3) // defeat Safari bug
			source=source.parentNode;
	if(source.tagName.toLowerCase()=='input')return true;
	if(dragDropCounter>=0)return false; else return true;
};

function cancelEvent(){
	return false;
};

function initEvents(){
	document.body.onmousemove=moveDragableElement;
	document.body.onmouseup=stop_dragDropElement;
	document.body.onselectstart=cancelSelectionEvent;
	document.body.ondragstart=cancelEvent;
	documentHeight=document.documentElement.clientHeight;
};

function createRSSBoxesFromCookie(){
	var cookieValue=Get_Cookie(nameOfCookie);
	if(cookieValue!=null){
		var l_info=cookieValue.split('|');
		cookieCounter=1;
		//lang = l_info[0];
		document.getElementById('url').value= (l_info[1]!='') ? l_info[1] : 'http://www.viciao2k3.net';
		document.getElementById('avisar').checked=(l_info[2]==1);
		document.getElementById('autorun').checked=(l_info[3]==1);
		var t_columnes=l_info[4].split(';');
		for(i=0;i<t_columnes.length;i++){
			columna=i+1;
			var t_files=t_columnes[i].split(',');
			for(j=t_files.length-1;j>=0;j--){
				info_fila=t_files[j].split('-');
				id=info_fila[0];
				visible=(parseInt(info_fila[1])==1) ? '' : 'none';
				switch(parseInt(id)){
					case 1:
					crearCaixaNormal(TXT_DIAGNOSTIC,1,columna,visible);
					break;
					case 2:
					crearCaixaNormal(TXT_BACKLINKS,2,columna,visible);
					break;
					case 3:
					crearCaixaNormal(TXT_P_INDEX,3,columna,visible);
					break;
					case 4:
					crearCaixaNormal(TXT_RANK,4,columna,visible);
					break;
					case 5:
					crearCaixaNormal(TXT_VALIDATE,5,columna,visible);
					break;
					case 6:
					crearCaixaNormal(TXT_BOOKMARKS,6,columna,visible);
					break;
					case 7:
					crearCaixaNormal(TXT_FEED,7,columna,visible);
					break;
					case 8:
					crearCaixaNormal(TXT_DOMAIN,8,columna,visible);
					break;
					case 9:
					crearCaixaNormal(TXT_PHOTO,9,columna,visible);
					break;
				}
				document.getElementById('chk_'+id).checked=(visible=='');
			}
		}
	}
};

function hideHeaderOptionsForStaticBoxes(boxIndex){
	//if(document.getElementById('dragableBoxRefreshSource' + boxIndex))document.getElementById('dragableBoxRefreshSource' + boxIndex).style.display='none';
	//if(document.getElementById('dragableBoxCloseLink' + boxIndex))document.getElementById('dragableBoxCloseLink' + boxIndex).style.display='none';	
	if(document.getElementById('dragableBoxEditLink' + boxIndex))document.getElementById('dragableBoxEditLink' + boxIndex).style.display='none';
};

function crearCaixaNormal(titol,n,columna,visible){
	var id= 'staticObject'+n;
	var htmlContentOfNewBox='<div class="info_row">';
	switch(n){
		case 1:
		htmlContentOfNewBox += dibuixarContingut2(siteinfo);
		altura=h_siteinfo;
		break;
		case 2:
		htmlContentOfNewBox += dibuixarContingut(backlinks);
		altura=h_backlinks;
		break;
		case 3:
		htmlContentOfNewBox += dibuixarContingut(inlinks);
		altura=h_inlinks;
		break;
		case 4:
		htmlContentOfNewBox += dibuixarContingut(rank);
		altura=h_rank;
		break;
		case 5:
		htmlContentOfNewBox += dibuixarContingut(valid);
		altura=h_valid;
		break;
		case 6:
		htmlContentOfNewBox += dibuixarContingut(bookmarks);
		altura=h_bookmarks;
		break;
		case 7:
		htmlContentOfNewBox += dibuixarContingut(sindicacion);
		altura=h_sindicacion;
		break;
		case 8:
		htmlContentOfNewBox += dibuixarContingut(dominio);
		altura=h_dominio;
		break;
		case 9:
		htmlContentOfNewBox += '<center><span id="i_44"><br /><br /><br /><br /><br />?</span></center>';
		altura=h_captura;
		break;
	}
	htmlContentOfNewBox += '</div>';
	var titleOfNewBox=titol;
	if(!staticObjectArray[id]){
		var newIndex=createABox(columna,altura,false,id,false,n,visible);
		document.getElementById('dragableBoxContent' + newIndex).innerHTML=htmlContentOfNewBox;
		document.getElementById('dragableBoxHeader_txt' + newIndex).innerHTML=titleOfNewBox;
	}else{
		document.getElementById('dragableBoxContent' + staticObjectArray[id]).innerHTML=htmlContentOfNewBox;
		document.getElementById('dragableBoxHeader_txt' + staticObjectArray[id]).innerHTML=titleOfNewBox;
	}
	hideHeaderOptionsForStaticBoxes(staticObjectArray[id]);
};

function createDefaultBoxes(){
	if(cookieCounter==0){
		document.getElementById('url').value= 'http://www.viciao2k3.net';
		crearCaixaNormal(TXT_VALIDATE,5,2,'');
		crearCaixaNormal(TXT_BOOKMARKS,6,2,'');
		crearCaixaNormal(TXT_DOMAIN,8,1,'');
		crearCaixaNormal(TXT_BACKLINKS,2,3,'');
		crearCaixaNormal(TXT_FEED,7,2,'');
		crearCaixaNormal(TXT_DIAGNOSTIC,1,1,'');
		crearCaixaNormal(TXT_P_INDEX,3,3,'');
		crearCaixaNormal(TXT_RANK,4,2,'');
		crearCaixaNormal(TXT_PHOTO,9,1,'');
	}
	document.getElementById('floatingBoxParentContainer').style.display='';
	cargattot=true;
	setTimeout('saveCookies()',1);
};

function initDragableBoxesScript(){
	createColumns();
	createHelpObjects();
	initEvents();
	if(useCookiesToRememberRSSSources)createRSSBoxesFromCookie();
	createDefaultBoxes();
	chkmarcartots();
};

addLoadEvent(initDragableBoxesScript);

dragDropCounter=-1;
cargattot=false;
var pas;
var gurl;
var idajax=0;
var ajax;
var obj_loading;
var avisar;
var autorun;
var souncop;
var resultats;


function getXHR(){
	var newReq=null;
	if(window.XMLHttpRequest) {
		try{
			newReq=new XMLHttpRequest();
		}catch(e){
			newReq=false;
		}
	}else if(window.ActiveXObject) {
		try{
			newReq=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				newReq=new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				newReq=false;
            }
		}
	}
	return newReq;
};

function reproduirSo(){
	document.getElementById('div_so').innerHTML='<object type="application/x-shockwave-flash" data="swf/snd.swf" width="1" height="1"><param name="movie" value="swf/snd.swf" /></object>';
};

function reiniciar(){
	idajax=0;
	souncop=false;
	document.getElementById('btn_dpdf').style.display='none';
	obj_loading=document.getElementById('loading');
	obj_loading.className='loading';
	resultats=new Array();
	taula=new Array();
	t=numeroSeleccionats();
	for(r=1;r<=t[1];r++){
		var htmlContentOfNewBox='<div class="info_row">';
		switch(r){
			case 1:
				htmlContentOfNewBox += dibuixarContingut2(siteinfo);
			break;
			case 2:
				htmlContentOfNewBox += dibuixarContingut(backlinks);
			break;
			case 3:
				htmlContentOfNewBox += dibuixarContingut(inlinks);
			break;
			case 4:
				htmlContentOfNewBox += dibuixarContingut(rank);
			break;
			case 5:
				htmlContentOfNewBox += dibuixarContingut(valid);
			break;
			case 6:
				htmlContentOfNewBox += dibuixarContingut(bookmarks);
			break;
			case 7:
				htmlContentOfNewBox += dibuixarContingut(sindicacion);
			break;
			case 8:
				htmlContentOfNewBox += dibuixarContingut(dominio);
			break;
			case 9:
				htmlContentOfNewBox += '<center><span id="i_44"><br /><br /><br /><br /><br />?</span></center>';
			break;
		}
		htmlContentOfNewBox += '</div>';
		document.getElementById('dragableBoxContent'+r).innerHTML=htmlContentOfNewBox;
	}
};

function statsTot(){
	if(cargattot){
		reiniciar();
		gurl=document.getElementById('url').value.replace(/http\:\/\//i,'');
		var cookieValue=Get_Cookie(nameOfCookie);
		if(cookieValue!=null){
			var l_info=cookieValue.split('|');
			var t_columnes=l_info[4].split(';');
			for(i=t_columnes.length-1;i>=0;i--){
				var t_files=t_columnes[i].split(',');
				for(j=t_files.length-1;j>=0;j--){
					info_fila=t_files[j].split('-');
					id=info_fila[0];
					if(parseInt(info_fila[1])==1)taula[taula.length]=id;
				}
			}
		}
		for(i=taula.length-1;i>=0;i--){
			switch(parseInt(taula[i])){
				case 1:
				quin=siteinfo;
				break;
				case 2:
				quin=backlinks;
				break;
				case 3:
				quin=inlinks;
				break;
				case 4:
				quin=rank;
				break;
				case 5:
				quin=valid;
				break;
				case 6:
				quin=bookmarks;
				break;
				case 7:
				quin=sindicacion;
				break;
				case 8:
				quin=dominio;
				break;
				case 9:
				quin=captura;
				break;
			}
			resultats=resultats.concat(quin);
		}
		if(resultats.length==0){
			obj_loading.className='';
			alert(TXT_REQUIRE);
			return false;
		}else numeroop=resultats.length;
		url='results/online.php?url='+gurl;
		id=0;
		ajax=new Array();
		ajax[id]= new getXHR();
	
		if(url.indexOf('?') >= 0)aleatori='&hash=' + Math.random();
		else aleatori='?hash=' + Math.random();
		ajax[id].open('GET', url+aleatori, true);
		ajax[id].onreadystatechange=function()
		{
			if (ajax[id].readyState==4)
			{
				if(ajax[id].responseText){
					getInfo();
					setTimeout('getInfo()',1);
				}else alert(TXT_BROKEN_URL);
			}
		};
		ajax[id].send(null);
	}
};

function $(id){
	return document.getElementById(id);
};

function getInfo(){
	ajax[idajax]= new getXHR();


if(objc = resultats[idajax]){ //para que no salte error,comprobar q existe

	nom=objc.split('-');


if(nom[0]!=27 && nom[0]!=15 && nom[0]!=17 && nom[0]!=18){
	url='results/'+nom[0]+'.php?url='+gurl+'&lang='+lang;
	setTimeout("ajax_recuperar(" + idajax + ",'"+url+ "');",2);
}else complet();



	idajax++;

}





};

function ajax_recuperar(id,url){
	if(url.indexOf('?') >= 0)aleatori='&hash=' + Math.random();
	else aleatori='?hash=' + Math.random();
	ajax[id].open('GET', url+aleatori, true);
	ajax[id].onreadystatechange=function()
	{
		if (ajax[id].readyState==4)
		{

			
			x=resultats[id];
			nom=resultats[id].split('-');
			if(obj=  $('i_'+nom[0]) ){
				if(nom[2]==1) eval(ajax[id].responseText);
				else obj.innerHTML=ajax[id].responseText;
			}



			complet();
		}
	};
	ajax[id].send(null);
};



function complet(){


souncop++;


			if(idajax<resultats.length)setTimeout("getInfo();",2);
			else {
				if(souncop==numeroop  ){
					obj_loading.className='';
					document.getElementById('btn_dpdf').style.display='';
					if(document.getElementById('avisar').checked)reproduirSo();
				}
			}

}



function numeroSeleccionats(){
	var obj=document.getElementById('header').getElementsByTagName('input');
	var contador=0;
	var elems=0;
	var taula2=new Array();
	for(i=0;i<obj.length;i++){
		if(obj[i].type=='checkbox' && obj[i].id.indexOf('chk')>-1){
			if(obj[i].checked)contador++;
			elems++;
		}
	}
	return new Array(contador,elems);
};

function chkmarcartots(){
	sels=numeroSeleccionats();
	document.getElementById('sel_tot').checked =(sels[0]==sels[1]);
};

function mostrarCaixa(id){
	var obj=document.getElementById('dragableBox'+id);
	obj.style.display=(obj.style.display=='') ? 'none' : '';
	document.getElementById('sel_tot').checked=(!obj.style.display=='none');
	chkmarcartots();
	saveCookies();
};

function mostrartodo(control){
	var obj=document.getElementById('header').getElementsByTagName('input');
	for(i=0;i<obj.length;i++){
		if(obj[i].type=='checkbox' && obj[i].id.indexOf('chk')>-1 ){
			id=obj[i].id.replace('chk_','');
			box=document.getElementById('dragableBox'+id);
			if(control.checked){
				box.style.display='';
				obj[i].checked=true;
			}else{
				box.style.display='none';
				obj[i].checked=false;
				
			}
		}
	}
	saveCookies();
};

function dibuixarContingut2(quin){
	var html='';
	for(x=0;x<quin.length;x++){
		nom=quin[x].split('-');
		html += '<div><b>'+nom[1]+'</b></div><span id="i_'+nom[0]+'">?</span>';
	}
	return html;
};

function dibuixarContingut(quin){
	var html='';
	for(x=0;x<quin.length;x++){
		nom=quin[x].split('-');
		html += '<div class=s_'+nom[0]+'><span id="i_'+nom[0]+'">?</span>'+nom[1]+':</div>';
	}
	return html;
};