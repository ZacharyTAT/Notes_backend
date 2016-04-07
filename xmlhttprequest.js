// JavaScript Document
var xmlhttp = false;

if (window.XMLHttpRequest) {
	xmlhttp = new XMLHttpRequest();
}else if (window.ActiveXObject) {
    var versions = 
    [
        "MSXML2.XmlHttp.6.0",
        "MSXML2.XmlHttp.3.0"
    ];

    for (var i = 0; i < versions.length; i++) {
        try 
        {
        	xmlhttp = new ActiveXObject(versions[i]);
            break;
        } 
        catch (error) 
        {
          //do nothing here
        }
    }

}