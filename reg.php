<html>
<head>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script>
function pass_match(pass, id){ //(password itself, id of input <input id="pass"> or <input id="pass2">)
    //IF "id" IS ONE, GET THE ID AND VALUE OF THE OTHER INPUT FOR COMPARISON
    if(id=='pass'){
        other_id = "pass2"; //ID OF OTHER
        other_pass = $('input#pass2').val(); //VALUE OF OTHER
    } else {
        if(id=='pass2'){
            other_id = "pass"; //ID OF OTHER
            other_pass = $("input#pass").val(); //VALUE OF OTHER
        }
    }
    /*IF BOTH PASSWORS ARE NOT EMPTY AND IF PASSWORDS DO NOT MATCH, DISPLAYS MESSAGE NEXT TO INPUT, ELSE CLEAR THE MESSAGE*/
    if(pass&&other_pass){
        if(pass!=other_pass){
            $("span#"+id).html("Passwords don't match");
            $("span#"+other_id).html(""); //CLEARS MESSAGE WHEN FOCUS IS BACK ON THIS INPUT
        } else {
            $("span#"+id).html("");
        }
    }
    else
    {
    $("span#"+id).html("");
    }
}
</script>
</head>
<body>
<table>
<tr><td align="right">Password: </td><td align="left"><input id="pass" onBlur="pass_match(this.value, $(this).attr('id'))" type="password"> <span id="pass"></span><br></td></tr>
<tr><td align="right">Confirm Password: </td><td align="left"><input id="pass2" onBlur="pass_match(this.value, $(this).attr('id'))" type="password"> <span id="pass2"></span></td></tr>
<tr><td align="right">Birthday: </td><td align="left"><input id="bday"> <span id="bday"></span></td></tr>
</table>
</body>
</html>