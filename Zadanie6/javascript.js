var hid = 0;
function sprawdz(a, b){
    if(a == "" || b == ""){
        window.alert("Proszę wypełnić WSZYTSKIE okna!");
        return false;
    }
    else if(isNaN(a) || isNaN(b)){
        window.alert("Proszę wypełnić okna LICZBAMI!");
        return false;
    }
    else{
        return true;
    }
}

function operacje(){
    let historia = '';
    var pop = sprawdz(document.getElementById("wartosc1").value, document.getElementById("wartosc2").value);
    if(pop == true){
    const a = parseInt(document.getElementById("wartosc1").value);
    const b = parseInt(document.getElementById("wartosc2").value);
    document.getElementById("wartosc3").readOnly = true;
    
    switch(document.getElementById('operacja').value){
        case "+":
            var add = a+b;
            document.getElementById("wartosc3").value = add;
            historia += a + " + " + b + " = " + add;
            ++hid;
            document.getElementById("historia").innerHTML += "<p id = 'historia-" + hid + "'>" + historia + "</p>"; 
        break;
        case "-":
            var sub = a-b;
            document.getElementById("wartosc3").value = sub;
            historia += a + " - " + b + " = " + sub;
            ++hid;
            document.getElementById("historia").innerHTML += "<p id = 'historia-" + hid + "'>" + historia + "</p>";
        break;
        case "*":
            var mul = a*b;
            document.getElementById("wartosc3").value = mul;
            historia += a + " * " + b + " = " + mul;
            ++hid;
            document.getElementById("historia").innerHTML += "<p id = 'historia-" + hid + "'>" + historia + "</p>";
        break;
        case "/":
            var div = a/b;
            document.getElementById("wartosc3").value = div;
            historia += a + " / " + b + " = " + div;
            ++hid;
            document.getElementById("historia").innerHTML += "<p id = 'historia-" + hid + "'>" + historia + "</p>";
        break;
        case "%":
            var mod = a%b;
            document.getElementById("wartosc3").value = mod;
            historia += a + " % " + b + " = " + mod;
            ++hid;
            document.getElementById("historia").innerHTML += "<p id = 'historia-" + hid + "'>" + historia + "</p>";
        break;
    }
}
}