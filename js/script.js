document.getElementById('register').addEventListener('click', register);

var email = document.getElementById('email');
var fname = document.getElementById('fname');
var lname = document.getElementById('lname');
var pnum = document.getElementById('pnum');
var type = document.getElementById('type');
var pass = document.getElementById('pass');

var emailerr = document.getElementById('emailerr');
var fnameerr = document.getElementById('fnameerr');
var lnameerr = document.getElementById('lnameerr');
var pnumerr = document.getElementById('pnumerr');
var typeerr = document.getElementById('typeerr');
var passerr = document.getElementById('passerr');

const success = "1px  solid green";
const error = "1px  solid red";
const message = '<i class="fa-solid fa-circle-exclamation"></i> Please input a valid data';

var nameregex = /^[a-zA-Z]+$/;
var numberregex = /^09|9|\+639\d{9}$/;
var emailregex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
var passregex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

function register(e){

    var emailvalue = email.value;
    var fnamevalue = fname.value;
    var lnamevalue = lname.value;
    var pnumvalue = pnum.value;
    var typevalue = type.value;
    var passvalue = pass.value;
            
    // no value
    if(emailvalue == "" || !emailvalue.match(emailregex)){
        emailerr.innerHTML = message;
        email.style.border = error;
        e.preventDefault();
    }else{
        emailerr.innerHTML = "";
        email.style.border = success;
    }

    if(fnamevalue == "" || !fnamevalue.match(nameregex)){
        fnameerr.innerHTML = message;
        fname.style.border = error;
        e.preventDefault();
    }else{
        fnameerr.innerHTML = "";
        fname.style.border = success;
    }

    if(lnamevalue == "" || !lnamevalue.match(nameregex)){
        lnameerr.innerHTML = message;
        lname.style.border = error;
        e.preventDefault();
    }else{
        lnameerr.innerHTML = "";
        lname.style.border = success;
    }

    if(pnumvalue == "" || !pnumvalue.match(numberregex)){
        pnumerr.innerHTML = message;
        pnum.style.border = error;
        e.preventDefault();
    }else{
        pnumerr.innerHTML = "";
        pnum.style.border = success;
    }

    if(typevalue == ""){
        typeerr.innerHTML = message;
        type.style.border = error;
        e.preventDefault();
    }else{
        typeerr.innerHTML = "";
        type.style.border = success;
    }

    if(passvalue == "" || !passvalue.match(passregex)){
        passerr.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Please input combination of uppercase and lowercase, digit and symbol with atleast 8 character';
        pass.style.border = error;
        e.preventDefault();
    }else{
        passerr.innerHTML = "";
        pass.style.border = success;
    }

}





